<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Kesehatan - Medical Style</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-in-out',
                        'slide-up': 'slideUp 0.8s ease-out'
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
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-overlay {
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-enter {
            animation: modalEnter 0.3s ease-out;
        }

        .modal-exit {
            animation: modalExit 0.3s ease-in;
        }

        .shake {
            animation: shake 0.6s ease-in-out;
        }

        .pulse-success {
            animation: pulseSuccess 1s ease-in-out;
        }

        .pulse-error {
            animation: pulseError 1s ease-in-out;
        }

        .bounce-in {
            animation: bounceIn 0.5s ease-out;
        }

        @keyframes modalEnter {
            from {
                opacity: 0;
                transform: scale(0.7) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes modalExit {
            from {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
            to {
                opacity: 0;
                transform: scale(0.7) translateY(-20px);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
            20%, 40%, 60%, 80% { transform: translateX(8px); }
        }

        @keyframes pulseSuccess {
            0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(34, 197, 94, 0); }
            100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
        }

        @keyframes pulseError {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { box-shadow: 0 0 0 15px rgba(239, 68, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.3);
                opacity: 0;
            }
            50% {
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .loading-spinner {
            border: 4px solid #f3f4f6;
            border-top: 4px solid #3b82f6;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="flex items-center mb-8 animate-fade-in">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-4 shadow-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                    </path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-gray-800 to-blue-600 bg-clip-text text-transparent">
                {{ __('Health Quiz') }}
            </h1>
        </div>
        
        <p class="text-gray-600 dark:text-gray-300 mb-12 text-lg animate-fade-in welcome-description">
            Uji pengetahuan Anda tentang mitos dan fakta kesehatan dengan pertanyaan menarik berdasarkan penelitian medis terpercaya.
        </p>

        <!-- Loading State -->
        <div id="loadingState" class="text-center py-12">
            <div class="loading-spinner mx-auto mb-4"></div>
            <p class="text-gray-600 dark:text-gray-300">Memuat data quiz...</p>
        </div>

        <!-- Error State -->
        <div id="errorState" class="hidden bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl p-6 mb-8">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <div>
                    <h3 class="text-red-800 dark:text-red-200 font-semibold">Gagal memuat quiz</h3>
                    <p class="text-red-600 dark:text-red-300 text-sm" id="errorMessage">Terjadi kesalahan saat memuat data quiz.</p>
                </div>
            </div>
            <button onclick="loadQuizData()" class="mt-4 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                Coba Lagi
            </button>
        </div>

        <!-- Main Welcome Screen -->
        <div id="welcomeScreen" class="hidden animate-slide-up">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 mb-12">
                <div class="flex items-start space-x-6 mb-6">
                    <div class="w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg floating-animation">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold mb-3 text-gray-800 dark:text-white">
                            {{ __('Health Myths vs Facts Quiz') }}
                        </h2>
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 space-x-3 mb-4">
                            <span>{{ __('Medical Team') }}</span>
                            <span>•</span>
                            <span class="question-count">Memuat...</span>
                            <span>•</span>
                            <span>{{ __('No Time Limit') }}</span>
                        </div>
                    </div>
                </div>

                <div class="text-gray-700 dark:text-gray-300 space-y-6">
                    <p class="text-lg font-medium text-gray-800 dark:text-gray-200">
                        {{ __('How good is your health knowledge? Let\'s test your understanding of various health myths and facts that are often circulating in society.') }}
                    </p>

                    <div class="grid md:grid-cols-2 gap-6 my-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">📊 {{ __('Quiz Format') }}</h4>
                            <ul class="text-sm text-blue-700 dark:text-blue-400 space-y-1">
                                <li>• <span class="question-count-detail">Memuat...</span> pertanyaan pilihan ganda</li>
                                <li>• Mitos atau Fakta</li>
                                <li>• Penjelasan untuk setiap jawaban</li>
                            </ul>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h4 class="font-semibold text-green-800 dark:text-green-300 mb-2">🎯 {{ __('Benefits') }}</h4>
                            <ul class="text-sm text-green-700 dark:text-green-400 space-y-1">
                                <li>• {{ __('Improve health literacy') }}</li>
                                <li>• {{ __('Eliminate false myths') }}</li>
                                <li>• {{ __('Based on scientific research') }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">{{ __('Ready to start?') }}</h4>
                        <p class="text-gray-600 dark:text-gray-400 mb-4">
                            {{ __('Click the button below to start the quiz and find out how good your health knowledge is!') }}
                        </p>
                        <button id="startQuizBtn"
                            class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition duration-300 shadow-lg transform hover:scale-105">
                            🚀 {{ __('Start Quiz Now') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quiz Modal -->
        <div id="quizModal" class="fixed inset-0 modal-overlay hidden flex items-center justify-center p-4 z-50">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-xl w-full max-h-[90vh] overflow-y-auto">
                <!-- Modal Header -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-4 rounded-t-2xl">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <span class="text-lg">📊</span>
                            <span class="font-medium text-sm">{{ __('Score') }}: <span id="score">0</span></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-lg">❓</span>
                            <span class="font-medium text-sm">Soal: <span id="currentQ">1</span>/<span id="totalQ">0</span></span>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <div class="mt-3 bg-white/20 rounded-full h-2">
                        <div id="progressBar" class="bg-white rounded-full h-2 transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>

                <!-- Modal Content -->
                <div class="p-6">
                    <!-- Question Display -->
                    <div id="questionDisplay" class="text-center">
                        <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-2xl text-white">
                            <span id="questionIcon">🤔</span>
                        </div>

                        <h2 class="text-lg md:text-xl font-bold text-gray-800 dark:text-white mb-6" id="questionText">
                            Memuat soal...
                        </h2>

                        <!-- Answer Buttons -->
                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button id="mitosBtn"
                                class="flex-1 max-w-xs bg-gradient-to-r from-red-500 to-red-600 text-white py-3 px-4 rounded-lg font-medium text-base hover:from-red-600 hover:to-red-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                <span class="text-lg mr-2">❌</span>
                                {{ __('MYTH') }}
                            </button>
                            <button id="faktaBtn"
                                class="flex-1 max-w-xs bg-gradient-to-r from-green-500 to-green-600 text-white py-3 px-4 rounded-lg font-medium text-base hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                <span class="text-lg mr-2">✅</span>
                                {{ __('FACT') }}
                            </button>
                        </div>
                    </div>

                    <!-- Result Display (Hidden initially) -->
                    <div id="resultDisplay" class="text-center hidden">
                        <div id="resultIcon" class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center text-3xl"></div>
                        <h3 id="resultTitle" class="text-xl font-bold mb-4"></h3>
                        <div id="resultExplanation" class="text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6 text-left"></div>
                        <button id="nextBtn" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-3 px-6 rounded-lg font-medium text-base hover:from-blue-600 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                            {{ __('Next Question') }} →
                        </button>
                    </div>

                    <!-- Final Score Display (Hidden initially) -->
                    <div id="finalDisplay" class="text-center hidden">
                        <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 flex items-center justify-center text-4xl">
                            <span id="finalIcon">🎉</span>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-3">{{ __('Quiz Finished!') }}</h2>

                        <div class="bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg p-4 mb-4">
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">
                                <span id="finalScore">0</span>/<span id="finalTotal">0</span>
                            </p>
                            <div class="text-base text-gray-700 dark:text-gray-300" id="scorePercentage"></div>
                        </div>

                        <div id="scoreMessage" class="text-sm text-gray-700 dark:text-gray-300 mb-6 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg"></div>

                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button id="restartBtn" class="bg-gradient-to-r from-green-500 to-green-600 text-white py-3 px-5 rounded-lg font-medium text-base hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                🔄 {{ __('Restart Quiz') }}
                            </button>
                            <button id="closeModalBtn" class="bg-gray-500 text-white py-3 px-5 rounded-lg font-medium text-base hover:bg-gray-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                ✖️ {{ __('Close') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Quiz data - akan diambil dari database
        let quizData = [];
        let isDataLoaded = false;

        // Multilingual support
        const quizLang = {
            correct: "{{ __('Correct!') }}",
            wrong: "{{ __('Wrong!') }}",
            percentRight: "{{ __(':percent% Correct') }}",
            excellent: "{{ __('Excellent! You have very good health knowledge.') }}",
            good: "{{ __('Good! Keep learning to improve your health knowledge.') }}",
            needLearn: "{{ __('Keep learning! There is still much to learn about health.') }}"
        };

        // DOM Elements
        const loadingState = document.getElementById('loadingState');
        const errorState = document.getElementById('errorState');
        const errorMessage = document.getElementById('errorMessage');
        const welcomeScreen = document.getElementById('welcomeScreen');
        const startQuizBtn = document.getElementById('startQuizBtn');
        const quizModal = document.getElementById('quizModal');
        const questionText = document.getElementById('questionText');
        const questionIcon = document.getElementById('questionIcon');
        const mitosBtn = document.getElementById('mitosBtn');
        const faktaBtn = document.getElementById('faktaBtn');
        const questionDisplay = document.getElementById('questionDisplay');
        const resultDisplay = document.getElementById('resultDisplay');
        const finalDisplay = document.getElementById('finalDisplay');
        const nextBtn = document.getElementById('nextBtn');
        const restartBtn = document.getElementById('restartBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const scoreElement = document.getElementById('score');
        const currentQElement = document.getElementById('currentQ');
        const totalQElement = document.getElementById('totalQ');
        const progressBar = document.getElementById('progressBar');

        // Quiz state
        let currentQuestion = 0;
        let score = 0;
        let isAnswered = false;

        // Fungsi untuk mengambil data quiz dari database
        async function loadQuizData() {
            try {
                console.log('Loading quiz data...');
                
                // Show loading state
                loadingState.classList.remove('hidden');
                errorState.classList.add('hidden');
                welcomeScreen.classList.add('hidden');

                const response = await fetch('/api/quiz-data', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                console.log('Response status:', response.status);
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const data = await response.json();
                console.log('Quiz data received:', data);
                
                if (data && Array.isArray(data) && data.length > 0) {
                    quizData = data;
                    isDataLoaded = true;
                    console.log('Quiz data loaded successfully:', quizData.length, 'questions');
                    
                    // Hide loading, show welcome screen
                    loadingState.classList.add('hidden');
                    welcomeScreen.classList.remove('hidden');
                    updateWelcomeScreen();
                } else {
                    throw new Error('No quiz data found in database');
                }
            } catch (error) {
                console.error('Error loading quiz data:', error);
                
                // Show error state
                loadingState.classList.add('hidden');
                errorState.classList.remove('hidden');
                errorMessage.textContent = error.message;
                
                // Fallback data
                quizData = [{
                    question: "Belum ada quiz tersedia di database",
                    answer: "Fakta",
                    explanation: "Silakan hubungi administrator untuk menambahkan quiz melalui dashboard admin."
                }];
                isDataLoaded = true;
            }
        }

        // Update welcome screen dengan data dinamis
        function updateWelcomeScreen() {
            const questionCount = quizData.length;
            
            // Update deskripsi utama
            const welcomeDescription = document.querySelector('.welcome-description');
            if (welcomeDescription) {
                welcomeDescription.textContent = `Uji pengetahuan Anda tentang mitos dan fakta kesehatan dengan ${questionCount} pertanyaan menarik berdasarkan penelitian medis terpercaya.`;
            }
            
            // Update jumlah pertanyaan di berbagai tempat
            const questionCountElements = document.querySelectorAll('.question-count');
            questionCountElements.forEach(el => {
                el.textContent = `${questionCount} Pertanyaan`;
            });
            
            const questionCountDetailElements = document.querySelectorAll('.question-count-detail');
            questionCountDetailElements.forEach(el => {
                el.textContent = questionCount;
            });
            
            // Update total questions display
            if (totalQElement) {
                totalQElement.textContent = questionCount;
            }
        }

        // Initialize quiz
        async function initQuiz() {
            // Pastikan data quiz sudah dimuat
            if (!isDataLoaded) {
                await loadQuizData();
            }
            
            currentQuestion = 0;
            score = 0;
            isAnswered = false;
            updateScore();
            updateQuestionNumber();
            updateProgressBar();
            loadQuestion();
            showQuestionDisplay();
        }

        // Show modal
        function showModal() {
            welcomeScreen.classList.add('hidden');
            quizModal.classList.remove('hidden');
            quizModal.querySelector('.bg-white').classList.add('modal-enter');
        }

        // Hide modal
        function hideModal() {
            const modalContent = quizModal.querySelector('.bg-white');
            modalContent.classList.add('modal-exit');

            setTimeout(() => {
                quizModal.classList.add('hidden');
                welcomeScreen.classList.remove('hidden');
                modalContent.classList.remove('modal-exit');
            }, 300);
        }

        // Load question
        function loadQuestion() {
            if (currentQuestion < quizData.length) {
                const question = quizData[currentQuestion];
                questionText.textContent = question.question;
                questionIcon.textContent = "🤔";
                isAnswered = false;

                // Reset buttons
                mitosBtn.disabled = false;
                faktaBtn.disabled = false;
                mitosBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                faktaBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        // Show question display
        function showQuestionDisplay() {
            questionDisplay.classList.remove('hidden');
            resultDisplay.classList.add('hidden');
            finalDisplay.classList.add('hidden');
        }

        // Show result display
        function showResultDisplay(isCorrect, explanation) {
            questionDisplay.classList.add('hidden');
            resultDisplay.classList.remove('hidden');
            resultDisplay.classList.add('bounce-in');

            const resultIcon = document.getElementById('resultIcon');
            const resultTitle = document.getElementById('resultTitle');
            const resultExplanation = document.getElementById('resultExplanation');

            if (isCorrect) {
                resultIcon.innerHTML = '<span class="text-green-500">✅</span>';
                resultIcon.className = 'w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center text-3xl bg-green-100 dark:bg-green-900/20';
                resultTitle.textContent = quizLang.correct;
                resultTitle.className = 'text-xl font-bold mb-4 text-green-600 dark:text-green-400';
            } else {
                resultIcon.innerHTML = '<span class="text-red-500">❌</span>';
                resultIcon.className = 'w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center text-3xl bg-red-100 dark:bg-red-900/20';
                resultTitle.textContent = quizLang.wrong;
                resultTitle.className = 'text-xl font-bold mb-4 text-red-600 dark:text-red-400';
            }

            resultExplanation.textContent = explanation;
        }

        // Show final display
        function showFinalDisplay() {
            questionDisplay.classList.add('hidden');
            resultDisplay.classList.add('hidden');
            finalDisplay.classList.remove('hidden');
            finalDisplay.classList.add('bounce-in');

            const finalScore = document.getElementById('finalScore');
            const finalTotal = document.getElementById('finalTotal');
            const scoreMessage = document.getElementById('scoreMessage');
            const finalIcon = document.getElementById('finalIcon');
            const scorePercentage = document.getElementById('scorePercentage');

            finalScore.textContent = score;
            finalTotal.textContent = quizData.length;
            const percentage = Math.round((score / quizData.length) * 100);
            scorePercentage.textContent = quizLang.percentRight.replace(':percent', percentage);

            if (percentage >= 80) {
                scoreMessage.textContent = quizLang.excellent;
                finalIcon.textContent = "🏆";
            } else if (percentage >= 60) {
                scoreMessage.textContent = quizLang.good;
                finalIcon.textContent = "🎉";
            } else {
                scoreMessage.textContent = quizLang.needLearn;
                finalIcon.textContent = "💪";
            }
        }

        // Update displays
        function updateScore() {
            if (scoreElement) {
                scoreElement.textContent = score;
            }
        }

        function updateQuestionNumber() {
            if (currentQElement) {
                currentQElement.textContent = currentQuestion + 1;
            }
            if (totalQElement) {
                totalQElement.textContent = quizData.length;
            }
        }

        function updateProgressBar() {
            if (progressBar) {
                const progress = ((currentQuestion + 1) / quizData.length) * 100;
                progressBar.style.width = `${progress}%`;
            }
        }

        // Handle answer
        function selectAnswer(selectedAnswer) {
            if (isAnswered) return;

            isAnswered = true;
            const correctAnswer = quizData[currentQuestion].answer;
            const isCorrect = selectedAnswer === correctAnswer;

            // Disable buttons
            mitosBtn.disabled = true;
            faktaBtn.disabled = true;
            mitosBtn.classList.add('opacity-50', 'cursor-not-allowed');
            faktaBtn.classList.add('opacity-50', 'cursor-not-allowed');

            // Add animation
            const questionContainer = questionDisplay;
            if (isCorrect) {
                score++;
                updateScore();
                questionContainer.classList.add('pulse-success');
            } else {
                questionContainer.classList.add('shake');
            }

            // Show result after animation
            setTimeout(() => {
                showResultDisplay(isCorrect, quizData[currentQuestion].explanation);
                questionContainer.classList.remove('pulse-success', 'shake');
            }, 1000);
        }

        // Next question
        function nextQuestion() {
            currentQuestion++;
            updateQuestionNumber();
            updateProgressBar();

            if (currentQuestion < quizData.length) {
                loadQuestion();
                showQuestionDisplay();
            } else {
                showFinalDisplay();
            }
        }

        // Event listeners
        if (startQuizBtn) {
            startQuizBtn.addEventListener('click', async () => {
                await initQuiz();
                showModal();
            });
        }

        if (mitosBtn) {
            mitosBtn.addEventListener('click', () => selectAnswer('Mitos'));
        }

        if (faktaBtn) {
            faktaBtn.addEventListener('click', () => selectAnswer('Fakta'));
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', nextQuestion);
        }
        
        if (restartBtn) {
            restartBtn.addEventListener('click', async () => {
                await initQuiz();
            });
        }

        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', hideModal);
        }

        // Close modal when clicking outside
        if (quizModal) {
            quizModal.addEventListener('click', (e) => {
                if (e.target === quizModal) {
                    hideModal();
                }
            });
        }

        // Dark mode toggle functionality
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
        }

        // Load dark mode preference
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        }

        // Load quiz data when page loads
        document.addEventListener('DOMContentLoaded', function() {
            loadQuizData();
        });
    </script>
</body>
</html>
