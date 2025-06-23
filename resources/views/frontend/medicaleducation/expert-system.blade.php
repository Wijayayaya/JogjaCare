@extends('frontend.layouts.app')

@section('title')
    {{ __('Informasi Kesehatan & Edukasi Gejala') }}
@endsection

@push('after-styles')
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite('resources/css/app.css')
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
                    {{ __('Health') }} <span class="text-blue-200">{{ __('Information') }}</span>
                </h1>
                <p class="text-xl md:text-2xl mb-10 opacity-90 max-w-3xl mx-auto leading-relaxed">
                    {{ __('A health education platform to understand symptoms and when to seek professional medical help') }}
                </p>

                <!-- Disclaimer Utama -->
                <div class="disclaimer-box rounded-xl p-6 mb-8 text-left max-w-4xl mx-auto">
                    <div class="flex items-start">
                        <svg class="w-8 h-8 text-red-600 mt-1 mr-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="font-bold text-red-800 text-xl mb-3">⚠️ {{ __('IMPORTANT - NOT A SUBSTITUTE FOR MEDICAL CONSULTATION') }}</h3>
                            <div class="text-red-800 space-y-2">
                                <p class="font-semibold">• {{ __('This platform is for health education and general information ONLY') }}</p>
                                <p class="font-semibold">• {{ __('Does NOT provide medical diagnosis or treatment advice') }}</p>
                                <p class="font-semibold">• {{ __('ALWAYS consult your doctor for your health conditions') }}</p>
                                <p class="font-semibold">• {{ __('If you experience serious symptoms, seek emergency medical help immediately') }}</p>
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
                    {{ __('Consent to Use Health Education Platform') }}
                </h2>
                <div class="space-y-4 mb-6">
                    <div class="flex items-start">
                        <input type="checkbox" id="consent1" class="mt-1 mr-3" required>
                        <label for="consent1" class="text-gray-700 dark:text-gray-300">
                            {{ __('I understand that this platform is for health education ONLY and NOT a substitute for professional medical consultation') }}
                        </label>
                    </div>
                    <div class="flex items-start">
                        <input type="checkbox" id="consent2" class="mt-1 mr-3" required>
                        <label for="consent2" class="text-gray-700 dark:text-gray-300">
                            {{ __('I will still consult a doctor for accurate diagnosis and treatment') }}
                        </label>
                    </div>
                    <div class="flex items-start">
                        <input type="checkbox" id="consent3" class="mt-1 mr-3" required>
                        <label for="consent3" class="text-gray-700 dark:text-gray-300">
                            {{ __('I understand that the information provided is general and not specific to my condition') }}
                        </label>
                    </div>
                </div>
                <button onclick="proceedToHealthInfo()" id="proceedBtn" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    {{ __('I Agree & Continue to Health Information') }}
                </button>
            </div>
        </div>

        <!-- Informasi Kesehatan Section -->
        <div id="healthInfoSection" class="hidden">
            
            <!-- Peringatan Darurat -->
            <div class="bg-red-50 border-l-4 border-red-500 p-6 mb-8 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-red-500 mt-1 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zm-4 4a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <h3 class="text-lg font-bold text-red-800 mb-2">🚨 {{ __('EMERGENCY CONDITION - GO TO THE HOSPITAL IMMEDIATELY') }}</h3>
                        <ul class="text-red-700 space-y-1">
                            <li>• {{ __('Severe difficulty breathing or shortness of breath') }}</li>
                            <li>• {{ __('Severe chest pain') }}</li>
                            <li>• {{ __('Loss of consciousness') }}</li>
                            <li>• {{ __('High fever (>40°C) that does not subside') }}</li>
                            <li>• {{ __('Uncontrolled bleeding') }}</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Pilihan Gejala untuk Edukasi -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 mb-8">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
                    📚 {{ __('Select Symptoms for Educational Information') }}
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-8">
                    {{ __('Select the symptoms you want to learn about. We will provide general educational information and advice on when to see a doctor.') }}
                </p>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8" id="symptomGrid">
                    <!-- Symptoms will be populated by JavaScript -->
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span id="selectedCount">0</span> {{ __('symptoms selected for education') }}
                    </div>
                    <div class="space-x-4">
                        <button onclick="resetSymptoms()" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                            {{ __('Reset') }}
                        </button>
                        <button onclick="getHealthInformation()" id="infoBtn" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-300 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                            {{ __('Get Health Information') }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hasil Informasi Kesehatan -->
            <div id="healthInfoResults" class="hidden">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 mb-8">
                    <h3 class="text-2xl font-bold mb-6 text-gray-800 dark:text-white">
                        📋 {{ __('Health Information & Education') }}
                    </h3>
                    
                    <!-- Disclaimer dalam Hasil -->
                    <div class="warning-box rounded-lg p-4 mb-6">
                        <p class="text-yellow-800 font-semibold">
                            ⚠️ {{ __('The following information is for education only. Consult your doctor for proper diagnosis and treatment.') }}
                        </p>
                    </div>
                    
                    <div id="educationalContent" class="space-y-6">
                        <!-- Content will be populated by JavaScript -->
                    </div>
                    
                    <!-- Rekomendasi Konsultasi -->
                    <div class="mt-8 p-6 bg-green-50 rounded-lg border border-green-200">
                        <h4 class="font-semibold text-green-800 mb-3">🏥 {{ __('Next Steps') }}</h4>
                        <ul class="text-green-700 space-y-2">
                            <li>• <strong>{{ __('Doctor Consultation') }}:</strong> {{ __('Schedule a consultation with a general practitioner or specialist') }}</li>
                            <li>• <strong>{{ __('Record Symptoms') }}:</strong> {{ __('Make a detailed note of the symptoms you are experiencing') }}</li>
                            <li>• <strong>{{ __('Bring Medical History') }}:</strong> {{ __('Prepare your medical history and current medications') }}</li>
                            <li>• <strong>{{ __('Don\'t Delay') }}:</strong> {{ __('If symptoms worsen, seek medical help immediately') }}</li>
                        </ul>
                    </div>
                    
                    <div class="mt-8 flex justify-center space-x-4">
                        <button onclick="startNewInquiry()" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                            {{ __('Find Other Information') }}
                        </button>
                        <a href="tel:119" class="px-8 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition duration-300">
                            📞 {{ __('Emergency') }}: 119
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
                    name: "@lang('Fever')",
                    description: "@lang('Increased body temperature above normal (>37.5°C)')",
                    education: {
                        what_is: "@lang('Fever is the body\'s natural response to infection or inflammation. Normal body temperature ranges from 36-37°C.')",
                        care_tips: [
                            "@lang('Get enough rest in a cool place')",
                            "@lang('Drink plenty of fluids (water, juice, soup)')",
                            "@lang('Compress with warm water (not cold)')",
                            "@lang('Wear thin and sweat-absorbing clothes')",
                            "@lang('Eat easily digestible foods')"
                        ],
                        when_to_doctor: [
                            "@lang('Fever >39°C or lasts >3 days')",
                            "@lang('Accompanied by shortness of breath or chest pain')",
                            "@lang('Febrile seizures (especially in children)')",
                            "@lang('Severe dehydration (dry mouth, infrequent urination)')",
                            "@lang('Widespread skin rash')"
                        ],
                        avoid: [
                            "@lang('Do not use alcohol for compress')",
                            "@lang('Do not force to eat if not hungry')",
                            "@lang('Do not bathe in cold water during high fever')"
                        ]
                    }
                },
                'batuk': {
                    name: "@lang('Cough')",
                    description: "@lang('Reflex of the body to clear the respiratory tract')",
                    education: {
                        what_is: "@lang('Coughing is the body\'s natural reflex to clear the airways of irritants, mucus, or foreign objects.')",
                        care_tips: [
                            "@lang('Drink warm water with honey (for ages >1 year)')",
                            "@lang('Gargle with warm salt water')",
                            "@lang('Avoid cigarette smoke and air pollution')",
                            "@lang('Maintain humidity in the room')",
                            "@lang('Rest with your head slightly elevated')"
                        ],
                        when_to_doctor: [
                            "@lang('Coughing up blood or colored mucus')",
                            "@lang('Cough lasts >2 weeks')",
                            "@lang('Accompanied by high fever >3 days')",
                            "@lang('Shortness of breath or chest pain')",
                            "@lang('Unexplained weight loss')"
                        ],
                        avoid: [
                            "@lang('Do not give honey to babies <1 year')",
                            "@lang('Avoid cough medicine without doctor\'s consultation')",
                            "@lang('Do not smoke or be exposed to smoke')"
                        ]
                    }
                },
                'sakit_kepala': {
                    name: "@lang('Headache')",
                    description: "@lang('Pain or discomfort in the head area')",
                    education: {
                        what_is: "@lang('Headaches can be caused by various factors such as stress, lack of sleep, dehydration, or muscle tension.')",
                        care_tips: [
                            "@lang('Rest in a quiet and dark room')",
                            "@lang('Cold compress on the forehead or back of the neck')",
                            "@lang('Gently massage the temples and neck')",
                            "@lang('Drink enough water')",
                            "@lang('Maintain a regular sleep pattern')"
                        ],
                        when_to_doctor: [
                            "@lang('Sudden and severe headache')",
                            "@lang('Accompanied by high fever and stiff neck')",
                            "@lang('Vision or speech disturbances')",
                            "@lang('Recurring and worsening headaches')",
                            "@lang('Accompanied by continuous nausea and vomiting')"
                        ],
                        avoid: [
                            "@lang('Do not consume pain relievers excessively')",
                            "@lang('Avoid bright lights during a headache')",
                            "@lang('Do not ignore unusual headaches')"
                        ]
                    }
                },
                'mual': {
                    name: "@lang('Nausea')",
                    description: "@lang('Uncomfortable sensation in the stomach with the urge to vomit')",
                    education: {
                        what_is: "@lang('Nausea is an uncomfortable sensation in the stomach with the urge to vomit, which can be caused by digestive disorders or other conditions.')",
                        care_tips: [
                            "@lang('Eat in small but frequent portions')",
                            "@lang('Avoid fatty, spicy, or strongly scented foods')",
                            "@lang('Drink warm ginger tea or chamomile tea')",
                            "@lang('Rest with your head elevated')",
                            "@lang('Breathe in fresh air')"
                        ],
                        when_to_doctor: [
                            "@lang('Vomiting continuously for >24 hours')",
                            "@lang('Signs of dehydration (dry mouth, dizziness)')",
                            "@lang('Accompanied by severe abdominal pain')",
                            "@lang('Vomiting blood or greenish fluid')",
                            "@lang('High fever accompanied by nausea')"
                        ],
                        avoid: [
                            "@lang('Do not eat heavy foods when nauseous')",
                            "@lang('Avoid strong odors')",
                            "@lang('Do not lie down immediately after eating')"
                        ]
                    }
                },
                'pusing': {
                    name: "@lang('Dizziness')",
                    description: "@lang('Lightheadedness or loss of balance')",
                    education: {
                        what_is: "@lang('Dizziness can be a feeling of lightheadedness, loss of balance, or a spinning sensation (vertigo).')",
                        care_tips: [
                            "@lang('Sit or lie down slowly when feeling dizzy')",
                            "@lang('Drink enough water')",
                            "@lang('Avoid sudden head movements')",
                            "@lang('Get enough and regular rest')",
                            "@lang('Avoid standing for too long')"
                        ],
                        when_to_doctor: [
                            "@lang('Recurring dizziness for no apparent reason')",
                            "@lang('Accompanied by chest pain or shortness of breath')",
                            "@lang('Loss of consciousness or near-fainting')",
                            "@lang('Hearing disturbances or ringing in the ears')",
                            "@lang('Dizziness accompanied by severe headache')"
                        ],
                        avoid: [
                            "@lang('Do not drive when feeling dizzy')",
                            "@lang('Avoid dangerous activities at heights')",
                            "@lang('Do not ignore recurring dizziness')"
                        ]
                    }
                },
                'sesak_napas': {
                    name: "@lang('Shortness of Breath')",
                    description: "@lang('Difficulty breathing or short breaths')",
                    education: {
                        what_is: "@lang('Shortness of breath is difficulty in breathing that can be caused by heavy activity, lung conditions, or heart problems.')",
                        care_tips: [
                            "@lang('Sit upright leaning forward')",
                            "@lang('Breathe slowly and deeply through the nose')",
                            "@lang('Use a fan for air circulation')",
                            "@lang('Avoid heavy activities')",
                            "@lang('Stay calm and do not panic')"
                        ],
                        when_to_doctor: [
                            "@lang('Sudden and severe shortness of breath')",
                            "@lang('Not improving with rest')",
                            "@lang('Accompanied by chest pain or dizziness')",
                            "@lang('Bluish lips or nails')",
                            "@lang('History of heart or lung disease')"
                        ],
                        avoid: [
                            "@lang('Do not lie flat on your back when short of breath')",
                            "@lang('Avoid dusty or smoky places')",
                            "@lang('Do not delay seeking medical help')"
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
                            📖 {{ __('Information about') }} ${info.name}
                        </h4>
                        <p class="text-blue-700 dark:text-blue-400 mb-4">${info.education.what_is}</p>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h5 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">💡 {{ __('General Care Tips:') }}</h5>
                                <ul class="text-blue-700 dark:text-blue-400 space-y-1">
                                    ${info.education.care_tips.map(tip => `<li>• ${tip}</li>`).join('')}
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-semibold text-red-800 dark:text-red-300 mb-2">🏥 {{ __('When to See a Doctor:') }}</h5>
                                <ul class="text-red-700 dark:text-red-400 space-y-1">
                                    ${info.education.when_to_doctor.map(condition => `<li>• ${condition}</li>`).join('')}
                                </ul>
                            </div>
                        </div>
                        ${info.education.avoid ? `
                            <div class="mt-4">
                                <h5 class="font-semibold text-orange-800 dark:text-orange-300 mb-2">⚠️ {{ __('Things to Avoid:') }}</h5>
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
