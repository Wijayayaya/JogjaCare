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
let coverageAreas = [] // Add this new variable for storing unique coverage areas
let selectedCoverageArea = "all" // Add this for tracking selected filter

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
        coverage: ambulance.coverage_area || "", // Changed from coverage to coverage_area
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
        coverage: ambulance.coverage_area || "", // Changed to coverage_area
        response_time: ambulance.response_time || "",
        facilities: ambulance.facilities || [],
        description: ambulance.description || "",
      }
    })
  }

  console.log("✅ Data transformation completed")

  // Extract coverage areas for filtering
  extractCoverageAreas()
}

// Extract unique coverage areas for filtering
function extractCoverageAreas() {
  console.log("🗺️ Extracting coverage areas from database...")

  const areas = new Set()

  // Extract from emergency contacts - use coverage_area
  Object.values(ambulanceData.emergency_contacts).forEach((ambulance) => {
    if (ambulance.coverage && ambulance.coverage.trim()) {
      // Split by comma if multiple areas are listed
      const coverageAreas = ambulance.coverage.split(",").map((area) => area.trim())
      coverageAreas.forEach((area) => {
        if (area) areas.add(area)
      })
    }
  })

  // Extract from hospital ambulances - use coverage_area
  Object.values(ambulanceData.hospitals_with_ambulance).forEach((ambulance) => {
    if (ambulance.coverage_area && ambulance.coverage_area.trim()) {
      // Split by comma if multiple areas are listed
      const coverageAreas = ambulance.coverage_area.split(",").map((area) => area.trim())
      coverageAreas.forEach((area) => {
        if (area) areas.add(area)
      })
    }
  })

  // Extract from private ambulances - use coverage_area
  Object.values(ambulanceData.private_ambulance).forEach((ambulance) => {
    if (ambulance.coverage && ambulance.coverage.trim()) {
      // Split by comma if multiple areas are listed
      const coverageAreas = ambulance.coverage.split(",").map((area) => area.trim())
      coverageAreas.forEach((area) => {
        if (area) areas.add(area)
      })
    }
  })

  coverageAreas = Array.from(areas).sort()
  console.log("✅ Coverage areas extracted from database:", coverageAreas)
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
  // Generate location filter dropdown
  let locationFilterHtml = ""
  if (coverageAreas.length > 0) {
    locationFilterHtml = `
      <div style="margin-bottom: 15px; padding: 12px; background: #f8f9fd; border-radius: 8px; border: 1px solid #e4e7f2;">
        <div style="font-weight: bold; margin-bottom: 8px; color: #4776E6;">📍 Filter Berdasarkan Lokasi:</div>
        <select id="coverageAreaFilter" onchange="window.filterByCoverageArea(this.value)" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
          <option value="all">Semua Lokasi</option>
          ${coverageAreas.map((area) => `<option value="${area}" ${selectedCoverageArea === area ? "selected" : ""}>${area}</option>`).join("")}
        </select>
      </div>
    `
  }

  const optionsHtml = `
        ${locationFilterHtml}
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

// Filter ambulances by coverage area
function filterByCoverageArea(selectedArea) {
  console.log("🗺️ Filtering by coverage area:", selectedArea)
  selectedCoverageArea = selectedArea

  if (typeof window.addMessage === "function") {
    if (selectedArea === "all") {
      window.addMessage("bot", "📍 Menampilkan semua ambulans dari seluruh lokasi")
    } else {
      window.addMessage("bot", `📍 Menampilkan ambulans untuk area: <strong>${selectedArea}</strong>`)
    }
  }
}

// Filter hospital ambulances by coverage area
function getFilteredHospitalAmbulances() {
  if (selectedCoverageArea === "all") {
    return Object.entries(ambulanceData.hospitals_with_ambulance)
  }

  return Object.entries(ambulanceData.hospitals_with_ambulance).filter(([hospital, data]) => {
    if (!data.coverage_area) return false

    // Check if the selected area is included in the coverage area
    const coverageAreas = data.coverage_area.split(",").map((area) => area.trim())
    return coverageAreas.some(
      (area) =>
        area.toLowerCase().includes(selectedCoverageArea.toLowerCase()) ||
        selectedCoverageArea.toLowerCase().includes(area.toLowerCase()),
    )
  })
}

// Filter private ambulances by coverage area
function getFilteredPrivateAmbulances() {
  if (selectedCoverageArea === "all") {
    return Object.entries(ambulanceData.private_ambulance)
  }

  return Object.entries(ambulanceData.private_ambulance).filter(([service, data]) => {
    if (!data.coverage) return false

    // Check if the selected area is included in the coverage area
    const coverageAreas = data.coverage.split(",").map((area) => area.trim())
    return coverageAreas.some(
      (area) =>
        area.toLowerCase().includes(selectedCoverageArea.toLowerCase()) ||
        selectedCoverageArea.toLowerCase().includes(area.toLowerCase()),
    )
  })
}

// Show hospital ambulances from database
function showHospitalAmbulances() {
  if (typeof window.addMessage === "function") {
    window.addMessage("user", "Ambulans Rumah Sakit")
  }

  let hospitalHtml =
    '<div class="back-button" onclick="window.displayAmbulanceOptions()">← Kembali ke Menu Ambulans</div>'

  const filteredHospitals = getFilteredHospitalAmbulances()

  if (selectedCoverageArea !== "all") {
    hospitalHtml += `<div style="background: #e3f2fd; padding: 8px; border-radius: 4px; margin-bottom: 10px; font-size: 12px;">📍 Filter aktif: <strong>${selectedCoverageArea}</strong></div>`
  }

  hospitalHtml += '<div style="font-weight: bold; margin-bottom: 10px;">🏥 Ambulans Rumah Sakit Terdekat:</div>'

  if (filteredHospitals.length === 0) {
    hospitalHtml += `
      <div style="text-align: center; padding: 20px; color: #666;">
        <div style="font-size: 18px; margin-bottom: 10px;">😔</div>
        <div>Tidak ada ambulans rumah sakit yang tersedia untuk area <strong>${selectedCoverageArea}</strong></div>
        <div style="margin-top: 10px;">
          <button onclick="window.filterByCoverageArea('all'); window.showHospitalAmbulances();" style="background: #4776E6; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">Tampilkan Semua</button>
        </div>
      </div>
    `
  } else {
    for (const [hospital, data] of filteredHospitals) {
      const facilitiesText = Array.isArray(data.facilities)
        ? data.facilities.join(", ")
        : data.facilities || "Tidak tersedia"

      hospitalHtml += `
              <div class="hospital-ambulance-card" style="border: 1px solid #e4e7f2; border-radius: 8px; padding: 12px; margin-bottom: 10px; background: #f8f9fd;">
                  <div style="font-weight: bold; color: #4776E6; margin-bottom: 5px;">${hospital}</div>
                  <div style="font-size: 13px; margin-bottom: 8px;">📍 ${data.address}</div>
                  ${data.coverage_area ? `<div style="font-size: 12px; margin-bottom: 5px; color: #28a745;">🗺️ Area: ${data.coverage_area}</div>` : ""}
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

  const filteredPrivate = getFilteredPrivateAmbulances()

  if (selectedCoverageArea !== "all") {
    privateHtml += `<div style="background: #e3f2fd; padding: 8px; border-radius: 4px; margin-bottom: 10px; font-size: 12px;">📍 Filter aktif: <strong>${selectedCoverageArea}</strong></div>`
  }

  privateHtml += '<div style="font-weight: bold; margin-bottom: 10px;">🚑 Layanan Ambulans Swasta:</div>'

  if (filteredPrivate.length === 0) {
    privateHtml += `
      <div style="text-align: center; padding: 20px; color: #666;">
        <div style="font-size: 18px; margin-bottom: 10px;">😔</div>
        <div>Tidak ada ambulans swasta yang tersedia untuk area <strong>${selectedCoverageArea}</strong></div>
        <div style="margin-top: 10px;">
          <button onclick="window.filterByCoverageArea('all'); window.showPrivateAmbulances();" style="background: #4776E6; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer;">Tampilkan Semua</button>
        </div>
      </div>
    `
  } else {
    for (const [service, data] of filteredPrivate) {
      privateHtml += `
              <div class="private-ambulance-card" style="border: 1px solid #e4e7f2; border-radius: 8px; padding: 12px; margin-bottom: 10px; background: #f8f9fd;">
                  <div style="font-weight: bold; color: #4776E6; margin-bottom: 5px;">${service}</div>
                  <div style="font-size: 13px; margin-bottom: 8px;">📍 ${data.address}</div>
                  ${data.coverage ? `<div style="font-size: 12px; margin-bottom: 5px; color: #28a745;">🗺️ Area: ${data.coverage}</div>` : ""}
                  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5px; font-size: 12px; margin-bottom: 8px;">
                      <div>💰 Tarif: ${data.tariff}</div>
                      <div>⏱️ Respon: ${data.response_time}</div>
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

// Get coverage areas directly from database
async function getCoverageAreasFromDatabase() {
  try {
    console.log("📡 Fetching coverage areas from database...")

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
      throw new Error(result.message || "Failed to fetch coverage areas")
    }

    // Extract unique coverage areas from all ambulance types
    const areas = new Set()

    // From emergency ambulances
    if (result.data.emergency) {
      result.data.emergency.forEach((ambulance) => {
        if (ambulance.coverage_area && ambulance.coverage_area.trim()) {
          const coverageAreas = ambulance.coverage_area.split(",").map((area) => area.trim())
          coverageAreas.forEach((area) => {
            if (area) areas.add(area)
          })
        }
      })
    }

    // From hospital ambulances
    if (result.data.hospital) {
      result.data.hospital.forEach((ambulance) => {
        if (ambulance.coverage_area && ambulance.coverage_area.trim()) {
          const coverageAreas = ambulance.coverage_area.split(",").map((area) => area.trim())
          coverageAreas.forEach((area) => {
            if (area) areas.add(area)
          })
        }
      })
    }

    // From private ambulances
    if (result.data.private) {
      result.data.private.forEach((ambulance) => {
        if (ambulance.coverage_area && ambulance.coverage_area.trim()) {
          const coverageAreas = ambulance.coverage_area.split(",").map((area) => area.trim())
          coverageAreas.forEach((area) => {
            if (area) areas.add(area)
          })
        }
      })
    }

    coverageAreas = Array.from(areas).sort()
    console.log("✅ Coverage areas loaded from database:", coverageAreas)

    return coverageAreas
  } catch (error) {
    console.error("❌ Error loading coverage areas:", error)
    return []
  }
}

// Make functions available globally
window.initializeAmbulanceService = initializeAmbulanceService
window.displayAmbulanceOptions = displayAmbulanceOptions
window.showHospitalAmbulances = showHospitalAmbulances
window.showPrivateAmbulances = showPrivateAmbulances
window.showEmergencyTips = showEmergencyTips
window.handleAmbulanceMessage = handleAmbulanceMessage
window.loadAmbulanceData = loadAmbulanceData
window.filterByCoverageArea = filterByCoverageArea
window.getFilteredHospitalAmbulances = getFilteredHospitalAmbulances
window.getFilteredPrivateAmbulances = getFilteredPrivateAmbulances
window.getCoverageAreasFromDatabase = getCoverageAreasFromDatabase

console.log("✅ Ambulance service with database integration loaded!")
