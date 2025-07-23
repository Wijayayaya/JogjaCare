@extends('frontend.layouts.app')

@section('title')
    {{ __('About Us') }}
@endsection

@section('content')
<!-- Hero Section with Enhanced Design -->
<section class="relative min-h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 text-white overflow-hidden">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 bg-cover bg-center z-0" 
         style="background-image: url('{{ asset('img/Wallpaper/wallpapertugu.jpg') }}');">
    </div>
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/80 via-blue-800/70 to-indigo-900/80 z-10"></div>
    
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 z-5">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-indigo-400/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>
    
    <div class="container mx-auto flex px-6 py-32 items-center justify-center flex-col relative z-20">
        <!-- Logo with Enhanced Styling -->
        <div class="mb-12 transform hover:scale-105 transition-transform duration-300">
            <img class="lg:w-80 md:w-72 w-64 object-cover object-center rounded-2xl shadow-2xl border-4 border-white/20 backdrop-blur-sm" 
                 alt="JogjaCare Logo" 
                 src="{{ asset('img/JOGCARE1000.png') }}">
        </div>
        
        <!-- Hero Content -->
        <div class="text-center lg:w-4/5 w-full">
            <h1 class="title-font text-5xl md:text-7xl lg:text-8xl mb-8 font-bold text-white tracking-tight">
                About <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-cyan-200">JogjaCare</span>
            </h1>
            <p class="mb-12 text-xl md:text-2xl leading-relaxed text-blue-100 max-w-4xl mx-auto">
                Bridging Healthcare Excellence with Yogyakarta's Cultural Heritage
            </p>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-400 to-cyan-400 mx-auto rounded-full"></div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20">
        <div class="animate-bounce">
            <svg class="w-6 h-6 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</section>

<!-- About Section with Modern Design -->
<section class="py-24 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="container mx-auto px-6">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center px-4 py-2 bg-blue-100 dark:bg-blue-900/30 rounded-full mb-6">
                <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm tracking-wide uppercase">Our Story</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-8 tracking-tight">
                About <span class="text-blue-600">JogjaCare</span>
            </h2>
        </div>
        
        <!-- Content -->
        <div class="max-w-5xl mx-auto">
            <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100 dark:border-gray-700">
                <div class="prose prose-lg prose-gray dark:prose-invert max-w-none text-center">
                    <p class="text-xl leading-relaxed text-gray-700 dark:text-gray-300 mb-8">
                        {{ __('About Intro') }}
                    </p>
                    <p class="text-xl leading-relaxed text-gray-700 dark:text-gray-300 mb-8">
                        {{ __('About Services') }}
                    </p>
                    <p class="text-xl leading-relaxed text-gray-700 dark:text-gray-300">
                        {{ __('About Uniqueness') }}
                    </p>
                </div>
                <div class="flex justify-center mt-12">
                    <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission Section with Enhanced Cards -->
<section class="py-24 bg-white dark:bg-gray-900 overflow-hidden">
    <div class="container mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 max-w-7xl mx-auto">
            <!-- Vision Card -->
            <div class="group">
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-3xl p-8 md:p-12 shadow-xl hover:shadow-2xl transition-all duration-300 border border-blue-100 dark:border-blue-800/30 h-full">
                    <!-- Icon and Badge -->
                    <div class="flex items-center mb-8">
                        <div class="p-4 bg-blue-500 rounded-2xl mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <span class="inline-block py-2 px-4 rounded-full bg-blue-500 text-white text-sm font-semibold tracking-wide uppercase">Our Vision</span>
                    </div>
                    
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        Leading Health Tourism Platform
                    </h3>
                    
                    <blockquote class="text-lg text-gray-700 dark:text-gray-300 mb-8 italic leading-relaxed border-l-4 border-blue-500 pl-6">
                        "To be the leading platform connecting tourists with quality health services in Yogyakarta, combining the cultural beauty and friendliness of the city with modern medical care."
                    </blockquote>
                    
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-4">This vision includes several important aspects:</h4>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <p class="text-gray-600 dark:text-gray-400">Position as the main platform for health tourism</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <p class="text-gray-600 dark:text-gray-400">Focus on Yogyakarta as a destination</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <p class="text-gray-600 dark:text-gray-400">Emphasis on the quality of health services</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <p class="text-gray-600 dark:text-gray-400">Integration between tourism and medical care</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <p class="text-gray-600 dark:text-gray-400">Highlighting the unique culture and hospitality of Yogyakarta</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mission Card -->
            <div class="group">
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-3xl p-8 md:p-12 shadow-xl hover:shadow-2xl transition-all duration-300 border border-indigo-100 dark:border-indigo-800/30 h-full">
                    <!-- Icon and Badge -->
                    <div class="flex items-center mb-8">
                        <div class="p-4 bg-indigo-500 rounded-2xl mr-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <span class="inline-block py-2 px-4 rounded-full bg-indigo-500 text-white text-sm font-semibold tracking-wide uppercase">Our Mission</span>
                    </div>
                    
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        Trusted Healthcare Bridge
                    </h3>
                    
                    <blockquote class="text-lg text-gray-700 dark:text-gray-300 mb-8 italic leading-relaxed border-l-4 border-indigo-500 pl-6">
                        "To be a trusted bridge connecting tourists with quality health services in Yogyakarta, while promoting the cultural richness and natural beauty of this area."
                    </blockquote>
                    
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-4">This mission includes several important aspects:</h4>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-indigo-500 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <p class="text-gray-600 dark:text-gray-400">Connecting tourists with health services</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-indigo-500 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <p class="text-gray-600 dark:text-gray-400">Guarantee the quality of the services offered</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-indigo-500 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <p class="text-gray-600 dark:text-gray-400">Promote Yogyakarta as a health tourism destination</p>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-indigo-500 rounded-full mt-2 mr-4 flex-shrink-0"></div>
                                <p class="text-gray-600 dark:text-gray-400">Combining health aspects with culture and style</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section with Professional Cards -->
<section class="py-24 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="container mx-auto px-6">
        <!-- Section Header -->
        <div class="text-center mb-20">
            <div class="flex items-center justify-center mb-8">
                <div class="p-3 bg-blue-500 rounded-2xl mr-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <span class="inline-block py-2 px-4 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-sm font-semibold tracking-wide uppercase">Our Team</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-8 tracking-tight">
                Meet Our <span class="text-blue-600">Professionals</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-4xl mx-auto leading-relaxed">
                At JogjaCare, we have a team of professionals dedicated to providing the best health experience for you. 
                Carefully selected to combine the latest medical expertise with typical Jogja hospitality.
            </p>
        </div>

        <!-- Team Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
            <!-- Team Member 1 -->
            <div class="group">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="relative overflow-hidden">
                        <img alt="Marsalina" 
                             class="w-full h-80 object-cover object-center group-hover:scale-105 transition-transform duration-300" 
                             src="{{ asset('img/profile/marsa.jpg') }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 transition-colors">
                            Marsalina
                        </h3>
                        <div class="inline-block py-1 px-3 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-sm font-medium rounded-full mb-4">
                            Project Manager
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6 italic">
                            "Never give up on your dreams. They're what make life fun."
                        </p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="group">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="relative overflow-hidden">
                        <img alt="Nessa Aulia Rahma" 
                             class="w-full h-80 object-cover object-center group-hover:scale-105 transition-transform duration-300" 
                             src="{{ asset('img/profile/nesa.jpg') }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 transition-colors">
                            Nessa Aulia Rahma
                        </h3>
                        <div class="inline-block py-1 px-3 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-sm font-medium rounded-full mb-4">
                            System Analyst
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6 italic">
                            "It's not how long, but how well you live that counts"
                        </p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="group">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="relative overflow-hidden">
                        <img alt="Amelia Kusuma Paramesti" 
                             class="w-full h-80 object-cover object-center group-hover:scale-105 transition-transform duration-300" 
                             src="{{ asset('img/profile/amel.jpg') }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 transition-colors">
                            Amelia Kusuma Paramesti
                        </h3>
                        <div class="inline-block py-1 px-3 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-sm font-medium rounded-full mb-4">
                            System Analyst
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6 italic">
                            "Every day is a new opportunity to get better."
                        </p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Member 4 -->
            <div class="group">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="relative overflow-hidden">
                        <img alt="Dian Gita Meilani" 
                             class="w-full h-80 object-cover object-center group-hover:scale-105 transition-transform duration-300" 
                             src="{{ asset('img/profile/meila.jpg') }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 transition-colors">
                            Dian Gita Meilani
                        </h3>
                        <div class="inline-block py-1 px-3 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-sm font-medium rounded-full mb-4">
                            Programmer
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6 italic">
                            "Success is not the end of the journey, but the beginning of a greater adventure."
                        </p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Member 5 -->
            <div class="group">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="relative overflow-hidden">
                        <img alt="Ahmad Pandu Wijaya" 
                             class="w-full h-80 object-cover object-center group-hover:scale-105 transition-transform duration-300" 
                             src="{{ asset('img/profile/yaya.jpg') }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 transition-colors">
                            Ahmad Pandu Wijaya
                        </h3>
                        <div class="inline-block py-1 px-3 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-sm font-medium rounded-full mb-4">
                            Programmer
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6 italic">
                            "Failure is not defined in the dictionary of life; it is just quitting up too soon."
                        </p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Member 6 -->
            <div class="group">
                <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="relative overflow-hidden">
                        <img alt="Yukri Andriani A" 
                             class="w-full h-80 object-cover object-center group-hover:scale-105 transition-transform duration-300" 
                             src="{{ asset('img/profile/yukri.jpg') }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 transition-colors">
                            Yukri Andriani A
                        </h3>
                        <div class="inline-block py-1 px-3 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-sm font-medium rounded-full mb-4">
                            Tester
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-6 italic">
                            "Failure is not defined in the dictionary of life; it is just quitting up too soon."
                        </p>
                        <div class="flex justify-center space-x-4">
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="p-3 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-full transition-all duration-200">
                                <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                                    <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-24 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-white/20 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-6 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-center mb-8">
                <div class="p-4 bg-white/20 rounded-2xl backdrop-blur-sm">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold text-white mb-8 tracking-tight">
                Ready to Experience <span class="text-blue-200">JogjaCare?</span>
            </h2>
            <p class="text-xl md:text-2xl text-blue-100 mb-12 leading-relaxed">
                Discover the perfect blend of healthcare excellence and cultural exploration in the heart of Yogyakarta.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <button class="bg-white text-blue-600 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-blue-50 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:-translate-y-1">
                    Start Your Journey
                </button>
                <button class="border-2 border-white/30 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/10 transition-all duration-300 backdrop-blur-sm">
                    Learn More
                </button>
            </div>
        </div>
    </div>
</section>
@endsection