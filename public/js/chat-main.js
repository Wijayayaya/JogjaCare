// Main Chat Manager - Coordinates all chat functionality
document.addEventListener('DOMContentLoaded', function() {
    const chatBubble = document.getElementById('chatBubble');
    const chatOptions = document.getElementById('chatOptions');
    const chatWindow = document.getElementById('chatWindow');
    const chatClose = document.getElementById('chatClose');
    
    // Chat option buttons
    const openFaqBot = document.getElementById('openFaqBot');
    const openCustomerService = document.getElementById('openCustomerService');
    const openAiChat = document.getElementById('openAiChat');
    
    let currentChatMode = null;
    
    // Toggle welcome screen
    chatBubble.addEventListener('click', function() {
        // If chat window is open, close it instead of showing options
        if (chatWindow.style.display === 'flex') {
            chatWindow.style.display = 'none';
            return;
        }
        
        // Show welcome screen with robot and options
        showWelcomeScreen();
    });
    
    // Function to display the welcome screen with robot and options
    function showWelcomeScreen() {
        // Update the chat header
        document.getElementById('chatHeader').innerHTML = 'JogjaCare Assistant <div class="chat-close" id="chatClose">×</div>';
        
        // Clear chat body and add welcome content
        const chatBody = document.getElementById('chatBody');
        chatBody.innerHTML = `
            <div class="welcome-container">
                <div class="welcome-robot">
                    <svg class="robot-icon-large" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="80" height="80">
                        <!-- Robot Head -->
                        <circle class="robot-head" cx="12" cy="10" r="7" fill="#4776E6" />
                        
                        <!-- Robot Eyes -->
                        <circle class="robot-eye" cx="9.5" cy="8.5" r="1.2" fill="white" />
                        <circle class="robot-eye" cx="14.5" cy="8.5" r="1.2" fill="white" />
                        
                        <!-- Robot Ears/Antenna -->
                        <circle class="robot-ear" cx="5" cy="10" r="1.2" fill="#8E54E9" />
                        <circle class="robot-ear" cx="19" cy="10" r="1.2" fill="#8E54E9" />
                        
                        <!-- Robot Medical Mask -->
                        <path class="robot-mask" d="M8,11 C8,11 10,13 12,13 C14,13 16,11 16,11 L16,14 C16,14 14,16 12,16 C10,16 8,14 8,14 Z" fill="#a3d4ff" />
                        <path class="robot-mask-strap" d="M8,11 C8,11 7,11 6,10 M16,11 C16,11 17,11 18,10" stroke="white" stroke-width="0.7" fill="none" />
                        
                        <!-- Robot Body -->
                        <path class="robot-body" d="M9,17 L15,17 L15,22 L9,22 Z" fill="#4776E6" />
                        <circle class="robot-button" cx="12" cy="19.5" r="1" fill="white" />
                        
                        <!-- Robot Arms -->
                        <path class="robot-arm" d="M9,18 L5,20" stroke="#8E54E9" stroke-width="1.5" stroke-linecap="round" />
                        <path class="robot-arm" d="M15,18 L19,20" stroke="#8E54E9" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="welcome-title">Chat Bot</div>
                <div class="welcome-subtitle">How can I help you today?</div>
                
                <div class="welcome-options">
                    <div class="welcome-option" id="welcomeFaqBot">
                        <div class="welcome-option-icon">🤖</div>
                        <div>FAQ Bot</div>
                    </div>
                    <div class="welcome-option" id="welcomeCustomerService">
                        <div class="welcome-option-icon">👨‍💼</div>
                        <div>Customer Service</div>
                    </div>
                    <div class="welcome-option" id="welcomeAiChat">
                        <div class="welcome-option-icon">🧠</div>
                        <div>AI Assistant</div>
                    </div>
                    <div class="welcome-option" id="welcomeLiveChat">
                        <div class="welcome-option-icon">💬</div>
                        <div>Live Chat</div>
                    </div>
                </div>
            </div>
        `;
        
        // Add event listeners to the welcome options
        document.getElementById('welcomeFaqBot').addEventListener('click', function() {
            initializeFaqBot();
            currentChatMode = 'faq';
            
            // Update header
            document.getElementById('chatHeader').innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> &nbsp;JogjaCare FAQ Bot <div class="chat-close" id="chatClose">×</div>';
            
            // Rebind close button
            document.getElementById('chatClose').addEventListener('click', function() {
                chatWindow.style.display = 'none';
            });
        });
        
        document.getElementById('welcomeCustomerService').addEventListener('click', function() {
            initializeCustomerService();
            currentChatMode = 'cs';
            
            // Update header
            document.getElementById('chatHeader').innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> &nbsp;Customer Service <div class="chat-close" id="chatClose">×</div>';
            
            // Rebind close button
            document.getElementById('chatClose').addEventListener('click', function() {
                chatWindow.style.display = 'none';
            });
        });
        
        document.getElementById('welcomeAiChat').addEventListener('click', function() {
            initializeAiChat();
            currentChatMode = 'ai';
            
            // Update header
            document.getElementById('chatHeader').innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg> &nbsp;AI Assistant <div class="chat-close" id="chatClose">×</div>';
            
            // Rebind close button
            document.getElementById('chatClose').addEventListener('click', function() {
                chatWindow.style.display = 'none';
            });
        });
        
        // Add Live Chat option
        document.getElementById('welcomeLiveChat').addEventListener('click', function() {
            initializeTawkChat();
            currentChatMode = 'tawk';
            
            // Update header
            document.getElementById('chatHeader').innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> &nbsp;Live Chat <div class="chat-close" id="chatClose">×</div>';
            
            // Rebind close button
            document.getElementById('chatClose').addEventListener('click', function() {
                chatWindow.style.display = 'none';
                
                // Hide Tawk.to widget if it's visible
                if (window.Tawk_API) {
                    Tawk_API.hideWidget();
                }
            });
        });
        
        // Rebind close button
        document.getElementById('chatClose').addEventListener('click', function() {
            chatWindow.style.display = 'none';
        });
        
        // Show chat window
        chatWindow.style.display = 'flex';
    }
    
    // Close button for chat window
    chatClose.addEventListener('click', function() {
        chatWindow.style.display = 'none';
        
        // Hide Tawk.to widget if it's visible
        if (window.Tawk_API && currentChatMode === 'tawk') {
            Tawk_API.hideWidget();
        }
    });
    
    // Open FAQ Bot
    openFaqBot.addEventListener('click', function() {
        // Reset and initialize the FAQ bot
        initializeFaqBot();
        currentChatMode = 'faq';
        
        // Update header
        document.getElementById('chatHeader').innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> &nbsp;JogjaCare FAQ Bot <div class="chat-close" id="chatClose">×</div>';
        
        // Rebind close button
        document.getElementById('chatClose').addEventListener('click', function() {
            chatWindow.style.display = 'none';
        });
        
        // Show chat window and hide options
        chatWindow.style.display = 'flex';
        chatOptions.style.display = 'none';
    });
    
    // Open Customer Service
    openCustomerService.addEventListener('click', function() {
        initializeCustomerService();
        currentChatMode = 'cs';
        
        // Update header
        document.getElementById('chatHeader').innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> &nbsp;Customer Service <div class="chat-close" id="chatClose">×</div>';
        
        // Rebind close button
        document.getElementById('chatClose').addEventListener('click', function() {
            chatWindow.style.display = 'none';
        });
        
        // Show chat window and hide options
        chatWindow.style.display = 'flex';
        chatOptions.style.display = 'none';
    });
    
    // Open AI Chat
    openAiChat.addEventListener('click', function() {
        initializeAiChat();
        currentChatMode = 'ai';
        
        // Update header
        document.getElementById('chatHeader').innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg> &nbsp;AI Assistant <div class="chat-close" id="chatClose">×</div>';
        
        // Rebind close button
        document.getElementById('chatClose').addEventListener('click', function() {
            chatWindow.style.display = 'none';
        });
        
        // Show chat window and hide options
        chatWindow.style.display = 'flex';
        chatOptions.style.display = 'none';
    });
    
    // Add new Live Chat Option 
    // Create the new option in the chat bubble options menu
    const chatOptionsDiv = document.getElementById('chatOptions');
    const liveChatOption = document.createElement('div');
    liveChatOption.className = 'chat-option';
    liveChatOption.id = 'openLiveChat';
    liveChatOption.innerHTML = `
        <div class="chat-option-icon">💬</div>
        <div>Live Chat</div>
    `;
    chatOptionsDiv.appendChild(liveChatOption);
    
    // Add event listener for the new Live Chat option
    document.getElementById('openLiveChat').addEventListener('click', function() {
        initializeTawkChat();
        currentChatMode = 'tawk';
        
        // Update header
        document.getElementById('chatHeader').innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> &nbsp;Live Chat <div class="chat-close" id="chatClose">×</div>';
        
        // Rebind close button
        document.getElementById('chatClose').addEventListener('click', function() {
            chatWindow.style.display = 'none';
            
            // Hide Tawk.to widget if it's visible
            if (window.Tawk_API) {
                Tawk_API.hideWidget();
            }
        });
        
        // Show chat window and hide options
        chatWindow.style.display = 'flex';
        chatOptions.style.display = 'none';
    });
    
    // Handle send button click based on current mode
    document.getElementById('chatSend').addEventListener('click', function() {
        const chatInput = document.getElementById('chatInput');
        const message = chatInput.value.trim();
        
        if (message === '') return;
        
        switch(currentChatMode) {
            case 'faq':
                handleFaqBotMessage(message);
                break;
            case 'cs':
                handleCustomerServiceMessage(message);
                break;
            case 'ai':
                handleAiChatMessage(message);
                break;
            case 'tawk':
                handleTawkChatMessage(message);
                break;
        }
        
        // Clear input
        chatInput.value = '';
        
        // Focus on input after sending
        chatInput.focus();
    });
    
    // Handle enter key in input
    document.getElementById('chatInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('chatSend').click();
        }
    });
    
    // Helper functions for handling messages across all chat types
    window.addMessage = function(type, content) {
        const chatBody = document.getElementById('chatBody');
        const messageContainer = document.createElement('div');
        messageContainer.className = 'message-container';
        
        // Create message wrapper with avatar and message
        const messageWrapper = document.createElement('div');
        messageWrapper.className = `message-wrapper ${type === 'user' ? 'user-wrapper' : 'bot-wrapper'}`;
        
        // Create avatar element
        const avatar = document.createElement('div');
        avatar.className = `message-avatar ${type === 'user' ? 'user-avatar' : 'bot-avatar'}`;
        
        // Set avatar content based on type
        if (type === 'user') {
            avatar.innerHTML = `
                <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" width="36" height="36">
                    <circle cx="18" cy="18" r="18" fill="#e4e7f2"/>
                    <path d="M18,10.5 C19.6569,10.5 21,11.8431 21,13.5 C21,15.1569 19.6569,16.5 18,16.5 C16.3431,16.5 15,15.1569 15,13.5 C15,11.8431 16.3431,10.5 18,10.5 Z" fill="#8E54E9"/>
                    <path d="M24,25.5 C24,21.9101 21.3137,19 18,19 C14.6863,19 12,21.9101 12,25.5 L24,25.5 Z" fill="#8E54E9"/>
                </svg>
            `;
        } else {
            // Bot avatar with robot icon
            avatar.innerHTML = `
                <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" width="36" height="36">
                    <circle cx="18" cy="18" r="18" fill="#e4e7f2"/>
                    <circle cx="18" cy="14" r="6" fill="#4776E6"/>
                    <circle cx="15" cy="13" r="1.5" fill="white"/>
                    <circle cx="21" cy="13" r="1.5" fill="white"/>
                    <path d="M14,17 C14,17 16,19 18,19 C20,19 22,17 22,17" stroke="white" stroke-width="1.5" fill="none"/>
                    <rect x="13" y="20" width="10" height="8" rx="2" fill="#4776E6"/>
                    <circle cx="18" cy="24" r="1" fill="white"/>
                </svg>
            `;
        }
        
        // Create message element
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${type === 'user' ? 'user-message' : 'bot-message'}`;
        messageDiv.innerHTML = content;
        
        // Assemble message
        if (type === 'user') {
            messageWrapper.appendChild(messageDiv);
            messageWrapper.appendChild(avatar);
        } else {
            messageWrapper.appendChild(avatar);
            messageWrapper.appendChild(messageDiv);
        }
        
        messageContainer.appendChild(messageWrapper);
        chatBody.appendChild(messageContainer);
        
        // Scroll to bottom
        chatBody.scrollTop = chatBody.scrollHeight;
    };
    
    window.showTypingIndicator = function() {
        const chatBody = document.getElementById('chatBody');
        const messageContainer = document.createElement('div');
        messageContainer.className = 'message-container';
        
        // Create message wrapper
        const messageWrapper = document.createElement('div');
        messageWrapper.className = 'message-wrapper bot-wrapper';
        
        // Create avatar element
        const avatar = document.createElement('div');
        avatar.className = 'message-avatar bot-avatar';
        avatar.innerHTML = `
            <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" width="36" height="36">
                <circle cx="18" cy="18" r="18" fill="#e4e7f2"/>
                <circle cx="18" cy="14" r="6" fill="#4776E6"/>
                <circle cx="15" cy="13" r="1.5" fill="white"/>
                <circle cx="21" cy="13" r="1.5" fill="white"/>
                <path d="M14,17 C14,17 16,19 18,19 C20,19 22,17 22,17" stroke="white" stroke-width="1.5" fill="none"/>
                <rect x="13" y="20" width="10" height="8" rx="2" fill="#4776E6"/>
                <circle cx="18" cy="24" r="1" fill="white"/>
            </svg>
        `;
        
        // Create typing indicator
        const indicatorDiv = document.createElement('div');
        indicatorDiv.className = 'typing-indicator bot-message';
        indicatorDiv.id = 'typingIndicator';
        indicatorDiv.innerHTML = '<span></span><span></span><span></span>';
        
        // Assemble message
        messageWrapper.appendChild(avatar);
        messageWrapper.appendChild(indicatorDiv);
        messageContainer.appendChild(messageWrapper);
        chatBody.appendChild(messageContainer);
        
        // Scroll to bottom
        chatBody.scrollTop = chatBody.scrollHeight;
    };
    
    window.hideTypingIndicator = function() {
        const typingIndicator = document.getElementById('typingIndicator');
        if (typingIndicator) {
            // Remove the entire message container
            typingIndicator.closest('.message-container').remove();
        }
    };
    
    window.setInputState = function(disabled) {
        document.getElementById('chatInput').disabled = disabled;
        document.getElementById('chatSend').disabled = disabled;
    };
});

document.getElementById('welcomeLiveChat').addEventListener('click', function() {
    console.log('Live Chat button clicked');
    initializeTawkChat();
    currentChatMode = 'tawk';
    
    // Update header
    document.getElementById('chatHeader').innerHTML = '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> &nbsp;Live Chat <div class="chat-close" id="chatClose">×</div>';
    
    // Rebind close button with proper Tawk.to handling
    document.getElementById('chatClose').addEventListener('click', function() {
        chatWindow.style.display = 'none';
        
        // Hide Tawk.to widget when closing chat
        if (window.Tawk_API && typeof Tawk_API.hideWidget === 'function') {
            console.log('Hiding Tawk widget');
            Tawk_API.hideWidget();
        }
    });
});