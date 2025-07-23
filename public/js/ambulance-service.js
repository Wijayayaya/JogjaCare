// Ambulance Service Integration with Database for JogjaCare Chat
// Uses: App\Http\Controllers\Frontend\AmbulanceServiceController
console.log("🚑 Loading ambulance service with database integration...")

// Global variables for ambulance data
let ambulanceData = {
  emergency_contacts: {},
  hospitals_with_ambulance: {},
  private_ambulance: {},
}

let isDataLoaded = false

// Load ambulance data from database
async function loadAmbulanceData() {
  try {
    console.log("📡 Fetching ambulance data from database...")

    const response = await fetch("/api/ambulance/", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
    })

    if (!response.ok) {
      throw new Error(`HTTP ${response.status}: ${response.statusText}`)
    }

    const result = await response.json()

    if (!result.success) {
      throw new Error(result.message || "Failed to fetch ambulance data")
    }

    // Transform database data to match the expected format
    transformAmbulanceData(result.data)
    isDataLoaded = true

    console.log("✅ Ambulance data loaded successfully")
    return true
  } catch (error) {
    console.error("❌ Error loading ambulance data:", error)

    // Fallback to show error message
    if (typeof window.addMessage === "function") {
      window.addMessage("bot", `❌ Gagal memuat data ambulans: ${error.message}`)
    }

    return false
  }
}

// Transform database data to match the expected format
function transformAmbulanceData(data) {
  console.log("🔄 Transforming ambulance data...")

  // Reset data
  ambulanceData = {
    emergency_contacts: {},
    hospitals_with_ambulance: {},
    private_ambulance: {},
  }

  // Transform emergency contacts
  if (data.emergency && data.emergency.length > 0) {
    data.emergency.forEach((ambulance) => {
      ambulanceData.emergency_contacts[ambulance.phone] = {
        name: ambulance.name,
        description: ambulance.description || "",
        coverage: ambulance.coverage_area || "",
        response_time: ambulance.response_time || "",
      }
    })
  }

  // Transform hospital ambulances
  if (data.hospital && data.hospital.length > 0) {
    data.hospital.forEach((ambulance) => {
      ambulanceData.hospitals_with_ambulance[ambulance.name] = {
        phone: ambulance.phone,
        ambulance_phone: ambulance.phone,
        whatsapp: ambulance.whatsapp,
        address: ambulance.address || "",
        distance_from_malioboro: ambulance.distance_from_malioboro || "",
        response_time: ambulance.response_time || "",
        tariff_range: ambulance.tariff_range || "",
        facilities: ambulance.facilities || [],
        coverage_area: ambulance.coverage_area || "",
        description: ambulance.description || "",
      }
    })
  }

  // Transform private ambulances
  if (data.private && data.private.length > 0) {
    data.private.forEach((ambulance) => {
      ambulanceData.private_ambulance[ambulance.name] = {
        phone: ambulance.phone,
        whatsapp: ambulance.whatsapp,
        address: ambulance.address || "",
        tariff: ambulance.tariff_range || "",
        coverage: ambulance.coverage_area || "",
        response_time: ambulance.response_time || "",
        facilities: ambulance.facilities || [],
        description: ambulance.description || "",
      }
    })
  }

  console.log("✅ Data transformation completed")
}

// Initialize Ambulance Service with database data
async function initializeAmbulanceService() {
  const chatBody = document.getElementById("chatBody")
  if (chatBody) {
    chatBody.innerHTML = ""
  }

  // Load data if not already loaded
  if (!isDataLoaded) {
    if (typeof window.addMessage === "function") {
      window.addMessage("bot", "📡 Memuat data ambulans...")
      window.showTypingIndicator()
    }

    const loaded = await loadAmbulanceData()

    if (typeof window.hideTypingIndicator === "function") {
      window.hideTypingIndicator()
    }

    if (!loaded) {
      if (typeof window.addMessage === "function") {
        window.addMessage("bot", "❌ Gagal memuat data ambulans. Silakan coba lagi nanti.")
      }
      return
    }
  }

  // Emergency warning message
  if (typeof window.addMessage === "function") {
    window.addMessage("bot", '🚨 <strong style="color: #dc3545;">LAYANAN DARURAT AMBULANS</strong> 🚨')
    window.addMessage("bot", "⚠️ <strong>Jika ini adalah keadaan darurat yang mengancam jiwa, segera hubungi:</strong>")
  }

  // Emergency numbers from database
  const emergencyHtml = generateEmergencyContactsHtml()
  if (typeof window.addMessage === "function") {
    window.addMessage("bot", emergencyHtml)
    window.addMessage("bot", "Untuk layanan ambulans non-darurat, silakan pilih opsi di bawah ini:")
  }

  // Ambulance options
  displayAmbulanceOptions()
}

// Generate emergency contacts HTML from database
function generateEmergencyContactsHtml() {
  let html = `
        <div style="background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px; padding: 12px; margin: 10px 0;">
            <div style="font-weight: bold; color: #856404; margin-bottom: 8px;">📞 NOMOR DARURAT:</div>
    `

  for (const [phone, data] of Object.entries(ambulanceData.emergency_contacts)) {
    html += `
            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                <span>🚑 ${data.name}:</span>
                <a href="tel:${phone}" style="color: #dc3545; font-weight: bold; text-decoration: none;">${phone}</a>
            </div>
        `
  }

  html += `</div>`
  return html
}

// Display ambulance options
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

  if (typeof window.addMessage === "function") {
    window.addMessage("bot", optionsHtml)
  }
}

// Show hospital ambulances from database
function showHospitalAmbulances() {
  if (typeof window.addMessage === "function") {
    window.addMessage("user", "Ambulans Rumah Sakit")
  }

  let hospitalHtml =
    '<div class="back-button" onclick="window.displayAmbulanceOptions()">← Kembali ke Menu Ambulans</div>'
  hospitalHtml += '<div style="font-weight: bold; margin-bottom: 10px;">🏥 Ambulans Rumah Sakit Terdekat:</div>'

  for (const [hospital, data] of Object.entries(ambulanceData.hospitals_with_ambulance)) {
    const facilitiesText = Array.isArray(data.facilities)
      ? data.facilities.join(", ")
      : data.facilities || "Tidak tersedia"

    hospitalHtml += `
            <div class="hospital-ambulance-card" style="border: 1px solid #e4e7f2; border-radius: 8px; padding: 12px; margin-bottom: 10px; background: #f8f9fd;">
                <div style="font-weight: bold; color: #4776E6; margin-bottom: 5px;">${hospital}</div>
                <div style="font-size: 13px; margin-bottom: 8px;">📍 ${data.address}</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5px; font-size: 12px; margin-bottom: 8px;">
                    <div>📏 Jarak: ${data.distance_from_malioboro}</div>
                    <div>⏱️ Respon: ${data.response_time}</div>
                </div>
                <div style="font-size: 12px; margin-bottom: 8px;">
                    💰 Tarif: ${data.tariff_range || "Hubungi RS"}
                </div>
                <div style="font-size: 12px; margin-bottom: 8px;">
                    🏥 Fasilitas: ${facilitiesText}
                </div>
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <a href="tel:${data.ambulance_phone}" style="background: #dc3545; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: bold;">📞 Panggil Ambulans</a>
                    <a href="tel:${data.phone}" style="background: #28a745; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px;">📞 Info RS</a>
                    ${data.whatsapp ? `<a href="https://wa.me/${data.whatsapp.replace(/[^0-9]/g, "")}" style="background: #25d366; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px;">💬 WhatsApp</a>` : ""}
                </div>
            </div>
        `
  }

  if (typeof window.addMessage === "function") {
    window.addMessage("bot", hospitalHtml)
  }
}

// Show private ambulances from database
function showPrivateAmbulances() {
  if (typeof window.addMessage === "function") {
    window.addMessage("user", "Ambulans Swasta")
  }

  let privateHtml =
    '<div class="back-button" onclick="window.displayAmbulanceOptions()">← Kembali ke Menu Ambulans</div>'
  privateHtml += '<div style="font-weight: bold; margin-bottom: 10px;">🚑 Layanan Ambulans Swasta:</div>'

  for (const [service, data] of Object.entries(ambulanceData.private_ambulance)) {
    privateHtml += `
            <div class="private-ambulance-card" style="border: 1px solid #e4e7f2; border-radius: 8px; padding: 12px; margin-bottom: 10px; background: #f8f9fd;">
                <div style="font-weight: bold; color: #4776E6; margin-bottom: 5px;">${service}</div>
                <div style="font-size: 13px; margin-bottom: 8px;">📍 ${data.address}</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5px; font-size: 12px; margin-bottom: 8px;">
                    <div>💰 Tarif: ${data.tariff}</div>
                    <div>⏱️ Respon: ${data.response_time}</div>
                </div>
                <div style="font-size: 12px; margin-bottom: 8px;">
                    📍 Cakupan: ${data.coverage}
                </div>
                ${
                  data.facilities && data.facilities.length > 0
                    ? `
                <div style="font-size: 12px; margin-bottom: 8px;">
                    🏥 Fasilitas: ${Array.isArray(data.facilities) ? data.facilities.join(", ") : data.facilities}
                </div>
                `
                    : ""
                }
                <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                    <a href="tel:${data.phone}" style="background: #dc3545; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px; font-weight: bold;">📞 Telepon</a>
                    ${data.whatsapp ? `<a href="https://wa.me/${data.whatsapp.replace(/[^0-9]/g, "")}" style="background: #25d366; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 12px;">💬 WhatsApp</a>` : ""}
                </div>
            </div>
        `
  }

  if (typeof window.addMessage === "function") {
    window.addMessage("bot", privateHtml)
  }
}

// Show emergency tips (unchanged)
function showEmergencyTips() {
  if (typeof window.addMessage === "function") {
    window.addMessage("user", "Tips Darurat")
  }

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

  if (typeof window.addMessage === "function") {
    window.addMessage("bot", tipsHtml)
  }
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
    if (typeof window.addMessage === "function") {
      window.addMessage("user", message)
      window.showTypingIndicator()
    }

    setTimeout(async () => {
      if (typeof window.hideTypingIndicator === "function") {
        window.hideTypingIndicator()
      }

      if (lowerMessage.includes("darurat") || lowerMessage.includes("emergency")) {
        if (typeof window.addMessage === "function") {
          window.addMessage(
            "bot",
            '🚨 Untuk keadaan darurat yang mengancam jiwa, segera hubungi <a href="tel:118" style="color: #dc3545; font-weight: bold;">118</a> (Ambulans) atau <a href="tel:119" style="color: #dc3545; font-weight: bold;">119</a> (Rescue)',
          )
        }
      }

      if (typeof window.addMessage === "function") {
        window.addMessage("bot", "Saya akan menampilkan informasi lengkap layanan ambulans untuk Anda.")
      }

      await initializeAmbulanceService()
    }, 1500)

    return true
  }

  return false
}

// Make functions available globally
window.initializeAmbulanceService = initializeAmbulanceService
window.displayAmbulanceOptions = displayAmbulanceOptions
window.showHospitalAmbulances = showHospitalAmbulances
window.showPrivateAmbulances = showPrivateAmbulances
window.showEmergencyTips = showEmergencyTips
window.handleAmbulanceMessage = handleAmbulanceMessage
window.loadAmbulanceData = loadAmbulanceData

console.log("✅ Ambulance service with database integration loaded!")
