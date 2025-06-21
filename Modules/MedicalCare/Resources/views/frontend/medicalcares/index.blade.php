@extends('frontend.layouts.app')

@section('title') {{ __($module_title) }} @endsection

@section('content')

<!-- Hero Section with Gradient Background -->
<section class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-20 overflow-hidden">
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
        <div class="max-w-4xl mx-auto text-center">
            <!-- Medical Care Icon -->
            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-8 animate-pulse">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                {{ __($module_title) }}
            </h1>

            <button id="descriptionBtn"
                data-show-text="{{ __('Show Description') }}"
                data-hide-text="{{ __('Hide Description') }}"
                class="group bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-3 rounded-xl font-medium text-lg transition-all duration-300 transform hover:scale-105 mb-8 flex items-center mx-auto">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <span id="btnText">{{ __('Show Description') }}</span>
                </span>
            </button>

            <div class="hidden" id="description">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 mb-8 text-left animate-fade-in">
                    <p class="mb-4 leading-relaxed">
                        {{ __('Medical care is a cornerstone of modern society, encompassing a broad spectrum of services and practices designed to maintain, restore, and improve human health. At its core, medical care represents an organized effort to address health problems, prevent disease, and improve overall well-being through the application of scientific knowledge, clinical expertise, and compassionate care.') }}
                    </p>
                    <p class="leading-relaxed">
                        {{ __('The scope of health services is very broad and varied. This starts with primary health care, the first line of defense in health care, where general practitioners and family doctors provide routine check-ups, preventive services, and treat common health problems. This basic level of care serves as a gateway to more specialized services when needed, ensuring that patients receive appropriate attention for their specific health concerns.') }}
                    </p>
                </div>
            </div>

            <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                {{ __('Explore our comprehensive collection of :name.', ['name' => __($module_name)]) }}
            </p>

            @include('frontend.includes.messages')
        </div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 left-10 w-6 h-6 bg-blue-400 rounded-full opacity-50 animate-bounce" style="animation-delay: 0s;"></div>
    <div class="absolute top-40 right-20 w-4 h-4 bg-blue-300 rounded-full opacity-40 animate-bounce" style="animation-delay: 1s;"></div>
    <div class="absolute bottom-20 left-20 w-5 h-5 bg-blue-200 rounded-full opacity-30 animate-bounce" style="animation-delay: 2s;"></div>
</section>

<!-- Search and Filter Section -->
<section class="bg-gray-50 dark:bg-gray-900 py-12">
    <div class="container mx-auto px-4">
        <form action="{{ route('frontend.medicalcares.index') }}" method="GET" class="mb-8">
            <div class="max-w-5xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">{{ __('Find Medical Care Services') }}</h2>
                
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full md:w-2/5 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="search">
                            {{ __('Search') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input class="w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg py-3 px-4 pl-10 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                id="search" type="text" placeholder="{{ __('Search by name') }}" name="search" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="w-full md:w-1/5 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="type">
                            {{ __('Care Level') }}
                        </label>
                        <div class="relative">
                            <select class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all appearance-none dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                id="type" name="type">
                                <option value="">{{ __('All Types') }}</option>
                                <option value="Primary Health care" {{ request('type') == 'Primary Health care' ? 'selected' : '' }}>{{ __('Primary Health care') }}</option>
                                <option value="Secondary Health care" {{ request('type') == 'Secondary Health care' ? 'selected' : '' }}>{{ __('Secondary Health care') }}</option>
                                <option value="Tertiary Health care" {{ request('type') == 'Tertiary Health care' ? 'selected' : '' }}>{{ __('Tertiary Health care') }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/5 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="sort">
                            {{ __('Sort By') }}
                        </label>
                        <div class="relative">
                            <select class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all appearance-none dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                id="sort" name="sort">
                                <option value="">{{ __('Sort By') }}</option>
                                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>{{ __('Most Recent') }}</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>{{ __('Oldest') }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/5 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            &nbsp;
                        </label>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                {{ __('Filter') }}
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Results Section -->
<section class="bg-white dark:bg-gray-800 py-16">
    <div class="container mx-auto px-4">

        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($medicalcares as $medicalcare)
            @php
            $details_url = route("frontend.medicalcares.show",[encode_id($medicalcare->id), $medicalcare->slug]);
            @endphp
            
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:transform hover:scale-105 flex flex-col h-full group">
                <div class="relative">
                    @php
                    $typeColors = [
                        'Primary Health care' => 'from-green-600 to-emerald-600',
                        'Secondary Health care' => 'from-blue-600 to-indigo-600',
                        'Tertiary Health care' => 'from-purple-600 to-violet-600'
                    ];
                    $colorClass = $typeColors[$medicalcare->type] ?? 'from-blue-600 to-indigo-600';
                    @endphp
                    <span class="absolute top-3 left-3 bg-gradient-to-r {{ $colorClass }} text-white text-xs font-semibold px-3 py-1 rounded-full z-10">
                        {{ $medicalcare->type }}
                    </span>
                    @if($medicalcare->image)
                        <div class="overflow-hidden h-56">
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                                src="{{ asset($medicalcare->image) }}" 
                                alt="{{ $medicalcare->name }}">
                        </div>
                    @else
                        <div class="h-56 bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900 dark:to-indigo-900 flex items-center justify-center">
                            <svg class="w-16 h-16 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        {{ $medicalcare->name }}
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6 flex-grow overflow-hidden" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                        {{ $medicalcare->intro }}
                    </p>
                    <div class="mt-auto">
                        <a href="{{ $details_url }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-all duration-300 group">
                            {{ __('View Details') }}
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $medicalcares->links() }}
        </div>
    </div>
</section>

@endsection

@push('after-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const descriptionBtn = document.getElementById('descriptionBtn');
        const description = document.getElementById('description');
        const btnText = document.getElementById('btnText');
        
        descriptionBtn.addEventListener('click', function() {
            description.classList.toggle('hidden');
            const showText = descriptionBtn.getAttribute('data-show-text');
            const hideText = descriptionBtn.getAttribute('data-hide-text');
            if (!description.classList.contains('hidden')) {
                description.style.animation = 'fadeIn 0.5s ease-out forwards';
                btnText.textContent = hideText;
            } else {
                btnText.textContent = showText;
            }
        });
        
        // Enhanced hover effects for cards
        const cards = document.querySelectorAll('.grid > div');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
                this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = '';
            });
        });
    });
</script>
@endpush

@push('after-styles')
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
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
    
    .animate-fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }
    
    .animate-slide-up {
        animation: slideUp 0.5s ease-out;
    }
    
    .animate-bounce-in {
        animation: bounceIn 0.8s ease-out;
    }
    
    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: .7; }
    }
    
    .animate-bounce {
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-25%); }
    }
    
    /* Pagination styling */
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .pagination li {
        margin: 0 0.25rem;
    }
    
    .pagination li a, .pagination li span {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        color: #3b82f6;
        background-color: #fff;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .pagination li.active span {
        background-color: #3b82f6;
        color: white;
        border-color: #3b82f6;
    }
    
    .pagination li a:hover {
        background-color: #f3f4f6;
    }
    
    .dark .pagination li a, .dark .pagination li span {
        background-color: #1f2937;
        border-color: #374151;
        color: #60a5fa;
    }
    
    .dark .pagination li.active span {
        background-color: #3b82f6;
        color: white;
    }
    
    .dark .pagination li a:hover {
        background-color: #374151;
    }
</style>
@endpush