{{-- resources/views/frontend/payment/health-information-payment.blade.php --}}
@extends('frontend.layouts.app')

@section('title')
    {{ __('Berlangganan Informasi Kesehatan Premium') }}
@endsection

@push('after-styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .pricing-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .pricing-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        
        .feature-check {
            animation: checkmark 0.5s ease-in-out;
        }
        
        @keyframes checkmark {
            0% { transform: scale(0); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        
        .payment-loading {
            display: none;
        }
        
        .payment-loading.active {
            display: flex;
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-emerald-600 via-teal-600 to-cyan-700 text-white py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)" />
            </svg>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-8 animate-pulse">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                
                <h1 class   ="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Akses <span class="text-emerald-200">Premium</span>
                </h1>
                <p class="text-xl md:text-2xl mb-10 opacity-90 max-w-3xl mx-auto leading-relaxed">
                    Dapatkan akses penuh ke Platform Edukasi Kesehatan dengan konten premium dan fitur lengkap
                </p>
                
                <!-- Disclaimer Penting -->
                <div class="bg-red-50/20 border border-red-300 rounded-xl p-4 mb-8 max-w-2xl mx-auto">
                    <p class="text-red-100 font-semibold text-sm">
                        ⚠️ Platform edukasi kesehatan - Bukan pengganti konsultasi medis profesional
                    </p>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 py-16 max-w-6xl">
        <!-- Pricing Section -->
        <div class="max-w-4xl mx-auto">
            <!-- Main Pricing Card -->
            <div class="pricing-card bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden mb-12">
                <div class="bg-gradient-to-r from-emerald-500 to-teal-600 p-8 text-white text-center">
                    <h2 class="text-3xl font-bold mb-2">Edukasi Kesehatan Premium</h2>
                    <p class="text-emerald-100 text-lg">Akses penuh selama 30 hari</p>
                    <div class="mt-6">
                        <span class="text-5xl font-bold">Rp 50.000</span>
                        <span class="text-emerald-200 text-lg">/bulan</span>
                    </div>
                </div>
                
                <div class="p-8">
                    <div class="grid md:grid-cols-2 gap-8 mb-8">
                        <!-- Features List -->
                        <div>
                            <h3 class="text-xl font-semibold mb-6 text-gray-800 dark:text-white">Fitur yang Anda Dapatkan:</h3>
                            <ul class="space-y-4">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-emerald-500 mr-3 feature-check" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700 dark:text-gray-300">Informasi gejala lengkap</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-emerald-500 mr-3 feature-check" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700 dark:text-gray-300">Database 50+ topik kesehatan</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-emerald-500 mr-3 feature-check" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700 dark:text-gray-300">Tips perawatan kesehatan</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-emerald-500 mr-3 feature-check" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700 dark:text-gray-300">Panduan kapan ke dokter</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-emerald-500 mr-3 feature-check" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700 dark:text-gray-300">Akses unlimited selama 30 hari</span>
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-emerald-500 mr-3 feature-check" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-gray-700 dark:text-gray-300">Cetak informasi kesehatan</span>
                                </li>
                            </ul>
                        </div>
                        
                        <!-- Payment Methods -->
                        <div>
                            <h3 class="text-xl font-semibold mb-6 text-gray-800 dark:text-white">Metode Pembayaran:</h3>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg text-center">
                                    <div class="text-2xl mb-1">💳</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">Kartu Kredit</div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg text-center">
                                    <div class="text-2xl mb-1">🏦</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">Virtual Account</div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg text-center">
                                    <div class="text-2xl mb-1">📱</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">E-Wallet</div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg text-center">
                                    <div class="text-2xl mb-1">🔄</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">QRIS</div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg text-center">
                                    <div class="text-2xl mb-1">🛒</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">ShopeePay</div>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg text-center">
                                    <div class="text-2xl mb-1">🟢</div>
                                    <div class="text-xs text-gray-600 dark:text-gray-400">GoPay</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Button -->
                    <div class="text-center">
                        <button id="payButton" class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-12 py-4 rounded-xl font-bold text-lg hover:from-emerald-700 hover:to-teal-700 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                            <span class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                Bayar Sekarang - Rp 50.000
                            </span>
                        </button>
                        
                        <!-- Loading State -->
                        <div id="paymentLoading" class="payment-loading items-center justify-center mt-4">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-emerald-600 mr-3"></div>
                            <span class="text-gray-600 dark:text-gray-400">Memproses pembayaran...</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Security Notice -->
            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-6 mb-8">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">Pembayaran Aman & Terpercaya</h4>
                        <p class="text-sm text-blue-700 dark:text-blue-400">
                            Pembayaran diproses melalui Midtrans dengan enkripsi SSL 256-bit. Data kartu kredit Anda tidak disimpan di server kami.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Medical Disclaimer -->
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-6 mb-8">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h4 class="font-semibold text-red-800 dark:text-red-300 mb-2">⚠️ Penting - Platform Edukasi Kesehatan</h4>
                        <p class="text-sm text-red-700 dark:text-red-400">
                            Platform ini hanya untuk edukasi kesehatan dan TIDAK menggantikan konsultasi medis profesional. Selalu konsultasikan kondisi kesehatan Anda dengan dokter yang berkualifikasi.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- FAQ Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white text-center">Pertanyaan Umum</h3>
                <div class="space-y-6">
                    <div>
                        <h4 class="font-semibold text-gray-800 dark:text-white mb-2">Apakah platform ini menggantikan konsultasi dokter?</h4>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">Tidak. Platform ini hanya memberikan informasi edukasi kesehatan umum. Selalu konsultasikan dengan dokter untuk diagnosis dan pengobatan yang akurat.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800 dark:text-white mb-2">Berapa lama akses berlaku?</h4>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">Akses berlaku selama 30 hari sejak pembayaran berhasil. Anda dapat menggunakan semua fitur edukasi kesehatan tanpa batas selama periode tersebut.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800 dark:text-white mb-2">Apa saja yang termasuk dalam paket premium?</h4>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">Paket premium mencakup akses ke informasi gejala lengkap, tips perawatan kesehatan, artikel premium, kuis interaktif, dan panduan kapan harus mencari bantuan medis.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800 dark:text-white mb-2">Apakah ada garansi uang kembali?</h4>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">Ya, kami memberikan garansi uang kembali 100% dalam 7 hari pertama jika Anda tidak puas dengan konten edukasi yang disediakan.</p>
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800 dark:text-white mb-2">Apakah informasi yang diberikan akurat?</h4>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">Semua informasi edukasi kesehatan disusun berdasarkan sumber terpercaya dan ditinjau oleh tenaga kesehatan. Namun, informasi ini bersifat umum dan tidak menggantikan konsultasi medis personal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
<script>
document.getElementById('payButton').addEventListener('click', function() {
    const button = this;
    const loading = document.getElementById('paymentLoading');
    
    // Show loading state
    button.disabled = true;
    button.style.opacity = '0.6';
    loading.classList.add('active');
    
    // Create payment
    fetch('{{ route("payment.create") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Payment creation response:', data);
        
        if (data.snap_token) {
            // Open Midtrans Snap
            snap.pay(data.snap_token, {
                onSuccess: function(result) {
                    console.log('Payment success:', result);
                    
                    // Show success message
                    alert('Pembayaran berhasil! Memverifikasi pembayaran...');
                    
                    // Check payment status manually
                    checkPaymentStatusManual(data.order_id, 0);
                },
                onPending: function(result) {
                    console.log('Payment pending:', result);
                    alert('Pembayaran sedang diproses. Silakan selesaikan pembayaran Anda.');
                    checkPaymentStatusManual(data.order_id, 0);
                },
                onError: function(result) {
                    console.log('Payment error:', result);
                    alert('Terjadi kesalahan dalam pembayaran. Silakan coba lagi.');
                    resetButton();
                },
                onClose: function() {
                    console.log('Payment popup closed');
                    resetButton();
                }
            });
        } else {
            alert('Terjadi kesalahan. Silakan coba lagi.');
            resetButton();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan. Silakan coba lagi.');
        resetButton();
    });
    
    function resetButton() {
        button.disabled = false;
        button.style.opacity = '1';
        loading.classList.remove('active');
    }
    
    function checkPaymentStatusManual(orderId, attempt) {
        console.log(`Checking payment status manually for: ${orderId}, attempt: ${attempt + 1}`);
        
        fetch('{{ route("payment.manual-check") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                order_id: orderId
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Manual check result:', data);
            
            if (data.success) {
                // Success - redirect to health information system
                alert('Pembayaran berhasil diverifikasi! Anda akan diarahkan ke platform edukasi kesehatan premium.');
                window.location.href = '{{ route("expert-system") }}';
            } else {
                // Not successful yet, try again up to 15 times
                if (attempt < 15) {
                    setTimeout(() => {
                        checkPaymentStatusManual(orderId, attempt + 1);
                    }, 2000); // Check every 2 seconds
                } else {
                    // After 15 attempts still failed, give manual option
                    alert('Pembayaran mungkin masih diproses. Silakan refresh halaman atau coba akses platform edukasi kesehatan langsung dalam beberapa menit.');
                    resetButton();
                }
            }
        })
        .catch(error => {
            console.error('Manual check error:', error);
            
            // Fallback: try again
            if (attempt < 10) {
                setTimeout(() => {
                    checkPaymentStatusManual(orderId, attempt + 1);
                }, 3000);
            } else {
                alert('Terjadi kesalahan verifikasi. Silakan coba akses platform edukasi kesehatan langsung atau hubungi support.');
                resetButton();
            }
        });
    }
});
</script>
@endpush
