@extends('frontend.layouts.app')

@section('title')
    @lang('Change Password: ') {{ $$module_name_singular->name }}
@endsection

@section('content')
<!-- Enhanced Change Password Section -->
<section class="relative py-20 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:to-gray-800 min-h-screen">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-1/4 right-1/4 w-96 h-96 bg-gradient-to-r from-indigo-400 to-purple-400 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 left-1/4 w-80 h-80 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Messages -->
        <div class="max-w-4xl mx-auto mb-8">
            @include('frontend.includes.messages')
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Enhanced Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden sticky top-8">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 px-8 py-12 text-center text-white">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            <h1 class="text-2xl font-bold mb-2">@lang('Change Password')</h1>
                            <p class="text-indigo-100 text-sm">
                                @lang('Secure your account with a strong password')
                            </p>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-8">
                            <div class="space-y-4 mb-8">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">Use at least 8 characters</p>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">Include numbers and letters</p>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-green-400 to-green-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">Avoid common passwords</p>
                                </div>
                            </div>
                            
                            <a href='{{ route('frontend.users.profile') }}' 
                               class="group w-full inline-flex items-center justify-center px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-semibold rounded-2xl hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300 transform hover:-translate-y-1">
                                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                @lang('View Profile')
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Form Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <!-- Form Header -->
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-8 py-6 border-b border-gray-200 dark:border-gray-600">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                Update Your Password
                            </h2>
                        </div>

                        <!-- Form Content -->
                        <div class="p-8">
                            {{ html()->form('PATCH', route('frontend.users.changePasswordUpdate'))->class('space-y-6')->open() }}
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- New Password -->
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                        {{ __('labels.backend.users.fields.password') }}
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        </div>
                                        {{ html()->password('password')
                                            ->placeholder('Enter new password')
                                            ->class('w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300')
                                            ->required() }}
                                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center toggle-password">
                                            <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                        {{ __('labels.backend.users.fields.password_confirmation') }}
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        {{ html()->password('password_confirmation')
                                            ->placeholder('Confirm new password')
                                            ->class('w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300')
                                            ->required() }}
                                        <button type="button" class="absolute inset-y-0 right-0 pr-4 flex items-center toggle-password">
                                            <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-6">
                                <button type="submit" 
                                        class="group w-full inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-indigo-500 via-purple-600 to-indigo-600 text-white font-bold rounded-2xl shadow-2xl hover:shadow-indigo-500/30 transform hover:-translate-y-2 hover:scale-105 transition-all duration-500">
                                    <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                    </svg>
                                    @lang('Update Password')
                                </button>
                            </div>
                            {{ html()->closeModelForm() }}
                        </div>
                    </div>

                    <!-- Enhanced Edit Profile Section -->
                    <div class="mt-12 bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-600 px-8 py-6 border-b border-gray-200 dark:border-gray-600">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                @lang('Edit Profile')
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 mt-2">
                                @lang('Update your account information and profile details.')
                            </p>
                        </div>
                        
                        <div class="p-8 text-center">
                            <a href="{{ route('frontend.users.profileEdit') }}" 
                               class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-bold rounded-2xl shadow-2xl hover:shadow-blue-500/30 transform hover:-translate-y-2 hover:scale-105 transition-all duration-500">
                                <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                @lang('Edit Profile')
                            </a>
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
    @keyframes pulse-glow {
        0%, 100% { 
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }
        50% { 
            box-shadow: 0 0 30px rgba(99, 102, 241, 0.5);
        }
    }
    
    .animate-pulse-glow {
        animation: pulse-glow 2s ease-in-out infinite;
    }
    
    /* Password strength indicator */
    .password-strength {
        height: 4px;
        border-radius: 2px;
        transition: all 0.3s ease;
    }
    
    .strength-weak { background: linear-gradient(90deg, #ef4444, #f87171); }
    .strength-medium { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
    .strength-strong { background: linear-gradient(90deg, #10b981, #34d399); }
</style>
@endpush

@push('after-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Password visibility toggle
        const toggleButtons = document.querySelectorAll('.toggle-password');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                
                // Toggle icon
                const icon = this.querySelector('svg');
                if (type === 'text') {
                    icon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    `;
                } else {
                    icon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    `;
                }
            });
        });

        // Password strength checker
        const passwordInput = document.querySelector('input[name="password"]');
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = checkPasswordStrength(password);
                updatePasswordStrength(strength);
            });
        }

        function checkPasswordStrength(password) {
            let score = 0;
            if (password.length >= 8) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;
            
            if (score < 3) return 'weak';
            if (score < 5) return 'medium';
            return 'strong';
        }

        function updatePasswordStrength(strength) {
            // Add strength indicator if it doesn't exist
            let indicator = document.querySelector('.password-strength');
            if (!indicator) {
                indicator = document.createElement('div');
                indicator.className = 'password-strength mt-2';
                passwordInput.parentElement.appendChild(indicator);
            }
            
            indicator.className = `password-strength mt-2 strength-${strength}`;
            
            let width = '0%';
            if (strength === 'weak') width = '33%';
            if (strength === 'medium') width = '66%';
            if (strength === 'strong') width = '100%';
            
            indicator.style.width = width;
        }

        // Form validation
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const password = document.querySelector('input[name="password"]').value;
                const confirmation = document.querySelector('input[name="password_confirmation"]').value;
                
                if (password !== confirmation) {
                    e.preventDefault();
                    showNotification('Passwords do not match!', 'error');
                    return false;
                }
                
                if (password.length < 8) {
                    e.preventDefault();
                    showNotification('Password must be at least 8 characters long!', 'error');
                    return false;
                }
            });
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const bgColor = type === 'success' ? 'from-green-500 to-emerald-600' : 
                            type === 'error' ? 'from-red-500 to-red-600' : 
                            'from-blue-500 to-indigo-600';
            
            notification.className = `fixed top-6 right-6 bg-gradient-to-r ${bgColor} text-white px-8 py-4 rounded-2xl shadow-2xl z-50 transform translate-x-full transition-all duration-500 max-w-sm`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span class="font-medium">${message}</span>
                </div>
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 500);
            }, 4000);
        }
    });
</script>
@endpush