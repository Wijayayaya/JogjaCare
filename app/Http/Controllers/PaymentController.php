<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Payment;
use App\Models\User;

class PaymentController extends Controller
{
    private $serverKey;
    private $clientKey;
    private $isProduction;
    private $baseUrl;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->clientKey = config('midtrans.client_key');
        $this->isProduction = config('midtrans.is_production', false);
        $this->baseUrl = $this->isProduction 
            ? 'https://app.midtrans.com/snap/v1' 
            : 'https://app.sandbox.midtrans.com/snap/v1';
    }

    public function showPaymentPage()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu');
        }

        $user = Auth::user();
        
        // Check if user already has access
        if ($user->expert_system_access && $user->expert_system_expires_at > now()) {
            return redirect()->route('expert-system');
        }

        return view('frontend.payment.expert-system-payment');
    }

    public function createPayment(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $orderId = 'EXPERT-' . $user->id . '-' . time();
        $grossAmount = 50000;

        try {
            // Create payment record
            $payment = Payment::create([
                'user_id' => $user->id,
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
                'transaction_status' => 'pending',
                'expires_at' => now()->addHours(24)
            ]);

            Log::info('Payment record created', [
                'payment_id' => $payment->id,
                'order_id' => $orderId,
                'user_id' => $user->id
            ]);

            // Prepare transaction data
            $transactionData = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $grossAmount,
                ],
                'item_details' => [
                    [
                        'id' => 'expert-system-access',
                        'price' => $grossAmount,
                        'quantity' => 1,
                        'name' => 'Akses Sistem Pakar Deteksi Penyakit - 30 Hari'
                    ]
                ],
                'customer_details' => [
                    'first_name' => $user->first_name ?? $user->name,
                    'last_name' => $user->last_name ?? '',
                    'email' => $user->email,
                    'phone' => $user->phone ?? '',
                ],
                'enabled_payments' => [
                    'credit_card', 'bca_va', 'bni_va', 'bri_va', 
                    'echannel', 'permata_va', 'other_va', 'gopay', 
                    'shopeepay', 'qris'
                ],
                'callbacks' => [
                    'finish' => url('/expert-system'),
                    'error' => url('/expert-system/payment'),
                    'unfinish' => url('/expert-system/payment')
                ],
                'expiry' => [
                    'start_time' => date('Y-m-d H:i:s O'),
                    'unit' => 'hours',
                    'duration' => 24
                ]
            ];

            // Create Snap Token using cURL
            $snapToken = $this->createSnapToken($transactionData);
            
            if (!$snapToken) {
                throw new \Exception('Failed to create Snap Token');
            }

            // Update payment with snap token
            $payment->update(['snap_token' => $snapToken]);

            Log::info('Snap token created successfully', [
                'order_id' => $orderId,
                'snap_token' => substr($snapToken, 0, 20) . '...'
            ]);

            return response()->json([
                'snap_token' => $snapToken,
                'order_id' => $orderId
            ]);

        } catch (\Exception $e) {
            Log::error('Payment Creation Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => $user->id
            ]);
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function createSnapToken($transactionData)
    {
        $url = $this->baseUrl . '/transactions';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($transactionData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($this->serverKey . ':')
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 201) {
            Log::error('Midtrans API Error', [
                'http_code' => $httpCode,
                'response' => $response,
                'url' => $url
            ]);
            return false;
        }

        $responseData = json_decode($response, true);
        return $responseData['token'] ?? false;
    }

    public function handleNotification(Request $request)
    {
        try {
            Log::info('=== MIDTRANS NOTIFICATION START ===');
            Log::info('Raw Input:', $request->all());
            Log::info('Headers:', $request->headers->all());
            
            // Verify notification signature
            $orderId = $request->order_id;
            $statusCode = $request->status_code;
            $grossAmount = $request->gross_amount;
            $serverKey = $this->serverKey;
            
            Log::info('Signature Verification:', [
                'order_id' => $orderId,
                'status_code' => $statusCode,
                'gross_amount' => $grossAmount,
                'server_key_masked' => substr($serverKey, 0, 10) . '...'
            ]);
            
            $signatureKey = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
            
            if ($signatureKey !== $request->signature_key) {
                Log::warning('Invalid signature', [
                    'expected' => $signatureKey,
                    'received' => $request->signature_key
                ]);
                return response()->json(['message' => 'Invalid signature'], 400);
            }

            $transactionStatus = $request->transaction_status;
            $fraudStatus = $request->fraud_status ?? null;
            $transactionId = $request->transaction_id;

            Log::info('Transaction Details:', [
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'transaction_id' => $transactionId
            ]);

            $payment = Payment::where('order_id', $orderId)->first();
            
            if (!$payment) {
                Log::warning('Payment not found', ['order_id' => $orderId]);
                return response()->json(['message' => 'Payment not found'], 404);
            }

            Log::info('Payment found:', [
                'payment_id' => $payment->id,
                'user_id' => $payment->user_id,
                'current_status' => $payment->transaction_status
            ]);

            // Update payment details
            $payment->update([
                'transaction_id' => $transactionId,
                'transaction_status' => $transactionStatus,
                'fraud_status' => $fraudStatus,
                'payment_type' => $request->payment_type ?? null,
                'va_number' => isset($request->va_numbers[0]['va_number']) ? $request->va_numbers[0]['va_number'] : null,
                'bank' => isset($request->va_numbers[0]['bank']) ? $request->va_numbers[0]['bank'] : null,
                'payment_code' => $request->payment_code ?? null,
                'pdf_url' => $request->pdf_url ?? null,
                'status_message' => $request->status_message ?? null,
            ]);

            Log::info('Payment updated successfully');

            // Handle transaction status
            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                Log::info('Payment successful, checking fraud status');
                
                if ($fraudStatus == 'accept' || $fraudStatus == null) {
                    Log::info('Fraud check passed, granting access');
                    
                    // Payment successful - grant access
                    $user = User::find($payment->user_id);
                    
                    if ($user) {
                        $user->update([
                            'expert_system_access' => true,
                            'expert_system_expires_at' => now()->addDays(30)
                        ]);
                        
                        $payment->update(['paid_at' => now()]);
                        
                        Log::info('Access granted successfully', [
                            'user_id' => $user->id,
                            'user_email' => $user->email,
                            'expires_at' => now()->addDays(30)->toDateTimeString()
                        ]);
                    } else {
                        Log::error('User not found', ['user_id' => $payment->user_id]);
                    }
                } else {
                    Log::warning('Fraud check failed', ['fraud_status' => $fraudStatus]);
                }
            } else {
                Log::info('Payment not settled yet', ['status' => $transactionStatus]);
            }

            Log::info('=== MIDTRANS NOTIFICATION END ===');
            return response()->json(['message' => 'Notification handled successfully']);

        } catch (\Exception $e) {
            Log::error('Notification Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function manualCheckStatus(Request $request)
    {
        $orderId = $request->input('order_id');
        
        if (!$orderId) {
            return response()->json(['error' => 'Order ID required'], 400);
        }
        
        try {
            Log::info('Manual status check for order: ' . $orderId);
            
            // Get payment from database
            $payment = Payment::where('order_id', $orderId)->first();
            
            if (!$payment) {
                return response()->json(['error' => 'Payment not found'], 404);
            }
            
            // Check status from Midtrans
            $status = $this->getTransactionStatus($orderId);
            
            if ($status) {
                Log::info('Status from Midtrans:', $status);
                
                // Update payment
                $payment->update([
                    'transaction_status' => $status['transaction_status'],
                    'fraud_status' => $status['fraud_status'] ?? null,
                    'payment_type' => $status['payment_type'] ?? $payment->payment_type,
                ]);
                
                // Grant access if payment successful
                if ($status['transaction_status'] == 'settlement' || $status['transaction_status'] == 'capture') {
                    if (($status['fraud_status'] ?? null) == 'accept' || ($status['fraud_status'] ?? null) == null) {
                        $user = User::find($payment->user_id);
                        
                        if ($user) {
                            $user->update([
                                'expert_system_access' => true,
                                'expert_system_expires_at' => now()->addDays(30)
                            ]);
                            
                            $payment->update(['paid_at' => now()]);
                            
                            Log::info('Access granted via manual check', [
                                'user_id' => $user->id,
                                'expires_at' => now()->addDays(30)
                            ]);
                            
                            return response()->json([
                                'success' => true,
                                'message' => 'Access granted successfully',
                                'redirect_url' => route('expert-system')
                            ]);
                        }
                    }
                }
            }
            
            return response()->json([
                'success' => false,
                'status' => $payment->transaction_status,
                'message' => 'Payment not completed yet'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Manual check error:', [
                'order_id' => $orderId,
                'error' => $e->getMessage()
            ]);
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function getTransactionStatus($orderId)
    {
        $url = ($this->isProduction ? 'https://api.midtrans.com' : 'https://api.sandbox.midtrans.com') . '/v2/' . $orderId . '/status';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'Authorization: Basic ' . base64_encode($this->serverKey . ':')
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            Log::error('Failed to get transaction status', [
                'order_id' => $orderId,
                'http_code' => $httpCode,
                'response' => $response
            ]);
            return false;
        }

        return json_decode($response, true);
    }

    public function checkPaymentStatus($orderId)
    {
        $payment = Payment::where('order_id', $orderId)->first();
        
        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        return response()->json([
            'status' => $payment->transaction_status,
            'payment_type' => $payment->payment_type,
            'va_number' => $payment->va_number,
            'bank' => $payment->bank,
            'payment_code' => $payment->payment_code,
            'pdf_url' => $payment->pdf_url,
            'expires_at' => $payment->expires_at,
            'paid_at' => $payment->paid_at
        ]);
    }
}