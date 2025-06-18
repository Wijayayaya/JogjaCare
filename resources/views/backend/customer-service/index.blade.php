@extends('backend.layouts.app')

@section('title') Customer Service Chat @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{route("backend.dashboard")}}' icon='fa fa-dashboard' >
        Dashboard
    </x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active">Customer Service Chat</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="fa-solid fa-comments"></i> Customer Service Chat
                </h4>
                <div class="small text-muted">
                    Manage customer service conversations
                </div>
            </div>
        </div>
        <hr>

        <div class="row">
            <!-- Chat Sessions List -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Active Chats <span class="badge bg-primary" id="activeChatsCount">{{ $sessions->count() }}</span></h5>
                    </div>
                    <div class="card-body p-0" style="max-height: 600px; overflow-y: auto;">
                        <div id="chatSessionsList">
                            @forelse($sessions as $session)
                                <div class="chat-session-item p-3 border-bottom" data-user-id="{{ $session->user_id }}" style="cursor: pointer;">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">{{ $session->user->name }}</h6>
                                            <p class="mb-1 text-muted small">
                                                {{ $session->latestMessage ? Str::limit($session->latestMessage->message, 50) : 'No messages yet' }}
                                            </p>
                                            <small class="text-muted">{{ $session->last_activity->diffForHumans() }}</small>
                                        </div>
                                        @php
                                            $unreadCount = \App\Models\ChatMessage::where('user_id', $session->user_id)
                                                ->where('sender_type', 'user')
                                                ->where('is_read', false)
                                                ->count();
                                        @endphp
                                        @if($unreadCount > 0)
                                            <span class="badge bg-danger">{{ $unreadCount }}</span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-3 text-center text-muted">
                                    No active chats
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chat Window -->
            <div class="col-md-8">
                <div class="card" id="chatWindow" style="display: none;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 id="chatUserName">Select a chat</h5>
                        <button class="btn btn-sm btn-outline-secondary" id="closeChatBtn">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div id="chatMessages" style="height: 400px; overflow-y: auto; padding: 15px;">
                            <!-- Messages will be loaded here -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <form id="sendMessageForm" class="d-flex">
                            <input type="hidden" id="currentUserId" value="">
                            <input type="text" class="form-control me-2" id="messageInput" placeholder="Type your message..." required>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card" id="noChatSelected">
                    <div class="card-body text-center py-5">
                        <i class="fa fa-comments fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Select a chat to start conversation</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.chat-session-item:hover {
    background-color: #f8f9fa;
}

.chat-session-item.active {
    background-color: #e3f2fd;
    border-left: 4px solid #2196f3;
}

.message-item {
    margin-bottom: 15px;
}

.message-user {
    text-align: right;
}

.message-admin {
    text-align: left;
}

.message-bubble {
    display: inline-block;
    padding: 10px 15px;
    border-radius: 18px;
    max-width: 70%;
    word-wrap: break-word;
}

.message-user .message-bubble {
    background-color: #007bff;
    color: white;
}

.message-admin .message-bubble {
    background-color: #f1f3f4;
    color: #333;
}

.message-time {
    font-size: 0.75rem;
    color: #6c757d;
    margin-top: 5px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentUserId = null;
    let lastMessageId = 0;
    let pollInterval = null;

    // Chat session click handler
    document.querySelectorAll('.chat-session-item').forEach(item => {
        item.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const userName = this.querySelector('h6').textContent;
            openChat(userId, userName);
            
            // Update active state
            document.querySelectorAll('.chat-session-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Send message form
    document.getElementById('sendMessageForm').addEventListener('submit', function(e) {
        e.preventDefault();
        sendMessage();
    });

    // Close chat button
    document.getElementById('closeChatBtn').addEventListener('click', function() {
        closeChat();
    });

    function openChat(userId, userName) {
        currentUserId = userId;
        document.getElementById('currentUserId').value = userId;
        document.getElementById('chatUserName').textContent = userName;
        document.getElementById('noChatSelected').style.display = 'none';
        document.getElementById('chatWindow').style.display = 'block';
        
        loadMessages();
        startPolling();
    }

    function closeChat() {
        currentUserId = null;
        document.getElementById('chatWindow').style.display = 'none';
        document.getElementById('noChatSelected').style.display = 'block';
        document.querySelectorAll('.chat-session-item').forEach(i => i.classList.remove('active'));
        stopPolling();
    }

    function loadMessages() {
        if (!currentUserId) return;

        fetch(`/admin/customer-service/chat/${currentUserId}/messages?last_message_id=0`)
            .then(response => response.json())
            .then(data => {
                displayMessages(data.messages);
                if (data.messages.length > 0) {
                    lastMessageId = Math.max(...data.messages.map(m => m.id));
                }
            })
            .catch(error => console.error('Error loading messages:', error));
    }

    function sendMessage() {
        const messageInput = document.getElementById('messageInput');
        const message = messageInput.value.trim();
        
        if (!message || !currentUserId) return;

        fetch(`/admin/customer-service/chat/${currentUserId}/send`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayMessage(data.message);
                messageInput.value = '';
                lastMessageId = data.message.id;
            }
        })
        .catch(error => console.error('Error sending message:', error));
    }

    function displayMessages(messages) {
        const chatMessages = document.getElementById('chatMessages');
        chatMessages.innerHTML = '';
        
        messages.forEach(message => {
            displayMessage(message);
        });
        
        scrollToBottom();
    }

    function displayMessage(message) {
        const chatMessages = document.getElementById('chatMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `message-item message-${message.sender_type}`;
        
        messageDiv.innerHTML = `
            <div class="message-bubble">
                ${message.message}
            </div>
            <div class="message-time">
                ${message.sender_name} • ${message.created_at}
            </div>
        `;
        
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }

    function scrollToBottom() {
        const chatMessages = document.getElementById('chatMessages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function startPolling() {
        stopPolling();
        pollInterval = setInterval(() => {
            if (currentUserId) {
                checkNewMessages();
            }
            updateSessionsList();
        }, 2000);
    }

    function stopPolling() {
        if (pollInterval) {
            clearInterval(pollInterval);
            pollInterval = null;
        }
    }

    function checkNewMessages() {
        if (!currentUserId) return;

        fetch(`/admin/customer-service/chat/${currentUserId}/messages?last_message_id=${lastMessageId}`)
            .then(response => response.json())
            .then(data => {
                if (data.messages.length > 0) {
                    data.messages.forEach(message => {
                        displayMessage(message);
                    });
                    lastMessageId = Math.max(...data.messages.map(m => m.id));
                }
            })
            .catch(error => console.error('Error checking new messages:', error));
    }

    function updateSessionsList() {
        fetch('/admin/customer-service/sessions')
            .then(response => response.json())
            .then(data => {
                updateSessionsDisplay(data.sessions);
            })
            .catch(error => console.error('Error updating sessions:', error));
    }

    function updateSessionsDisplay(sessions) {
        const sessionsList = document.getElementById('chatSessionsList');
        const activeCount = document.getElementById('activeChatsCount');
        
        activeCount.textContent = sessions.length;
        
        // Update existing sessions or add new ones
        sessions.forEach(session => {
            let sessionElement = document.querySelector(`[data-user-id="${session.user_id}"]`);
            
            if (!sessionElement) {
                // Create new session element
                sessionElement = document.createElement('div');
                sessionElement.className = 'chat-session-item p-3 border-bottom';
                sessionElement.dataset.userId = session.user_id;
                sessionElement.style.cursor = 'pointer';
                sessionsList.appendChild(sessionElement);
                
                // Add click handler
                sessionElement.addEventListener('click', function() {
                    const userId = this.dataset.userId;
                    const userName = this.querySelector('h6').textContent;
                    openChat(userId, userName);
                    
                    document.querySelectorAll('.chat-session-item').forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                });
            }
            
            // Update session content
            sessionElement.innerHTML = `
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="mb-1">${session.user_name}</h6>
                        <p class="mb-1 text-muted small">${session.last_message || 'No messages yet'}</p>
                        <small class="text-muted">${session.last_activity}</small>
                    </div>
                    ${session.unread_count > 0 ? `<span class="badge bg-danger">${session.unread_count}</span>` : ''}
                </div>
            `;
        });
    }

    // Start polling for session updates
    startPolling();
});
</script>
@endsection
