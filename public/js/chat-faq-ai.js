// Combined FAQ and AI Chat System
let faqData = {
  "Umum": {
      "Apa itu JogjaCare?": "JogjaCare adalah website yang menyediakan informasi lengkap mengenai layanan kesehatan dan destinasi wisata di Yogyakarta, khusus untuk wisatawan medical tourism.",
      "Apa tujuan dari JogjaCare?": "Untuk menghubungkan wisatawan dengan layanan kesehatan berkualitas serta destinasi wisata di Yogyakarta.",
      "Siapa saja yang bisa menggunakan JogjaCare?": "Wisatawan lokal maupun mancanegara.",
      "Apakah JogjaCare bekerja sama dengan rumah sakit resmi?": "Belum, Untuk sekarang kita hanya menyediakan informasi dan belum bekerja sama dengan rumah sakit dan klinik terakreditasi di Yogyakarta.",
      "Apa manfaat menggunakan JogjaCare?": "Memudahkan mencari layanan kesehatan & wisata dalam satu platform.",
      "Apakah JogjaCare aman digunakan?": "Ya, data pengguna dilindungi dengan enkripsi dan sistem keamanan.",
      "Apakah JogjaCare punya layanan 24 jam?": "Website dapat diakses 24 jam, termasuk fitur live chat jika tersedia.",
      "Bagaimana cara menggunakan JogjaCare?": "Buka website, pilih fitur sesuai kebutuhan (Medical Care, Paket Wisata, dll).",
      "Siapa pengelola JogjaCare?": "Dikelola oleh tim profesional dengan dukungan stakeholder kesehatan dan pariwisata di Yogyakarta.",
      "Apakah JogjaCare bisa dipakai agen perjalanan?": "Ya, tersedia kolaborasi untuk agen perjalanan dan penyedia layanan kesehatan."
  },
  "Medical Care": {
      "Apa itu fitur Medical Care?": "Menyediakan info layanan klinik, rumah sakit, dokter, dan perawatan umum.",
      "Apa saja spesialisasi dokter di JogjaCare?": "Kardiologi, gigi, kulit, THT, bedah plastik, dll.",
      "Apakah bisa mencari dokter berdasarkan spesialisasi?": "Bisa, lewat fitur pencarian berdasarkan spesialisasi.",
      "Apa layanan unggulan rumah sakit di Jogja?": "Perawatan jantung, bedah saraf, ortopedi, serta terapi pemulihan.",
      "Apakah tersedia informasi jadwal dokter?": "Ya, di setiap profil rumah sakit/klinik.",
      "Apakah ada layanan untuk perawatan ibu dan anak?": "Tersedia layanan seperti kandungan, kehamilan, dan anak-anak.",
      "Apakah JogjaCare memberikan informasi rawat inap?": "Ya, lengkap dengan fasilitas kamar dan tarif.",
      "Bagaimana saya memilih rumah sakit yang sesuai?": "Gunakan filter berdasarkan spesialisasi, lokasi, dan biaya.",
      "Apakah tersedia info tenaga medis berlisensi?": "Ya, semua dokter dan praktisi terdaftar memiliki lisensi.",
      "Bagaimana jika saya butuh layanan gawat darurat?": "Informasi IGD 24 jam tersedia di Medical Points."
  },
  "Medical Points": {
      "Apa itu fitur Medical Points?": "Menyediakan lokasi fasilitas medis dekat area wisata.",
      "Di mana klinik terdekat dari Malioboro?": "Beberapa klinik dan apotek 24 jam tersedia di sekitar Malioboro.",
      "Fasilitas medis di sekitar Kraton Yogyakarta?": "Klinik umum dan apotek malam tersedia di area ini.",
      "Rumah sakit dekat Prambanan apa?": "RS Nur Hidayah, berjarak sekitar 6 km.",
      "Rumah sakit dekat Parangtritis?": "RSUP Dr. Sardjito berjarak sekitar 7 km.",
      "Apakah ada peta lokasi di JogjaCare?": "Ya, tersedia peta interaktif untuk setiap fasilitas.",
      "Bagaimana akses transportasi ke rumah sakit?": "Info transportasi umum dan taksi online tersedia di halaman rumah sakit.",
      "Apakah ada klinik dekat Museum Affandi?": "Ya, Anda bisa cek Medical Points untuk klinik terdekat.",
      "Apakah tersedia ambulans dalam JogjaCare?": "Beberapa rumah sakit menyediakan kontak layanan ambulans.",
      "Apakah JogjaCare mencantumkan jam operasional fasilitas medis?": "Ya, tiap fasilitas mencantumkan jam operasional."
  },
  "Medical Cost": {
      "Apa itu fitur Medical Cost?": "Info biaya untuk berbagai prosedur dan perbandingan antar fasilitas.",
      "Berapa biaya pemeriksaan umum?": "Antara Rp100.000 – Rp300.000.",
      "Biaya perawatan gigi di JogjaCare?": "Rp500.000 – Rp2.000.000 tergantung jenis layanan.",
      "Apakah biaya medical check-up tersedia?": "Ya, paket check-up mulai Rp1.000.000.",
      "Bisa bandingkan biaya antar rumah sakit?": "Ya, fitur perbandingan tersedia.",
      "Biaya perawatan kecantikan di Jogja?": "Mulai Rp300.000 tergantung layanan.",
      "Apakah biaya termasuk obat?": "Tergantung fasilitas, informasi lengkap dicantumkan di detail layanan.",
      "Bagaimana cara estimasi biaya?": "Masukkan jenis layanan dan rumah sakit di fitur simulasi biaya.",
      "Biaya operasi ringan di JogjaCare?": "Mulai dari Rp2.000.000 tergantung tindakan.",
      "Biaya pengobatan tradisional seperti bekam?": "Mulai Rp100.000 – Rp300.000."
  },
  "Hospital and Medical Centers": {
      "Apa itu fitur Hospital and Medical Centers?": "Menampilkan profil rumah sakit dan pusat kesehatan di Jogja.",
      "Rumah sakit unggulan di Jogja?": "RSUP Sardjito, RS Bethesda, RSUD Panembahan Senopati.",
      "Info fasilitas tiap rumah sakit?": "Tersedia di halaman profil, termasuk ICU, rawat inap, dan lab.",
      "Jadwal praktik dokter bisa dilihat?": "Ya, di halaman masing-masing rumah sakit.",
      "Apakah rumah sakit memiliki akreditasi?": "Ya, semua yang terdaftar memiliki sertifikasi nasional.",
      "Bisa konsultasi langsung lewat JogjaCare?": "Ya, lewat form konsultasi atau live chat.",
      "Apakah rumah sakit terhubung dengan asuransi?": "Beberapa rumah sakit bekerja sama dengan asuransi tertentu.",
      "Ada fasilitas untuk wisatawan asing?": "Ya, beberapa rumah sakit menyediakan interpreter dan layanan khusus turis.",
      "Fasilitas apa yang tersedia untuk pasien difabel?": "Tersedia lift, kursi roda, dan kamar ramah difabel di beberapa rumah sakit.",
      "Apakah saya bisa memilih dokter sendiri?": "Ya, bisa memilih dokter dari daftar yang tersedia."
  },
  "Pengobatan Tradisional": {
      "Apa itu fitur Alternative and Traditional Medicine?": "Info tentang pengobatan tradisional seperti jamu, bekam, pijat, dll.",
      "Pengobatan tradisional apa saja di Jogja?": "Pijat Jawa, kerokan, bekam, jamu herbal.",
      "Siapa saja praktisi jamu di Jogja?": "Tersedia daftar praktisi bersertifikat.",
      "Pengobatan tradisional aman nggak?": "JogjaCare hanya mencantumkan yang berizin resmi.",
      "Apakah bisa booking pengobatan tradisional?": "Tidak, tapi kita menyediakan informasi terkait pengobatan informasi beserta titik point dan no yang dapat dihubungi.",
      "Apakah jamu tersedia dalam paket?": "Ya, beberapa paket wellness mencakup terapi jamu bisa ditemukan di pengobatan tradisional.",
      "Bisakah saya melihat ulasan pengguna tentang layanan alternatif?": "Ya, pengguna bisa membaca dan menulis ulasan terkait pengalaman mereka."
  }
};

let currentFaqState = 'welcome'; // welcome -> categories -> questions -> answer
let currentCategory = null;

// Initialize AI messages for context
window.aiMessages = [
  {
      "role": "system",
      "content": "Anda adalah asisten AI untuk JogjaCare, website yang menyediakan informasi lengkap mengenai layanan kesehatan dan destinasi wisata di Yogyakarta untuk wisatawan medical tourism. Berikan informasi yang akurat, sopan, dan ramah. Jika pengguna bertanya tentang hal yang tidak terkait dengan JogjaCare atau medical tourism di Yogyakarta, arahkan mereka kembali ke topik yang relevan."
  }
];

function initializeFaqAiChat() {
  // Clear chat body
  const chatBody = document.getElementById('chatBody');
  chatBody.innerHTML = '';
  
  // Reset state
  currentFaqState = 'welcome';
  currentCategory = null;
  
  // Welcome message
  addMessage('bot', 'Selamat datang di JogjaCare FAQ & AI Assistant! 🤖');
  addMessage('bot', 'Saya dapat membantu Anda dengan dua cara:');
  addMessage('bot', '📋 <strong>Pilih kategori FAQ</strong> untuk melihat pertanyaan yang sering ditanyakan');
  addMessage('bot', '💬 <strong>Ketik pertanyaan langsung</strong> dan saya akan menjawab menggunakan AI');
  
  // Display categories
  displayCategories();
}

function displayCategories() {
  const categories = Object.keys(faqData);
  let categoriesHtml = '<div style="margin-top: 15px;"><strong>📋 Kategori FAQ:</strong></div>';
  categoriesHtml += '<ul class="category-list">';
  
  categories.forEach(category => {
      categoriesHtml += `<li class="category-item" onclick="selectCategory('${category}')">${category}</li>`;
  });
  
  categoriesHtml += '</ul>';
  categoriesHtml += '<div style="margin-top: 10px; font-size: 13px; color: #666; text-align: center;">Atau ketik pertanyaan Anda langsung di bawah ini 👇</div>';
  
  addMessage('bot', categoriesHtml);
}

function selectCategory(category) {
  currentCategory = category;
  currentFaqState = 'questions';
  
  // Display message
  addMessage('user', `Saya ingin tahu tentang: ${category}`);
  
  // Display questions for the category
  const questions = Object.keys(faqData[category]);
  let questionsHtml = '<div class="back-button" onclick="goBackToCategories()">← Kembali ke Kategori</div>';
  questionsHtml += '<ul class="question-list">';
  
  questions.forEach(question => {
      questionsHtml += `<li class="question-item" onclick="selectQuestion('${question.replace(/'/g, "\\'")}')">${question}</li>`;
  });
  
  questionsHtml += '</ul>';
  addMessage('bot', `Silakan pilih pertanyaan tentang ${category}:`);
  addMessage('bot', questionsHtml);
}

function selectQuestion(question) {
  currentFaqState = 'answer';
  
  // Display question
  addMessage('user', question);
  
  // Get and display answer
  const answer = faqData[currentCategory][question];
  
  // Show typing indicator
  showTypingIndicator();
  
  // Simulate typing delay
  setTimeout(() => {
      hideTypingIndicator();
      addMessage('bot', `📋 <strong>FAQ:</strong> ${answer}`);
      
      // Show option to ask another question
      let backHtml = '<div class="back-button" onclick="goBackToQuestions()">← Pertanyaan Lain</div>';
      backHtml += '<div class="back-button" onclick="goBackToCategories()">← Kategori Lain</div>';
      addMessage('bot', backHtml);
  }, 1000);
}

function goBackToCategories() {
  currentFaqState = 'categories';
  currentCategory = null;
  
  addMessage('bot', 'Silakan pilih kategori pertanyaan:');
  displayCategories();
}

function goBackToQuestions() {
  currentFaqState = 'questions';
  selectCategory(currentCategory);
}

async function handleFaqAiMessage(message) {
  // Add user message to chat
  addMessage('user', message);
  
  // First, try to find exact or partial match in FAQ data
  let faqFound = false;
  
  for (const category in faqData) {
      for (const question in faqData[category]) {
          if (question.toLowerCase().includes(message.toLowerCase()) || 
              message.toLowerCase().includes(question.toLowerCase().substring(0, 10))) {
              // Found a FAQ match
              showTypingIndicator();
              setTimeout(() => {
                  hideTypingIndicator();
                  addMessage('bot', `📋 <strong>FAQ:</strong> ${faqData[category][question]}`);
                  
                  // Show option to go back
                  let backHtml = '<div class="back-button" onclick="goBackToCategories()">← Lihat Kategori FAQ</div>';
                  addMessage('bot', backHtml);
              }, 1000);
              faqFound = true;
              return;
          }
      }
  }
  
  // If no FAQ match found, use AI
  if (!faqFound) {
      // Add message to AI history for context
      window.aiMessages.push({
          "role": "user",
          "content": message
      });
      
      // Show typing indicator
      showTypingIndicator();
      
      // Disable input while processing
      setInputState(true);
      
      try {
          const res = await fetch('https://openrouter.ai/api/v1/chat/completions', {
              method: 'POST',
              headers: {
                  'Authorization': 'Bearer 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',
                  'HTTP-Referer': window.location.href,
                  'X-Title': 'jogjacare',
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
              },
              body: JSON.stringify({
                  model: 'deepseek/deepseek-r1:free',
                  messages: window.aiMessages,
                  temperature: 0.7,
                  max_tokens: 1000
              })
          });
          
          const data = await res.json();
          
          if (data.choices && data.choices.length > 0) {
              const reply = data.choices[0].message.content;
              
              // Add AI response to messages history
              window.aiMessages.push({
                  "role": "assistant",
                  "content": reply
              });
              
              // Remove typing indicator and add message to chat
              hideTypingIndicator();
              addMessage('bot', `🤖 <strong>AI Assistant:</strong> ${reply}`);
              
              // Show FAQ categories option
              let faqHtml = '<div class="back-button" onclick="goBackToCategories()">📋 Lihat FAQ Kategori</div>';
              addMessage('bot', faqHtml);
              
              // Limit context window to save tokens
              if (window.aiMessages.length > 10) {
                  // Keep system message and last 4 exchanges (8 messages)
                  window.aiMessages = [
                      window.aiMessages[0],
                      ...window.aiMessages.slice(-8)
                  ];
              }
          } else {
              if (data.error) {
                  hideTypingIndicator();
                  addMessage('bot', `Maaf, terjadi kesalahan: ${data.error.message || 'Tidak dapat mendapatkan respons'}`);
              } else {
                  hideTypingIndicator();
                  addMessage('bot', 'Maaf, saya tidak dapat memproses permintaan Anda saat ini. Silakan coba lagi nanti atau pilih dari kategori FAQ berikut:');
                  displayCategories();
              }
          }
      } catch (error) {
          console.error('Error:', error);
          hideTypingIndicator();
          addMessage('bot', 'Maaf, terjadi kesalahan teknis. Silakan coba lagi nanti atau pilih dari kategori FAQ berikut:');
          displayCategories();
      } finally {
          // Re-enable input
          setInputState(false);
      }
  }
}

// Make functions available globally for onclick handlers
window.selectCategory = selectCategory;
window.selectQuestion = selectQuestion;
window.goBackToCategories = goBackToCategories;
window.goBackToQuestions = goBackToQuestions;
window.handleFaqAiMessage = handleFaqAiMessage;
window.initializeFaqAiChat = initializeFaqAiChat;