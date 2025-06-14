@extends('frontend.layouts.app')

@section('title')
    {{ __('Informasi Kesehatan & Edukasi Gejala') }}
@endsection

@push('after-styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .disclaimer-box {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            border: 2px solid #ef4444;
            animation: pulse 2s infinite;
        }
        
        .warning-box {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            border: 2px solid #f59e0b;
        }
        
        .info-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .info-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .symptom-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        
        .symptom-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .symptom-card.selected {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section dengan Disclaimer Kuat -->
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-24 overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Medical Education Icon -->
                <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Informasi <span class="text-blue-200">Kesehatan</span>
                </h1>
                <p class="text-xl md:text-2xl mb-10 opacity-90 max-w-3xl mx-auto leading-relaxed">
                    Platform edukasi kesehatan untuk memahami gejala dan kapan harus mencari bantuan medis profesional
                </p>
                
                <!-- Disclaimer Utama -->
                <div class="disclaimer-box rounded-xl p-6 mb-8 text-left max-w-4xl mx-auto">
                    <div class="flex items-start">
                        <svg class="w-8 h-8 text-red-600 mt-1 mr-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="font-bold text-red-800 text-xl mb-3">⚠️ PENTING - BUKAN PENGGANTI KONSULTASI MEDIS</h3>
                            <div class="text-red-800 space-y-2">
                                <p class="font-semibold">• Platform ini HANYA untuk edukasi kesehatan dan informasi umum</p>
                                <p class="font-semibold">• TIDAK memberikan diagnosis medis atau saran pengobatan</p>
                                <p class="font-semibold">• SELALU konsultasi dengan dokter untuk kondisi kesehatan Anda</p>
                                <p class="font-semibold">• Jika mengalami gejala serius, segera cari bantuan medis darurat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        
        <!-- Persetujuan Pengguna -->
        <div id="consentSection" class="mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8">
                <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
                    Persetujuan Penggunaan Platform Edukasi Kesehatan
                </h2>
                
                <div class="space-y-4 mb-6">
                    <div class="flex items-start">
                        <input type="checkbox" id="consent1" class="mt-1 mr-3" required>
                        <label for="consent1" class="text-gray-700 dark:text-gray-300">
                            Saya memahami bahwa platform ini hanya untuk edukasi kesehatan dan BUKAN pengganti konsultasi medis profesional
                        </label>
                    </div>
                    <div class="flex items-start">
                        <input type="checkbox" id="consent2" class="mt-1 mr-3" required>
                        <label for="consent2" class="text-gray-700 dark:text-gray-300">
                            Saya akan tetap berkonsultasi dengan dokter untuk diagnosis dan pengobatan yang akurat
                        </label>
                    </div>
                    <div class="flex items-start">
                        <input type="checkbox" id="consent3" class="mt-1 mr-3" required>
                        <label for="consent3" class="text-gray-700 dark:text-gray-300">
                            Saya memahami bahwa informasi yang diberikan bersifat umum dan tidak spesifik untuk kondisi saya
                        </label>
                    </div>
                </div>
                
                <button onclick="proceedToHealthInfo()" id="proceedBtn" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    Saya Setuju & Lanjutkan ke Informasi Kesehatan
                </button>
            </div>
        </div>

        <!-- Informasi Kesehatan Section -->
        <div id="healthInfoSection" class="hidden">
            
            <!-- Peringatan Darurat -->
            <div class="bg-red-50 border-l-4 border-red-500 p-6 mb-8 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-red-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h3 class="text-lg font-bold text-red-800 mb-2">🚨 KONDISI DARURAT - SEGERA KE RUMAH SAKIT</h3>
                        <ul class="text-red-700 space-y-1">
                            <li>• Kesulitan bernapas atau sesak napas berat</li>
                            <li>• Nyeri dada yang hebat</li>
                            <li>• Kehilangan kesadaran</li>
                            <li>• Demam tinggi (>40°C) yang tidak turun</li>
                            <li>• Perdarahan yang tidak terkontrol</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Pilihan Gejala untuk Edukasi -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 mb-8">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
                    📚 Pilih Gejala untuk Informasi Edukasi
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-8">
                    Pilih gejala yang ingin Anda pelajari. Kami akan memberikan informasi edukasi umum dan saran kapan harus ke dokter.
                </p>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8" id="symptomGrid">
                    <!-- Symptoms will be populated by JavaScript -->
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span id="selectedCount">0</span> gejala dipilih untuk edukasi
                    </div>
                    <div class="space-x-4">
                        <button onclick="resetSymptoms()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                            Reset
                        </button>
                        <button onclick="getHealthInformation()" id="infoBtn" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            Dapatkan Informasi Kesehatan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hasil Informasi Kesehatan -->
            <div id="healthInfoResults" class="hidden">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 mb-8">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
                        📋 Informasi Kesehatan & Edukasi
                    </h3>
                    
                    <!-- Disclaimer dalam Hasil -->
                    <div class="warning-box rounded-lg p-4 mb-6">
                        <p class="text-yellow-800 font-semibold">
                            ⚠️ Informasi berikut hanya untuk edukasi. Konsultasikan kondisi Anda dengan dokter untuk diagnosis dan pengobatan yang tepat.
                        </p>
                    </div>
                    
                    <div id="educationalContent" class="space-y-6">
                        <!-- Content will be populated by JavaScript -->
                    </div>
                    
                    <!-- Rekomendasi Konsultasi -->
                    <div class="mt-8 p-6 bg-green-50 rounded-lg border border-green-200">
                        <h4 class="font-semibold text-green-800 mb-3">🏥 Langkah Selanjutnya</h4>
                        <ul class="text-green-700 space-y-2">
                            <li>• <strong>Konsultasi Dokter:</strong> Jadwalkan konsultasi dengan dokter umum atau spesialis</li>
                            <li>• <strong>Catat Gejala:</strong> Buat catatan detail tentang gejala yang dialami</li>
                            <li>• <strong>Bawa Riwayat:</strong> Siapkan riwayat kesehatan dan obat yang sedang dikonsumsi</li>
                            <li>• <strong>Jangan Tunda:</strong> Jika gejala memburuk, segera cari bantuan medis</li>
                        </ul>
                    </div>
                    
                    <div class="mt-8 flex justify-center space-x-4">
                        <button onclick="startNewInquiry()" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                            Cari Informasi Lain
                        </button>
                        <a href="tel:119" class="px-8 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                            📞 Darurat: 119
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        // Basis pengetahuan untuk edukasi kesehatan (bukan diagnosis)
        const healthEducationBase = {
            symptoms: {
                'demam': {
                    name: 'Demam',
                    description: 'Peningkatan suhu tubuh di atas normal (>37.5°C)',
                    education: {
                        what_is: 'Demam adalah respons alami tubuh terhadap infeksi atau peradangan. Suhu tubuh normal berkisar 36-37°C.',
                        care_tips: [
                            'Istirahat yang cukup di tempat yang sejuk',
                            'Minum banyak cairan (air putih, jus, sup)',
                            'Kompres dengan air hangat (bukan dingin)',
                            'Pakai pakaian yang tipis dan menyerap keringat',
                            'Konsumsi makanan yang mudah dicerna'
                        ],
                        when_to_doctor: [
                            'Demam >39°C atau berlangsung >3 hari',
                            'Disertai sesak napas atau nyeri dada',
                            'Kejang demam (terutama pada anak)',
                            'Dehidrasi berat (mulut kering, jarang buang air kecil)',
                            'Ruam kulit yang menyebar'
                        ],
                        avoid: [
                            'Jangan gunakan alkohol untuk kompres',
                            'Jangan paksa makan jika tidak nafsu makan',
                            'Jangan mandi air dingin saat demam tinggi'
                        ]
                    }
                },
                'batuk': {
                    name: 'Batuk',
                    description: 'Refleks tubuh untuk membersihkan saluran pernapasan',
                    education: {
                        what_is: 'Batuk adalah refleks alami tubuh untuk membersihkan saluran pernapasan dari iritan, lendir, atau benda asing.',
                        care_tips: [
                            'Minum air hangat dengan madu (untuk usia >1 tahun)',
                            'Berkumur dengan air garam hangat',
                            'Hindari asap rokok dan polusi udara',
                            'Jaga kelembaban udara di ruangan',
                            'Istirahat dengan posisi kepala sedikit lebih tinggi'
                        ],
                        when_to_doctor: [
                            'Batuk berdarah atau dahak berwarna',
                            'Batuk berlangsung >2 minggu',
                            'Disertai demam tinggi >3 hari',
                            'Sesak napas atau nyeri dada',
                            'Penurunan berat badan tanpa sebab'
                        ],
                        avoid: [
                            'Jangan berikan madu pada bayi <1 tahun',
                            'Hindari obat batuk tanpa konsultasi dokter',
                            'Jangan merokok atau terpapar asap'
                        ]
                    }
                },
                'sakit_kepala': {
                    name: 'Sakit Kepala',
                    description: 'Nyeri atau ketidaknyamanan di area kepala',
                    education: {
                        what_is: 'Sakit kepala dapat disebabkan berbagai faktor seperti stres, kurang tidur, dehidrasi, atau ketegangan otot.',
                        care_tips: [
                            'Istirahat di ruangan yang tenang dan gelap',
                            'Kompres dingin di dahi atau belakang leher',
                            'Pijat lembut area pelipis dan leher',
                            'Minum air putih yang cukup',
                            'Atur pola tidur yang teratur'
                        ],
                        when_to_doctor: [
                            'Sakit kepala mendadak dan sangat hebat',
                            'Disertai demam tinggi dan kaku kuduk',
                            'Gangguan penglihatan atau bicara',
                            'Sakit kepala berulang dan semakin parah',
                            'Disertai mual muntah terus menerus'
                        ],
                        avoid: [
                            'Jangan konsumsi obat pereda nyeri berlebihan',
                            'Hindari cahaya terang saat sakit kepala',
                            'Jangan abaikan sakit kepala yang tidak biasa'
                        ]
                    }
                },
                'mual': {
                    name: 'Mual',
                    description: 'Sensasi tidak nyaman di perut dengan keinginan muntah',
                    education: {
                        what_is: 'Mual adalah sensasi tidak nyaman di perut dengan keinginan untuk muntah, dapat disebabkan gangguan pencernaan atau kondisi lainnya.',
                        care_tips: [
                            'Makan dalam porsi kecil tapi sering',
                            'Hindari makanan berlemak, pedas, atau berbau menyengat',
                            'Minum jahe hangat atau teh chamomile',
                            'Istirahat dengan posisi kepala lebih tinggi',
                            'Hirup udara segar'
                        ],
                        when_to_doctor: [
                            'Muntah terus menerus >24 jam',
                            'Tanda-tanda dehidrasi (mulut kering, pusing)',
                            'Disertai nyeri perut hebat',
                            'Muntah darah atau cairan kehijauan',
                            'Demam tinggi disertai mual'
                        ],
                        avoid: [
                            'Jangan makan makanan berat saat mual',
                            'Hindari bau-bauan yang menyengat',
                            'Jangan berbaring langsung setelah makan'
                        ]
                    }
                },
                'pusing': {
                    name: 'Pusing',
                    description: 'Sensasi kepala ringan atau kehilangan keseimbangan',
                    education: {
                        what_is: 'Pusing dapat berupa kepala ringan, kehilangan keseimbangan, atau sensasi berputar (vertigo).',
                        care_tips: [
                            'Duduk atau berbaring perlahan saat merasa pusing',
                            'Minum air putih yang cukup',
                            'Hindari gerakan kepala yang mendadak',
                            'Istirahat yang cukup dan teratur',
                            'Hindari berdiri terlalu lama'
                        ],
                        when_to_doctor: [
                            'Pusing berulang tanpa sebab jelas',
                            'Disertai nyeri dada atau sesak napas',
                            'Kehilangan kesadaran atau hampir pingsan',
                            'Gangguan pendengaran atau telinga berdenging',
                            'Pusing disertai sakit kepala hebat'
                        ],
                        avoid: [
                            'Jangan mengemudi saat merasa pusing',
                            'Hindari aktivitas berbahaya di ketinggian',
                            'Jangan abaikan pusing yang berulang'
                        ]
                    }
                },
                'sesak_napas': {
                    name: 'Sesak Napas',
                    description: 'Kesulitan bernapas atau napas pendek',
                    education: {
                        what_is: 'Sesak napas adalah kesulitan bernapas yang bisa disebabkan aktivitas berat, kondisi paru-paru, atau jantung.',
                        care_tips: [
                            'Duduk tegak dengan bersandar ke depan',
                            'Bernapas perlahan dan dalam melalui hidung',
                            'Gunakan kipas angin untuk sirkulasi udara',
                            'Hindari aktivitas berat',
                            'Tetap tenang dan jangan panik'
                        ],
                        when_to_doctor: [
                            'Sesak napas mendadak dan berat',
                            'Tidak membaik dengan istirahat',
                            'Disertai nyeri dada atau pusing',
                            'Bibir atau kuku kebiruan',
                            'Riwayat penyakit jantung atau paru'
                        ],
                        avoid: [
                            'Jangan berbaring telentang saat sesak',
                            'Hindari tempat berdebu atau berasap',
                            'Jangan tunda mencari bantuan medis'
                        ]
                    }
                }
            }
        };

        let selectedSymptoms = [];

        // Initialize consent checking
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('#consentSection input[type="checkbox"]');
            const proceedBtn = document.getElementById('proceedBtn');
            
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
                    proceedBtn.disabled = !allChecked;
                });
            });
            
            renderSymptomGrid();
        });

        function proceedToHealthInfo() {
            document.getElementById('consentSection').classList.add('hidden');
            document.getElementById('healthInfoSection').classList.remove('hidden');
        }

        function renderSymptomGrid() {
            const grid = document.getElementById('symptomGrid');
            const symptoms = Object.keys(healthEducationBase.symptoms);
            
            grid.innerHTML = symptoms.map(symptom => `
                <div class="symptom-card p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200" 
                     onclick="toggleSymptom('${symptom}')" 
                     data-symptom="${symptom}">
                    <div class="flex items-center">
                        <div class="w-4 h-4 border-2 border-gray-300 rounded mr-3 flex items-center justify-center">
                            <svg class="w-3 h-3 text-white hidden" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800 dark:text-gray-200">
                                ${healthEducationBase.symptoms[symptom].name}
                            </h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                ${healthEducationBase.symptoms[symptom].description}
                            </p>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function toggleSymptom(symptom) {
            const card = document.querySelector(`[data-symptom="${symptom}"]`);
            const checkbox = card.querySelector('svg');
            
            if (selectedSymptoms.includes(symptom)) {
                selectedSymptoms = selectedSymptoms.filter(s => s !== symptom);
                card.classList.remove('selected');
                checkbox.classList.add('hidden');
            } else {
                selectedSymptoms.push(symptom);
                card.classList.add('selected');
                checkbox.classList.remove('hidden');
            }
            
            updateSelectedCount();
            updateInfoButton();
        }

        function updateSelectedCount() {
            document.getElementById('selectedCount').textContent = selectedSymptoms.length;
        }

        function updateInfoButton() {
            const btn = document.getElementById('infoBtn');
            btn.disabled = selectedSymptoms.length === 0;
        }

        function resetSymptoms() {
            selectedSymptoms = [];
            document.querySelectorAll('.symptom-card').forEach(card => {
                card.classList.remove('selected');
                card.querySelector('svg').classList.add('hidden');
            });
            updateSelectedCount();
            updateInfoButton();
        }

        function getHealthInformation() {
            if (selectedSymptoms.length === 0) return;
            
            const content = document.getElementById('educationalContent');
            const resultsSection = document.getElementById('healthInfoResults');
            
            let html = '';
            
            selectedSymptoms.forEach(symptom => {
                const info = healthEducationBase.symptoms[symptom];
                html += `
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-6 border border-blue-200 mb-6">
                        <h4 class="text-xl font-bold text-blue-800 dark:text-blue-300 mb-3">
                            📖 Informasi tentang ${info.name}
                        </h4>
                        <p class="text-blue-700 dark:text-blue-400 mb-4">${info.education.what_is}</p>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h5 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">💡 Tips Perawatan Umum:</h5>
                                <ul class="text-blue-700 dark:text-blue-400 space-y-1">
                                    ${info.education.care_tips.map(tip => `<li>• ${tip}</li>`).join('')}
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-semibold text-red-800 dark:text-red-300 mb-2">🏥 Kapan Harus ke Dokter:</h5>
                                <ul class="text-red-700 dark:text-red-400 space-y-1">
                                    ${info.education.when_to_doctor.map(condition => `<li>• ${condition}</li>`).join('')}
                                </ul>
                            </div>
                        </div>
                        
                        ${info.education.avoid ? `
                            <div class="mt-4">
                                <h5 class="font-semibold text-orange-800 dark:text-orange-300 mb-2">⚠️ Yang Harus Dihindari:</h5>
                                <ul class="text-orange-700 dark:text-orange-400 space-y-1">
                                    ${info.education.avoid.map(item => `<li>• ${item}</li>`).join('')}
                                </ul>
                            </div>
                        ` : ''}
                    </div>
                `;
            });
            
            content.innerHTML = html;
            resultsSection.classList.remove('hidden');
            
            // Scroll to results
            resultsSection.scrollIntoView({ behavior: 'smooth' });
        }

        function startNewInquiry() {
            selectedSymptoms = [];
            document.getElementById('healthInfoResults').classList.add('hidden');
            resetSymptoms();
            
            // Scroll back to symptom selection
            document.getElementById('healthInfoSection').scrollIntoView({ behavior: 'smooth' });
        }
    </script>
@endpush
