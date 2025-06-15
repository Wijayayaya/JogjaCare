<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerServiceChatController extends Controller
{
    public function initializeChat()
    {
        try {
            // Check authentication first
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'error' => 'User not authenticated',
                    'messages' => [],
                    'user_name' => 'Guest'
                ], 401);
            }

            $user = Auth::user();
            Log::info('Initializing customer service chat', ['user_id' => $user->id]);

            // Check if tables exist
            if (!$this->tablesExist()) {
                Log::error('Database tables do not exist');
                return response()->json([
                    'success' => false,
                    'error' => 'Database tables not found. Please run migrations.',
                    'messages' => [],
                    'user_name' => $user->name
                ], 500);
            }

            // Get existing messages using raw query for better error handling
            $messages = DB::select("
                SELECT 
                    cm.id,
                    cm.message,
                    cm.sender_type,
                    cm.created_at,
                    u1.name as user_name,
                    u2.name as admin_name
                FROM chat_messages cm
                LEFT JOIN users u1 ON cm.user_id = u1.id
                LEFT JOIN users u2 ON cm.admin_id = u2.id
                WHERE cm.user_id = ?
                ORDER BY cm.created_at ASC
                LIMIT 50
            ", [$user->id]);

            // Mark admin messages as read
            DB::update("
                UPDATE chat_messages 
                SET is_read = 1 
                WHERE user_id = ? AND sender_type = 'admin' AND is_read = 0
            ", [$user->id]);

            // Format messages
            $formattedMessages = array_map(function($message) {
                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_type' => $message->sender_type,
                    'created_at' => date('H:i', strtotime($message->created_at)),
                    'sender_name' => $message->sender_type === 'user' 
                        ? $message->user_name 
                        : ($message->admin_name ?: 'Admin')
                ];
            }, $messages);

            Log::info('Customer service chat initialized successfully', [
                'user_id' => $user->id,
                'message_count' => count($formattedMessages)
            ]);

            return response()->json([
                'success' => true,
                'messages' => $formattedMessages,
                'user_name' => $user->name
            ]);

        } catch (\Exception $e) {
            Log::error('Error initializing customer service chat', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Database error: ' . $e->getMessage(),
                'messages' => [],
                'user_name' => Auth::user()->name ?? 'User'
            ], 500);
        }
    }

    public function sendMessage(Request $request)
    {
        try {
            // Check authentication first
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'error' => 'User not authenticated'
                ], 401);
            }

            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            $user = Auth::user();

            // Check if tables exist
            if (!$this->tablesExist()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Database tables not found'
                ], 500);
            }

            // Create or update chat session using raw query
            DB::statement("
                INSERT INTO chat_sessions (user_id, status, last_activity, created_at, updated_at) 
                VALUES (?, 'active', NOW(), NOW(), NOW())
                ON DUPLICATE KEY UPDATE 
                status = 'active', 
                last_activity = NOW(), 
                updated_at = NOW()
            ", [$user->id]);

            // Insert message using raw query
            $messageId = DB::table('chat_messages')->insertGetId([
                'user_id' => $user->id,
                'message' => $request->message,
                'sender_type' => 'user',
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Log::info('Customer service message sent', [
                'user_id' => $user->id,
                'message_id' => $messageId
            ]);

            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $messageId,
                    'message' => $request->message,
                    'sender_type' => 'user',
                    'created_at' => now()->format('H:i'),
                    'user_name' => $user->name
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error sending customer service message', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Failed to send message: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getMessages(Request $request)
    {
        try {
            // Check authentication first
            if (!Auth::check()) {
                return response()->json(['messages' => []], 401);
            }

            $user = Auth::user();
            $lastMessageId = $request->get('last_message_id', 0);

            // Get new messages using raw query
            $messages = DB::select("
                SELECT 
                    cm.id,
                    cm.message,
                    cm.sender_type,
                    cm.created_at,
                    u1.name as user_name,
                    u2.name as admin_name
                FROM chat_messages cm
                LEFT JOIN users u1 ON cm.user_id = u1.id
                LEFT JOIN users u2 ON cm.admin_id = u2.id
                WHERE cm.user_id = ? AND cm.id > ?
                ORDER BY cm.created_at ASC
            ", [$user->id, $lastMessageId]);

            // Mark admin messages as read
            if (!empty($messages)) {
                DB::update("
                    UPDATE chat_messages 
                    SET is_read = 1 
                    WHERE user_id = ? AND sender_type = 'admin' AND is_read = 0
                ", [$user->id]);
            }

            // Format messages
            $formattedMessages = array_map(function($message) {
                return [
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_type' => $message->sender_type,
                    'created_at' => date('H:i', strtotime($message->created_at)),
                    'sender_name' => $message->sender_type === 'user' 
                        ? $message->user_name 
                        : ($message->admin_name ?: 'Admin')
                ];
            }, $messages);

            return response()->json([
                'messages' => $formattedMessages
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting customer service messages', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);

            return response()->json(['messages' => []]);
        }
    }

    private function tablesExist()
    {
        try {
            $tables = ['chat_sessions', 'chat_messages', 'users'];
            foreach ($tables as $table) {
                $exists = DB::select("SHOW TABLES LIKE '{$table}'");
                if (empty($exists)) {
                    Log::error("Table {$table} does not exist");
                    return false;
                }
            }
            return true;
        } catch (\Exception $e) {
            Log::error('Error checking table existence', ['error' => $e->getMessage()]);
            return false;
        }
    }
}
