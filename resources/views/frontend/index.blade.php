@extends('frontend.layouts.app')

@section('title')
    {{ app_name() }}
@endsection

@section('content')
<section class="bg-white dark:bg-gray-800 relative">
        <div class="absolute inset-0 bg-cover bg-center z-0" 
            style="background-image: url('{{ asset('img/Wallpaper/wallpaperprambanan1.jpg') }}');
                    opacity: 0.4;">
        </div>
        <div class="mx-auto max-w-screen-xl px-4 py-24 text-center sm:px-12 relative z-10">
            <div class="m-4 flex justify-center">
                <img class="h-24 rounded" src="{{ asset('img/logo-square.jpg') }}" alt="{{ app_name() }}">
            </div>
            <h1 class="mb-6 text-4xl font-extrabold leading-none tracking-tight text-gray-900 dark:text-white sm:text-6xl">
                {{ app_name() }}
            </h1>
            <p class="mb-6 text-lg font-normal text-gray-900 dark:text-gray-300 sm:px-16 sm:text-2xl xl:px-48">
                {!! setting('app_description') !!}
            </p>
            <div class="mb-4 flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-x-4 sm:space-y-0 lg:mb-16">
                <a class="inline-flex items-center justify-center rounded-lg border-0 bg-blue-500 px-5 py-3 text-center text-base font-medium text-white hover:bg-blue-600"
                    href="{{ route('frontend.aboutus') }}">
<!--                     {{__('Read more')}} -->
                    {{__('Baca Selengkapnya')}}
                </a>
            </div>

            @include('frontend.includes.messages')
        </div>
    </section>

    <section class="bg-blue-100 text-gray-600 body-font dark:bg-gray-700 dark:text-gray-400">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
            <img class="object-cover object-center rounded animate-smooth-bounce" alt="hero" src="{{ asset('img/asset/Medical-care.png') }}">
            </div>
            <div class="animate-description lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900 dark:text-white">{{__('Medical Cares')}}
                </h1>
                <p class="mb-8 leading-relaxed">{{__('Medical Cares Descriptions')}}</p>
                <div class="flex justify-center">
                    <a class="inline-flex text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg" href="{{ route('frontend.medicalcares.index') }}">{{__('Read more')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-800 text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
            <div class="animate-description lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900 dark:text-white">{{__('Medical Points')}}
                </h1>
                <p class="mb-8 leading-relaxed dark:text-gray-400">{{__('Medical Points Descriptions')}}</p>
                <div class="flex justify-center">
                    <a class="inline-flex text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg" href="{{ route('frontend.medicalpoints.index') }}">{{__('Read more')}}</a>
                </div>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
            <img class="object-cover object-center rounded animate-smooth-bounce" alt="hero" src="{{ asset('img/asset/Medical-point.png') }}">
            </div>
        </div>
    </section>

    <section class="bg-blue-100 text-gray-600 body-font dark:bg-gray-700 dark:text-gray-400">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
            <img class="object-cover object-center rounded animate-smooth-bounce" alt="hero" src="{{ asset('img/asset/Medical-center.png') }}">
            </div>
            <div class="animate-description lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900 dark:text-white">{{__('Medical Centers')}}
                </h1>
                <p class="mb-8 leading-relaxed">{{__('Medical Centers Descriptions')}}</p>
                <div class="flex justify-center">
                    <a class="inline-flex text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg" href="{{ route('frontend.medicalcenters.index') }}">{{__('Read more')}}</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Medical Education Section -->
    <section class="bg-white dark:bg-gray-800 text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
            <div class="animate-description lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900 dark:text-white">{{__('Medical Education')}}
                </h1>
                <p class="mb-4 leading-relaxed dark:text-gray-400">{{__('Enhance your medical knowledge with a comprehensive interactive learning platform.')}}</p>
                <div class="mb-6 space-y-2">
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        {{__('Interactive quiz with 150+ medical topics')}}
                    </div>
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        {{__('Health Information System According to Articles & Journals')}}
                    </div>
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                        <svg class="w-4 h-4 mr-2 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        {{__('Latest medical articles from experts')}}
                    </div>
                </div>
                <div class="flex justify-center">
                    <a class="inline-flex text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg" href="{{ route('frontend.medicaleducation.index') }}">{{__('Read more')}}</a>
                </div>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
                <img class="object-cover object-center rounded animate-smooth-bounce" alt="Medical Education" src="{{ asset('img/asset/education.png') }}">
            </div>
        </div>
    </section>

    <section class="bg-blue-100 text-gray-600 body-font dark:bg-gray-700 dark:text-gray-400">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
            <img class="object-cover object-center rounded animate-smooth-bounce" alt="hero" src="{{ asset('img/asset/Medical-cost.png') }}">
            </div>
            <div class="animate-description lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900 dark:text-white">{{__('Medical Costs')}}
                </h1>
                <p class="mb-8 leading-relaxed">{{__('Medical Costs Descriptions')}}</p>
                <div class="flex justify-center">
                    <a class="inline-flex text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg" href="{{ route('frontend.medicalcosts.index') }}">{{__('Read more')}}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-800 text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
            <div class="animate-description lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900 dark:text-white">{{__('Medical Alternative')}}
                </h1>
                <p class="mb-8 leading-relaxed dark:text-gray-400">{{__('Medical Alternative Descriptions')}}</p>
                <div class="flex justify-center">
                    <a class="inline-flex text-white bg-blue-500 border-0 py-2 px-8 focus:outline-none hover:bg-blue-600 rounded text-lg" href="{{ route('frontend.medicalalters.index') }}">{{__('Read more')}}</a>
                </div>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
            <img class="object-cover object-center rounded animate-smooth-bounce" alt="hero" src="{{ asset('img/asset/Medical-alter.png') }}">
            </div>
        </div>
    </section>

    <!-- Enhanced Destinations Section -->
    <section class="bg-blue-100 dark:bg-gray-700 text-gray-600 body-font py-24">
        <div class="container px-5 mx-auto">
            <!-- Section Header -->
            <div class="text-center w-full mb-16 animate-fade-in">
                <div class="mb-4">
                    <span class="inline-block w-16 h-1 bg-blue-500 rounded-full"></span>
                    <span class="inline-block w-8 h-1 bg-blue-300 rounded-full ml-1"></span>
                </div>
                <h1 class="sm:text-4xl text-3xl font-bold title-font mb-4 text-gray-900 dark:text-white">
                    <i class="fas fa-map-marked-alt text-blue-500 mr-3"></i>
                    {{__('Recommended Destinations')}}
                </h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-lg dark:text-gray-300 text-gray-600">
                    {{__('Discover amazing places and create unforgettable memories with our carefully curated destination recommendations')}}
                </p>
            </div>

            @php
                $destinations = \App\Models\Destination::active()->ordered()->get();
                $destinationChunks = $destinations->chunk(6); // Bagi menjadi grup 6
            @endphp

            @if($destinations->count() > 0)
            <!-- Tab Navigation -->
            @if($destinationChunks->count() > 1)
            <div class="flex justify-center mb-12">
                <div class="destination-tabs">
                    @foreach($destinationChunks as $index => $chunk)
                    <button class="destination-tab {{ $index === 0 ? 'active' : '' }}" 
                            data-tab="{{ $index }}"
                            onclick="showDestinationTab({{ $index }})">
                        <i class="fas fa-map-pin mr-2"></i>
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
                    <div class="flex flex-wrap -m-4">
                        @foreach($chunk as $index => $destination)
                        <div class="lg:w-1/3 sm:w-1/2 p-4 destination-item" 
                             style="animation-delay: {{ $index * 0.1 }}s">
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
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>View Location</span>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Content -->
                                <div class="destination-content">
                                    <div class="destination-badge">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <span>Recommended</span>
                                    </div>
                                    <h2 class="destination-title">{{ $destination->title }}</h2>
                                    <p class="destination-description">{{ Str::limit($destination->description, 100) }}</p>
                                    
                                    <!-- Action Buttons -->
                                    <div class="destination-actions">
                                        @if($destination->map_url)
                                        <a href="{{ $destination->map_url }}" 
                                           target="_blank" 
                                           class="destination-btn-primary">
                                            <i class="fas fa-directions mr-2"></i>
                                            Get Directions
                                        </a>
                                        @endif
                                        <button class="destination-btn-secondary" 
                                                onclick="shareDestination('{{ $destination->title }}', '{{ $destination->map_url }}')">
                                            <i class="fas fa-share-alt"></i>
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
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="mb-6">
                        <i class="fas fa-map-marked-alt text-6xl text-gray-300 dark:text-gray-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        {{__('No Destinations Available')}}
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400">
                        {{__('Check back later for amazing destination recommendations!')}}
                    </p>
                </div>
            </div>
            @endif
        </div>
    </section>

    @push('after-styles')
<style>
    /* Enhanced Animations */
    .animate-description {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .animate-description.show {
        opacity: 1;
        transform: translateY(0);
    }

    .animate-fade-in {
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Tab Navigation Styles */
    .destination-tabs {
        display: flex;
        background: white;
        border-radius: 15px;
        padding: 6px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        gap: 4px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .destination-tab {
        display: flex;
        align-items: center;
        padding: 12px 20px;
        border: none;
        background: transparent;
        color: #6b7280;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 14px;
        white-space: nowrap;
    }

    .destination-tab:hover {
        background: #f3f4f6;
        color: #374151;
        transform: translateY(-1px);
    }

    .destination-tab.active {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        transform: translateY(-2px);
    }

    .tab-count {
        margin-left: 6px;
        font-size: 12px;
        opacity: 0.8;
    }

    /* Tab Content */
    .destination-tab-content {
        display: none;
        animation: fadeInUp 0.6s ease-out;
    }

    .destination-tab-content.active {
        display: block;
    }

    /* Destination Cards */
    .destination-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 380px;
        display: flex;
        flex-direction: column;
    }

    .destination-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .destination-image-container {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .destination-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .destination-card:hover .destination-image {
        transform: scale(1.05);
    }

    .destination-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(59, 130, 246, 0.8), rgba(147, 51, 234, 0.8));
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .destination-card:hover .destination-overlay {
        opacity: 1;
    }

    .destination-overlay-content {
        text-align: center;
        transform: translateY(20px);
        transition: transform 0.3s ease;
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
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .destination-map-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        color: #1f2937;
        text-decoration: none;
    }

    .destination-content {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .destination-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        background: linear-gradient(135deg, #fbbf24, #f59e0b);
        color: white;
        border-radius: 15px;
        font-size: 11px;
        font-weight: 600;
        width: fit-content;
        margin-bottom: 10px;
    }

    .destination-title {
        font-size: 18px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .destination-description {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.5;
        margin-bottom: 15px;
        flex: 1;
    }

    .destination-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: auto;
    }

    .destination-btn-primary {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .destination-btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
        color: white;
        text-decoration: none;
    }

    .destination-btn-secondary {
        padding: 8px 12px;
        background: #f3f4f6;
        color: #6b7280;
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .destination-btn-secondary:hover {
        background: #e5e7eb;
        color: #374151;
        transform: translateY(-1px);
    }

    /* Smooth Bounce Animation */
    .animate-smooth-bounce {
        animation: smoothBounce 4s ease-in-out infinite;
    }

    @keyframes smoothBounce {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-15px);
        }
    }

    /* Loading Animation for Items */
    .destination-item {
        opacity: 0;
        transform: translateY(30px);
        animation: slideInUp 0.6s ease forwards;
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
    }

    .dark .destination-btn-secondary:hover {
        background: #6b7280;
        color: #f9fafb;
    }

    .dark .destination-tabs {
        background: #374151;
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
            height: 350px;
        }
        
        .destination-image-container {
            height: 180px;
        }
        
        .destination-content {
            padding: 16px;
        }
        
        .destination-title {
            font-size: 16px;
        }
        
        .destination-description {
            font-size: 13px;
        }
        
        .destination-tabs {
            padding: 4px;
            gap: 2px;
        }
        
        .destination-tab {
            padding: 10px 16px;
            font-size: 13px;
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
            item.style.animation = `slideInUp 0.6s ease forwards`;
            item.style.animationDelay = `${index * 0.1}s`;
        });
    }

    // Enhanced scroll animation
    function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function handleScroll() {
        var elements = document.getElementsByClassName('animate-description');
        for (var i = 0; i < elements.length; i++) {
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
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
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

    // Initialize everything when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize scroll animations
        window.addEventListener('scroll', handleScroll);
        handleScroll(); // Run once on load
        
        // Auto-switch tabs every 10 seconds (optional)
        const tabs = document.querySelectorAll('.destination-tab');
        if (tabs.length > 1) {
            let currentTab = 0;
            setInterval(() => {
                currentTab = (currentTab + 1) % tabs.length;
                showDestinationTab(currentTab);
            }, 10000); // 10 seconds
        }
    });
</script>

@endpush

@endpush

@endsection
