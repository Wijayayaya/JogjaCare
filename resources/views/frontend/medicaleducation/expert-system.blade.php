{{-- resources/views/frontend/medicaleducation/expert-system.blade.php --}}
@extends('frontend.layouts.app')

@section('title')
    {{ __('Sistem Pakar Deteksi Penyakit') }}
@endsection

@push('after-styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-in-out',
                        'slide-up': 'slideUp 0.8s ease-out',
                        'pulse-glow': 'pulseGlow 2s ease-in-out infinite',
                        'bounce-in': 'bounceIn 0.5s ease-out'
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.6); }
        }
        
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .symptom-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        
        .symptom-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .symptom-card.selected {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.4);
        }
        
        .progress-step {
            transition: all 0.5s ease;
        }
        
        .progress-step.active {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            transform: scale(1.1);
        }
        
        .progress-step.completed {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            color: white;
        }
        
        .disease-result {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .disease-result:hover {
            border-color: #3b82f6;
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1);
        }
        
        .floating-icon {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
    </style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-green-600 via-green-700 to-emerald-800 text-white py-24 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)" />
            </svg>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Medical Icon -->
                <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-8 animate-pulse">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Sistem <span class="text-green-200">Pakar</span>
                </h1>
                <p class="text-xl md:text-2xl mb-10 opacity-90 max-w-3xl mx-auto leading-relaxed">
                    Deteksi dini penyakit berdasarkan gejala yang Anda alami dengan teknologi sistem pakar medis
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <button onclick="startDiagnosis()" class="group bg-white text-green-600 px-10 py-4 rounded-xl font-semibold text-lg hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            Mulai Diagnosis
                        </span>
                    </button>
                    <a href="{{ url('/medical-education') }}" class="group border-2 border-white text-white px-10 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-green-600 transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Kembali ke Edukasi
                        </span>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-6 h-6 bg-green-400 rounded-full opacity-50 animate-bounce" style="animation-delay: 0s;"></div>
        <div class="absolute top-40 right-20 w-4 h-4 bg-green-300 rounded-full opacity-40 animate-bounce" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-20 w-5 h-5 bg-green-200 rounded-full opacity-30 animate-bounce" style="animation-delay: 2s;"></div>
    </section>

    <div class="container mx-auto px-4 py-8 max-w-6xl">
        
        <!-- Welcome Section -->
        <div id="welcomeSection" class="animate-fade-in">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 mb-8">
                <div class="flex items-start space-x-6 mb-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg floating-icon">
                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-3xl font-bold mb-4 text-gray-800 dark:text-white">
                            Sistem Pakar Deteksi Penyakit
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300 text-lg leading-relaxed mb-6">
                            Sistem pakar ini akan membantu Anda mengidentifikasi kemungkinan penyakit berdasarkan gejala yang Anda alami. 
                            Sistem menggunakan basis pengetahuan medis untuk memberikan diagnosis awal.
                        </p>
                        
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 mb-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                <div>
                                    <h4 class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Penting untuk Diingat</h4>
                                    <p class="text-sm text-yellow-700 dark:text-yellow-400">
                                        Hasil dari sistem ini hanya sebagai referensi awal dan tidak menggantikan konsultasi dengan dokter profesional. 
                                        Selalu konsultasikan kondisi kesehatan Anda dengan tenaga medis yang qualified.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <button onclick="startDiagnosis()" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-lg font-semibold text-lg hover:from-blue-700 hover:to-indigo-700 transition duration-300 shadow-lg transform hover:scale-105 animate-pulse-glow">
                            🔍 Mulai Diagnosis
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Steps -->
        <div id="progressSection" class="hidden mb-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div class="progress-step flex items-center px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                        <span class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">1</span>
                        Pilih Gejala
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 dark:bg-gray-700 mx-4"></div>
                    <div class="progress-step flex items-center px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                        <span class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">2</span>
                        Analisis
                    </div>
                    <div class="flex-1 h-1 bg-gray-200 dark:bg-gray-700 mx-4"></div>
                    <div class="progress-step flex items-center px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                        <span class="w-6 h-6 bg-gray-400 rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">3</span>
                        Hasil
                    </div>
                </div>
            </div>
        </div>

        <!-- Symptom Selection -->
        <div id="symptomSection" class="hidden animate-slide-up">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 mb-8">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white flex items-center">
                    <svg class="w-8 h-8 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h2m0-8h2a2 2 0 012 2v6a2 2 0 01-2 2H9m0-8v8"></path>
                    </svg>
                    Pilih Gejala yang Anda Alami
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-8">
                    Klik pada gejala-gejala yang sedang Anda rasakan. Anda dapat memilih lebih dari satu gejala.
                </p>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8" id="symptomGrid">
                    <!-- Symptoms will be populated by JavaScript -->
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span id="selectedCount">0</span> gejala dipilih
                    </div>
                    <div class="space-x-4">
                        <button onclick="resetSymptoms()" class="px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300">
                            Reset
                        </button>
                        <button onclick="analyzeSymptoms()" id="analyzeBtn" class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg font-semibold hover:from-green-700 hover:to-green-800 transition duration-300 shadow-lg disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            Analisis Gejala
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analysis Loading -->
        <div id="analysisSection" class="hidden">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 mb-8 text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 animate-spin">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Menganalisis Gejala...</h3>
                <p class="text-gray-600 dark:text-gray-300">Sistem sedang memproses gejala yang Anda pilih dan mencocokkan dengan basis pengetahuan medis.</p>
            </div>
        </div>

        <!-- Results Section -->
        <div id="resultsSection" class="hidden animate-bounce-in">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 mb-8">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white flex items-center">
                    <svg class="w-8 h-8 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Hasil Diagnosis
                </h3>
                
                <div id="diagnosisResults" class="space-y-6">
                    <!-- Results will be populated by JavaScript -->
                </div>
                
                <div class="mt-8 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                    <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        Rekomendasi Tindak Lanjut
                    </h4>
                    <ul class="text-sm text-blue-700 dark:text-blue-400 space-y-2">
                        <li>• Konsultasikan hasil ini dengan dokter untuk diagnosis yang lebih akurat</li>
                        <li>• Catat gejala tambahan yang mungkin muncul</li>
                        <li>• Jika gejala memburuk, segera cari bantuan medis</li>
                        <li>• Jaga pola hidup sehat dan istirahat yang cukup</li>
                    </ul>
                </div>
                
                <div class="mt-8 flex justify-center space-x-4">
                    <button onclick="startNewDiagnosis()" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition duration-300 shadow-lg">
                        Diagnosis Baru
                    </button>
                    <button onclick="printResults()" class="px-8 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-300">
                        Cetak Hasil
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-scripts')
    <script>
        // Knowledge Base - Disease and Symptoms Database
        const knowledgeBase = {
            diseases: {
                'flu': {
                    name: 'Influenza (Flu)',
                    symptoms: ['demam', 'batuk', 'pilek', 'sakit_kepala', 'nyeri_otot', 'kelelahan', 'sakit_tenggorokan'],
                    description: 'Infeksi virus yang menyerang sistem pernapasan',
                    severity: 'Ringan - Sedang',
                    treatment: 'Istirahat, minum banyak air, obat pereda demam, antiviral jika diperlukan',
                    duration: '7-10 hari'
                },
                'covid19': {
                    name: 'COVID-19',
                    symptoms: ['demam', 'batuk', 'sesak_napas', 'kelelahan', 'sakit_kepala', 'hilang_penciuman', 'sakit_tenggorokan', 'diare'],
                    description: 'Infeksi virus SARS-CoV-2 yang dapat menyebabkan gejala ringan hingga berat',
                    severity: 'Ringan - Berat',
                    treatment: 'Isolasi mandiri, istirahat, monitoring saturasi oksigen, konsultasi dokter',
                    duration: '10-14 hari'
                },
                'migrain': {
                    name: 'Migrain',
                    symptoms: ['sakit_kepala', 'mual', 'muntah', 'sensitif_cahaya', 'sensitif_suara'],
                    description: 'Sakit kepala berdenyut yang sering disertai mual dan sensitivitas terhadap cahaya',
                    severity: 'Sedang - Berat',
                    treatment: 'Obat pereda nyeri, istirahat di ruangan gelap, hindari pemicu',
                    duration: '4-72 jam'
                },
                'gastritis': {
                    name: 'Gastritis',
                    symptoms: ['nyeri_perut', 'mual', 'muntah', 'kembung', 'hilang_nafsu_makan'],
                    description: 'Peradangan pada dinding lambung',
                    severity: 'Ringan - Sedang',
                    treatment: 'Antasida, hindari makanan pedas dan asam, makan teratur',
                    duration: 'Beberapa hari hingga minggu'
                },
                'hipertensi': {
                    name: 'Hipertensi',
                    symptoms: ['sakit_kepala', 'pusing', 'sesak_napas', 'nyeri_dada', 'kelelahan'],
                    description: 'Tekanan darah tinggi yang dapat meningkatkan risiko penyakit jantung',
                    severity: 'Sedang - Berat',
                    treatment: 'Obat antihipertensi, diet rendah garam, olahraga teratur',
                    duration: 'Kondisi kronis yang memerlukan pengelolaan jangka panjang'
                },
                'anemia': {
                    name: 'Anemia',
                    symptoms: ['kelelahan', 'pusing', 'pucat', 'sesak_napas', 'jantung_berdebar'],
                    description: 'Kondisi kekurangan sel darah merah atau hemoglobin',
                    severity: 'Ringan - Berat',
                    treatment: 'Suplemen zat besi, diet kaya zat besi, pengobatan penyebab dasar',
                    duration: 'Bervariasi tergantung penyebab'
                }
            },
            symptoms: {
                'demam': 'Suhu tubuh di atas 37.5°C',
                'batuk': 'Batuk kering atau berdahak',
                'pilek': 'Hidung tersumbat atau berair',
                'sakit_kepala': 'Nyeri di area kepala',
                'nyeri_otot': 'Nyeri atau pegal pada otot',
                'kelelahan': 'Merasa sangat lelah atau lemah',
                'sakit_tenggorokan': 'Nyeri atau gatal di tenggorokan',
                'sesak_napas': 'Kesulitan bernapas atau napas pendek',
                'hilang_penciuman': 'Tidak dapat mencium bau',
                'diare': 'Buang air besar cair lebih dari 3x sehari',
                'mual': 'Rasa ingin muntah',
                'muntah': 'Mengeluarkan isi lambung',
                'sensitif_cahaya': 'Mata tidak tahan terhadap cahaya terang',
                'sensitif_suara': 'Telinga tidak tahan terhadap suara keras',
                'nyeri_perut': 'Nyeri di area perut atau lambung',
                'kembung': 'Perut terasa penuh dan mengembang',
                'hilang_nafsu_makan': 'Tidak ada keinginan untuk makan',
                'pusing': 'Kepala terasa berputar atau tidak stabil',
                'nyeri_dada': 'Nyeri atau tekanan di area dada',
                'pucat': 'Kulit atau bibir tampak pucat',
                'jantung_berdebar': 'Detak jantung terasa cepat atau tidak teratur'
            }
        };

        // Application State
        let selectedSymptoms = [];
        let currentStep = 0;

        // Initialize the application
        function initializeApp() {
            renderSymptomGrid();
            updateSelectedCount();
        }

        // Render symptom selection grid
        function renderSymptomGrid() {
            const grid = document.getElementById('symptomGrid');
            const symptoms = Object.keys(knowledgeBase.symptoms);
            
            grid.innerHTML = symptoms.map(symptom => `
                <div class="symptom-card p-4 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600" 
                     onclick="toggleSymptom('${symptom}')" 
                     data-symptom="${symptom}">
                    <div class="flex items-center">
                        <div class="w-4 h-4 border-2 border-gray-300 dark:border-gray-500 rounded mr-3 flex items-center justify-center">
                            <svg class="w-3 h-3 text-white hidden" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-medium text-gray-800 dark:text-gray-200 capitalize">
                                ${symptom.replace('_', ' ')}
                            </h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                ${knowledgeBase.symptoms[symptom]}
                            </p>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Toggle symptom selection
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
            updateAnalyzeButton();
        }

        // Update selected symptoms count
        function updateSelectedCount() {
            document.getElementById('selectedCount').textContent = selectedSymptoms.length;
        }

        // Update analyze button state
        function updateAnalyzeButton() {
            const btn = document.getElementById('analyzeBtn');
            btn.disabled = selectedSymptoms.length === 0;
        }

        // Reset all selected symptoms
        function resetSymptoms() {
            selectedSymptoms = [];
            document.querySelectorAll('.symptom-card').forEach(card => {
                card.classList.remove('selected');
                card.querySelector('svg').classList.add('hidden');
            });
            updateSelectedCount();
            updateAnalyzeButton();
        }

        // Start diagnosis process
        function startDiagnosis() {
            document.getElementById('welcomeSection').classList.add('hidden');
            document.getElementById('progressSection').classList.remove('hidden');
            document.getElementById('symptomSection').classList.remove('hidden');
            
            updateProgressStep(1);
        }

        // Update progress step indicator
        function updateProgressStep(step) {
            const steps = document.querySelectorAll('.progress-step');
            steps.forEach((stepEl, index) => {
                const stepNumber = index + 1;
                if (stepNumber < step) {
                    stepEl.classList.add('completed');
                    stepEl.classList.remove('active');
                } else if (stepNumber === step) {
                    stepEl.classList.add('active');
                    stepEl.classList.remove('completed');
                } else {
                    stepEl.classList.remove('active', 'completed');
                }
            });
        }

        // Analyze selected symptoms
        function analyzeSymptoms() {
            if (selectedSymptoms.length === 0) return;
            
            document.getElementById('symptomSection').classList.add('hidden');
            document.getElementById('analysisSection').classList.remove('hidden');
            updateProgressStep(2);
            
            // Simulate analysis delay
            setTimeout(() => {
                const results = performDiagnosis();
                displayResults(results);
            }, 3000);
        }

        // Perform diagnosis using expert system logic
        function performDiagnosis() {
            const results = [];
            
            Object.keys(knowledgeBase.diseases).forEach(diseaseKey => {
                const disease = knowledgeBase.diseases[diseaseKey];
                const matchingSymptoms = disease.symptoms.filter(symptom => 
                    selectedSymptoms.includes(symptom)
                );
                
                if (matchingSymptoms.length > 0) {
                    const confidence = (matchingSymptoms.length / disease.symptoms.length) * 100;
                    const coverage = (matchingSymptoms.length / selectedSymptoms.length) * 100;
                    const overallScore = (confidence + coverage) / 2;
                    
                    results.push({
                        disease: disease,
                        matchingSymptoms: matchingSymptoms,
                        confidence: Math.round(confidence),
                        coverage: Math.round(coverage),
                        score: Math.round(overallScore)
                    });
                }
            });
            
            // Sort by overall score
            return results.sort((a, b) => b.score - a.score);
        }

        // Display diagnosis results
        function displayResults(results) {
            document.getElementById('analysisSection').classList.add('hidden');
            document.getElementById('resultsSection').classList.remove('hidden');
            updateProgressStep(3);
            
            const resultsContainer = document.getElementById('diagnosisResults');
            
            if (results.length === 0) {
                resultsContainer.innerHTML = `
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-600 dark:text-gray-400 mb-2">Tidak Ada Diagnosis yang Cocok</h4>
                        <p class="text-gray-500 dark:text-gray-500">Gejala yang Anda pilih tidak cocok dengan penyakit dalam basis pengetahuan kami. Silakan konsultasi dengan dokter.</p>
                    </div>
                `;
                return;
            }
            
            resultsContainer.innerHTML = results.map((result, index) => {
                const confidenceColor = result.score >= 70 ? 'text-red-600' : 
                                      result.score >= 50 ? 'text-yellow-600' : 'text-green-600';
                const confidenceBg = result.score >= 70 ? 'bg-red-100 dark:bg-red-900/20' : 
                                   result.score >= 50 ? 'bg-yellow-100 dark:bg-yellow-900/20' : 'bg-green-100 dark:bg-green-900/20';
                
                return `
                    <div class="disease-result p-6 rounded-lg ${index === 0 ? 'ring-2 ring-blue-500' : ''}">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                                    ${index + 1}. ${result.disease.name}
                                    ${index === 0 ? '<span class="text-sm bg-blue-100 text-blue-800 px-2 py-1 rounded-full ml-2">Kemungkinan Tertinggi</span>' : ''}
                                </h4>
                                <p class="text-gray-600 dark:text-gray-300 mb-3">${result.disease.description}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-2xl font-bold ${confidenceColor} mb-1">${result.score}%</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Kesesuaian</div>
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div class="${confidenceBg} p-3 rounded-lg">
                                <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tingkat Keparahan</div>
                                <div class="font-semibold ${confidenceColor}">${result.disease.severity}</div>
                            </div>
                            <div class="${confidenceBg} p-3 rounded-lg">
                                <div class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Durasi</div>
                                <div class="font-semibold ${confidenceColor}">${result.disease.duration}</div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h5 class="font-semibold text-gray-800 dark:text-white mb-2">Gejala yang Cocok:</h5>
                            <div class="flex flex-wrap gap-2">
                                ${result.matchingSymptoms.map(symptom => `
                                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/20 text-blue-800 dark:text-blue-300 rounded-full text-sm">
                                        ${symptom.replace('_', ' ')}
                                    </span>
                                `).join('')}
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <h5 class="font-semibold text-gray-800 dark:text-white mb-2">Rekomendasi Pengobatan:</h5>
                            <p class="text-gray-600 dark:text-gray-300 text-sm">${result.disease.treatment}</p>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Start new diagnosis
        function startNewDiagnosis() {
            selectedSymptoms = [];
            currentStep = 0;
            
            document.getElementById('resultsSection').classList.add('hidden');
            document.getElementById('welcomeSection').classList.remove('hidden');
            document.getElementById('progressSection').classList.add('hidden');
            
            resetSymptoms();
        }

        // Print results
        function printResults() {
            window.print();
        }

        // Initialize app when DOM is loaded
        document.addEventListener('DOMContentLoaded', initializeApp);
    </script>
@endpush