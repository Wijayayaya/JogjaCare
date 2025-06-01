// Updated Main Chat Manager with Ambulance Integration
document.addEventListener("DOMContentLoaded", () => {
    const chatBubble = document.getElementById("chatBubble")
    const chatWindow = document.getElementById("chatWindow")
    const chatClose = document.getElementById("chatClose")
  
    let currentChatMode = null
  
    // Declare the variables
    let initializeAmbulanceService
    let initializeFaqAiChat
    let initializeTawkChat
    let handleAmbulanceMessage
    let handleFaqAiMessage
    let handleTawkChatMessage
    let addMessage
    let showTypingIndicator
    let hideTypingIndicator
  
    // Toggle welcome screen
    chatBubble.addEventListener("click", () => {
      if (chatWindow.style.display === "flex") {
        chatWindow.style.display = "none"
        return
      }
  
      showWelcomeScreen()
    })
  
    // Update the welcome screen function to properly initialize the ambulance service
    function showWelcomeScreen() {
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
                  <div class="welcome-option" id="welcomeLiveChat">
                      <div class="welcome-option-icon">💬</div>
                      <div>
                          <div style="font-weight: bold;">Live Chat</div>
                          <div style="font-size: 12px; color: #666;">Chat dengan customer service</div>
                      </div>
                  </div>
              </div>
          </div>
      `
  
      // Make sure we have access to the functions before adding event listeners
      setTimeout(() => {
        // Add event listeners
        document.getElementById("welcomeAmbulance").addEventListener("click", () => {
          if (typeof window.initializeAmbulanceService === "function") {
            window.initializeAmbulanceService()
            currentChatMode = "ambulance"
  
            document.getElementById("chatHeader").innerHTML =
              '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg> &nbsp;Layanan Ambulans <div class="chat-close" id="chatClose">×</div>'
  
            document.getElementById("chatClose").addEventListener("click", () => {
              chatWindow.style.display = "none"
            })
          } else {
            console.error("initializeAmbulanceService function not found")
          }
        })
  
        document.getElementById("welcomeFaqAi").addEventListener("click", () => {
          if (typeof window.initializeFaqAiChat === "function") {
            window.initializeFaqAiChat()
            currentChatMode = "faq-ai"
  
            document.getElementById("chatHeader").innerHTML =
              '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg> &nbsp;FAQ & AI Assistant <div class="chat-close" id="chatClose">×</div>'
  
            document.getElementById("chatClose").addEventListener("click", () => {
              chatWindow.style.display = "none"
            })
          } else {
            console.error("initializeFaqAiChat function not found")
          }
        })
  
        document.getElementById("welcomeLiveChat").addEventListener("click", () => {
          if (typeof window.initializeTawkChat === "function") {
            window.initializeTawkChat()
            currentChatMode = "tawk"
  
            document.getElementById("chatHeader").innerHTML =
              '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg> &nbsp;Live Chat <div class="chat-close" id="chatClose">×</div>'
  
            document.getElementById("chatClose").addEventListener("click", () => {
              chatWindow.style.display = "none"
              if (typeof Tawk_API !== "undefined") {
                Tawk_API.hideWidget()
              }
            })
          } else {
            console.error("initializeTawkChat function not found")
          }
        })
  
        document.getElementById("chatClose").addEventListener("click", () => {
          chatWindow.style.display = "none"
        })
      }, 100)
  
      chatWindow.style.display = "flex"
    }
  
    chatClose.addEventListener("click", () => {
      chatWindow.style.display = "none"
  
      if (window.Tawk_API && currentChatMode === "tawk") {
        Tawk_API.hideWidget()
      }
    })
  
    // Updated message handler with ambulance support
    document.getElementById("chatSend").addEventListener("click", () => {
      const chatInput = document.getElementById("chatInput")
      const message = chatInput.value.trim()
  
      if (message === "") return
  
      // Check for ambulance keywords first
      if (handleAmbulanceMessage && handleAmbulanceMessage(message)) {
        currentChatMode = "ambulance"
        chatInput.value = ""
        chatInput.focus()
        return
      }
  
      switch (currentChatMode) {
        case "faq-ai":
          handleFaqAiMessage(message)
          break
        case "tawk":
          handleTawkChatMessage(message)
          break
        case "ambulance":
          // For ambulance mode, treat as general inquiry
          addMessage("user", message)
          showTypingIndicator()
          setTimeout(() => {
            hideTypingIndicator()
            addMessage(
              "bot",
              "Untuk informasi lebih lanjut tentang layanan ambulans, silakan gunakan menu di atas atau hubungi nomor darurat yang tersedia.",
            )
          }, 1000)
          break
      }
  
      chatInput.value = ""
      chatInput.focus()
    })
  
    document.getElementById("chatInput").addEventListener("keypress", (e) => {
      if (e.key === "Enter") {
        document.getElementById("chatSend").click()
      }
    })
  
    // Helper functions remain the same
    window.addMessage = (type, content) => {
      const chatBody = document.getElementById("chatBody")
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
      document.getElementById("chatInput").disabled = disabled
      document.getElementById("chatSend").disabled = disabled
    }
  })
  