@extends('dashboardadmin.layouts.app')

@section('title', 'Create Medical Care')
@section('page-title', 'Create Medical Care')
@section('page-description', 'Add new medical care service to the system')

@push('styles')
<style>
    .form-section {
        background: #f8fafc;
        border-left: 4px solid #3b82f6;
        padding: 1rem;
        margin-bottom: 1.5rem;
        border-radius: 0 0.5rem 0.5rem 0;
    }
    .form-section h3 {
        color: #1e40af;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    .required-field::after {
        content: " *";
        color: #ef4444;
    }
    .image-preview {
        max-width: 200px;
        max-height: 200px;
        border: 2px dashed #d1d5db;
        border-radius: 0.5rem;
        padding: 1rem;
        text-align: center;
        transition: border-color 0.2s;
    }
    .image-preview:hover {
        border-color: #3b82f6;
    }
    .char-counter {
        font-size: 0.75rem;
        color: #6b7280;
        text-align: right;
        margin-top: 0.25rem;
    }
</style>
@endpush

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-plus-circle mr-2 text-blue-600"></i>Create New Medical Care Service
                    </h2>
                    <p class="text-gray-600 mt-1">Fill in the information below to add a new medical care service</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('dashboardadmin.services.medicalcare.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200 inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Back to List
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('dashboardadmin.services.medicalcare.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <!-- Basic Information Section -->
            <div class="form-section">
                <h3><i class="fas fa-info-circle mr-2"></i>Basic Information</h3>
                <p class="text-sm text-gray-600">Essential details about the medical care service</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Name -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2 required-field">Service Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror" 
                           placeholder="Enter the medical care service name"
                           maxlength="255"
                           required>
                    <div class="char-counter">
                        <span id="name-counter">0</span>/255 characters
                    </div>
                    @error('name')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2 required-field">Service Type</label>
                    <select name="type" id="type" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror" 
                            required>
                        <option value="">Select Service Type</option>
                        <option value="General Care" {{ old('type') == 'General Care' ? 'selected' : '' }}>General Care</option>
                        <option value="Emergency Care" {{ old('type') == 'Emergency Care' ? 'selected' : '' }}>Emergency Care</option>
                        <option value="Specialized Care" {{ old('type') == 'Specialized Care' ? 'selected' : '' }}>Specialized Care</option>
                        <option value="Preventive Care" {{ old('type') == 'Preventive Care' ? 'selected' : '' }}>Preventive Care</option>
                        <option value="Rehabilitation" {{ old('type') == 'Rehabilitation' ? 'selected' : '' }}>Rehabilitation</option>
                        <option value="Mental Health" {{ old('type') == 'Mental Health' ? 'selected' : '' }}>Mental Health</option>
                        <option value="Pediatric Care" {{ old('type') == 'Pediatric Care' ? 'selected' : '' }}>Pediatric Care</option>
                        <option value="Geriatric Care" {{ old('type') == 'Geriatric Care' ? 'selected' : '' }}>Geriatric Care</option>
                    </select>
                    @error('type')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2 required-field">Status</label>
                    <select name="status" id="status" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('status') border-red-500 @enderror" 
                            required>
                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Image Section -->
            <div class="form-section">
                <h3><i class="fas fa-image mr-2"></i>Service Image</h3>
                <p class="text-sm text-gray-600">Upload an image to represent this medical care service</p>
            </div>

            <div class="mb-8">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Service Image</label>
                <div class="image-preview" id="imagePreview">
                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                    <p class="text-sm text-gray-600">Click to upload or drag and drop</p>
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF up to 2MB</p>
                </div>
                <input type="file" name="image" id="image" accept="image/*" class="hidden">
                @error('image')
                    <p class="mt-2 text-sm text-red-600 flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Content Section -->
            <div class="form-section">
                <h3><i class="fas fa-file-alt mr-2"></i>Content Information</h3>
                <p class="text-sm text-gray-600">Detailed information about the medical care service</p>
            </div>

            <div class="grid grid-cols-1 gap-6 mb-8">
                <!-- Introduction -->
                <div>
                    <label for="intro" class="block text-sm font-medium text-gray-700 mb-2">Introduction</label>
                    <textarea name="intro" id="intro" rows="3" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('intro') border-red-500 @enderror"
                              placeholder="Brief introduction about the medical care service"
                              maxlength="500">{{ old('intro') }}</textarea>
                    <div class="char-counter">
                        <span id="intro-counter">0</span>/500 characters
                    </div>
                    @error('intro')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Detailed Description</label>
                    <textarea name="description" id="description" rows="6" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                              placeholder="Comprehensive description of the medical care service">{{ old('description') }}</textarea>
                    <div class="char-counter">
                        <span id="description-counter">0</span> characters
                    </div>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- SEO Section -->
            <div class="form-section">
                <h3><i class="fas fa-search mr-2"></i>SEO Settings</h3>
                <p class="text-sm text-gray-600">Search engine optimization settings</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Meta Title -->
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_title') border-red-500 @enderror"
                           placeholder="SEO title for search engines"
                           maxlength="255">
                    <div class="char-counter">
                        <span id="meta-title-counter">0</span>/255 characters
                    </div>
                    @error('meta_title')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Meta Keywords -->
                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_keywords') border-red-500 @enderror"
                           placeholder="Keywords separated by commas"
                           maxlength="255">
                    <div class="char-counter">
                        <span id="meta-keywords-counter">0</span>/255 characters
                    </div>
                    @error('meta_keywords')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Meta Description -->
                <div class="md:col-span-2">
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="3" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('meta_description') border-red-500 @enderror"
                              placeholder="SEO description for search engines"
                              maxlength="300">{{ old('meta_description') }}</textarea>
                    <div class="char-counter">
                        <span id="meta-description-counter">0</span>/300 characters
                    </div>
                    @error('meta_description')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex flex-col md:flex-row justify-end space-y-2 md:space-y-0 md:space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('dashboardadmin.services.medicalcare.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200 text-center">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-200 flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i>Create Medical Care Service
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counters
    const fields = ['name', 'intro', 'description', 'meta_title', 'meta_keywords', 'meta_description'];
    
    fields.forEach(field => {
        const input = document.getElementById(field);
        const counter = document.getElementById(field.replace('_', '-') + '-counter');
        
        if (input && counter) {
            function updateCounter() {
                counter.textContent = input.value.length;
            }
            
            input.addEventListener('input', updateCounter);
            updateCounter(); // Initial count
        }
    });

    // Image preview
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    
    imagePreview.addEventListener('click', () => imageInput.click());
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="max-w-full max-h-48 rounded-lg">
                    <p class="text-sm text-gray-600 mt-2">${file.name}</p>
                    <p class="text-xs text-gray-500">Click to change image</p>
                `;
            };
            reader.readAsDataURL(file);
        }
    });
});
</script>
@endpush