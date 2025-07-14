<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Kesehatan - Medical Style</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
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
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-8px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(8px);
            }
        }

        @keyframes pulseSuccess {
            0% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(34, 197, 94, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
            }
        }

        @keyframes pulseError {
            0% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(239, 68, 68, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
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

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Header -->
        <div class="flex items-center mb-8 animate-fade-in">
            <div
                class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-4 shadow-lg">
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

        <p class="text-gray-600 dark:text-gray-300 mb-12 text-lg animate-fade-in">
            {{ __('Test your knowledge about health myths and facts with 9 interesting questions based on trusted medical research.') }}

        </p>

        <!-- Main Welcome Screen -->
        <div id="welcomeScreen" class="animate-slide-up">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 mb-12">
                <div class="flex items-start space-x-6 mb-6">
                    <div
                        class="w-24 h-24 bg-gradient-to-br from-green-400 to-green-600 rounded-lg flex-shrink-0 flex items-center justify-center shadow-lg floating-animation">
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

                            <span>{{ __(':count Questions', ['count' => 9]) }}</span>
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
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">📊 {{ __('Quiz Format') }}
                            </h4>
                            <ul class="text-sm text-blue-700 dark:text-blue-400 space-y-1">

                                <li>• {{ __('9 multiple choice questions') }}</li>
                                <li>• {{ __('Myth or Fact') }}</li>
                                <li>• {{ __('Explanation for each answer') }}</li>
                            </ul>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <h4 class="font-semibold text-green-800 dark:text-green-300 mb-2">🎯 {{ __('Benefits') }}
                            </h4>
                            <ul class="text-sm text-green-700 dark:text-green-400 space-y-1">
                                <li>• {{ __('Improve health literacy') }}</li>
                                <li>• {{ __('Eliminate false myths') }}</li>
                                <li>• {{ __('Based on scientific research') }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                        <h4 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">{{ __('Ready to start?') }}
                        </h4>
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

                            <span class="font-medium text-sm">{{ __('Question') }}: <span id="currentQ">1</span>/<span
                                    id="totalQ">9</span></span>

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
                        <div
                            class="w-14 h-14 mx-auto mb-4 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-2xl text-white">
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
                        <div id="resultIcon"
                            class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center text-3xl">
                        </div>

                        <h3 id="resultTitle" class="text-xl font-bold mb-4"></h3>

                        <div id="resultExplanation"
                            class="text-sm text-gray-700 dark:text-gray-300 bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6 text-left">
                        </div>

                        <button id="nextBtn"
                            class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-3 px-6 rounded-lg font-medium text-base hover:from-blue-600 hover:to-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                            {{ __('Next Question') }} →
                        </button>
                    </div>

                    <!-- Final Score Display (Hidden initially) -->
                    <div id="finalDisplay" class="text-center hidden">
                        <div
                            class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-r from-yellow-400 to-orange-500 flex items-center justify-center text-4xl">
                            <span id="finalIcon">🎉</span>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-3">{{ __('Quiz Finished!') }}
                        </h2>

                        <div
                            class="bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg p-4 mb-4">
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">
                                <span id="finalScore">0</span>/<span id="finalTotal">0</span>
                            </p>
                            <div class="text-base text-gray-700 dark:text-gray-300" id="scorePercentage"></div>
                        </div>

                        <div id="scoreMessage"
                            class="text-sm text-gray-700 dark:text-gray-300 mb-6 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 justify-center">
                            <button id="restartBtn"
                                class="bg-gradient-to-r from-green-500 to-green-600 text-white py-3 px-5 rounded-lg font-medium text-base hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                🔄 {{ __('Restart Quiz') }}
                            </button>
                            <button id="closeModalBtn"
                                class="bg-gray-500 text-white py-3 px-5 rounded-lg font-medium text-base hover:bg-gray-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                ✖️ {{ __('Close') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-16 animate-fade-in">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-8">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
                    {{ __('Improve Your Health Literacy') }}
                </h3>
                <p class="text-gray-600 dark:text-gray-300 mb-6">
                    {{ __('Get trusted health information based on the latest scientific research') }}
                </p>
                <button
                    class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition duration-300 shadow-lg">
                    {{ __('Learn More') }}
                </button>
            </div>
        </div>
    </div>

    <script>

        // Quiz data
        const quizData = {!! json_encode([
            [
                'question' => __('Is brown sugar healthier than white sugar?'),
                'answer' => __('Myth'),
                'explanation' => __(
                    'The calorie content and glycemic index are not much different; consumption should still be limited.',
                ),
            ],
            [
                'question' => __('Does eating pineapple cause miscarriage in pregnant women?'),
                'answer' => __('Myth'),
                'explanation' => __(
                    'The amount of bromelain in fresh pineapple is very small and not enough to cause contractions or miscarriage, so it is safe for pregnant women to consume pineapple in normal amounts.',
                ),
            ],
            [
                'question' => __('Chewing ice can damage teeth'),
                'answer' => __('Fact'),
                'explanation' => __('Chewing ice can cause small cracks in teeth and damage enamel.'),
            ],
            [
                'question' => __('Bathing at night causes rheumatism'),
                'answer' => __('Myth'),
                'explanation' => __(
                    'Rheumatism is not caused by bathing at night; it is an autoimmune or joint inflammatory disorder.',
                ),
            ],
            [
                'question' => __('Eating spicy food can trigger stomach ulcers'),
                'answer' => __('Fact'),
                'explanation' => __(
                    'Spicy food can increase stomach acid, and if it exceeds your tolerance, it can trigger GERD.',
                ),
            ],
            [
                'question' => __('Drinking cold water during menstruation causes ovarian cysts'),
                'answer' => __('Myth'),
                'explanation' => __(
                    'Ovarian cysts are fluid-filled sacs in the ovary, usually caused by hormonal fluctuations and unhealthy lifestyle, not by the temperature of your drink.',
                ),
            ],
            [
                'question' => __('Antibiotics prescribed by a doctor must be finished'),
                'answer' => __('Fact'),
                'explanation' => __(
                    'If not finished, stronger bacteria can survive and cause recurring infections and antibiotic resistance.',
                ),
            ],
            [
                'question' => __('Frequent headaches are caused by lack of sleep'),
                'answer' => __('Fact'),
                'explanation' => __(
                    'People with irregular sleep are prone to TTH (Tension Type Headache) and migraines due to narrowing of blood vessels in the scalp.',
                ),
            ],
            [
                'question' => __('Laughing can increase life expectancy'),
                'answer' => __('Fact'),
                'explanation' => __(
                    'Laughing relieves stress, releases endorphins, lowers sugar and adrenaline, and reduces blood pressure.',
                ),
            ],
        ]) !!};

        // Multilang strings for JS
        const quizLang = {
            correct: "{{ __('Correct! 🎉') }}",
            wrong: "{{ __('Wrong! 😔') }}",
            percentRight: "{{ __(':percent% Correct', ['percent' => ':percent']) }}",
            excellent: "{{ __('🌟 Excellent! You really understand health facts!') }}",
            good: "{{ __('👍 Good! Your health knowledge is quite good.') }}",
            needLearn: "{{ __('📚 You still need to learn more about health. Keep it up!') }}"
        };


        // Quiz state
        let currentQuestion = 0;
        let score = 0;
        let isAnswered = false;

        // DOM Elements
        const startQuizBtn = document.getElementById('startQuizBtn');
        const welcomeScreen = document.getElementById('welcomeScreen');
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
            welcomeScreen.style.display = 'none';
            quizModal.classList.remove('hidden');
            quizModal.querySelector('.bg-white').classList.add('modal-enter');
        }

        // Hide modal
        function hideModal() {
            const modalContent = quizModal.querySelector('.bg-white');
            modalContent.classList.add('modal-exit');

            setTimeout(() => {
                quizModal.classList.add('hidden');
                welcomeScreen.style.display = 'block';
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
                resultIcon.className =
                    'w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center text-3xl bg-green-100 dark:bg-green-900/20';
                resultTitle.textContent = quizLang.correct;
                resultTitle.className = 'text-xl font-bold mb-4 text-green-600 dark:text-green-400';
            } else {
                resultIcon.innerHTML = '<span class="text-red-500">❌</span>';
                resultIcon.className =
                    'w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center text-3xl bg-red-100 dark:bg-red-900/20';
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
            // Use multilang string for percent
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
            scoreElement.textContent = score;
        }

        function updateQuestionNumber() {
            currentQElement.textContent = currentQuestion + 1;
            totalQElement.textContent = quizData.length;
        }

        function updateProgressBar() {
            const progress = ((currentQuestion + 1) / quizData.length) * 100;
            progressBar.style.width = `${progress}%`;
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
        startQuizBtn.addEventListener('click', async () => {
            await initQuiz();
            showModal();
        });

        const labelMyth = "{{ __('Myth') }}";
        const labelFact = "{{ __('Fact') }}";
        mitosBtn.addEventListener('click', () => selectAnswer(labelMyth));
        faktaBtn.addEventListener('click', () => selectAnswer(labelFact));
        nextBtn.addEventListener('click', nextQuestion);
        
        restartBtn.addEventListener('click', async () => {
            await initQuiz();

        });

        closeModalBtn.addEventListener('click', hideModal);

        // Close modal when clicking outside
        quizModal.addEventListener('click', (e) => {
            if (e.target === quizModal) {
                hideModal();
            }
        });

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
