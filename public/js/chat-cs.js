// Customer Service Chat Integration - Simplified Version
console.log("🔄 Loading chat-cs.js...")(
  // Initialize immediately when script loads
  () => {
    const csMessages = []
    let csLastMessageId = 0
    let csPollInterval = null
    let csInitialized = false

    function initializeCustomerServiceChat() {
      console.log("🚀 Initializing Customer Service Chat...")

      // Clear chat body
      const chatBody = document.getElementById("chatBody")
      if (!chatBody) {
        console.error("❌ Chat body not found")
        return
      }

      chatBody.innerHTML = ""

      // Check if user is logged in
      if (!isUserLoggedIn()) {
        addMessageSafe("bot", "🔐 Untuk menggunakan layanan chat customer service, Anda harus login terlebih dahulu.")

        const loginHtml = `
                <div style="margin-top: 15px; text-align: center;">
                    <a href="/login" class="btn btn-primary" style="background: linear-gradient(135deg, #4776E6 0%, #8E54E9 100%); color: white; padding: 10px 20px; border-radius: 20px; text-decoration: none; display: inline-block;">
                        Login Sekarang
                    </a>
                </div>
            `
        addMessageSafe("bot", loginHtml)
        return
      }

      // Initialize chat
      addMessageSafe("bot", "💬 Menghubungkan Anda dengan customer service...")
      showTypingIndicatorSafe()

      // Load existing messages
      fetch("/customer-service/initialize", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": getCSRFToken(),
        },
      })
        .then((response) => response.json())
        .then((data) => {
          hideTypingIndicatorSafe()

          if (data.messages && data.messages.length > 0) {
            addMessageSafe("bot", "📋 Memuat riwayat percakapan...")

            data.messages.forEach((message) => {
              displayCsMessage(message)
            })

            csLastMessageId = Math.max(...data.messages.map((m) => m.id))
          } else {
            addMessageSafe("bot", "👋 Halo! Saya customer service JogjaCare. Ada yang bisa saya bantu?")
          }

          csInitialized = true
          startCsPolling()
          setInputStateSafe(false)
        })
        .catch((error) => {
          hideTypingIndicatorSafe()
          console.error("❌ Error initializing CS chat:", error)
          addMessageSafe(
            "bot",
            "❌ Maaf, terjadi kesalahan saat menghubungkan ke customer service. Silakan coba lagi nanti.",
          )
          setInputStateSafe(false)
        })
    }

    function handleCustomerServiceMessage(message) {
      console.log("📨 Handling CS message:", message)

      if (!csInitialized) {
        addMessageSafe("bot", "⏳ Sedang menginisialisasi chat. Silakan tunggu sebentar...")
        return
      }

      // Add user message to UI immediately
      addMessageSafe("user", message)

      // Send message to server
      fetch("/customer-service/send", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": getCSRFToken(),
        },
        body: JSON.stringify({ message: message }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            csLastMessageId = data.message.id

            // Show typing indicator to simulate admin response time
            showTypingIndicatorSafe()
            setTimeout(() => {
              hideTypingIndicatorSafe()
              addMessageSafe("bot", "✅ Pesan terkirim. Customer service akan merespons segera.")
            }, 1000)
          } else {
            addMessageSafe("bot", "❌ Gagal mengirim pesan. Silakan coba lagi.")
          }
        })
        .catch((error) => {
          console.error("❌ Error sending CS message:", error)
          addMessageSafe("bot", "❌ Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.")
        })
    }

    function displayCsMessage(message) {
      const messageText = message.message
      const senderType = message.sender_type
      const senderName = message.sender_name
      const time = message.created_at

      if (senderType === "user") {
        return // Don't display user messages again
      } else {
        // Display admin message
        const adminMessage = `
                <div style="background: #f0f8ff; border-left: 4px solid #4776E6; padding: 12px; margin: 10px 0; border-radius: 8px;">
                    <div style="font-weight: bold; color: #4776E6; margin-bottom: 5px;">
                        👨‍💼 ${senderName} • ${time}
                    </div>
                    <div>${messageText}</div>
                </div>
            `
        addMessageSafe("bot", adminMessage)
      }
    }

    function startCsPolling() {
      stopCsPolling()
      csPollInterval = setInterval(() => {
        if (csInitialized) {
          checkForNewCsMessages()
        }
      }, 3000)
    }

    function stopCsPolling() {
      if (csPollInterval) {
        clearInterval(csPollInterval)
        csPollInterval = null
      }
    }

    function checkForNewCsMessages() {
      fetch(`/customer-service/messages?last_message_id=${csLastMessageId}`, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": getCSRFToken(),
        },
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.messages && data.messages.length > 0) {
            data.messages.forEach((message) => {
              if (message.sender_type === "admin") {
                displayCsMessage(message)
              }
            })
            csLastMessageId = Math.max(...data.messages.map((m) => m.id))
          }
        })
        .catch((error) => {
          console.error("❌ Error checking for new CS messages:", error)
        })
    }

    function cleanupCustomerServiceChat() {
      stopCsPolling()
      csInitialized = false
      csLastMessageId = 0
    }

    // Helper functions
    function isUserLoggedIn() {
      return getCSRFToken() !== null
    }

    function getCSRFToken() {
      const csrfToken = document.querySelector('meta[name="csrf-token"]')
      return csrfToken ? csrfToken.getAttribute("content") : null
    }

    function addMessageSafe(type, message) {
      if (typeof window.addMessage === "function") {
        window.addMessage(type, message)
      } else {
        console.log(`Message (${type}):`, message)
      }
    }

    function showTypingIndicatorSafe() {
      if (typeof window.showTypingIndicator === "function") {
        window.showTypingIndicator()
      }
    }

    function hideTypingIndicatorSafe() {
      if (typeof window.hideTypingIndicator === "function") {
        window.hideTypingIndicator()
      }
    }

    function setInputStateSafe(disabled) {
      if (typeof window.setInputState === "function") {
        window.setInputState(disabled)
      }
    }

    // Make functions available globally IMMEDIATELY
    window.initializeCustomerServiceChat = initializeCustomerServiceChat
    window.handleCustomerServiceMessage = handleCustomerServiceMessage
    window.cleanupCustomerServiceChat = cleanupCustomerServiceChat

    console.log("✅ Customer Service Chat functions loaded successfully!")
    console.log("🔍 Function check:", typeof window.initializeCustomerServiceChat)
  },
)()
