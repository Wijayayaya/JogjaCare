<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CustomerServiceController extends Controller
{
    public function index()
    {
        try {
            // Check authentication
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            // Get active sessions using raw query
            $sessions = DB::select("
                SELECT 
                    cs.id,
                    cs.user_id,
                    cs.admin_id,
                    cs.status,
                    cs.last_activity,
                    u.name as user_name,
                    admin.name as admin_name,
                    (SELECT message FROM chat_messages WHERE user_id = cs.user_id ORDER BY created_at DESC LIMIT 1) as latest_message,
                    (SELECT COUNT(*) FROM chat_messages WHERE user_id = cs.user_id AND sender_type = 'user' AND is_read = 0) as unread_count
                FROM chat_sessions cs
                LEFT JOIN users u ON cs.user_id = u.id
                LEFT JOIN users admin ON cs.admin_id = admin.id
                WHERE cs.status = 'active'
                ORDER BY cs.last_activity DESC
            ");

            // Convert to collection-like objects
            $sessions = collect($sessions)->map(function($session) {
                return (object)[
                    'id' => $session->id,
                    'user_id' => $session->user_id,
                    'user' => (object)['name' => $session->user_name],
                    'admin' => $session->admin_name ? (object)['name' => $session->admin_name] : null,
                    'status' => $session->status,
                    'last_activity' => \Carbon\Carbon::parse($session->last_activity),
                    'latestMessage' => $session->latest_message ? (object)['message' => $session->latest_message] : null,
                    'unread_count' => $session->unread_count
                ];
            });

            return view('backend.customer-service.index', compact('sessions'));

        } catch (\Exception $e) {
            Log::error('Error loading customer service index', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id()
            ]);

            return back()->with('error', 'Error loading customer service data: ' . $e->getMessage());
        }
    }

    public function showChat($userId)
    {
        try {
            // Check authentication
            if (!Auth::check()) {
                return redirect()->route('login');
            }

            // Get session
            $session = DB::selectOne("
                SELECT cs.*, u.name as user_name
                FROM chat_sessions cs
                LEFT JOIN users u ON cs.user_id = u.id
                WHERE cs.user_id = ?
            ", [$userId]);
            
            if (!$session) {
                return redirect()->route('backend.customer-service.index')
                    ->with('error', 'Chat session not found');
            }

            // Get messages
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
            ", [$userId]);

            // Mark user messages as read
            DB::update("
                UPDATE chat_messages 
                SET is_read = 1 
                WHERE user_id = ? AND sender_type = 'user' AND is_read = 0
            ", [$userId]);

            // Convert to objects
            $session = (object)[
                'id' => $session->id,
                'user_id' => $session->user_id,
                'user' => (object)['name' => $session->user_name],
                'status' => $session->status
            ];

            $messages = collect($messages)->map(function($message) {
                return (object)[
                    'id' => $message->id,
                    'message' => $message->message,
                    'sender_type' => $message->sender_type,
                    'created_at' => \Carbon\Carbon::parse($message->created_at),
                    'user' => (object)['name' => $message->user_name],
                    'admin' => $message->admin_name ? (object)['name' => $message->admin_name] : null
                ];
            });

            return view('backend.customer-service.chat', compact('session', 'messages'));

        } catch (\Exception $e) {
            Log::error('Error loading customer service chat', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
                'target_user_id' => $userId
            ]);

            return redirect()->route('backend.customer-service.index')
                ->with('error', 'Error loading chat: ' . $e->getMessage());
        }
    }

    public function sendMessage(Request $request, $userId)
    {
        try {
            // Check authentication
            if (!Auth::check()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Not authenticated'
                ], 401);
            }

            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            $admin = Auth::user();
            
            // Update session with admin assignment
            DB::update("
                UPDATE chat_sessions 
                SET admin_id = ?, last_activity = NOW(), updated_at = NOW()
                WHERE user_id = ?
            ", [$admin->id, $userId]);

            // Create message
            $messageId = DB::table('chat_messages')->insertGetId([
                'user_id' => $userId,
                'admin_id' => $admin->id,
                'message' => $request->message,
                'sender_type' => 'admin',
                'is_read' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => [
                    'id' => $messageId,
                    'message' => $request->message,
                    'sender_type' => 'admin',
                    'created_at' => now()->format('H:i'),
                    'sender_name' => $admin->name
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error sending admin message', [
                'error' => $e->getMessage(),
                'admin_id' => Auth::id(),
                'user_id' => $userId
            ]);

            return response()->json([
                'success' => false,
                'error' => 'Failed to send message: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getNewMessages(Request $request, $userId)
    {
        try {
            // Check authentication
            if (!Auth::check()) {
                return response()->json(['messages' => []], 401);
            }

            $lastMessageId = $request->get('last_message_id', 0);

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
            ", [$userId, $lastMessageId]);

            // Mark user messages as read
            if (!empty($messages)) {
                DB::update("
                    UPDATE chat_messages 
                    SET is_read = 1 
                    WHERE user_id = ? AND sender_type = 'user' AND is_read = 0
                ", [$userId]);
            }

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
            Log::error('Error getting new admin messages', [
                'error' => $e->getMessage(),
                'admin_id' => Auth::id(),
                'user_id' => $userId
            ]);

            return response()->json(['messages' => []]);
        }
    }

    public function getActiveSessions()
    {
        try {
            // Check authentication
            if (!Auth::check()) {
                return response()->json(['sessions' => []], 401);
            }

            $sessions = DB::select("
                SELECT 
                    cs.user_id,
                    cs.last_activity,
                    u.name as user_name,
                    (SELECT message FROM chat_messages WHERE user_id = cs.user_id ORDER BY created_at DESC LIMIT 1) as latest_message,
                    (SELECT COUNT(*) FROM chat_messages WHERE user_id = cs.user_id AND sender_type = 'user' AND is_read = 0) as unread_count
                FROM chat_sessions cs
                LEFT JOIN users u ON cs.user_id = u.id
                WHERE cs.status = 'active'
                ORDER BY cs.last_activity DESC
            ");

            $formattedSessions = array_map(function($session) {
                return [
                    'user_id' => $session->user_id,
                    'user_name' => $session->user_name,
                    'last_message' => $session->latest_message ?: '',
                    'last_activity' => \Carbon\Carbon::parse($session->last_activity)->diffForHumans(),
                    'unread_count' => $session->unread_count
                ];
            }, $sessions);

            return response()->json([
                'sessions' => $formattedSessions
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting active sessions', [
                'error' => $e->getMessage(),
                'admin_id' => Auth::id()
            ]);

            return response()->json(['sessions' => []]);
        }
    }
}
