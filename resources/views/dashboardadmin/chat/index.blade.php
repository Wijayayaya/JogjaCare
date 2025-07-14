@extends('dashboardadmin.layouts.app')

@section('title', 'Customer Chat - Medical Services')

@push('styles')
<style>
    .chat-container {
        height: calc(100vh - 180px);
        min-height: 600px;
    }
    
    .chat-sidebar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    .chat-list {
        height: calc(100% - 120px);
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: rgba(255,255,255,0.3) transparent;
    }
    
    .chat-list::-webkit-scrollbar {
        width: 4px;
    }
    
    .chat-list::-webkit-scrollbar-track {
        background: transparent;
    }
    
    .chat-list::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,0.3);
        border-radius: 2px;
    }
    
    .chat-messages {
        height: calc(100% - 140px);
        overflow-y: auto;
        background: linear-gradient(to bottom, #f8fafc 0%, #e2e8f0 100%);
        scrollbar-width: thin;
        scrollbar-color: #cbd5e0 transparent;
    }
    
    .chat-messages::-webkit-scrollbar {
        width: 6px;
    }
    
    .chat-messages::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 3px;
    }
    
    .chat-messages::-webkit-scrollbar-thumb {
        background: #cbd5e0;
        border-radius: 3px;
    }
    
    .message-bubble {
        max-width: 75%;
        word-wrap: break-word;
        animation: fadeInUp 0.3s ease-out;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .message-user {
        background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e0 100%);
        color: #1a202c;
        border-bottom-right-radius: 4px;
    }
    
    .message-admin {
        background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
        color: white;
        border-bottom-left-radius: 4px;
    }
    
    .chat-list-item {
        transition: all 0.2s ease;
        border-radius: 12px;
        margin: 4px 8px;
        backdrop-filter: blur(10px);
    }
    
    .chat-list-item:hover {
        background: rgba(255,255,255,0.15);
        transform: translateX(4px);
    }
    
    .chat-list-item.active {
        background: rgba(255,255,255,0.2);
        border-left: 4px solid #fbbf24;
        transform: translateX(4px);
    }
    
    .unread-indicator {
        width: 10px;
        height: 10px;
        background: linear-gradient(45deg, #f59e0b, #d97706);
        border-radius: 50%;
        animation: pulse 2s infinite;
        box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
    }
    
    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(245, 158, 11, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(245, 158, 11, 0);
        }
    }
    
    .unread-count {
        background: linear-gradient(45deg, #ef4444, #dc2626);
        color: white;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 12px;
        min-width: 20px;
        text-align: center;
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3);
        animation: bounce 0.5s ease-out;
    }
    
    @keyframes bounce {
        0%, 20%, 53%, 80%, 100% {
            transform: translate3d(0,0,0);
        }
        40%, 43% {
            transform: translate3d(0,-8px,0);
        }
        70% {
            transform: translate3d(0,-4px,0);
        }
        90% {
            transform: translate3d(0,-2px,0);
        }
    }
    
    .chat-header {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-bottom: 1px solid #e2e8f0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    
    .chat-input-area {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-top: 1px solid #e2e8f0;
        box-shadow: 0 -2px 8px rgba(0,0,0,0.05);
    }
    
    .message-input {
        border: 2px solid #e2e8f0;
        border-radius: 25px;
        padding: 12px 20px;
        transition: all 0.3s ease;
        background: white;
    }
    
    .message-input:focus {
        border-color: #4299e1;
        box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.1);
        outline: none;
    }
    
    .send-button {
        background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
        border-radius: 50%;
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(66, 153, 225, 0.3);
    }
    
    .send-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(66, 153, 225, 0.4);
    }
    
    .send-button:active {
        transform: translateY(0);
    }
    
    .online-status {
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
        animation: pulse-green 2s infinite;
    }
    
    @keyframes pulse-green {
        0% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        }
        70% {
            box-shadow: 0 0 0 6px rgba(16, 185, 129, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
        }
    }
    
    .empty-state {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-radius: 16px;
        padding: 3rem;
        text-align: center;
        margin: 2rem;
        border: 2px dashed #cbd5e0;
    }
    
    .stats-card {
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 1rem;
        margin: 0.5rem;
        border: 1px solid rgba(255,255,255,0.2);
    }
    
    .typing-indicator {
        display: flex;
        align-items: center;
        padding: 8px 16px;
        background: rgba(0,0,0,0.05);
        border-radius: 20px;
        margin: 8px 0;
    }
    
    .typing-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #94a3b8;
        margin: 0 2px;
        animation: typing 1.4s infinite ease-in-out;
    }
    
    .typing-dot:nth-child(1) { animation-delay: -0.32s; }
    .typing-dot:nth-child(2) { animation-delay: -0.16s; }
    
    @keyframes typing {
        0%, 80%, 100% {
            transform: scale(0.8);
            opacity: 0.5;
        }
        40% {
            transform: scale(1);
            opacity: 1;
        }
    }
    
    .message-time {
        font-size: 0.7rem;
        opacity: 0.7;
        margin-top: 4px;
    }
    
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .avatar-user {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        color: white;
    }
    
    .avatar-admin {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
</style>
@endpush

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-comments text-blue-600 mr-3"></i>
                Customer Chat
            </h1>
            <p class="text-gray-600 mt-1">Manage customer conversations and provide support</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium shadow-lg">
                <i class="fas fa-users mr-2"></i>
                {{ $chatSessions->count() }} Active Conversations
            </div>
            @php
                $totalUnreadCount = 0;
                foreach($chatSessions as $session) {
                    $totalUnreadCount += \App\Models\ChatMessage::where('user_id', $session->user_id)
                        ->where('sender_type', 'user')
                        ->where('is_read', false)
                        ->count();
                }
            @endphp
            @if($totalUnreadCount > 0)
            <div class="bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-full text-sm font-medium shadow-lg animate-pulse">
                <i class="fas fa-bell mr-2"></i>
                {{ $totalUnreadCount }} Unread Messages
            </div>
            @endif
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-2xl chat-container overflow-hidden">
    <div class="flex h-full">
        <!-- Chat Sessions Sidebar -->
        <div class="w-80 chat-sidebar">
            <div class="p-6 border-b border-white border-opacity-20">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-inbox mr-3"></i>
                        Conversations
                    </h3>
                    <div class="stats-card text-center">
                        <div class="text-2xl font-bold">{{ $chatSessions->count() }}</div>
                        <div class="text-xs opacity-80">Total</div>
                    </div>
                </div>
                <div class="mt-4 flex space-x-2">
                    <div class="stats-card flex-1 text-center">
                        <div class="text-lg font-bold text-green-300">
                            {{ $chatSessions->where('status', 'active')->count() }}
                        </div>
                        <div class="text-xs opacity-80">Active</div>
                    </div>
                    <div class="stats-card flex-1 text-center">
                        <div class="text-lg font-bold text-yellow-300">{{ $totalUnreadCount }}</div>
                        <div class="text-xs opacity-80">Unread</div>
                    </div>
                </div>
            </div>
            
            <div class="chat-list">
                @forelse($chatSessions as $session)
                <div class="chat-list-item p-4 cursor-pointer" 
                     onclick="selectChat({{ $session->user_id }}, '{{ $session->user->name ?? 'Unknown User' }}', '{{ $session->user->email ?? '' }}')">
                    <div class="flex items-start space-x-3">
                        <div class="flex-shrink-0 relative">
                            <div class="avatar avatar-user">
                                {{ strtoupper(substr($session->user->name ?? 'U', 0, 1)) }}
                            </div>
                            @php
                                $unreadCount = \App\Models\ChatMessage::where('user_id', $session->user_id)
                                    ->where('sender_type', 'user')
                                    ->where('is_read', false)
                                    ->count();
                            @endphp
                            @if($unreadCount > 0)
                                <div class="absolute -top-1 -right-1 unread-indicator"></div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-white truncate">
                                    {{ $session->user->name ?? 'Unknown User' }}
                                </p>
                                @if($unreadCount > 0)
                                    <span class="unread-count">{{ $unreadCount }}</span>
                                @endif
                            </div>
                            <p class="text-xs text-white text-opacity-70 truncate">
                                {{ $session->user->email ?? 'No email' }}
                            </p>
                            @if($session->latestMessage)
                                <p class="text-sm text-white text-opacity-80 truncate mt-2">
                                    @if($session->latestMessage->sender_type === 'admin')
                                        <i class="fas fa-reply text-xs mr-1"></i>
                                    @endif
                                    {{ Str::limit($session->latestMessage->message, 35) }}
                                </p>
                                <p class="text-xs text-white text-opacity-60 mt-1">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $session->latestMessage->created_at->diffForHumans() }}
                                </p>
                            @else
                                <p class="text-sm text-white text-opacity-60 mt-2 italic">No messages yet</p>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-white text-opacity-80">
                    <i class="fas fa-comments text-5xl mb-4 opacity-50"></i>
                    <p class="text-lg font-medium">No conversations yet</p>
                    <p class="text-sm mt-2 opacity-70">Customer messages will appear here when they start chatting</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Chat Messages Area -->
        <div class="flex-1 flex flex-col bg-gray-50">
            <!-- Chat Header -->
            <div id="chatHeader" class="chat-header p-6 hidden">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="avatar avatar-user" id="chatUserAvatar">
                            U
                        </div>
                        <div>
                            <h4 id="chatUserName" class="text-xl font-bold text-gray-900"></h4>
                            <div class="flex items-center space-x-2">
                                <p id="chatUserEmail" class="text-sm text-gray-600"></p>
                                <div class="flex items-center space-x-1">
                                    <div class="online-status"></div>
                                    <span class="text-xs text-green-600 font-medium">Online</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-phone"></i>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Messages Container -->
            <div id="chatMessages" class="flex-1 chat-messages p-6">
                <div class="empty-state">
                    <i class="fas fa-mouse-pointer text-6xl text-gray-400 mb-6"></i>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Select a conversation</h3>
                    <p class="text-gray-500">Choose a customer from the sidebar to start chatting and providing support</p>
                </div>
            </div>

            <!-- Chat Input -->
            <div id="chatInput" class="chat-input-area p-6 hidden">
                <form id="messageForm" class="flex items-end space-x-4">
                    <input type="hidden" id="selectedUserId" value="">
                    <div class="flex-1">
                        <input type="text" id="messageInput" 
                               placeholder="Type your message..." 
                               class="message-input w-full"
                               maxlength="1000">
                        <div class="flex items-center justify-between mt-2 px-2">
                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                <span>Press Enter to send</span>
                                <span>Shift + Enter for new line</span>
                            </div>
                            <span id="charCount" class="text-xs text-gray-400">0/1000</span>
                        </div>
                    </div>
                    <button type="submit" class="send-button text-white hover:bg-blue-600 transition-all duration-200">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
let currentUserId = null;
let messagePolling = null;
let isTyping = false;

function selectChat(userId, userName, userEmail) {
    currentUserId = userId;
    
    // Update UI
    document.getElementById('selectedUserId').value = userId;
    document.getElementById('chatUserName').textContent = userName;
    document.getElementById('chatUserEmail').textContent = userEmail;
    document.getElementById('chatUserAvatar').textContent = userName.charAt(0).toUpperCase();
    document.getElementById('chatHeader').classList.remove('hidden');
    document.getElementById('chatInput').classList.remove('hidden');
    
    // Update active chat item
    document.querySelectorAll('.chat-list-item').forEach(item => {
        item.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
    
    // Load messages
    loadMessages(userId);
    
    // Start polling for new messages
    if (messagePolling) {
        clearInterval(messagePolling);
    }
    messagePolling = setInterval(() => loadMessages(userId), 3000);
}

function loadMessages(userId) {
    fetch(`/dashboardadmin/chat/messages/${userId}`)
        .then(response => response.json())
        .then(data => {
            const messagesContainer = document.getElementById('chatMessages');
            messagesContainer.innerHTML = '';
            
            if (data.messages.length === 0) {
                messagesContainer.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-comment-dots text-6xl text-gray-400 mb-6"></i>
                        <h3 class="text-2xl font-bold text-gray-700 mb-2">No messages yet</h3>
                        <p class="text-gray-500">Start the conversation by sending a message to ${data.user_name}</p>
                    </div>
                `;
                return;
            }
            
            data.messages.forEach((message, index) => {
                const messageDiv = document.createElement('div');
                messageDiv.className = `mb-6 flex ${message.sender_type === 'admin' ? 'justify-end' : 'justify-start'}`;
                
                const bubbleClass = message.sender_type === 'admin' ? 'message-admin' : 'message-user';
                const senderName = message.sender_type === 'admin' ? 'Dashboard Admin' : data.user_name;
                const messageTime = new Date(message.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
                const avatarClass = message.sender_type === 'admin' ? 'avatar-admin' : 'avatar-user';
                const avatarText = message.sender_type === 'admin' ? 'A' : data.user_name.charAt(0).toUpperCase();
                
                messageDiv.innerHTML = `
                    <div class="flex items-end space-x-3 ${message.sender_type === 'admin' ? 'flex-row-reverse space-x-reverse' : ''}">
                        <div class="avatar ${avatarClass} flex-shrink-0">
                            ${avatarText}
                        </div>
                        <div class="message-bubble ${bubbleClass} px-4 py-3 rounded-2xl">
                            <p class="text-sm leading-relaxed">${escapeHtml(message.message)}</p>
                            <div class="message-time flex items-center justify-between mt-2">
                                <span class="font-medium">${senderName}</span>
                                <span>${messageTime}</span>
                            </div>
                        </div>
                    </div>
                `;
                
                messagesContainer.appendChild(messageDiv);
            });
            
            // Scroll to bottom smoothly
            messagesContainer.scrollTo({
                top: messagesContainer.scrollHeight,
                behavior: 'smooth'
            });
            
            // Update unread indicators
            updateSidebarUnreadCounts();
        })
        .catch(error => {
            console.error('Error loading messages:', error);
            showNotification('Error loading messages', 'error');
        });
}

function updateSidebarUnreadCounts() {
    // Remove unread indicators for current chat
    const currentChatItem = document.querySelector('.chat-list-item.active');
    if (currentChatItem) {
        const unreadIndicator = currentChatItem.querySelector('.unread-indicator');
        const unreadCount = currentChatItem.querySelector('.unread-count');
        if (unreadIndicator) unreadIndicator.remove();
        if (unreadCount) unreadCount.remove();
    }
}

// Handle message form submission
document.getElementById('messageForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value.trim();
    const userId = document.getElementById('selectedUserId').value;
    
    if (!message || !userId) {
        return;
    }
    
    // Disable send button temporarily
    const sendButton = this.querySelector('button[type="submit"]');
    const originalContent = sendButton.innerHTML;
    sendButton.disabled = true;
    sendButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    
    // Send message
    fetch('/dashboardadmin/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            user_id: userId,
            message: message
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messageInput.value = '';
            updateCharCount();
            loadMessages(userId);
            showNotification('Message sent successfully', 'success');
        } else {
            showNotification('Error sending message: ' + (data.error || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
        showNotification('Error sending message', 'error');
    })
    .finally(() => {
        // Re-enable send button
        sendButton.disabled = false;
        sendButton.innerHTML = originalContent;
    });
});

// Character count for message input
document.getElementById('messageInput').addEventListener('input', updateCharCount);

function updateCharCount() {
    const input = document.getElementById('messageInput');
    const count = input.value.length;
    const charCountElement = document.getElementById('charCount');
    charCountElement.textContent = `${count}/1000`;
    
    if (count > 900) {
        charCountElement.classList.add('text-red-500');
        charCountElement.classList.remove('text-gray-400');
    } else {
        charCountElement.classList.remove('text-red-500');
        charCountElement.classList.add('text-gray-400');
    }
}

// Handle Enter key to send message
document.getElementById('messageInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        document.getElementById('messageForm').dispatchEvent(new Event('submit'));
    }
});

// Escape HTML to prevent XSS
function escapeHtml(text) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Show notification
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
    
    if (type === 'success') {
        notification.classList.add('bg-green-500', 'text-white');
        notification.innerHTML = `<i class="fas fa-check-circle mr-2"></i>${message}`;
    } else if (type === 'error') {
        notification.classList.add('bg-red-500', 'text-white');
        notification.innerHTML = `<i class="fas fa-exclamation-circle mr-2"></i>${message}`;
    } else {
        notification.classList.add('bg-blue-500', 'text-white');
        notification.innerHTML = `<i class="fas fa-info-circle mr-2"></i>${message}`;
    }
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Animate out and remove
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Cleanup polling when page unloads
window.addEventListener('beforeunload', function() {
    if (messagePolling) {
        clearInterval(messagePolling);
    }
});

// Auto-refresh page every 5 minutes to update unread counts
setInterval(function() {
    if (!currentUserId) {
        location.reload();
    }
}, 300000);

// Initialize tooltips and other UI enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth scrolling to all internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
</script>
@endpush
