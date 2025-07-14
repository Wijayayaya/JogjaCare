@extends('dashboardadmin.layouts.app')

@section('title', 'Customer Service - Medical Services')
@section('page-title', 'Customer Service')
@section('page-description', 'Manage customer inquiries and support')

@section('content')
<!-- Chat Customer Service Section -->
<div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-xl font-bold text-gray-900 mb-4">
        <i class="fas fa-comments mr-2 text-blue-600"></i>Customer Service Chat
        <span class="ml-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ count(array_filter($chatMessages, fn($msg) => $msg['status'] === 'unread')) }} New</span>
    </h2>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Messages List -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Recent Messages</h3>
            <div class="h-80 overflow-y-auto border rounded p-4 bg-gray-50 space-y-3">
                @foreach($chatMessages as $message)
                <div class="p-4 rounded-lg cursor-pointer transition duration-200 hover:shadow-md
                    {{ $message['status'] === 'unread' ? 'bg-blue-50 border-l-4 border-blue-400' : 
                       ($message['status'] === 'replied' ? 'bg-green-50 border-l-4 border-green-400' : 'bg-white border') }}"
                    onclick="selectMessage({{ json_encode($message) }})">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex items-center space-x-2">
                            <p class="font-semibold text-gray-900">{{ $message['user_name'] }}</p>
                            @if($message['status'] === 'unread')
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">New</span>
                            @elseif($message['status'] === 'replied')
                                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-check"></i> Replied
                                </span>
                            @endif
                        </div>
                        <span class="text-xs text-gray-500">{{ $message['created_at']->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700 text-sm">{{ $message['message'] }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Reply Section -->
        <div>
            <h3 class="text-lg font-semibold mb-3">Reply to Customer</h3>
            <div id="selectedMessage" class="h-80 border rounded p-4 bg-gray-50">
                <div class="flex items-center justify-center h-full text-gray-500">
                    <div class="text-center">
                        <i class="fas fa-mouse-pointer text-4xl mb-4"></i>
                        <p>Select a message to reply</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Chat functionality
    function selectMessage(message) {
        const selectedDiv = document.getElementById('selectedMessage');
        selectedDiv.innerHTML = `
            <div class="h-full flex flex-col">
                <div class="bg-white p-4 rounded-lg mb-4 border-l-4 border-blue-400">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-semibold text-gray-900">${message.user_name}</h4>
                        <span class="text-xs text-gray-500">${new Date(message.created_at).toLocaleString()}</span>
                    </div>
                    <p class="text-gray-700">${message.message}</p>
                </div>
                
                <div class="flex-1 flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2">Your Reply:</label>
                    <textarea id="replyMessage" placeholder="Type your reply here..." 
                              class="flex-1 border rounded-lg p-3 resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              rows="6"></textarea>
                    <div class="flex space-x-2 mt-3">
                        <button onclick="sendReply(${message.id})" 
                                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>Send Reply
                        </button>
                        <button onclick="clearReply()" 
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                            <i class="fas fa-times mr-2"></i>Clear
                        </button>
                    </div>
                </div>
            </div>
        `;
    }

    function sendReply(messageId) {
        const replyText = document.getElementById('replyMessage').value.trim();
        
        if (!replyText) {
            alert('Please enter a reply message');
            return;
        }

        // Send AJAX request
        fetch('{{ route("dashboardadmin.send-message") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                message: replyText,
                user_id: messageId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert('Reply sent successfully!');
                document.getElementById('replyMessage').value = '';
                location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error sending reply');
        });
    }

    function clearReply() {
        document.getElementById('replyMessage').value = '';
    }
</script>
@endpush