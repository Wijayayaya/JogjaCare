<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ChatController extends Controller
{
    // Define allowed admin IDs
    private $allowedAdminIds = [1, 6];

    /**
     * Check if current user is authorized admin
     */
    private function checkAdminAccess()
    {
        if (!Auth::check() || !in_array(Auth::id(), $this->allowedAdminIds)) {
            abort(403, 'Unauthorized access to chat system');
        }
    }

    public function index()
    {
        $this->checkAdminAccess();
        
        try {
            // Check if tables exist first
            if (!Schema::hasTable('chat_sessions') || !Schema::hasTable('chat_messages')) {
                // Return empty view if tables don't exist
                $chatSessions = collect();
                $totalUnreadCount = 0;
                return view('dashboardadmin.chat.index', compact('chatSessions', 'totalUnreadCount'));
            }

            // Get all users who have sent messages (create sessions if they don't exist)
            $usersWithMessages = ChatMessage::select('user_id')
                ->groupBy('user_id')
                ->pluck('user_id');

            // Create chat sessions for users who don't have them
            foreach ($usersWithMessages as $userId) {
                ChatSession::firstOrCreate(
                    ['user_id' => $userId],
                    [
                        'admin_id' => Auth::id(),
                        'status' => 'active',
                        'last_activity' => now()
                    ]
                );
            }

            // Get all chat sessions with latest messages
            $chatSessions = ChatSession::with(['user', 'admin'])
                ->whereHas('user') // Make sure user exists
                ->orderBy('last_activity', 'desc')
                ->get();

            // Add latest message and unread count to each session
            foreach ($chatSessions as $session) {
                $session->latestMessage = ChatMessage::where('user_id', $session->user_id)
                    ->orderBy('created_at', 'desc')
                    ->first();
                
                $session->unread_count = ChatMessage::where('user_id', $session->user_id)
                    ->where('sender_type', 'user')
                    ->where('is_read', false)
                    ->count();
            }

            // Get total statistics
            $totalUnreadCount = ChatMessage::whereIn('user_id', $chatSessions->pluck('user_id'))
                ->where('sender_type', 'user')
                ->where('is_read', false)
                ->count();

            return view('dashboardadmin.chat.index', compact('chatSessions', 'totalUnreadCount'));
        } catch (\Exception $e) {
            Log::error('Chat index error: ' . $e->getMessage());
            // If there's an error, return empty view
            $chatSessions = collect();
            $totalUnreadCount = 0;
            return view('dashboardadmin.chat.index', compact('chatSessions', 'totalUnreadCount'));
        }
    }

    public function getMessages($userId)
    {
        $this->checkAdminAccess();
        
        try {
            $user = User::findOrFail($userId);
            
            $messages = ChatMessage::where('user_id', $userId)
                ->with(['admin'])
                ->orderBy('created_at', 'asc')
                ->get();

            // Mark user messages as read
            ChatMessage::where('user_id', $userId)
                ->where('sender_type', 'user')
                ->where('is_read', false)
                ->update(['is_read' => true]);

            // Update session activity
            $session = ChatSession::where('user_id', $userId)->first();
            if ($session) {
                $session->update(['last_activity' => now()]);
            }

            return response()->json([
                'success' => true,
                'messages' => $messages,
                'user_name' => $user->name,
                'user_email' => $user->email
            ]);
        } catch (\Exception $e) {
            Log::error('Get messages error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'messages' => [],
                'user_name' => 'Unknown User',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function sendMessage(Request $request)
    {
        $this->checkAdminAccess();
        
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'message' => 'required|string|max:1000'
            ]);

            $currentAdminId = Auth::id();

            DB::beginTransaction();

            // Create or update chat session
            $chatSession = ChatSession::firstOrCreate(
                ['user_id' => $request->user_id],
                [
                    'admin_id' => $currentAdminId,
                    'status' => 'active',
                    'last_activity' => now()
                ]
            );

            // Update session activity and admin if different
            $chatSession->update([
                'admin_id' => $currentAdminId,
                'last_activity' => now()
            ]);

            // Create message
            $message = ChatMessage::create([
                'user_id' => $request->user_id,
                'admin_id' => $currentAdminId,
                'message' => trim($request->message),
                'sender_type' => 'admin',
                'is_read' => false
            ]);

            DB::commit();

            // Load admin relationship
            $message->load('admin');

            return response()->json([
                'success' => true,
                'message' => $message,
                'admin_name' => Auth::user()->name
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Send message error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function markAsRead($userId)
    {
        $this->checkAdminAccess();
        
        try {
            $updated = ChatMessage::where('user_id', $userId)
                ->where('sender_type', 'user')
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return response()->json([
                'success' => true,
                'updated_count' => $updated
            ]);
        } catch (\Exception $e) {
            Log::error('Mark as read error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteSession($sessionId)
    {
        $this->checkAdminAccess();
        
        try {
            $session = ChatSession::findOrFail($sessionId);

            // Mark session as closed instead of deleting
            $session->update([
                'status' => 'closed'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Chat session closed successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Delete session error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getUnreadCount()
    {
        $this->checkAdminAccess();
        
        try {
            $unreadCount = ChatMessage::where('sender_type', 'user')
                ->where('is_read', false)
                ->count();

            return response()->json([
                'success' => true,
                'unread_count' => $unreadCount
            ]);
        } catch (\Exception $e) {
            Log::error('Get unread count error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function assignToAdmin(Request $request, $sessionId)
    {
        $this->checkAdminAccess();
        
        try {
            $request->validate([
                'admin_id' => 'required|in:1,6'
            ]);

            $session = ChatSession::findOrFail($sessionId);

            $session->update([
                'admin_id' => $request->admin_id,
                'last_activity' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Chat session assigned successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Assign to admin error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
