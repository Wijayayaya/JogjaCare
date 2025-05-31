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
            <!-- Cost Icon -->
            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-8 animate-pulse">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-.05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
                </svg>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                {{ __($module_title) }}
            </h1>
            
            <button id="descriptionBtn" class="group bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-3 rounded-xl font-medium text-lg transition-all duration-300 transform hover:scale-105 mb-8 flex items-center mx-auto">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                    <span id="btnText">Show Description</span>
                </span>
            </button>
            
            <div class="hidden" id="description">
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 mb-8 text-left animate-fade-in">
                    <p class="mb-4 leading-relaxed">
                        Treatment costs are a major and frequently debated aspect of healthcare systems around the world. These expenses include all financial expenses related to health maintenance, disease prevention, and treatment of medical conditions. As healthcare advances and the population ages, understanding and managing medical costs becomes increasingly important for individuals, healthcare providers, and policy makers.
                    </p>
                    <p class="leading-relaxed">
                        Medical expense coverage is complex and varies widely in different contexts. Factors such as geographic location, type of healthcare provider, complexity of the medical condition, and insurance coverage all play a role in determining the final cost of medical care. This variability can make it difficult for individuals to estimate and plan their health care costs, often leading to financial stress or, in some cases, avoidance of necessary medical care.
                    </p>
                </div>
            </div>
            
            <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                Explore our comprehensive collection of {{ __($module_name) }}.
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
        <form action="{{ route('frontend.medicalcosts.index') }}" method="GET" class="mb-8">
            <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Search Medical Treatment Costs</h2>
                
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full md:w-2/6 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="search">
                            Search Service
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input class="w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg py-3 px-4 pl-10 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                id="search" type="text" placeholder="Search by service name" name="search" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="w-full md:w-1/6 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="min_price">
                            Min Price
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="text-gray-500 dark:text-gray-400 text-sm">Rp</span>
                            </div>
                            <input class="w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg py-3 px-4 pl-8 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                id="min_price" type="number" placeholder="0" name="min_price" value="{{ request('min_price') }}">
                        </div>
                    </div>
                    <div class="w-full md:w-1/6 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="max_price">
                            Max Price
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="text-gray-500 dark:text-gray-400 text-sm">Rp</span>
                            </div>
                            <input class="w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg py-3 px-4 pl-8 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                id="max_price" type="number" placeholder="999999999" name="max_price" value="{{ request('max_price') }}">
                        </div>
                    </div>
                    <div class="w-full md:w-1/6 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="sort">
                            Sort By
                        </label>
                        <div class="relative">
                            <select class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all appearance-none dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                id="sort" name="sort">
                                <option value="">Sort By</option>
                                <option value="lowest_price" {{ request('sort') == 'lowest_price' ? 'selected' : '' }}>Lowest Price</option>
                                <option value="highest_price" {{ request('sort') == 'highest_price' ? 'selected' : '' }}>Highest Price</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/6 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            &nbsp;
                        </label>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                                </svg>
                                Filter
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
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-10 text-center">Medical Treatment Costs</h2>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 uppercase bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 dark:text-gray-300">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-bold" style="width: 5%;">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    No.
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 font-bold" style="width: 45%;">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    Service Name
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 font-bold" style="width: 25%;">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                    </svg>
                                    Lowest Price
                                </div>
                            </th>
                            <th scope="col" class="px-6 py-4 font-bold" style="width: 25%;">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                    </svg>
                                    Highest Price
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($$module_name as $index => $$module_name_singular)
                        <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                <div class="flex items-center justify-center w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full">
                                    <span class="text-blue-600 dark:text-blue-400 font-bold text-sm">{{ $index + 1 }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $$module_name_singular->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                                    Rp {{ number_format($$module_name_singular->lowest_price, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                                    Rp {{ number_format($$module_name_singular->highest_price, 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $$module_name->links() }}
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
            
            if (!description.classList.contains('hidden')) {
                description.style.animation = 'fadeIn 0.5s ease-out forwards';
                btnText.textContent = 'Hide Description';
            } else {
                btnText.textContent = 'Show Description';
            }
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
    
    .animate-fade-in {
        animation: fadeIn 0.6s ease-in-out;
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