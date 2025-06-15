<!-- Place this in your main layout file -->
<!-- CSS -->
<style>
    /* Chat Widget Styles */
    .jogjacare-widget {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        font-family: 'Nunito', 'Segoe UI', Roboto, Arial, sans-serif;
    }

    .chat-bubble {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 6px 16px rgba(78, 115, 223, 0.3);
        transition: all 0.3s ease;
    }

    .chat-bubble:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(78, 115, 223, 0.4);
    }

    .chat-bubble-icon {
        font-size: 24px;
        color: white;
    }
    
    /* Robot icon animations */
    .robot-icon {
        transition: all 0.3s ease;
    }
    
    .robot-eye {
        animation: blink 3s infinite;
    }
    
    .robot-mask {
        animation: breathe 2s infinite alternate;
    }
    
    .robot-arm {
        animation: wave 4s infinite alternate;
        transform-origin: top;
    }
    
    .robot-ear {
        animation: pulse 2s infinite alternate;
    }
    
    .robot-button {
        animation: glow 1.5s infinite alternate;
    }
    
    @keyframes blink {
        0%, 45%, 50%, 100% { transform: scale(1); }
        48% { transform: scale(0.1); }
    }
    
    @keyframes pulse {
        0% { opacity: 0.7; }
        100% { opacity: 1; }
    }
    
    @keyframes breathe {
        0% { transform: scaleY(0.95); }
        100% { transform: scaleY(1.05); }
    }
    
    @keyframes wave {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(5deg); }
    }
    
    @keyframes glow {
        0% { opacity: 0.5; }
        100% { opacity: 1; }
    }
    
    .chat-bubble:hover .robot-eye {
        animation: blink 1s infinite;
    }
    
    .chat-bubble:hover .robot-arm {
        animation: wave 1s infinite alternate;
    }

    .chat-options {
        position: absolute;
        bottom: 70px;
        right: 0;
        width: 220px;
        background-color: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        display: none;
        overflow: hidden;
        animation: slideUp 0.3s ease;
    }
    
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .chat-option {
        padding: 14px 16px;
        cursor: pointer;
        transition: background-color 0.2s;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
    }

    .chat-option:hover {
        background-color: #f8f9fd;
    }

    .chat-option-icon {
        margin-right: 12px;
        width: 24px;
        height: 24px;
        background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
    }

    .dark .chat-options {
        background-color: #2d2d2d;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
        color: #ddd;
        border: 1px solid #444;
    }

    .dark .chat-option {
        color: #ddd;
        border-bottom: 1px solid #444;
    }

    .dark .chat-option:hover {
        background-color: #44475a;
        color: #fff;
    }

    /* Chat Window */
    .chat-window {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 340px;
        height: 500px;
        background-color: #f8f9fd;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        display: none;
        flex-direction: column;
        z-index: 9998;
        overflow: hidden;
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .chat-header {
        padding: 16px;
        background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
        color: white;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-radius: 20px 20px 0 0;
    }

    .chat-close {
        cursor: pointer;
        font-size: 18px;
        height: 24px;
        width: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.2);
        transition: background-color 0.2s;
    }
    
    .chat-close:hover {
        background-color: rgba(255, 255, 255, 0.3);
    }

    .chat-body {
        flex: 1;
        overflow-y: auto;
        padding: 16px;
        background-color: white;
    }

    .chat-footer {
        padding: 12px 16px;
        background-color: white;
        border-top: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
    }

    .chat-input {
        flex: 1;
        padding: 12px 18px;
        border: 1px solid #e4e7f2;
        border-radius: 24px;
        outline: none;
        font-size: 14px;
        transition: border-color 0.2s;
    }
    
    .chat-input:focus {
        border-color: #8E54E9;
        box-shadow: 0 0 0 2px rgba(142, 84, 233, 0.1);
    }

    .chat-send {
        margin-left: 10px;
        background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
        color: white;
        border: none;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s;
    }
    
    .chat-send:hover {
        transform: scale(1.05);
    }
    
    .chat-send:active {
        transform: scale(0.95);
    }

    /* Message container and wrapper styles */
    .message-container {
        margin-bottom: 16px;
        display: flex;
        flex-direction: column;
        animation: fadeInMessage 0.3s ease;
    }
    
    .message-wrapper {
        display: flex;
        align-items: flex-end;
        gap: 8px;
    }
    
    .bot-wrapper {
        justify-content: flex-start;
    }
    
    .user-wrapper {
        justify-content: flex-end;
    }
    
    .message-avatar {
        width: 36px;
        height: 36px;
        flex-shrink: 0;
    }
    
    /* Message styles */
    .message {
        max-width: calc(100% - 60px);
        animation: fadeInMessage 0.3s ease;
    }
    
    @keyframes fadeInMessage {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .user-message {
        background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
        color: white;
        border-radius: 18px 4px 18px 18px;
        padding: 12px 16px;
        box-shadow: 0 2px 8px rgba(142, 84, 233, 0.15);
    }

    .bot-message {
        background-color: #f4f6fc;
        color: #333;
        border-radius: 4px 18px 18px 18px;
        padding: 12px 16px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }

    /* Category list for FAQ */
    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-item {
        padding: 12px 16px;
        cursor: pointer;
        border-radius: 10px;
        margin-bottom: 8px;
        border: 1px solid #e4e7f2;
        transition: all 0.2s;
        font-weight: 500;
    }

    .category-item:hover {
        background-color: #f8f9fd;
        border-color: #8E54E9;
        transform: translateY(-2px);
    }

    .question-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .question-item {
        padding: 12px 16px;
        cursor: pointer;
        border-radius: 10px;
        margin-bottom: 8px;
        border: 1px solid #e4e7f2;
        transition: all 0.2s;
    }

    .question-item:hover,
    .category-item:hover,
    .chat-option:hover {
        background-color: #f8f9fd;
        border-color: #8E54E9;
        transform: translateY(-2px);
    }

    .back-button {
        display: inline-block;
        margin-bottom: 12px;
        padding: 8px 14px;
        background-color: #f0f2fa;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.2s;
        color: #5a5a5a;
    }
    
    .back-button:hover {
        background-color: #e4e7f2;
        color: #333;
    }

    /* Typing indicator */
    .typing-indicator {
        display: flex;
        padding: 12px 16px;
        align-items: center;
        background-color: #f4f6fc;
        border-radius: 4px 18px 18px 18px;
        width: fit-content;
    }

    .typing-indicator span {
        height: 8px;
        width: 8px;
        background-color: #8E54E9;
        border-radius: 50%;
        display: inline-block;
        margin: 0 2px;
        animation: typing 1s infinite;
        opacity: 0.6;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes typing {
        0%, 60%, 100% { transform: translateY(0); }
        30% { transform: translateY(-10px); }
    }

    /* Welcome Screen Styles */
    .welcome-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 220px 20px;
        text-align: center;
        height: 100%;
    }
    
    .welcome-robot {
        margin-bottom: 20px;
        background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow:0 8px 24px rgba(71, 118, 230, 0.3);
    }
    
    .robot-icon-large {
        transform: scale(1.2);
    }
    
    .welcome-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #333;
    }
    
    .welcome-subtitle {
        font-size: 16px;
        color: #666;
        margin-bottom: 30px;
    }
    
    .welcome-options {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .welcome-option {
        padding: 16px;
        border-radius: 12px;
        background-color: white;
        border: 1px solid #e4e7f2;
        display: flex;
        align-items: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    
    .welcome-option:hover {
        background-color: #f8f9fd;
        border-color: #8E54E9;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .welcome-option-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        color: white;
        font-size: 16px;
    }

    /* Dark Mode */
    .dark .chat-window,
    .dark .chat-options {
        background-color: #1f2937;
        color: #fff;
    }

    .dark .chat-header {
        background-color: #111827;
        color: #fff;
    }

    .dark .chat-option,
    .dark .question-item,
    .dark .category-item {
        border-bottom: 1px solid #374151;
    }
    
    .dark .chat-option-icon,
    .dark .chat-option div {
        color: #fff;
    }

    .dark .chat-footer,
    .dark .chat-input {
        background-color: #1f2937;
        color: #fff;
        border-color: #374151;
    }

    .dark .chat-input::placeholder {
        color: #9ca3af;
    }

    .dark .chat-body {
        background-color: #1f2937;
        color: #fff;
    }

    .dark .chat-option:hover,
    .dark .category-item:hover,
    .dark .question-item:hover,
    .dark .back-button:hover {
        background-color: #9ca3af;
    }

    .dark .bot-message {
        background-color: #9ca3af;
        color: #1f2937;
    }

    .dark .back-button {
        background-color: #9ca3af;
        color: #1f2937;
        border: #1f2937;
    }

    .dark .welcome-option {
        background-color: #374151;
        color: #fff;
        border: 1px solid #4b5563;
    }
    
    .dark .welcome-option:hover {
        background-color: #4b5563;
        border-color: #6b7280;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Hide Tawk.to elements */
    iframe[title*="chat"] {
        bottom: 0 !important;
        height: 0 !important;
        width: 0 !important;
        visibility: hidden !important;
        opacity: 0 !important;
        z-index: -999 !important;
        position: fixed !important;
    }

    /* Only show the iframe when chat is active */
    iframe[title*="chat"].chat-active {
        height: 600px !important;
        width: 360px !important;
        visibility: visible !important;
        opacity: 1 !important;
        z-index: 10000 !important;
        right: 20px !important;
    }

    /* Hide all tawk elements that could appear as bubbles */
    .tawk-min-container,
    [data-testid="tawkCard"],
    button[data-text="Open chat widget"],
    div[id*="tawk-bubble"],
    div[class*="tawk-bubble"],
    div[style*="tawk-min-container"] {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        width: 0 !important;
        height: 0 !important;
        position: absolute !important;
        z-index: -9999 !important;
        pointer-events: none !important;
    }
</style>

<!-- HTML Structure -->
<div class="jogjacare-widget">
    <!-- Chat Bubble -->
    <div class="chat-bubble" id="chatBubble">
        <div class="chat-bubble-icon">
            <svg class="robot-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36">
                <!-- Robot Head -->
                <circle class="robot-head" cx="12" cy="10" r="7" fill="white" />
                
                <!-- Robot Eyes -->
                <circle class="robot-eye" cx="9.5" cy="8.5" r="1.2" fill="#8E54E9" />
                <circle class="robot-eye" cx="14.5" cy="8.5" r="1.2" fill="#8E54E9" />
                
                <!-- Robot Ears/Antenna -->
                <circle class="robot-ear" cx="5" cy="10" r="1.2" fill="white" />
                <circle class="robot-ear" cx="19" cy="10" r="1.2" fill="white" />
                
                <!-- Robot Medical Mask -->
                <path class="robot-mask" d="M8,11 C8,11 10,13 12,13 C14,13 16,11 16,11 L16,14 C16,14 14,16 12,16 C10,16 8,14 8,14 Z" fill="#a3d4ff" />
                <path class="robot-mask-strap" d="M8,11 C8,11 7,11 6,10 M16,11 C16,11 17,11 18,10" stroke="white" stroke-width="0.7" fill="none" />
                
                <!-- Robot Body -->
                <path class="robot-body" d="M9,17 L15,17 L15,22 L9,22 Z" fill="white" />
                <circle class="robot-button" cx="12" cy="19.5" r="1" fill="#8E54E9" />
                
                <!-- Robot Arms -->
                <path class="robot-arm" d="M9,18 L5,20" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                <path class="robot-arm" d="M15,18 L19,20" stroke="white" stroke-width="1.5" stroke-linecap="round" />
            </svg>
        </div>
    </div>

    <!-- Chat Window - will be populated by JS -->
    <div class="chat-window" id="chatWindow">
        <div class="chat-header" id="chatHeader">
            JogjaCare Assistant
            <div class="chat-close" id="chatClose">×</div>
        </div>
        <div class="chat-body" id="chatBody">
            <!-- Messages will appear here -->
        </div>
        <div class="chat-footer" id="chatFooter">
            <input type="text" class="chat-input" id="chatInput" placeholder="Tulis pesan Anda atau pilih kategori FAQ...">
            <button class="chat-send" id="chatSend">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </button>
        </div>
    </div>
</div>
<div id="tawk-container"></div>

<!-- Tawk.to initialization -->
<script type="text/javascript">
// Initialize Tawk variables but don't load script yet
var Tawk_API = Tawk_API || {};
var Tawk_LoadStart = new Date();

// We'll load it on demand when the user selects live chat
document.addEventListener('DOMContentLoaded', function() {
    // Add debug console log
    console.log('Chat widget DOM loaded');
});
</script>

<!-- Customer Service Chat - Updated with Better Error Handling -->
<script>
console.log("🔄 Loading Customer Service Chat inline...");

// Customer Service Chat Functions - Updated Version
(function() {
    const csMessages = [];
    let csLastMessageId = 0;
    let csPollInterval = null;
    let csInitialized = false;

    function initializeCustomerServiceChat() {
        console.log("🚀 Initializing Customer Service Chat...");

        // Clear chat body
        const chatBody = document.getElementById("chatBody");
        if (!chatBody) {
            console.error("❌ Chat body not found");
            return;
        }

        chatBody.innerHTML = "";

        // Check if user is logged in
        if (!isUserLoggedIn()) {
            addMessageSafe("bot", "🔐 Untuk menggunakan layanan chat customer service, Anda harus login terlebih dahulu.");

            const loginHtml = `
                <div style="margin-top: 15px; text-align: center;">
                    <a href="/login" class="btn btn-primary" style="background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%); color: white; padding: 10px 20px; border-radius: 20px; text-decoration: none; display: inline-block;">
                        Login Sekarang
                    </a>
                </div>
            `;
            addMessageSafe("bot", loginHtml);
            return;
        }

        // Initialize chat
        addMessageSafe("bot", "💬 Menghubungkan Anda dengan customer service...");
        showTypingIndicatorSafe();

        // Load existing messages
        fetch("/customer-service/initialize", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": getCSRFToken(),
                "Accept": "application/json"
            },
        })
        .then(response => {
            console.log("📡 Initialize response status:", response.status);
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("📨 Initialize response data:", data);
            hideTypingIndicatorSafe();

            if (data.success === false) {
                throw new Error(data.error || 'Server returned error');
            }

            if (data.messages && data.messages.length > 0) {
                addMessageSafe("bot", "📋 Memuat riwayat percakapan...");

                data.messages.forEach(message => {
                    displayCsMessage(message);
                });

                csLastMessageId = Math.max(...data.messages.map(m => m.id));
            } else {
                addMessageSafe("bot", "👋 Halo! Saya customer service JogjaCare. Ada yang bisa saya bantu?");
            }

            csInitialized = true;
            startCsPolling();
            setInputStateSafe(false);
        })
        .catch(error => {
            hideTypingIndicatorSafe();
            console.error("❌ Error initializing CS chat:", error);
            
            // Show detailed error message
            let errorMessage = "Silakan Login terlebih dahulu untuk menggunakan layanan chat customer service.";
            
            if (error.message.includes('404')) {
                errorMessage += "<br><small>Error: Route tidak ditemukan. Pastikan routes sudah ditambahkan.</small>";
            } else if (error.message.includes('500')) {
                errorMessage += "<br><small>Error: Server error. Periksa database dan controller.</small>";
            } else if (error.message.includes('403')) {
                errorMessage += "<br><small>Error: Akses ditolak. Pastikan Anda sudah login.</small>";
            } else {
                errorMessage += `<br><small>Error: ${error.message}</small>`;
            }
            
            errorMessage += `
            <div style="margin-top: 15px; text-align: center;">
                <button onclick="window.location.href='/login'" style="background: #007bff; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; margin-right: 10px;">
                    Login
                </button>
                <button onclick="window.location.href='/register'" style="background: #6c757d; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">
                    Register
                </button>
            </div>
        `;

            
            addMessageSafe("bot", errorMessage);
            setInputStateSafe(false);
        });
    }

    function handleCustomerServiceMessage(message) {
        console.log("📨 Handling CS message:", message);

        if (!csInitialized) {
            addMessageSafe("bot", "⏳ Sedang menginisialisasi chat. Silakan tunggu sebentar...");
            return;
        }

        // Add user message to UI immediately
        addMessageSafe("user", message);

        // Send message to server
        fetch("/customer-service/send", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": getCSRFToken(),
                "Accept": "application/json"
            },
            body: JSON.stringify({ message: message }),
        })
        .then(response => {
            console.log("📡 Send message response status:", response.status);
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("📨 Send message response data:", data);
            if (data.success) {
                csLastMessageId = data.message.id;

                // Show typing indicator to simulate admin response time
                showTypingIndicatorSafe();
                setTimeout(() => {
                    hideTypingIndicatorSafe();
                    addMessageSafe("bot", "✅ Pesan terkirim. Customer service akan merespons segera.");
                }, 1000);
            } else {
                addMessageSafe("bot", "❌ Gagal mengirim pesan. Silakan coba lagi.");
            }
        })
        .catch(error => {
            console.error("❌ Error sending CS message:", error);
            addMessageSafe("bot", `❌ Terjadi kesalahan saat mengirim pesan: ${error.message}`);
        });
    }

    function displayCsMessage(message) {
        const messageText = message.message;
        const senderType = message.sender_type;
        const senderName = message.sender_name;
        const time = message.created_at;

        if (senderType === "user") {
            return; // Don't display user messages again
        } else {
            // Display admin message
            const adminMessage = `
                <div style="background: #f0f8ff; border-left: 4px solid #4776E6; padding: 12px; margin: 10px 0; border-radius: 8px;">
                    <div style="font-weight: bold; color: #4776E6; margin-bottom: 5px;">
                        👨‍💼 ${senderName} • ${time}
                    </div>
                    <div>${messageText}</div>
                </div>
            `;
            addMessageSafe("bot", adminMessage);
        }
    }

    function startCsPolling() {
        stopCsPolling();
        csPollInterval = setInterval(() => {
            if (csInitialized) {
                checkForNewCsMessages();
            }
        }, 3000);
    }

    function stopCsPolling() {
        if (csPollInterval) {
            clearInterval(csPollInterval);
            csPollInterval = null;
        }
    }

    function checkForNewCsMessages() {
        fetch(`/customer-service/messages?last_message_id=${csLastMessageId}`, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": getCSRFToken(),
                "Accept": "application/json"
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.messages && data.messages.length > 0) {
                data.messages.forEach(message => {
                    if (message.sender_type === "admin") {
                        displayCsMessage(message);
                    }
                });
                csLastMessageId = Math.max(...data.messages.map(m => m.id));
            }
        })
        .catch(error => {
            console.error("❌ Error checking for new CS messages:", error);
        });
    }

    function cleanupCustomerServiceChat() {
        stopCsPolling();
        csInitialized = false;
        csLastMessageId = 0;
    }

    // Helper functions
    function isUserLoggedIn() {
        return getCSRFToken() !== null;
    }

    function getCSRFToken() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        return csrfToken ? csrfToken.getAttribute("content") : null;
    }

    function addMessageSafe(type, message) {
        if (typeof window.addMessage === "function") {
            window.addMessage(type, message);
        } else {
            console.log(`Message (${type}):`, message);
        }
    }

    function showTypingIndicatorSafe() {
        if (typeof window.showTypingIndicator === "function") {
            window.showTypingIndicator();
        }
    }

    function hideTypingIndicatorSafe() {
        if (typeof window.hideTypingIndicator === "function") {
            window.hideTypingIndicator();
        }
    }

    function setInputStateSafe(disabled) {
        if (typeof window.setInputState === "function") {
            window.setInputState(disabled);
        }
    }

    // Make functions available globally IMMEDIATELY
    window.initializeCustomerServiceChat = initializeCustomerServiceChat;
    window.handleCustomerServiceMessage = handleCustomerServiceMessage;
    window.cleanupCustomerServiceChat = cleanupCustomerServiceChat;

    console.log("✅ Customer Service Chat functions loaded inline!");
    console.log("🔍 Function check:", typeof window.initializeCustomerServiceChat);
})();

// Add CSRF token to meta if not exists
if (!document.querySelector('meta[name="csrf-token"]')) {
    const meta = document.createElement('meta');
    meta.name = 'csrf-token';
    meta.content = '{{ csrf_token() }}';
    document.head.appendChild(meta);
    console.log("✅ CSRF token added");
}
</script>

<!-- Load other scripts -->
<script src="{{ asset('js/chat-faq-ai.js') }}" onerror="console.error('❌ Failed to load chat-faq-ai.js')"></script>
<script src="{{ asset('js/ambulance-service.js') }}" onerror="console.error('❌ Failed to load ambulance-service.js')"></script>
<script src="{{ asset('js/chat-main.js') }}" onerror="console.error('❌ Failed to load chat-main.js')" onload="console.log('✅ chat-main.js loaded')"></script>

<script>
// Final check
window.addEventListener('load', () => {
    setTimeout(() => {
        console.log("🔍 Final function check:");
        console.log("- CS function:", typeof window.initializeCustomerServiceChat);
        console.log("- FAQ function:", typeof window.initializeFaqAiChat);
        console.log("- Ambulance function:", typeof window.initializeAmbulanceService);
        console.log("- Tawk function:", typeof window.initializeTawkChat);
    }, 1000);
});
</script>
