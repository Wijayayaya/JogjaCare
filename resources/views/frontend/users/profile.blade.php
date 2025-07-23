@extends('frontend.layouts.app')

@section('title')
    {{ $$module_name_singular?->name ?? 'User' }}'s Profile
@endsection

@section('content')
<!-- Enhanced Profile Header -->
<section class="relative py-20 bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 dark:from-gray-900 dark:to-gray-800 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
                
                <!-- Enhanced Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700 transform hover:scale-105 transition-all duration-500">
                        <!-- Profile Header with Gradient -->
                        <div class="relative h-32 bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-600">
                            <div class="absolute inset-0 bg-black/20"></div>
                            <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                                <div class="relative group">
                                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-400 via-indigo-400 to-purple-400 rounded-full blur-lg opacity-60 group-hover:opacity-80 animate-pulse transition-opacity duration-500"></div>
                                    <img class="relative w-32 h-32 rounded-full object-cover border-6 border-white dark:border-gray-800 shadow-2xl group-hover:scale-110 transition-transform duration-500" 
                                         src="{{ asset($$module_name_singular?->avatar) }}" 
                                         alt="{{ $$module_name_singular?->name }}">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Profile Content -->
                        <div class="pt-20 pb-8 px-8 text-center">
                            <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                                {{ $$module_name_singular?->name }}
                            </h1>
                            
                            @if($$module_name_singular?->address)
                            <p class="text-gray-600 dark:text-gray-300 mb-4 flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $$module_name_singular?->address }}
                            </p>
                            @endif
                            
                            <!-- Profile Links -->
                            <div class="space-y-3 mb-6">
                                <a class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-300 text-sm font-medium"
                                   href="{{ route('frontend.users.profile', $$module_name_singular?->username) }}" target="_blank">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                    {{ str_replace(['http://', 'https://'], '', route('frontend.users.profile', $$module_name_singular?->username)) }}
                                </a>
                                
                                @if ($$module_name_singular?->url_website)
                                <a class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors duration-300 text-sm font-medium"
                                   href="{{ $$module_name_singular?->url_website }}" target="_blank">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9"></path>
                                    </svg>
                                    {{ $$module_name_singular?->url_website }}
                                </a>
                                @endif
                            </div>
                            
                            <!-- Enhanced Social Media Links -->
                            <div class="flex justify-center space-x-4 mb-8">
                                @if ($$module_name_singular?->url_facebook)
                                <a href="{{ $$module_name_singular?->url_facebook }}" target="_blank" 
                                   class="group p-3 bg-blue-50 dark:bg-blue-900/30 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-all duration-300 transform hover:scale-110">
                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                                    </svg>
                                </a>
                                @endif

                                @if ($$module_name_singular?->url_twitter)
                                <a href="{{ $$module_name_singular?->url_twitter }}" target="_blank"
                                   class="group p-3 bg-sky-50 dark:bg-sky-900/30 rounded-full hover:bg-sky-100 dark:hover:bg-sky-900/50 transition-all duration-300 transform hover:scale-110">
                                    <svg class="w-5 h-5 text-sky-600 dark:text-sky-400 group-hover:text-sky-700 dark:group-hover:text-sky-300" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                                    </svg>
                                </a>
                                @endif

                                @if ($$module_name_singular?->url_instagram)
                                <a href="{{ $$module_name_singular?->url_instagram }}" target="_blank"
                                   class="group p-3 bg-pink-50 dark:bg-pink-900/30 rounded-full hover:bg-pink-100 dark:hover:bg-pink-900/50 transition-all duration-300 transform hover:scale-110">
                                    <svg class="w-5 h-5 text-pink-600 dark:text-pink-400 group-hover:text-pink-700 dark:group-hover:text-pink-300" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
                                    </svg>
                                </a>
                                @endif

                                @if ($$module_name_singular?->url_linkedin)
                                <a href="{{ $$module_name_singular?->url_linkedin }}" target="_blank"
                                   class="group p-3 bg-blue-50 dark:bg-blue-900/30 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-all duration-300 transform hover:scale-110">
                                    <svg class="w-5 h-5 text-blue-700 dark:text-blue-400 group-hover:text-blue-800 dark:group-hover:text-blue-300" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
                                    </svg>
                                </a>
                                @endif
                            </div>

                            <!-- Enhanced Action Buttons -->
                            @auth
                                @if (auth()->user()->id == $$module_name_singular?->id)
                                <div class="space-y-3">
                                    <a href='{{ route('frontend.users.profileEdit') }}' 
                                       class="group w-full inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-2xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                        <svg class="w-4 h-4 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit Profile
                                    </a>
                                    
                                    <a href="{{ route('frontend.users.changePassword') }}" 
                                       class="group w-full inline-flex items-center justify-center px-6 py-3 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold rounded-2xl border-2 border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                                        <svg class="w-4 h-4 mr-2 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                        </svg>
                                        Change Password
                                    </a>
                                </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Enhanced Profile Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-600 px-8 py-6 border-b border-gray-100 dark:border-gray-600">
                            <div class="flex items-center">
                                <div class="p-3 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-2xl mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Profile Information</h2>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Name -->
                                <div class="group">
                                    <div class="flex items-center mb-3">
                                        <div class="w-2 h-2 bg-blue-500 rounded-full mr-3 group-hover:scale-150 transition-transform duration-300"></div>
                                        <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Full Name</label>
                                    </div>
                                    <p class="text-lg font-medium text-gray-900 dark:text-white pl-5">
                                        {{ $$module_name_singular?->name }}
                                    </p>
                                </div>
                                
                                <!-- Email -->
                                <div class="group">
                                    <div class="flex items-center mb-3">
                                        <div class="w-2 h-2 bg-indigo-500 rounded-full mr-3 group-hover:scale-150 transition-transform duration-300"></div>
                                        <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Email Address</label>
                                    </div>
                                    <p class="text-lg font-medium text-gray-900 dark:text-white pl-5 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $$module_name_singular?->email }}
                                    </p>
                                </div>
                                
                                <!-- Mobile (only for own profile) -->
                                @auth
                                    @if (auth()->user()->id == $$module_name_singular?->id && $$module_name_singular?->mobile)
                                    <div class="group md:col-span-2">
                                        <div class="flex items-center mb-3">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mr-3 group-hover:scale-150 transition-transform duration-300"></div>
                                            <label class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wide">Mobile Number</label>
                                        </div>
                                        <p class="text-lg font-medium text-gray-900 dark:text-white pl-5 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                            </svg>
                                            {{ $$module_name_singular?->mobile }}
                                        </p>
                                    </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('after-styles')
<style>
    /* Enhanced animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    
    /* Smooth transitions */
    * {
        transition-property: transform, opacity, background-color, border-color, color, fill, stroke;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
</style>
@endpush

@push('after-scripts')
<script type="module" src="https://cdn.jsdelivr.net/npm/sharer.js@latest/sharer.min.js"></script>
<script>
    // Add smooth hover effects
    document.addEventListener('DOMContentLoaded', function() {
        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('a[href], button');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    });
</script>
@endpush