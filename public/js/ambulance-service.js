// Ambulance Service Integration for JogjaCare Chat
const ambulanceData = {
    emergency_contacts: {
      118: {
        name: "Ambulans Nasional Indonesia",
        description: "Layanan ambulans darurat nasional 24 jam",
        coverage: "Seluruh Indonesia",
        response_time: "8-15 menit",
      },
      119: {
        name: "Pemadam Kebakaran & Rescue",
        description: "Layanan darurat kebakaran dan penyelamatan",
        coverage: "Yogyakarta",
        response_time: "5-10 menit",
      },
    },
    hospitals_with_ambulance: {
      "RSUP Dr. Sardjito": {
        phone: "(0274) 587333",
        ambulance_phone: "(0274) 587333 ext. 1234",
        address: "Jl. Kesehatan No.1, Yogyakarta",
        distance_from_malioboro: "3.2 km",
        response_time: "10-15 menit",
        facilities: ["ICU Mobile", "Ventilator", "Defibrillator"],
      },
      "RS Bethesda": {
        phone: "(0274) 563533",
        ambulance_phone: "(0274) 563533 ext. 911",
        address: "Jl. Jend. Sudirman No.70, Yogyakarta",
        distance_from_malioboro: "2.8 km",
        response_time: "8-12 menit",
        facilities: ["Basic Life Support", "Oksigen", "Stretcher"],
      },
      "RS PKU Muhammadiyah Yogyakarta": {
        phone: "(0274) 512653",
        ambulance_phone: "(0274) 512653 ext. 119",
        address: "Jl. KH. Ahmad Dahlan No.20, Yogyakarta",
        distance_from_malioboro: "1.5 km",
        response_time: "5-10 menit",
        facilities: ["Advanced Life Support", "Cardiac Monitor", "Suction"],
      },
    },
    private_ambulance: {
      "Ambulans Jogja 24 Jam": {
        phone: "0812-3456-7890",
        whatsapp: "0812-3456-7890",
        tariff: "Rp 200.000 - Rp 500.000",
        coverage: "DIY & Jawa Tengah",
        response_time: "15-20 menit",
      },
      "Medika Ambulance": {
        phone: "0813-2345-6789",
        whatsapp: "0813-2345-6789",
        tariff: "Rp 150.000 - Rp 400.000",
        coverage: "Yogyakarta & sekitarnya",
        response_time: "10-15 menit",
      },
    },
  }
  
  // Mock addMessage, showTypingIndicator, and hideTypingIndicator for this standalone context
  function addMessage(sender, message) {
    console.log(`${sender}: ${message}`)
  }
  
  function showTypingIndicator() {
    console.log("Bot is typing...")
  }
  
  function hideTypingIndicator() {
    console.log("Bot stopped typing.")
  }
  
  // Initialize Ambulance Service
  function initializeAmbulanceService() {
    const chatBody = document.getElementById("chatBody")
    if (chatBody) {
      chatBody.innerHTML = ""
    }
  
    // Emergency warning message
    addMessage("bot", '🚨 <strong style="color: #dc3545;">LAYANAN DARURAT AMBULANS</strong> 🚨')
    addMessage("bot", "⚠️ <strong>Jika ini adalah keadaan darurat yang mengancam jiwa, segera hubungi:</strong>")
  
    // Emergency numbers
    const emergencyHtml = `
          <div style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px; padding: 12px; margin: 10px 0;">
              <div style="font-weight: bold; color: #856404; margin-bottom: 8px;">📞 NOMOR DARURAT:</div>
              <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                  <span>🚑 Ambulans Nasional:</span>
                  <a href="tel:118" style="color: #dc3545; font-weight: bold; text-decoration: none;">118</a>
              </div>
              <div style="display: flex; justify-content: space-between;">
                  <span>🚒 Pemadam & Rescue:</span>
                  <a href="tel:119" style="color: #dc3545; font-weight: bold; text-decoration: none;">119</a>
              </div>
          </div>
      `
  
    addMessage("bot", emergencyHtml)
    addMessage("bot", "Untuk layanan ambulans non-darurat, silakan pilih opsi di bawah ini:")
  
    // Ambulance options
    displayAmbulanceOptions()
  }
  
  // Modify the displayAmbulanceOptions function to use proper onclick handlers
  function displayAmbulanceOptions() {
    const optionsHtml = `
          <div style="margin-top: 15px;">
              <div style="font-weight: bold; margin-bottom: 10px;">🏥 Pilih Jenis Layanan Ambulans:</div>
              <div class="ambulance-options">
                  <div class="ambulance-option" onclick="window.showHospitalAmbulances()">
                      <div class="ambulance-option-icon">🏥</div>
                      <div>
                          <div style="font-weight: bold;">Ambulans Rumah Sakit</div>
                          <div style="font-size: 12px; color: #666;">Ambulans dari RS terdekat</div>
                      </div>
                  </div>
                  <div class="ambulance-option" onclick="window.showPrivateAmbulances()">
                      <div class="ambulance-option-icon">🚑</div>
                      <div>
                          <div style="font-weight: bold;">Ambulans Swasta</div>
                          <div style="font-size: 12px; color: #666;">Layanan ambulans privat</div>
                      </div>
                  </div>
                  <div class="ambulance-option" onclick="window.showEmergencyTips()">
                      <div class="ambulance-option-icon">📋</div>
                      <div>
                          <div style="font-weight: bold;">Tips Darurat</div>
                          <div style="font-size: 12px; color: #666;">Panduan pertolongan pertama</div>
                      </div>
                  </div>
              </div>
          </div>
      `
  
    addMessage("bot", optionsHtml)
  }
  
  // Modify the showHospitalAmbulances function to use proper back button
  function showHospitalAmbulances() {
    addMessage("user", "Ambulans Rumah Sakit")
  
    let hospitalHtml =
      '<div class="back-button" onclick="window.displayAmbulanceOptions()">← Kembali ke Menu Ambulans</div>'
    hospitalHtml += '<div style="font-weight: bold; margin-bottom: 10px;">🏥 Ambulans Rumah Sakit Terdekat:</div>'
  
    for (const [hospital, data] of Object.entries(ambulanceData.hospitals_with_ambulance)) {
      hospitalHtml += `
              <div class="hospital-ambulance-card" style="border: 1px solid #e4e7f2; border-radius: 8px; padding: 12px; margin-bottom: 10px; background: #f8f9fd;">
                  <div style="font-weight: bold; color: #4776E6; margin-bottom: 5px;">${hospital}</div>
                  <div style="font-size: 13px; margin-bottom: 8px;">📍 ${data.address}</div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5px; font-size: 12px; margin-bottom: 8px;">
                      <div>📏 Jarak: ${data.distance_from_malioboro}</div>
                      <div>⏱️ Respon: ${data.response_time}</div>
                  </div>
                  <div style="font-size: 12px; margin-bottom: 8px;">
                      🏥 Fasilitas: ${data.facilities.join(", ")}
                  </div>
                  <div style="display: flex; gap: 8px;">
                      <a href="tel:${data.ambulance_phone}" style="background: #dc3545; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: bold;">📞 Panggil Ambulans</a>
                      <a href="tel:${data.phone}" style="background: #28a745; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px;">📞 Info RS</a>
                  </div>
              </div>
          `
    }
  
    addMessage("bot", hospitalHtml)
  }
  
  // Modify the showPrivateAmbulances function to use proper back button
  function showPrivateAmbulances() {
    addMessage("user", "Ambulans Swasta")
  
    let privateHtml =
      '<div class="back-button" onclick="window.displayAmbulanceOptions()">← Kembali ke Menu Ambulans</div>'
    privateHtml += '<div style="font-weight: bold; margin-bottom: 10px;">🚑 Layanan Ambulans Swasta:</div>'
  
    for (const [service, data] of Object.entries(ambulanceData.private_ambulance)) {
      privateHtml += `
              <div class="private-ambulance-card" style="border: 1px solid #e4e7f2; border-radius: 8px; padding: 12px; margin-bottom: 10px; background: #f8f9fd;">
                  <div style="font-weight: bold; color: #4776E6; margin-bottom: 5px;">${service}</div>
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5px; font-size: 12px; margin-bottom: 8px;">
                      <div>💰 Tarif: ${data.tariff}</div>
                      <div>⏱️ Respon: ${data.response_time}</div>
                  </div>
                  <div style="font-size: 12px; margin-bottom: 8px;">
                      📍 Cakupan: ${data.coverage}
                  </div>
                  <div style="display: flex; gap: 8px;">
                      <a href="tel:${data.phone}" style="background: #dc3545; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: bold;">📞 Telepon</a>
                      <a href="https://wa.me/${data.whatsapp.replace(/[^0-9]/g, "")}" style="background: #25d366; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px;">💬 WhatsApp</a>
                  </div>
              </div>
          `
    }
  
    addMessage("bot", privateHtml)
  }
  
  // Modify the showEmergencyTips function to use proper back button
  function showEmergencyTips() {
    addMessage("user", "Tips Darurat")
  
    let tipsHtml = '<div class="back-button" onclick="window.displayAmbulanceOptions()">← Kembali ke Menu Ambulans</div>'
    tipsHtml += `
          <div style="font-weight: bold; margin-bottom: 10px;">📋 Tips Pertolongan Pertama:</div>
          <div style="background: #d1ecf1; border: 1px solid #bee5eb; border-radius: 8px; padding: 12px; margin-bottom: 10px;">
              <div style="font-weight: bold; color: #0c5460; margin-bottom: 8px;">🆘 Saat Menunggu Ambulans:</div>
              <ul style="margin: 0; padding-left: 20px; font-size: 13px;">
                  <li>Tetap tenang dan jangan panik</li>
                  <li>Pastikan korban dalam posisi aman</li>
                  <li>Jangan memindahkan korban jika ada cedera tulang belakang</li>
                  <li>Berikan pertolongan pertama sesuai kemampuan</li>
                  <li>Siapkan informasi lokasi yang jelas</li>
              </ul>
          </div>
          <div style="background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 8px; padding: 12px; margin-bottom: 10px;">
              <div style="font-weight: bold; color: #721c24; margin-bottom: 8px;">⚠️ Informasi Penting untuk Operator:</div>
              <ul style="margin: 0; padding-left: 20px; font-size: 13px;">
                  <li>Lokasi kejadian yang tepat</li>
                  <li>Kondisi korban saat ini</li>
                  <li>Jumlah korban</li>
                  <li>Jenis kecelakaan/penyakit</li>
                  <li>Nomor telepon yang bisa dihubungi</li>
              </ul>
          </div>
      `
  
    addMessage("bot", tipsHtml)
  }
  
  // Handle ambulance-related messages
  function handleAmbulanceMessage(message) {
    const lowerMessage = message.toLowerCase()
  
    if (
      lowerMessage.includes("ambulan") ||
      lowerMessage.includes("darurat") ||
      lowerMessage.includes("emergency") ||
      lowerMessage.includes("118") ||
      lowerMessage.includes("119")
    ) {
      addMessage("user", message)
  
      showTypingIndicator()
      setTimeout(() => {
        hideTypingIndicator()
  
        if (lowerMessage.includes("darurat") || lowerMessage.includes("emergency")) {
          addMessage(
            "bot",
            '🚨 Untuk keadaan darurat yang mengancam jiwa, segera hubungi <a href="tel:118" style="color: #dc3545; font-weight: bold;">118</a> (Ambulans) atau <a href="tel:119" style="color: #dc3545; font-weight: bold;">119</a> (Rescue)',
          )
        }
  
        addMessage("bot", "Saya akan menampilkan informasi lengkap layanan ambulans untuk Anda.")
        initializeAmbulanceService()
      }, 1500)
  
      return true
    }
  
    return false
  }
  
  // Make sure all functions are properly exposed to the global scope
  window.initializeAmbulanceService = initializeAmbulanceService
  window.displayAmbulanceOptions = displayAmbulanceOptions
  window.showHospitalAmbulances = showHospitalAmbulances
  window.showPrivateAmbulances = showPrivateAmbulances
  window.showEmergencyTips = showEmergencyTips
  window.handleAmbulanceMessage = handleAmbulanceMessage
  