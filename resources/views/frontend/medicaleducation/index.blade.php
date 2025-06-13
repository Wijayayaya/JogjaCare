@extends('frontend.layouts.app')

@section('title')
    {{ __('Medical Education') }}
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-24 overflow-hidden">
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
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Medical <span class="text-blue-200">Education</span>
                </h1>
                <p class="text-xl md:text-2xl mb-10 opacity-90 max-w-3xl mx-auto leading-relaxed">
                    Platform edukasi kesehatan dengan kuis interaktif, artikel terkini, dan informasi gejala untuk meningkatkan literasi kesehatan
                </p>
                
                <!-- Disclaimer Penting -->
                <div class="bg-red-50/20 border border-red-300 rounded-xl p-4 mb-8 text-left max-w-3xl mx-auto">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-red-300 mt-1 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        <div class="text-red-100">
                            <p class="font-semibold mb-1">⚠️ Platform Edukasi Kesehatan</p>
                            <p class="text-sm">Informasi di platform ini hanya untuk edukasi. Selalu konsultasi dengan dokter untuk kondisi kesehatan Anda.</p>
                        </div>
                    </div>
                </div>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <button onclick="scrollToQuiz()" class="group bg-white text-blue-600 px-10 py-4 rounded-xl font-semibold text-lg hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Mulai Kuis
                        </span>
                    </button>
                    <a href="{{ route('expert-system') }}" class="group bg-emerald-500 text-white px-10 py-4 rounded-xl font-semibold text-lg hover:bg-emerald-600 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Informasi Kesehatan
                        </span>
                    </a>
                    <button onclick="scrollToArticles()" class="group border-2 border-white text-white px-10 py-4 rounded-xl font-semibold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-3 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Jelajahi Artikel
                        </span>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Floating Elements -->
        <div class="absolute top-20 left-10 w-6 h-6 bg-blue-400 rounded-full opacity-50 animate-bounce" style="animation-delay: 0s;"></div>
        <div class="absolute top-40 right-20 w-4 h-4 bg-blue-300 rounded-full opacity-40 animate-bounce" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 left-20 w-5 h-5 bg-blue-200 rounded-full opacity-30 animate-bounce" style="animation-delay: 2s;"></div>
    </section>

    <!-- Main Content Sections -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-16">
                <!-- Quiz Section -->
                <div id="quiz-section">
                    @include('frontend.medicaleducation.quiz-section')
                </div>

                <!-- Articles Section -->
                <div id="articles-section">
                    @include('frontend.medicaleducation.articles-section')
                </div>
            </div>
        </div>
    </section>

    <!-- Health Information Preview Section -->
    <section class="py-20 bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-700 text-white relative overflow-hidden">
        <!-- Background Animation -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/80 to-cyan-600/80"></div>
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="animate-pulse absolute top-10 left-10 w-32 h-32 bg-white/5 rounded-full"></div>
                <div class="animate-pulse absolute bottom-20 right-20 w-24 h-24 bg-white/5 rounded-full" style="animation-delay: 1s;"></div>
                <div class="animate-pulse absolute top-1/2 left-1/3 w-16 h-16 bg-white/5 rounded-full" style="animation-delay: 2s;"></div>
            </div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Informasi Kesehatan & Edukasi Gejala</h2>
                <p class="text-xl md:text-2xl mb-10 opacity-90 max-w-3xl mx-auto leading-relaxed">
                    Pelajari tentang gejala kesehatan umum dan kapan harus mencari bantuan medis profesional
                </p>
                
                <!-- Disclaimer Box -->
                <div class="bg-red-50/20 border border-red-300 rounded-xl p-4 mb-8 max-w-2xl mx-auto">
                    <p class="text-red-100 font-semibold text-sm">
                        ⚠️ Hanya untuk edukasi kesehatan - Bukan pengganti konsultasi medis
                    </p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8 mb-12">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Edukasi Gejala</h3>
                        <p class="text-emerald-100 text-sm">Pelajari tentang gejala umum dan cara perawatan dasar</p>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Kapan ke Dokter</h3>
                        <p class="text-emerald-100 text-sm">Panduan kapan harus mencari bantuan medis profesional</p>
                    </div>
                    
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6">
                        <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">Tips Perawatan</h3>
                        <p class="text-emerald-100 text-sm">Saran perawatan umum dan pencegahan</p>
                    </div>
                </div>
                
                <a href="{{ route('expert-system') }}" class="inline-flex items-center bg-white text-emerald-600 px-12 py-5 rounded-xl font-bold text-lg hover:bg-gray-50 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Akses Informasi Kesehatan
                </a>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 text-white relative overflow-hidden">
        <!-- Background Animation -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/80 to-purple-600/80"></div>
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="animate-pulse absolute top-10 left-10 w-32 h-32 bg-white/5 rounded-full"></div>
                <div class="animate-pulse absolute bottom-20 right-20 w-24 h-24 bg-white/5 rounded-full" style="animation-delay: 1s;"></div>
                <div class="animate-pulse absolute top-1/2 left-1/3 w-16 h-16 bg-white/5 rounded-full" style="animation-delay: 2s;"></div>
            </div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Statistik Pembelajaran</h2>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    Bergabunglah dengan ribuan orang yang telah meningkatkan literasi kesehatan mereka
                </p>
            </div>
            
            <div class="grid md:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 transform hover:scale-105">
                        <div class="text-5xl font-bold mb-2 text-blue-200 group-hover:text-white transition-colors">150+</div>
                        <div class="text-lg text-blue-100 group-hover:text-white transition-colors">Topik Kuis</div>
                        <div class="mt-4 w-12 h-1 bg-blue-300 rounded-full mx-auto group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
                <div class="text-center group">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 transform hover:scale-105">
                        <div class="text-5xl font-bold mb-2 text-purple-200 group-hover:text-white transition-colors">500+</div>
                        <div class="text-lg text-blue-100 group-hover:text-white transition-colors">Artikel Medis</div>
                        <div class="mt-4 w-12 h-1 bg-purple-300 rounded-full mx-auto group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
                <div class="text-center group">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 transform hover:scale-105">
                        <div class="text-5xl font-bold mb-2 text-indigo-200 group-hover:text-white transition-colors">25,000+</div>
                        <div class="text-lg text-blue-100 group-hover:text-white transition-colors">Percobaan Kuis</div>
                        <div class="mt-4 w-12 h-1 bg-indigo-300 rounded-full mx-auto group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
                <div class="text-center group">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-8 hover:bg-white/20 transition-all duration-300 transform hover:scale-105">
                        <div class="text-5xl font-bold mb-2 text-emerald-200 group-hover:text-white transition-colors">50+</div>
                        <div class="text-lg text-blue-100 group-hover:text-white transition-colors">Topik Kesehatan</div>
                        <div class="mt-4 w-12 h-1 bg-emerald-300 rounded-full mx-auto group-hover:w-16 transition-all duration-300"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-20 bg-white dark:bg-gray-800">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-4xl mx-auto">
                <!-- Icon -->
                <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-8">
                    <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                    </svg>
                </div>
                
                <h2 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800 dark:text-white">
                    Tingkatkan Literasi Kesehatan Anda
                </h2>
                <p class="text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-12 max-w-3xl mx-auto leading-relaxed">
                    Uji pengetahuan dengan kuis, baca artikel terkini, dan pelajari informasi kesehatan yang akurat.
                </p>
                
                <!-- Enhanced CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <button onclick="scrollToQuiz()" class="group bg-gradient-to-r from-purple-600 to-blue-600 text-white px-12 py-5 rounded-xl font-bold text-lg hover:from-purple-700 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                        <span class="flex items-center">
                            <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Ambil Kuis Pertama Anda
                        </span>
                    </button>
                    <a href="{{ route('expert-system') }}" class="group bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-12 py-5 rounded-xl font-bold text-lg hover:from-emerald-700 hover:to-teal-700 transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                        <span class="flex items-center">
                            <svg class="w-6 h-6 mr-3 group-hover:rotate-12 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            Akses Informasi Kesehatan
                        </span>
                    </a>
                    <button onclick="scrollToArticles()" class="group border-2 border-blue-600 text-blue-600 dark:text-blue-400 dark:border-blue-400 px-12 py-5 rounded-xl font-bold text-lg hover:bg-blue-600 hover:text-white dark:hover:bg-blue-400 dark:hover:text-gray-900 transition-all duration-300 transform hover:scale-105">
                        <span class="flex items-center">
                            <svg class="w-6 h-6 mr-3 group-hover:translate-x-1 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Jelajahi Artikel
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-in-out',
                        'slide-up': 'slideUp 0.5s ease-out',
                        'bounce-in': 'bounceIn 0.8s ease-out',
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Smooth scrolling functions
        function scrollToQuiz() {
            document.getElementById('quiz-section').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
        
        function scrollToArticles() {
            document.getElementById('articles-section').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
        
        // Enhanced interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Intersection Observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in');
                    }
                });
            }, observerOptions);
            
            // Observe all cards
            const cards = document.querySelectorAll('.bg-white, .bg-gray-800');
            cards.forEach(card => {
                observer.observe(card);
            });
            
            // Enhanced hover effects
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                    this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                });
            });
        });
        
        // Theme toggle functionality
        function toggleTheme() {
            document.documentElement.classList.toggle('dark');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        }
        
        // Apply saved theme on load
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
@endpush
