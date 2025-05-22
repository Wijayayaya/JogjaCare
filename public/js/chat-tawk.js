// Tawk.to integration for JogjaCare Chat
let tawkLoaded = false;
let tawkAttempts = 0;

// Function to initialize Tawk.to chat
function initializeTawkChat() {
    // Clear the chat body and start fresh
    const chatBody = document.getElementById('chatBody');
    chatBody.innerHTML = '';
    
    // Add welcome message
    addMessage('bot', 'Welcome to Live Chat! Connecting you with our customer service representative...');
    
    // Show typing indicator while we load the chat
    showTypingIndicator();
    
    // Load Tawk.to if not already loaded
    if (!tawkLoaded) {
        loadTawkTo();
    } else if (window.Tawk_API) {
        // If already loaded, show the widget but keep iframe hidden
        Tawk_API.showWidget();
        Tawk_API.maximize();
        hideTawkBubble();
    }
    
    // Hide the typing indicator after a short delay and show instructions
    setTimeout(() => {
        hideTypingIndicator();
        addMessage('bot', 'Live chat is connected. You can now chat with our customer service representatives.');
        
        // Enable the chat input
        setInputState(false);
    }, 1500);
}

// Function to handle sending messages to Tawk.to
function handleTawkChatMessage(message) {
    // Add user message to our UI
    addMessage('user', message);
    
    // Check if Tawk_API is available
    if (window.Tawk_API) {
        // Send message to Tawk.to
        if (Tawk_API.isVisitorEngaged()) {
            // If Tawk.to is already engaged with user, send message directly
            Tawk_API.sendMessage(message);
        } else {
            // If not engaged, maximize the widget and then send
            Tawk_API.maximize();
            
            // Wait a moment before sending the message
            setTimeout(() => {
                Tawk_API.sendMessage(message);
                hideTawkBubble();
            }, 500);
        }
        
        // Show typing indicator to simulate response preparation
        showTypingIndicator();
        
        // We can't directly get responses from Tawk.to, so we'll show a generic message after a brief delay
        setTimeout(() => {
            hideTypingIndicator();
            addMessage('bot', 'Message received. Our agent will respond shortly.');
        }, 1000);
    } else {
        // If Tawk_API is not available, show an error and try to reload
        showTypingIndicator();
        
        setTimeout(() => {
            hideTypingIndicator();
            addMessage('bot', 'Our chat service is currently having trouble connecting. Please try again in a moment.');
            
            // Try loading Tawk.to again
            if (tawkAttempts < 3) {
                tawkAttempts++;
                loadTawkTo();
            }
        }, 1500);
    }
}

// Function to hide Tawk.to's default bubble
function hideTawkBubble() {
    // Wait for Tawk iframe to load
    setTimeout(() => {
        // Find Tawk's iframe and bubble elements
        const tawkIframes = document.querySelectorAll('iframe[title*="chat"]');
        tawkIframes.forEach(iframe => {
            if (iframe.id && iframe.id.includes('tawk')) {
                // Set the iframe parent's style to hide only the bubble, not the chat window
                const bubbleElement = iframe.contentDocument.querySelector('.tawk-min-container');
                if (bubbleElement) {
                    bubbleElement.style.display = 'none';
                }
                
                // Use direct CSS insertion to hide Tawk's bubble
                try {
                    const style = iframe.contentDocument.createElement('style');
                    style.textContent = `
                        .tawk-min-container { 
                            display: none !important; 
                            visibility: hidden !important; 
                        }
                        .tawk-card, button[data-text="Open chat widget"] { 
                            display: none !important; 
                        }
                    `;
                    iframe.contentDocument.head.appendChild(style);
                } catch (e) {
                    console.log('Could not inject styles into Tawk iframe:', e);
                }
            }
        });
        
        // Apply additional styles to the main document to hide any tawk bubbles
        const style = document.createElement('style');
        style.textContent = `
            .tawk-min-container, 
            div[style*="tawk-min-container"],
            div[style*="tawkNotification"],
            [data-testid="tawkCard"],
            [data-text="Open chat widget"] {
                display: none !important;
                visibility: hidden !important;
                opacity: 0 !important;
                pointer-events: none !important;
            }
        `;
        document.head.appendChild(style);
        
    }, 1000);
}

// Function to load Tawk.to script
function loadTawkTo() {
    if (!tawkLoaded) {
        // Clear any existing Tawk elements to prevent duplicates
        var existingScript = document.querySelector('script[src*="tawk.to"]');
        if (existingScript) {
            existingScript.remove();
        }
        
        // Reset Tawk_API
        window.Tawk_API = window.Tawk_API || {};
        window.Tawk_LoadStart = new Date();
        
        // Configure Tawk_API
        Tawk_API.onLoad = function() {
            console.log('Tawk.to loaded successfully');
            tawkLoaded = true;
            tawkAttempts = 0;
            
            // Only show Tawk widget functionality but hide their bubble
            Tawk_API.showWidget();
            Tawk_API.maximize();
            
            // Hide Tawk's default bubble
            hideTawkBubble();
            
            // Set up observer to ensure bubble stays hidden
            startTawkBubbleObserver();
        };
        
        // Handle Tawk.to events
        Tawk_API.onChatMaximized = function() {
            // Make sure bubble is hidden when chat is maximized
            hideTawkBubble();
        };
        
        // Handle agent messages - to relay them to our custom UI
        Tawk_API.onChatMessageAgent = function(message) {
            addMessage('bot', message);
        };
        
        // Track when chat ends
        Tawk_API.onChatEnded = function() {
            addMessage('bot', 'The chat session has ended. Thank you for contacting us!');
        };
        
        // Create and insert Tawk.to script
        var s1 = document.createElement("script");
        var s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/682c9a1c7738b2190b341511/1irn3k0qg';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
        
        // Log for debugging
        console.log('Tawk.to script loading attempt: ' + (tawkAttempts + 1));
    } else {
        console.log('Tawk.to already loaded');
        if (window.Tawk_API) {
            Tawk_API.showWidget();
            Tawk_API.maximize();
            hideTawkBubble();
        }
    }
}

// Set up a mutation observer to continuously hide Tawk's bubble
function startTawkBubbleObserver() {
    // Observer to detect new elements and hide Tawk bubble if it reappears
    const observer = new MutationObserver(function(mutations) {
        hideTawkBubble();
    });
    
    // Observe the entire document for changes
    observer.observe(document.body, { 
        childList: true, 
        subtree: true 
    });
    
    // Run initially and set interval as backup
    hideTawkBubble();
    setInterval(hideTawkBubble, 2000); // Check every 2 seconds as backup
}

// Global mutation observer to make sure Tawk.to bubble stays hidden
document.addEventListener('DOMContentLoaded', function() {
    // Apply initial styles to prevent Tawk bubbles from showing
    const style = document.createElement('style');
    style.textContent = `
        /* Hide all tawk elements that could appear as bubbles */
        .tawk-min-container,
        [data-testid="tawkCard"],
        button[data-text="Open chat widget"],
        div[id*="tawk-bubble"],
        div[class*="tawk-bubble"],
        div[style*="tawk-min-container"],
        iframe[title*="chat"] {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            position: absolute !important;
            z-index: -9999 !important;
            pointer-events: none !important;
        }
    `;
    document.head.appendChild(style);
    
    // Create a reusable function to handle Tawk bubble hiding
    function hideTawkElements() {
        // Hide any Tawk bubbles that might appear
        const tawkElements = document.querySelectorAll('[id*="tawk"], [class*="tawk"]');
        tawkElements.forEach(el => {
            if (el.id && el.id.includes('bubble') || 
                el.className && el.className.includes('bubble') || 
                el.id && el.id.includes('min-container')) {
                el.style.display = 'none';
                el.style.visibility = 'hidden';
                el.style.opacity = '0';
                el.style.pointerEvents = 'none';
            }
        });
        
        // Handle iframes specifically
        const tawkIframes = document.querySelectorAll('iframe');
        tawkIframes.forEach(iframe => {
            try {
                if (iframe.id && iframe.id.includes('tawk')) {
                    // This is for the chat window, keep it but hide any bubble elements
                    const bubbleElements = iframe.contentDocument.querySelectorAll('.tawk-min-container, [data-testid="tawkCard"]');
                    bubbleElements.forEach(el => {
                        el.style.display = 'none';
                        el.style.visibility = 'hidden';
                    });
                    
                    // Add styles to the iframe's document
                    const iframeStyle = iframe.contentDocument.createElement('style');
                    iframeStyle.textContent = `
                        .tawk-min-container, 
                        [data-testid="tawkCard"],
                        [class*="tawk-bubble"],
                        [id*="tawk-bubble"] {
                            display: none !important;
                            visibility: hidden !important;
                            opacity: 0 !important;
                        }
                    `;
                    iframe.contentDocument.head.appendChild(iframeStyle);
                }
            } catch (e) {
                // Silent catch for cross-origin iframe security restrictions
            }
        });
    }
    
    // Set up a global observer to continuously monitor and hide Tawk elements
    const observer = new MutationObserver(function(mutations) {
        hideTawkElements();
    });
    
    // Start observing the document
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    
    // Run initially and periodically as backup
    hideTawkElements();
    setInterval(hideTawkElements, 1000);
    
    // Override Tawk_API methods to maintain our control
    if (typeof Tawk_API !== 'undefined') {
        const originalShowWidget = Tawk_API.showWidget;
        Tawk_API.showWidget = function() {
            if (originalShowWidget) originalShowWidget.call(Tawk_API);
            setTimeout(hideTawkElements, 100);
        };
    }
});