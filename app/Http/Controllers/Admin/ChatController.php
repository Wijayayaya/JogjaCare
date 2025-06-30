<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        try {
            // Get all users who have sent messages (create sessions if they don't exist)
            $usersWithMessages = ChatMessage::select('user_id')
                ->groupBy('user_id')
                ->pluck('user_id');

            // Create chat sessions for users who don't have them
            foreach ($usersWithMessages as $userId) {
                ChatSession::firstOrCreate(
                    ['user_id' => $userId],
                    [
                        'admin_id' => 18,
                        'status' => 'active',
                        'last_activity' => now()
                    ]
                );
            }

            // Get all chat sessions with latest messages
            $chatSessions = ChatSession::with(['user'])
                ->whereHas('user') // Make sure user exists
                ->orderBy('last_activity', 'desc')
                ->get();

            // Add latest message to each session
            foreach ($chatSessions as $session) {
                $session->latestMessage = ChatMessage::where('user_id', $session->user_id)
                    ->orderBy('created_at', 'desc')
                    ->first();
            }

            return view('dashboardadmin.chat.index', compact('chatSessions'));
        } catch (\Exception $e) {
            // If there's an error (like tables don't exist), return empty view
            $chatSessions = collect();
            return view('dashboardadmin.chat.index', compact('chatSessions'));
        }
    }

    public function getMessages($userId)
    {
        try {
            $user = User::findOrFail($userId);
            
            $messages = ChatMessage::where('user_id', $userId)
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'messages' => $messages,
                'user_name' => $user->name
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'messages' => [],
                'user_name' => 'Unknown User',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function sendMessage(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'message' => 'required|string|max:1000'
            ]);

            $adminId = 18; // Fixed admin ID as requested

            // Create or update chat session
            $chatSession = ChatSession::firstOrCreate(
                ['user_id' => $request->user_id],
                [
                    'admin_id' => $adminId,
                    'status' => 'active',
                    'last_activity' => now()
                ]
            );

            // Update session activity
            $chatSession->update(['last_activity' => now()]);

            // Create message
            $message = ChatMessage::create([
                'user_id' => $request->user_id,
                'admin_id' => $adminId,
                'message' => $request->message,
                'sender_type' => 'admin',
                'is_read' => false
            ]);

            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function markAsRead($userId)
    {
        try {
            ChatMessage::where('user_id', $userId)
                ->where('sender_type', 'user')
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteSession($sessionId)
    {
        try {
            $session = ChatSession::findOrFail($sessionId);
            
            // Mark session as closed
            $session->update([
                'status' => 'closed'
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
