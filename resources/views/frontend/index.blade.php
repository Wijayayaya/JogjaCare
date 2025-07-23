@extends('frontend.layouts.app')

@section('title')
    {{ app_name() }}
@endsection

@section('content')
<!-- Enhanced Hero Section -->
<section class="relative min-h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 overflow-hidden">
    <!-- Background Image with Multiple Overlays -->
    <div class="absolute inset-0 bg-cover bg-center z-0" 
         style="background-image: url('{{ asset('img/Wallpaper/wallpaperprambanan1.jpg') }}');">
    </div>
    <div class="absolute inset-0 bg-gradient-to-br from-blue-900/85 via-blue-800/75 to-indigo-900/85 z-10"></div>
    
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 z-5">
        <div class="absolute top-20 left-10 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 right-10 w-80 h-80 bg-indigo-400/10 rounded-full blur-3xl animate-pulse delay-1000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-cyan-400/5 rounded-full blur-2xl animate-pulse delay-500"></div>
    </div>
    
    <div class="relative z-20 mx-auto max-w-screen-xl px-6 py-32 text-center flex flex-col justify-center min-h-screen">
        <!-- Logo with Enhanced Styling -->
        <div class="mb-12 transform hover:scale-105 transition-transform duration-500">
            <div class="relative inline-block">
                <img class="h-24 w-24 rounded-2xl shadow-2xl border-4 border-white/20 backdrop-blur-sm mx-auto" 
                     src="{{ asset('img/logo-square.jpg') }}" 
                     alt="{{ app_name() }}">
                <div class="absolute -inset-2 bg-gradient-to-r from-blue-400 to-cyan-400 rounded-2xl blur opacity-30 animate-pulse"></div>
            </div>
        </div>
        
        <!-- Main Title with Gradient Text -->
        <h1 class="mb-8 text-5xl md:text-7xl lg:text-8xl font-bold leading-none tracking-tight text-white">
            <span class="block mb-4">Welcome to</span>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-cyan-200 to-blue-300 animate-gradient">
                {{ app_name() }}
            </span>
        </h1>
        
        <!-- Description with Better Typography -->
        <div class="mb-12 max-w-4xl mx-auto">
            <p class="text-xl md:text-2xl leading-relaxed text-blue-100 font-light">
                {!! setting('app_description') !!}
            </p>
        </div>
        
        <!-- Enhanced CTA Buttons -->
        <div class="mb-8 flex flex-col sm:flex-row gap-6 justify-center items-center">
            <a class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-2xl hover:shadow-blue-500/25 transform hover:-translate-y-1 transition-all duration-300"
               href="{{ route('frontend.aboutus') }}">
                <span class="relative z-10">{{ __('Baca Selengkapnya') }}</span>
                <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
            <a class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white border-2 border-white/30 rounded-2xl backdrop-blur-sm hover:bg-white/10 transform hover:-translate-y-1 transition-all duration-300"
               href="#services">
                <span>Explore Services</span>
                <svg class="ml-2 w-4 h-4 transform group-hover:translate-y-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </a>
        </div>
        
        @include('frontend.includes.messages')
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
            <div class="animate-bounce">
                <svg class="w-5 h-5 text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- Services Section with Modern Cards -->
<section id="services" class="py-24 bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800">
    <div class="container mx-auto px-6">
        <!-- Section Header -->
        <div class="text-center mb-20">
            <div class="inline-flex items-center justify-center px-4 py-2 bg-blue-100 dark:bg-blue-900/30 rounded-full mb-6">
                <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm tracking-wide uppercase">Our Services</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-8 tracking-tight">
                Comprehensive <span class="text-blue-600">Healthcare Solutions</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                Discover our range of medical services designed to provide you with the best healthcare experience in Yogyakarta
            </p>
        </div>
    </div>
</section>

<!-- Medical Cares Section -->
<section class="py-24 bg-white dark:bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2 animate-description">
                <div class="relative">
                    <img class="w-full h-auto object-cover rounded-3xl shadow-2xl animate-smooth-bounce" 
                         alt="Medical Care" 
                         src="{{ asset('img/asset/Medical-care.png') }}">
                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-400/20 to-indigo-400/20 rounded-3xl blur-xl"></div>
                </div>
            </div>
            <div class="lg:w-1/2 animate-description">
                <div class="max-w-xl">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-blue-500 rounded-xl mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <span class="inline-block py-2 px-4 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-sm font-semibold rounded-full">Healthcare Excellence</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ __('Medical Cares') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                        {{ __('Medical Cares Descriptions') }}
                    </p>
                    <a class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl shadow-xl hover:shadow-blue-500/25 transform hover:-translate-y-1 transition-all duration-300" 
                       href="{{ route('frontend.medicalcares.index') }}">
                        <span>{{ __('Read more') }}</span>
                        <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Medical Points Section -->
<section class="py-24 bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-900">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row-reverse items-center gap-16">
            <div class="lg:w-1/2 animate-description">
                <div class="relative">
                    <img class="w-full h-auto object-cover rounded-3xl shadow-2xl animate-smooth-bounce" 
                         alt="Medical Points" 
                         src="{{ asset('img/asset/Medical-point.png') }}">
                    <div class="absolute -inset-4 bg-gradient-to-r from-indigo-400/20 to-purple-400/20 rounded-3xl blur-xl"></div>
                </div>
            </div>
            <div class="lg:w-1/2 animate-description">
                <div class="max-w-xl">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-indigo-500 rounded-xl mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <span class="inline-block py-2 px-4 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold rounded-full">Strategic Locations</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ __('Medical Points') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                        {{ __('Medical Points Descriptions') }}
                    </p>
                    <a class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-xl hover:shadow-indigo-500/25 transform hover:-translate-y-1 transition-all duration-300" 
                       href="{{ route('frontend.medicalpoints.index') }}">
                        <span>{{ __('Read more') }}</span>
                        <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Medical Centers Section -->
<section class="py-24 bg-white dark:bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2 animate-description">
                <div class="relative">
                    <img class="w-full h-auto object-cover rounded-3xl shadow-2xl animate-smooth-bounce" 
                         alt="Medical Centers" 
                         src="{{ asset('img/asset/Medical-center.png') }}">
                    <div class="absolute -inset-4 bg-gradient-to-r from-green-400/20 to-blue-400/20 rounded-3xl blur-xl"></div>
                </div>
            </div>
            <div class="lg:w-1/2 animate-description">
                <div class="max-w-xl">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-green-500 rounded-xl mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <span class="inline-block py-2 px-4 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-sm font-semibold rounded-full">Medical Facilities</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ __('Medical Centers') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                        {{ __('Medical Centers Descriptions') }}
                    </p>
                    <a class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-green-500 to-blue-600 rounded-2xl shadow-xl hover:shadow-green-500/25 transform hover:-translate-y-1 transition-all duration-300" 
                       href="{{ route('frontend.medicalcenters.index') }}">
                        <span>{{ __('Read more') }}</span>
                        <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Medical Education Section -->
<section class="py-24 bg-gradient-to-br from-purple-50 to-pink-50 dark:from-gray-800 dark:to-gray-900">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row-reverse items-center gap-16">
            <div class="lg:w-1/2 animate-description">
                <div class="relative">
                    <img class="w-full h-auto object-cover rounded-3xl shadow-2xl animate-smooth-bounce" 
                         alt="Medical Education" 
                         src="{{ asset('img/asset/education.png') }}">
                    <div class="absolute -inset-4 bg-gradient-to-r from-purple-400/20 to-pink-400/20 rounded-3xl blur-xl"></div>
                </div>
            </div>
            <div class="lg:w-1/2 animate-description">
                <div class="max-w-xl">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-purple-500 rounded-xl mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <span class="inline-block py-2 px-4 bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 text-sm font-semibold rounded-full">Learning Platform</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ __('Medical Education') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                        {{ __('Enhance your medical knowledge with a comprehensive interactive learning platform.') }}
                    </p>
                    
                    <!-- Feature List -->
                    <div class="mb-8 space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-5 h-5 bg-purple-500 rounded-full flex items-center justify-center mr-3 mt-1">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300">{{ __('Interactive quiz with 150+ medical topics') }}</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-5 h-5 bg-purple-500 rounded-full flex items-center justify-center mr-3 mt-1">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300">{{ __('Health Information System According to Articles & Journals') }}</p>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-5 h-5 bg-purple-500 rounded-full flex items-center justify-center mr-3 mt-1">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300">{{ __('Latest medical articles from experts') }}</p>
                        </div>
                    </div>
                    
                    <a class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-purple-500 to-pink-600 rounded-2xl shadow-xl hover:shadow-purple-500/25 transform hover:-translate-y-1 transition-all duration-300" 
                       href="{{ route('frontend.medicaleducation.index') }}">
                        <span>{{ __('Read more') }}</span>
                        <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Medical Costs Section -->
<section class="py-24 bg-white dark:bg-gray-900">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            <div class="lg:w-1/2 animate-description">
                <div class="relative">
                    <img class="w-full h-auto object-cover rounded-3xl shadow-2xl animate-smooth-bounce" 
                         alt="Medical Costs" 
                         src="{{ asset('img/asset/Medical-cost.png') }}">
                    <div class="absolute -inset-4 bg-gradient-to-r from-yellow-400/20 to-orange-400/20 rounded-3xl blur-xl"></div>
                </div>
            </div>
            <div class="lg:w-1/2 animate-description">
                <div class="max-w-xl">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-yellow-500 rounded-xl mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="inline-block py-2 px-4 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 text-sm font-semibold rounded-full">Transparent Pricing</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ __('Medical Costs') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                        {{ __('Medical Costs Descriptions') }}
                    </p>
                    <a class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-yellow-500 to-orange-600 rounded-2xl shadow-xl hover:shadow-yellow-500/25 transform hover:-translate-y-1 transition-all duration-300" 
                       href="{{ route('frontend.medicalcosts.index') }}">
                        <span>{{ __('Read more') }}</span>
                        <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Medical Alternative Section -->
<section class="py-24 bg-gradient-to-br from-teal-50 to-green-50 dark:from-gray-800 dark:to-gray-900">
    <div class="container mx-auto px-6">
        <div class="flex flex-col lg:flex-row-reverse items-center gap-16">
            <div class="lg:w-1/2 animate-description">
                <div class="relative">
                    <img class="w-full h-auto object-cover rounded-3xl shadow-2xl animate-smooth-bounce" 
                         alt="Medical Alternative" 
                         src="{{ asset('img/asset/Medical-alter.png') }}">
                    <div class="absolute -inset-4 bg-gradient-to-r from-teal-400/20 to-green-400/20 rounded-3xl blur-xl"></div>
                </div>
            </div>
            <div class="lg:w-1/2 animate-description">
                <div class="max-w-xl">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-teal-500 rounded-xl mr-3">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                            </svg>
                        </div>
                        <span class="inline-block py-2 px-4 bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 text-sm font-semibold rounded-full">Alternative Medicine</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ __('Medical Alternative') }}
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 leading-relaxed">
                        {{ __('Medical Alternative Descriptions') }}
                    </p>
                    <a class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-teal-500 to-green-600 rounded-2xl shadow-xl hover:shadow-teal-500/25 transform hover:-translate-y-1 transition-all duration-300" 
                       href="{{ route('frontend.medicalalters.index') }}">
                        <span>{{ __('Read more') }}</span>
                        <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Destinations Section -->
<section class="py-24 bg-white dark:bg-gray-900">
    <div class="container px-6 mx-auto">
        <!-- Section Header -->
        <div class="text-center w-full mb-20 animate-fade-in">
            <div class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-full mb-6">
                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm tracking-wide uppercase">Destinations</span>
            </div>
            <h2 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-8 tracking-tight">
                Recommended <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Destinations</span>
            </h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
                {{ __('Discover amazing places and create unforgettable memories with our carefully curated destination recommendations') }}
            </p>
        </div>

        @php
            $destinations = \App\Models\Destination::active()->ordered()->get();
            $destinationChunks = $destinations->chunk(6);
        @endphp

        @if($destinations->count() > 0)
        <!-- Tab Navigation -->
        @if($destinationChunks->count() > 1)
        <div class="flex justify-center mb-16">
            <div class="destination-tabs">
                @foreach($destinationChunks as $index => $chunk)
                <button class="destination-tab {{ $index === 0 ? 'active' : '' }}" 
                        data-tab="{{ $index }}"
                        onclick="showDestinationTab({{ $index }})">
                    <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    </svg>
                    {{ __('Page') }} {{ $index + 1 }}
                    <span class="tab-count">({{ $chunk->count() }})</span>
                </button>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Destinations Content -->
        <div class="destinations-container">
            @foreach($destinationChunks as $chunkIndex => $chunk)
            <div class="destination-tab-content {{ $chunkIndex === 0 ? 'active' : '' }}" 
                 id="tab-content-{{ $chunkIndex }}">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($chunk as $index => $destination)
                    <div class="destination-item group" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="destination-card">
                            <!-- Image Container -->
                            <div class="destination-image-container">
                                <img alt="{{ $destination->title }}" 
                                     class="destination-image" 
                                     src="{{ $destination->image_url }}"
                                     loading="lazy">
                                
                                <!-- Overlay -->
                                <div class="destination-overlay">
                                    <div class="destination-overlay-content">
                                        @if($destination->map_url)
                                        <a href="{{ $destination->map_url }}" 
                                           target="_blank" 
                                           class="destination-map-btn">
                                            <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            </svg>
                                            <span>View Location</span>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Content -->
                            <div class="destination-content">
                                <div class="destination-badge">
                                    <svg class="w-3 h-3 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    <span>Recommended</span>
                                </div>
                                <h3 class="destination-title">{{ $destination->title }}</h3>
                                <p class="destination-description">{{ Str::limit($destination->description, 100) }}</p>
                                
                                <!-- Action Buttons -->
                                <div class="destination-actions">
                                    @if($destination->map_url)
                                    <a href="{{ $destination->map_url }}" 
                                       target="_blank" 
                                       class="destination-btn-primary">
                                        <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                        </svg>
                                        Get Directions
                                    </a>
                                    @endif
                                    <button class="destination-btn-secondary" 
                                            onclick="shareDestination('{{ $destination->title }}', '{{ $destination->map_url }}')">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        @else
        <!-- Empty State -->
        <div class="text-center py-20">
            <div class="max-w-md mx-auto">
                <div class="mb-8">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 dark:text-gray-300 mb-4">
                    {{ __('No Destinations Available') }}
                </h3>
                <p class="text-gray-500 dark:text-gray-400 text-lg">
                    {{ __('Check back later for amazing destination recommendations!') }}
                </p>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-24 bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-800 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-white/20 to-transparent"></div>
        <div class="absolute top-20 left-20 w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-6 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="flex items-center justify-center mb-8">
                <div class="p-3 bg-white/20 rounded-xl backdrop-blur-sm">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <a href="{{ route('frontend.aboutus') }}" class="group inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-blue-600 bg-white rounded-2xl shadow-2xl hover:shadow-3xl transform hover:-translate-y-1 transition-all duration-300">
                    <span>Start Your Journey</span>
                    <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                <a href="#services" class="group inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-white border-2 border-white/30 rounded-2xl backdrop-blur-sm hover:bg-white/10 transition-all duration-300">
                    <span>Learn More</span>
                    <svg class="ml-2 w-4 h-4 transform group-hover:translate-y-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

@push('after-styles')
<style>
    /* Enhanced Animations */
    @keyframes gradient {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient 3s ease infinite;
    }

    .animate-description {
        opacity: 0;
        transform: translateY(50px);
        transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .animate-description.show {
        opacity: 1;
        transform: translateY(0);
    }

    .animate-fade-in {
        animation: fadeInUp 1.2s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Smooth Bounce Animation */
    .animate-smooth-bounce {
        animation: smoothBounce 6s ease-in-out infinite;
    }

    @keyframes smoothBounce {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        25% { transform: translateY(-10px) rotate(1deg); }
        50% { transform: translateY(-20px) rotate(0deg); }
        75% { transform: translateY(-10px) rotate(-1deg); }
    }

    /* Tab Navigation Styles */
    .destination-tabs {
        display: flex;
        background: white;
        border-radius: 20px;
        padding: 8px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        gap: 6px;
        flex-wrap: wrap;
        justify-content: center;
        border: 1px solid #e5e7eb;
    }

    .destination-tab {
        display: flex;
        align-items: center;
        padding: 14px 24px;
        border: none;
        background: transparent;
        color: #6b7280;
        font-weight: 600;
        border-radius: 14px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 15px;
        white-space: nowrap;
        position: relative;
    }

    .destination-tab:hover {
        background: #f8fafc;
        color: #374151;
        transform: translateY(-2px);
    }

    .destination-tab.active {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        transform: translateY(-3px);
    }

    .tab-count {
        margin-left: 8px;
        font-size: 13px;
        opacity: 0.8;
        background: rgba(255, 255, 255, 0.2);
        padding: 2px 8px;
        border-radius: 10px;
    }

    /* Tab Content */
    .destination-tab-content {
        display: none;
        animation: fadeInUp 0.8s ease-out;
    }

    .destination-tab-content.active {
        display: block;
    }

    /* Destination Cards */
    .destination-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        height: 420px;
        display: flex;
        flex-direction: column;
        border: 1px solid #f1f5f9;
    }

    .destination-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
    }

    .destination-image-container {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .destination-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .destination-card:hover .destination-image {
        transform: scale(1.08);
    }

    .destination-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.9), rgba(147, 51, 234, 0.9));
        opacity: 0;
        transition: all 0.4s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .destination-card:hover .destination-overlay {
        opacity: 1;
    }

    .destination-overlay-content {
        text-align: center;
        transform: translateY(30px);
        transition: transform 0.4s ease;
    }

    .destination-card:hover .destination-overlay-content {
        transform: translateY(0);
    }

    .destination-map-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: white;
        color: #1f2937;
        border-radius: 25px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 13px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .destination-map-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        color: #1f2937;
        text-decoration: none;
    }

    .destination-content {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .destination-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 12px;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: white;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        width: fit-content;
        margin-bottom: 12px;
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.3);
    }

    .destination-title {
        font-size: 20px;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 10px;
        line-height: 1.3;
    }

    .destination-description {
        font-size: 15px;
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 20px;
        flex: 1;
    }

    .destination-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: auto;
    }

    .destination-btn-primary {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 16px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
    }

    .destination-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
        color: white;
        text-decoration: none;
    }

    .destination-btn-secondary {
        padding: 10px 12px;
        background: #f8fafc;
        color: #6b7280;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .destination-btn-secondary:hover {
        background: #e2e8f0;
        color: #374151;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* Loading Animation for Items */
    .destination-item {
        opacity: 0;
        transform: translateY(40px);
        animation: slideInUp 0.8s ease forwards;
    }

    @keyframes slideInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Dark Mode Adjustments */
    .dark .destination-card {
        background: #374151;
        border-color: #4b5563;
    }

    .dark .destination-title {
        color: #f9fafb;
    }

    .dark .destination-description {
        color: #d1d5db;
    }

    .dark .destination-btn-secondary {
        background: #4b5563;
        color: #d1d5db;
        border-color: #6b7280;
    }

    .dark .destination-btn-secondary:hover {
        background: #6b7280;
        color: #f9fafb;
    }

    .dark .destination-tabs {
        background: #374151;
        border-color: #4b5563;
    }

    .dark .destination-tab {
        color: #d1d5db;
    }

    .dark .destination-tab:hover {
        background: #4b5563;
        color: #f9fafb;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .destination-card {
            height: 380px;
        }
        
        .destination-image-container {
            height: 200px;
        }
        
        .destination-content {
            padding: 20px;
        }
        
        .destination-title {
            font-size: 18px;
        }
        
        .destination-description {
            font-size: 14px;
        }
        
        .destination-tabs {
            padding: 6px;
            gap: 4px;
        }
        
        .destination-tab {
            padding: 12px 20px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .destination-tabs {
            flex-direction: column;
            width: 100%;
        }
        
        .destination-tab {
            justify-content: center;
            width: 100%;
        }
    }
</style>
@endpush

@push('after-scripts')
<script>
    // Tab functionality
    function showDestinationTab(tabIndex) {
        // Hide all tab contents
        const tabContents = document.querySelectorAll('.destination-tab-content');
        tabContents.forEach(content => {
            content.classList.remove('active');
        });
        
        // Remove active class from all tabs
        const tabs = document.querySelectorAll('.destination-tab');
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });
        
        // Show selected tab content
        const selectedContent = document.getElementById(`tab-content-${tabIndex}`);
        if (selectedContent) {
            selectedContent.classList.add('active');
        }
        
        // Add active class to selected tab
        const selectedTab = document.querySelector(`[data-tab="${tabIndex}"]`);
        if (selectedTab) {
            selectedTab.classList.add('active');
        }
        
        // Restart animations for destination items
        const destinationItems = selectedContent.querySelectorAll('.destination-item');
        destinationItems.forEach((item, index) => {
            item.style.animation = 'none';
            item.offsetHeight; // Trigger reflow
            item.style.animation = `slideInUp 0.8s ease forwards`;
            item.style.animationDelay = `${index * 0.1}s`;
        });
    }

    // Enhanced scroll animation
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function handleScroll() {
        const elements = document.getElementsByClassName('animate-description');
        for (let i = 0; i < elements.length; i++) {
            if (isElementInViewport(elements[i])) {
                elements[i].classList.add('show');
            }
        }
    }

    // Share destination function
    function shareDestination(title, mapUrl) {
        if (navigator.share) {
            navigator.share({
                title: title,
                text: `Check out this amazing destination: ${title}`,
                url: mapUrl || window.location.href
            }).catch(console.error);
        } else {
            const text = `Check out this amazing destination: ${title} ${mapUrl || ''}`;
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(() => {
                    showNotification('Link copied to clipboard!');
                });
            } else {
                const textArea = document.createElement('textarea');
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                showNotification('Link copied to clipboard!');
            }
        }
    }

    // Show notification
    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-3 rounded-xl shadow-lg z-50 transform translate-x-full transition-transform duration-300';
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.remove('translate-x-full');
        }, 100);
        
        setTimeout(() => {
            notification.classList.add('translate-x-full');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize scroll animations
        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Run once on load
        
        // Auto-switch tabs every 12 seconds (optional)
        const tabs = document.querySelectorAll('.destination-tab');
        if (tabs.length > 1) {
            let currentTab = 0;
            setInterval(() => {
                currentTab = (currentTab + 1) % tabs.length;
                showDestinationTab(currentTab);
            }, 12000); // 12 seconds
        }
        
        // Add loading animation to service sections
        const serviceImages = document.querySelectorAll('.animate-smooth-bounce');
        serviceImages.forEach((img, index) => {
            img.style.animationDelay = `${index * 0.5}s`;
        });
    });
</script>
@endpush

@endsection