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
            <!-- Hospital Icon -->
            <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-8 animate-pulse">
                <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
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
                        Hospital and medical centers are cornerstones of modern healthcare systems, serving as vital hubs for medical treatment, research, and education. These institutions play a crucial role in maintaining and improving public health, offering a wide range of services from emergency care to specialized treatments. As healthcare continues to evolve, hospitals and medical centers are adapting to meet the changing needs of patients and the advancements in medical science.
                    </p>
                    <p class="mb-4 leading-relaxed">
                        At their core, hospitals are complex organizations designed to provide comprehensive medical care. They house a variety of departments, each specializing in different areas of medicine, such as cardiology, oncology, pediatrics, and surgery. This multidisciplinary approach allows for integrated care, where patients can receive treatment for various conditions under one roof. Modern hospitals are equipped with state-of-the-art technology, including advanced diagnostic tools like MRI and CT scanners, as well as sophisticated surgical equipment that enables minimally invasive procedures.
                    </p>
                    <p class="leading-relaxed">
                        Medical centers, often larger and more comprehensive than traditional hospitals, typically combine patient care with medical research and education. These institutions are often affiliated with universities, fostering an environment where medical knowledge is not only applied but also advanced. The integration of research into clinical practice allows for the rapid translation of scientific discoveries into patient care, potentially leading to groundbreaking treatments and improved health outcomes.
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
        <form action="{{ route('frontend.medicalcenters.index') }}" method="GET" class="mb-8">
            <div class="max-w-6xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6 text-center">Find Medical Centers & Hospitals</h2>
                
                <!-- First Row -->
                <div class="flex flex-wrap -mx-2 mb-4">
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="search">
                            Search
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input class="w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg py-3 px-4 pl-10 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                id="search" type="text" placeholder="Search by name" name="search" value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="type">
                            Type
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <input class="w-full bg-gray-100 text-gray-700 border border-gray-300 rounded-lg py-3 px-4 pl-10 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                id="type" type="text" placeholder="Filter by type" name="type" value="{{ request('type') }}">
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="sort">
                            Sort By
                        </label>
                        <div class="relative">
                            <select class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all appearance-none dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                id="sort" name="sort">
                                <option value="">Sort By</option>
                                <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Most Recent</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Second Row -->
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="district">
                            District
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <select class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pl-10 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all appearance-none dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                name="district" id="district">
                                <option value="">Select District</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>{{ $district }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-2 mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2" for="sub_district">
                            Sub District
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                            <select class="w-full bg-gray-100 border border-gray-300 text-gray-700 py-3 px-4 pl-10 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all appearance-none dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                                name="sub_district" id="sub_district">
                                <option value="">Select Sub District</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700 dark:text-gray-300">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-1/3 px-2 mb-4">
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
        <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-10 text-center">Medical Centers & Hospitals</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($$module_name as $$module_name_singular)
            @php
            $details_url = route("frontend.$module_name.show",[encode_id($$module_name_singular->id), $$module_name_singular->slug]);
            @endphp
            
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:transform hover:scale-105 flex flex-col h-full group">
                <div class="relative">
                    <span class="absolute top-3 left-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full z-10">
                        {{ $$module_name_singular->type }}
                    </span>
                    @if($$module_name_singular->image)
                        <div class="overflow-hidden h-56">
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                                src="{{ asset($$module_name_singular->image) }}" 
                                alt="{{ $$module_name_singular->name }}">
                        </div>
                    @else
                        <div class="h-56 bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900 dark:to-indigo-900 flex items-center justify-center">
                            <svg class="w-16 h-16 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    @endif
                </div>
                
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                        {{ $$module_name_singular->name }}
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6 flex-grow overflow-hidden" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
                        {{ $$module_name_singular->intro }}
                    </p>
                    <div class="mt-auto">
                        <a href="{{ $details_url }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition-all duration-300 group">
                            View Details
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

        // District and Sub-district functionality
        const districtSelect = document.getElementById('district');
        const subDistrictSelect = document.getElementById('sub_district');
        const subDistricts = @json($sub_districts);

        districtSelect.addEventListener('change', function() {
            const selectedDistrict = this.value;
            subDistrictSelect.innerHTML = '<option value="">Select Sub District</option>';

            if (selectedDistrict && subDistricts[selectedDistrict]) {
                subDistricts[selectedDistrict].forEach(subDistrict => {
                    const option = document.createElement('option');
                    option.value = subDistrict;
                    option.textContent = subDistrict;
                    subDistrictSelect.appendChild(option);
                });
            }
        });

        // Set initial value for sub_district if district is already selected
        if (districtSelect.value) {
            districtSelect.dispatchEvent(new Event('change'));
            subDistrictSelect.value = '{{ request('sub_district') }}';
        }
        
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