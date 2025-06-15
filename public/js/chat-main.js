// Main Chat Manager - Updated without Live Chat
console.log("🔄 Loading chat-main.js...")

document.addEventListener("DOMContentLoaded", () => {
  console.log("📄 DOM loaded, initializing chat...")

  // Wait a bit for all scripts to load
  setTimeout(() => {
    initializeMainChat()
  }, 500)
})

function initializeMainChat() {
  console.log("🚀 Initializing main chat...")

  const chatBubble = document.getElementById("chatBubble")
  const chatWindow = document.getElementById("chatWindow")
  const chatClose = document.getElementById("chatClose")

  if (!chatBubble || !chatWindow) {
    console.error("❌ Chat elements not found")
    return
  }

  let currentChatMode = null

  // Toggle welcome screen
  chatBubble.addEventListener("click", () => {
    console.log("💬 Chat bubble clicked")
    if (chatWindow.style.display === "flex") {
      chatWindow.style.display = "none"
      return
    }
    showWelcomeScreen()
  })

  function showWelcomeScreen() {
    console.log("🏠 Showing welcome screen")

    // Check function availability
    console.log("🔍 Function availability check:")
    console.log("- CS function:", typeof window.initializeCustomerServiceChat)
    console.log("- FAQ function:", typeof window.initializeFaqAiChat)
    console.log("- Ambulance function:", typeof window.initializeAmbulanceService)

    document.getElementById("chatHeader").innerHTML =
      'JogjaCare Assistant <div class="chat-close" id="chatClose">×</div>'

    const chatBody = document.getElementById("chatBody")
    chatBody.innerHTML = `
            <div class="welcome-container">
                <div class="welcome-robot">
                    <svg class="robot-icon-large" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="60" height="60">
                        <circle class="robot-head" cx="12" cy="10" r="7" fill="#4776E6" />
                        <circle class="robot-eye" cx="9.5" cy="8.5" r="1.2" fill="white" />
                        <circle class="robot-eye" cx="14.5" cy="8.5" r="1.2" fill="white" />
                        <circle class="robot-ear" cx="5" cy="10" r="1.2" fill="#8E54E9" />
                        <circle class="robot-ear" cx="19" cy="10" r="1.2" fill="#8E54E9" />
                        <path class="robot-mask" d="M8,11 C8,11 10,13 12,13 C14,13 16,11 16,11 L16,14 C16,14 14,16 12,16 C10,16 8,14 8,14 Z" fill="#a3d4ff" />
                        <path class="robot-mask-strap" d="M8,11 C8,11 7,11 6,10 M16,11 C16,11 17,11 18,10" stroke="white" stroke-width="0.7" fill="none" />
                        <path class="robot-body" d="M9,17 L15,17 L15,22 L9,22 Z" fill="#4776E6" />
                        <circle class="robot-button" cx="12" cy="19.5" r="1" fill="white" />
                        <path class="robot-arm" d="M9,18 L5,20" stroke="#8E54E9" stroke-width="1.5" stroke-linecap="round" />
                        <path class="robot-arm" d="M15,18 L19,20" stroke="#8E54E9" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="welcome-title">JogjaCare Assistant</div>
                <div class="welcome-subtitle">Pilih layanan yang Anda butuhkan</div>
                
                <div class="welcome-options">
                    <div class="welcome-option" id="welcomeAmbulance" style="border: 2px solid #dc3545; background: #fff5f5;">
                        <div class="welcome-option-icon" style="background: #dc3545;">🚑</div>
                        <div>
                            <div style="font-weight: bold; color: #dc3545;">Panggil Ambulans</div>
                            <div style="font-size: 12px; color: #dc3545;">Layanan darurat ambulans</div>
                        </div>
                    </div>
                    <div class="welcome-option" id="welcomeFaqAi">
                        <div class="welcome-option-icon">🤖</div>
                        <div>
                            <div style="font-weight: bold;">FAQ & AI Chat</div>
                            <div style="font-size: 12px; color: #666;">Pertanyaan umum & AI assistant</div>
                        </div>
                    </div>
                    <div class="welcome-option" id="welcomeCustomerService">
                        <div class="welcome-option-icon">👨‍💼</div>
                        <div>
                            <div style="font-weight: bold;">Chat Customer Service</div>
                            <div style="font-size: 12px; color: #666;">Chat langsung dengan admin</div>
                        </div>
                    </div>
                </div>
            </div>
        `

    // Add event listeners with delay to ensure DOM is ready
    setTimeout(() => {
      addWelcomeEventListeners()
    }, 100)

    chatWindow.style.display = "flex"
  }

  function addWelcomeEventListeners() {
    console.log("🎯 Adding event listeners to welcome options")

    // Customer Service option - PRIORITY
    const csBtn = document.getElementById("welcomeCustomerService")
    if (csBtn) {
      console.log("🔧 Adding CS button listener...")
      csBtn.addEventListener("click", () => {
        console.log("👨‍💼 Customer Service clicked!")
        console.log("🔍 CS function type:", typeof window.initializeCustomerServiceChat)

        if (typeof window.initializeCustomerServiceChat === "function") {
          console.log("✅ CS function found, initializing...")
          cleanupCurrentMode()
          window.initializeCustomerServiceChat()
          currentChatMode = "customer-service"
          updateChatHeader("Customer Service", "fa-user-tie")
        } else {
          console.error("❌ CS function not found!")

          // Show detailed error in chat
          const chatBody = document.getElementById("chatBody")
          chatBody.innerHTML = `
                        <div style="padding: 20px; text-align: center;">
                            <div style="color: #dc3545; font-size: 18px; margin-bottom: 10px;">⚠️ Error</div>
                            <div style="margin-bottom: 15px;">Customer Service function not loaded</div>
                            <div style="font-size: 12px; color: #666; margin-bottom: 15px;">
                                Function type: ${typeof window.initializeCustomerServiceChat}
                            </div>
                            <button onclick="location.reload()" style="background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                                Refresh Page
                            </button>
                        </div>
                    `
        }
      })
      console.log("✅ CS button listener added")
    } else {
      console.error("❌ CS button not found in DOM")
    }

    // Ambulance option
    const ambulanceBtn = document.getElementById("welcomeAmbulance")
    if (ambulanceBtn) {
      ambulanceBtn.addEventListener("click", () => {
        console.log("🚑 Ambulance clicked")
        if (typeof window.initializeAmbulanceService === "function") {
          cleanupCurrentMode()
          window.initializeAmbulanceService()
          currentChatMode = "ambulance"
          updateChatHeader("Layanan Ambulans", "fa-ambulance")
        } else {
          console.error("❌ Ambulance function not found")
        }
      })
    }

    // FAQ & AI option
    const faqBtn = document.getElementById("welcomeFaqAi")
    if (faqBtn) {
      faqBtn.addEventListener("click", () => {
        console.log("🤖 FAQ AI clicked")
        if (typeof window.initializeFaqAiChat === "function") {
          cleanupCurrentMode()
          window.initializeFaqAiChat()
          currentChatMode = "faq-ai"
          updateChatHeader("FAQ & AI Assistant", "fa-question-circle")
        } else {
          console.error("❌ FAQ function not found")
        }
      })
    }

    // Close button
    const closeBtn = document.getElementById("chatClose")
    if (closeBtn) {
      closeBtn.addEventListener("click", () => {
        console.log("❌ Close clicked")
        chatWindow.style.display = "none"
        cleanupCurrentMode()
      })
    }
  }

  function updateChatHeader(title, icon) {
    document.getElementById("chatHeader").innerHTML =
      `<i class="fa ${icon}"></i> &nbsp;${title} <div class="chat-close" id="chatClose">×</div>`

    document.getElementById("chatClose").addEventListener("click", () => {
      chatWindow.style.display = "none"
      cleanupCurrentMode()
    })
  }

  function cleanupCurrentMode() {
    console.log("🧹 Cleaning up current mode:", currentChatMode)
    if (currentChatMode === "customer-service" && typeof window.cleanupCustomerServiceChat === "function") {
      window.cleanupCustomerServiceChat()
    }
    // Removed Tawk cleanup since we're removing live chat
  }

  // Close button handler
  if (chatClose) {
    chatClose.addEventListener("click", () => {
      chatWindow.style.display = "none"
      cleanupCurrentMode()
    })
  }

  // Message sending
  const chatSendBtn = document.getElementById("chatSend")
  if (chatSendBtn) {
    chatSendBtn.addEventListener("click", () => {
      const chatInput = document.getElementById("chatInput")
      const message = chatInput.value.trim()

      if (message === "") return

      // Handle different chat modes (removed tawk case)
      switch (currentChatMode) {
        case "faq-ai":
          if (window.handleFaqAiMessage) {
            window.handleFaqAiMessage(message)
          }
          break
        case "customer-service":
          if (window.handleCustomerServiceMessage) {
            window.handleCustomerServiceMessage(message)
          }
          break
        case "ambulance":
          if (window.addMessage) {
            window.addMessage("user", message)
            window.showTypingIndicator()
            setTimeout(() => {
              window.hideTypingIndicator()
              window.addMessage(
                "bot",
                "Untuk informasi lebih lanjut tentang layanan ambulans, silakan gunakan menu di atas atau hubungi nomor darurat yang tersedia.",
              )
            }, 1000)
          }
          break
      }

      chatInput.value = ""
      chatInput.focus()
    })
  }

  // Enter key handler
  const chatInput = document.getElementById("chatInput")
  if (chatInput) {
    chatInput.addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        document.getElementById("chatSend").click()
      }
    })
  }

  // Helper functions
  window.addMessage = (type, content) => {
    const chatBody = document.getElementById("chatBody")
    if (!chatBody) return

    const messageContainer = document.createElement("div")
    messageContainer.className = "message-container"

    const messageWrapper = document.createElement("div")
    messageWrapper.className = `message-wrapper ${type === "user" ? "user-wrapper" : "bot-wrapper"}`

    const avatar = document.createElement("div")
    avatar.className = `message-avatar ${type === "user" ? "user-avatar" : "bot-avatar"}`

    if (type === "user") {
      avatar.innerHTML = `
                <svg viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg" width="36" height="36">
                    <circle cx="18" cy="18" r="18" fill="#e4e7f2"/>
                    <path d="M18,10.5 C19.6569,10.5 21,11.8431 21,13.5 C21,15.1569 19.6569,16.5 18,16.5 C16.3431,16.5 15,15.1569 15,13.5 C15,11.8431 16.3431,10.5 18,10.5 Z" fill="#8E54E9"/>
                    <path d="M24,25.5 C24,21.9101 21.3137,19 18,19 C14.6863,19 12,21.9101 12,25.5 L24,25.5 Z" fill="#8E54E9"/>
                </svg>
            `
    } else {
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
            `
    }

    const messageDiv = document.createElement("div")
    messageDiv.className = `message ${type === "user" ? "user-message" : "bot-message"}`
    messageDiv.innerHTML = content

    if (type === "user") {
      messageWrapper.appendChild(messageDiv)
      messageWrapper.appendChild(avatar)
    } else {
      messageWrapper.appendChild(avatar)
      messageWrapper.appendChild(messageDiv)
    }

    messageContainer.appendChild(messageWrapper)
    chatBody.appendChild(messageContainer)
    chatBody.scrollTop = chatBody.scrollHeight
  }

  window.showTypingIndicator = () => {
    const chatBody = document.getElementById("chatBody")
    if (!chatBody) return

    const messageContainer = document.createElement("div")
    messageContainer.className = "message-container"

    const messageWrapper = document.createElement("div")
    messageWrapper.className = "message-wrapper bot-wrapper"

    const avatar = document.createElement("div")
    avatar.className = "message-avatar bot-avatar"
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
        `

    const indicatorDiv = document.createElement("div")
    indicatorDiv.className = "typing-indicator bot-message"
    indicatorDiv.id = "typingIndicator"
    indicatorDiv.innerHTML = "<span></span><span></span><span></span>"

    messageWrapper.appendChild(avatar)
    messageWrapper.appendChild(indicatorDiv)
    messageContainer.appendChild(messageWrapper)
    chatBody.appendChild(messageContainer)
    chatBody.scrollTop = chatBody.scrollHeight
  }

  window.hideTypingIndicator = () => {
    const typingIndicator = document.getElementById("typingIndicator")
    if (typingIndicator) {
      typingIndicator.closest(".message-container").remove()
    }
  }

  window.setInputState = (disabled) => {
    const chatInput = document.getElementById("chatInput")
    const chatSend = document.getElementById("chatSend")
    if (chatInput) chatInput.disabled = disabled
    if (chatSend) chatSend.disabled = disabled
  }

  console.log("✅ Main chat initialized successfully!")
}

console.log("✅ Chat main script loaded!")
