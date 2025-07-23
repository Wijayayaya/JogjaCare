@extends('frontend.layouts.app')

@section('title')
    Edit {{ $$module_name_singular->name }}'s Profile
@endsection

@section('content')
<!-- Enhanced Profile Edit Section with Blue Theme -->
<section class="relative py-20 bg-gradient-to-br from-blue-50 via-indigo-50 to-blue-100 dark:from-gray-900 dark:to-gray-800 min-h-screen">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-gradient-to-r from-indigo-400 to-blue-500 rounded-full blur-3xl animate-pulse delay-1000"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Messages -->
        <div class="max-w-4xl mx-auto mb-8">
            @include('frontend.includes.messages')
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <!-- Enhanced Sidebar with Blue Theme -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden sticky top-8">
                        <!-- Header -->
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-8 py-12 text-center text-white">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6 backdrop-blur-sm">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <h1 class="text-2xl font-bold mb-2">@lang('Edit Profile')</h1>
                            <p class="text-blue-100 text-sm">
                                @lang('Update your personal information')
                            </p>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-8">
                            <div class="space-y-4 mb-8">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">Information will be displayed publicly</p>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-indigo-400 to-indigo-500 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">Be careful what you share</p>
                                </div>
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 w-6 h-6 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-4 mt-1">
                                        <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm">Your data is secure with us</p>
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

                <!-- Enhanced Form Section with Blue Theme -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-3xl shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <!-- Form Header -->
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-600 px-8 py-6 border-b border-gray-200 dark:border-gray-600">
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                Update Profile Information
                            </h2>
                        </div>

                        <!-- Form Content -->
                        <div class="p-8">
                            {{ html()->modelForm($user, 'PATCH', route('frontend.users.profileUpdate'))->class('space-y-8')->acceptsFiles()->open() }}
                            
                            <!-- Name Field -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    {{ label_case('name') }}
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    {{ html()->text('name')
                                        ->placeholder('Enter your full name')
                                        ->class('w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300')
                                        ->required() }}
                                </div>
                            </div>

                            <!-- Email Field (Disabled) -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    Email Address
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <input type="email" 
                                           value="{{ $user->email }}" 
                                           disabled
                                           class="w-full pl-12 pr-4 py-4 bg-gray-100 dark:bg-gray-600 border border-gray-200 dark:border-gray-500 rounded-2xl text-gray-600 dark:text-gray-400 cursor-not-allowed">
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Email cannot be changed for security reasons</p>
                            </div>

                            <!-- Mobile Field -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                                    {{ label_case('mobile') }}
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                    </div>
                                    {{ html()->text('mobile')
                                        ->placeholder('Enter your mobile number')
                                        ->class('w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-2xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300')
                                        ->required() }}
                                </div>
                            </div>

                            <!-- Current Avatar Display -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                                    Current Profile Photo
                                </label>
                                <div class="flex items-center space-x-6">
                                    <div class="relative group">
                                        <div class="absolute -inset-2 bg-gradient-to-r from-blue-400 via-indigo-400 to-blue-500 rounded-full blur-lg opacity-60 group-hover:opacity-80 animate-pulse transition-opacity duration-500"></div>
                                        <img src="{{ asset($user->avatar) }}" 
                                             alt="{{ $user->name }}" 
                                             class="relative w-24 h-24 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-2xl group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $user->name }}</h4>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm">Upload a new image to change your profile photo</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Avatar Upload with Blue Theme -->
                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">
                                    Upload New Profile Photo
                                </label>
                                <div class="relative">
                                    <div class="flex justify-center px-6 pt-8 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-2xl hover:border-blue-400 dark:hover:border-blue-500 transition-colors duration-300 group-hover:bg-blue-50 dark:group-hover:bg-blue-900/20">
                                        <div class="space-y-4 text-center">
                                            <div class="mx-auto w-16 h-16 bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                </svg>
                                            </div>
                                            <div class="text-center">
                                                <label for="avatar" class="cursor-pointer">
                                                    <span class="text-blue-600 dark:text-blue-400 font-semibold hover:text-blue-700 dark:hover:text-blue-300 transition-colors duration-300">Upload a file</span>
                                                    <span class="text-gray-600 dark:text-gray-400"> or drag and drop</span>
                                                </label>
                                                <p class="text-gray-500 dark:text-gray-400 text-sm mt-2">PNG, JPG, GIF up to 10MB</p>
                                            </div>
                                        </div>
                                    </div>
                                    <input id="avatar" 
                                           name="avatar" 
                                           type="file" 
                                           accept="image/*"
                                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                           aria-describedby="avatar-description">
                                </div>
                                <p id="avatar-description" class="mt-3 text-sm text-gray-500 dark:text-gray-400">
                                    Choose a clear photo that represents you well. This will be visible to other users.
                                </p>
                            </div>

                            <!-- Submit Button with Blue Theme -->
                            <div class="pt-6 border-t border-gray-200 dark:border-gray-600">
                                <button type="submit" 
                                        class="group w-full inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-500 via-indigo-600 to-blue-600 text-white font-bold rounded-2xl shadow-2xl hover:shadow-blue-500/30 transform hover:-translate-y-2 hover:scale-105 transition-all duration-500">
                                    <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Save Changes
                                </button>
                            </div>
                            {{ html()->closeModelForm() }}
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
    /* Enhanced file upload animations with blue theme */
    .file-upload-preview {
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(20px);
    }
    
    .file-upload-preview.show {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Drag and drop styles with blue theme */
    .drag-over {
        border-color: #3b82f6 !important;
        background-color: rgba(59, 130, 246, 0.05) !important;
    }
    
    /* Form validation styles with blue theme */
    .field-error {
        border-color: #ef4444 !important;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
    }
    
    .field-success {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }
</style>
@endpush

@push('after-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File upload preview
        const fileInput = document.getElementById('avatar');
        const uploadArea = fileInput.parentElement;
        
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                showFilePreview(file);
            }
        });

        // Drag and drop functionality
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('drag-over');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('drag-over');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                showFilePreview(files[0]);
            }
        });

        function showFilePreview(file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Create preview element with blue theme
                    let preview = document.querySelector('.file-upload-preview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.className = 'file-upload-preview mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-2xl border border-blue-200 dark:border-blue-700';
                        uploadArea.parentElement.appendChild(preview);
                    }
                    
                    preview.innerHTML = `
                        <div class="flex items-center space-x-4">
                            <img src="${e.target.result}" alt="Preview" class="w-16 h-16 rounded-full object-cover border-2 border-blue-300">
                            <div class="flex-1">
                                <p class="font-semibold text-blue-800 dark:text-blue-200">${file.name}</p>
                                <p class="text-sm text-blue-600 dark:text-blue-400">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                            </div>
                            <button type="button" class="text-red-500 hover:text-red-700 transition-colors duration-300" onclick="removePreview()">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    `;
                    
                    preview.classList.add('show');
                };
                reader.readAsDataURL(file);
            }
        }

        // Remove preview function
        window.removePreview = function() {
            const preview = document.querySelector('.file-upload-preview');
            if (preview) {
                preview.classList.remove('show');
                setTimeout(() => preview.remove(), 300);
            }
            fileInput.value = '';
        };

        // Form validation
        const form = document.querySelector('form');
        const nameInput = document.querySelector('input[name="name"]');
        const mobileInput = document.querySelector('input[name="mobile"]');

        // Real-time validation
        nameInput.addEventListener('input', function() {
            validateField(this, this.value.trim().length >= 2, 'Name must be at least 2 characters');
        });

        mobileInput.addEventListener('input', function() {
            const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
            validateField(this, phoneRegex.test(this.value.replace(/\s/g, '')), 'Please enter a valid mobile number');
        });

        function validateField(field, isValid, errorMessage) {
            field.classList.remove('field-error', 'field-success');
            
            // Remove existing error message
            const existingError = field.parentElement.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }

            if (field.value.trim() === '') {
                return; // Don't validate empty fields in real-time
            }

            if (isValid) {
                field.classList.add('field-success');
            } else {
                field.classList.add('field-error');
                
                // Add error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'error-message mt-2 text-sm text-red-600 dark:text-red-400';
                errorDiv.textContent = errorMessage;
                field.parentElement.appendChild(errorDiv);
            }
        }

        // Form submission validation
        form.addEventListener('submit', function(e) {
            let isValid = true;

            // Validate name
            if (nameInput.value.trim().length < 2) {
                validateField(nameInput, false, 'Name must be at least 2 characters');
                isValid = false;
            }

            // Validate mobile
            const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
            if (!phoneRegex.test(mobileInput.value.replace(/\s/g, ''))) {
                validateField(mobileInput, false, 'Please enter a valid mobile number');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
                showNotification('Please fix the errors before submitting', 'error');
                
                // Scroll to first error
                const firstError = document.querySelector('.field-error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }
        });

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

        // Auto-format mobile number
        mobileInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, ''); // Remove non-digits
            if (value.length > 0) {
                // Format as needed (this is a simple example)
                if (value.length <= 3) {
                    value = value;
                } else if (value.length <= 6) {
                    value = value.slice(0, 3) + '-' + value.slice(3);
                } else {
                    value = value.slice(0, 3) + '-' + value.slice(3, 6) + '-' + value.slice(6, 10);
                }
            }
            this.value = value;
        });
    });
</script>
@endpush