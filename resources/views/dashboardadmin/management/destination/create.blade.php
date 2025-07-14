@extends('dashboardadmin.layouts.app')

@section('title', 'Create Destination - Medical Services')
@section('page-title', 'Create New Destination')
@section('page-description', 'Add a new medical service destination')

@push('styles')
<style>
    .form-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .form-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
    }
    
    .image-preview {
        max-height: 300px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .drag-drop-area {
        border: 2px dashed #cbd5e0;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .drag-drop-area.dragover {
        border-color: #3b82f6;
        background-color: #eff6ff;
    }
    
    .form-input {
        transition: all 0.3s ease;
    }
    
    .form-input:focus {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }
</style>
@endpush

@section('content')
<div class="form-container min-h-screen py-8">
    <div class="max-w-4xl mx-auto">
        <div class="form-card rounded-2xl shadow-2xl p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marked-alt text-2xl text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Create New Destination</h1>
                <p class="text-gray-600">Add a new medical service destination to your network</p>
            </div>

            <form action="{{ route('dashboardadmin.management.destination.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-heading mr-2 text-blue-600"></i>Destination Title
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                                   class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Enter destination title">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-align-left mr-2 text-blue-600"></i>Description
                            </label>
                            <textarea id="description" name="description" rows="6" required
                                      class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                      placeholder="Describe the destination and its services">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Map URL -->
                        <div>
                            <label for="map_url" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt mr-2 text-blue-600"></i>Map URL (Optional)
                            </label>
                            <input type="url" id="map_url" name="map_url" value="{{ old('map_url') }}"
                                   class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="https://maps.google.com/...">
                            @error('map_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Settings -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-sort-numeric-up mr-2 text-blue-600"></i>Sort Order
                                </label>
                                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('sort_order')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex items-end">
                                <label class="flex items-center space-x-3 cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                           class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="text-sm font-semibold text-gray-700">
                                        <i class="fas fa-toggle-on mr-2 text-green-600"></i>Active Status
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-image mr-2 text-blue-600"></i>Destination Image
                            </label>
                            <div class="drag-drop-area p-6 text-center" id="dropArea">
                                <input type="file" id="image" name="image" accept="image/*" class="hidden">
                                <div id="dropContent">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-600 mb-2">Drag and drop an image here, or</p>
                                    <button type="button" onclick="document.getElementById('image').click()" 
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                                        Choose File
                                    </button>
                                    <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF up to 2MB</p>
                                </div>
                                <div id="imagePreview" class="hidden">
                                    <img id="previewImg" src="/placeholder.svg" alt="Preview" class="image-preview mx-auto">
                                    <button type="button" onclick="removeImage()" 
                                            class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                                        <i class="fas fa-trash mr-2"></i>Remove Image
                                    </button>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preview Card -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                <i class="fas fa-eye mr-2 text-blue-600"></i>Preview
                            </h3>
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <div id="previewCardImage" class="h-32 bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-image text-2xl text-gray-400"></i>
                                </div>
                                <div class="p-4">
                                    <h4 id="previewTitle" class="font-semibold text-gray-900 mb-2">Destination Title</h4>
                                    <p id="previewDescription" class="text-sm text-gray-600">Destination description will appear here...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('dashboardadmin.management.destination.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition-colors flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to List
                    </a>
                    
                    <div class="flex space-x-4">
                        <button type="reset" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg transition-colors flex items-center">
                            <i class="fas fa-undo mr-2"></i>
                            Reset Form
                        </button>
                        <button type="submit" 
                                class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-8 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Create Destination
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Image upload and preview
const dropArea = document.getElementById('dropArea');
const imageInput = document.getElementById('image');
const dropContent = document.getElementById('dropContent');
const imagePreview = document.getElementById('imagePreview');
const previewImg = document.getElementById('previewImg');
const previewCardImage = document.getElementById('previewCardImage');

// Drag and drop functionality
dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('dragover');
});

dropArea.addEventListener('dragleave', () => {
    dropArea.classList.remove('dragover');
});

dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('dragover');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        handleImageUpload(files[0]);
    }
});

imageInput.addEventListener('change', (e) => {
    if (e.target.files.length > 0) {
        handleImageUpload(e.target.files[0]);
    }
});

function handleImageUpload(file) {
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImg.src = e.target.result;
            dropContent.classList.add('hidden');
            imagePreview.classList.remove('hidden');
            
            // Update preview card
            previewCardImage.innerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-full object-cover">`;
        };
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    imageInput.value = '';
    dropContent.classList.remove('hidden');
    imagePreview.classList.add('hidden');
    previewCardImage.innerHTML = '<i class="fas fa-image text-2xl text-gray-400"></i>';
}

// Live preview updates
document.getElementById('title').addEventListener('input', function() {
    document.getElementById('previewTitle').textContent = this.value || 'Destination Title';
});

document.getElementById('description').addEventListener('input', function() {
    const text = this.value || 'Destination description will appear here...';
    document.getElementById('previewDescription').textContent = text.substring(0, 100) + (text.length > 100 ? '...' : '');
});

// Form validation
document.querySelector('form').addEventListener('submit', function(e) {
    const title = document.getElementById('title').value.trim();
    const description = document.getElementById('description').value.trim();
    
    if (!title || !description) {
        e.preventDefault();
        alert('Please fill in all required fields.');
        return false;
    }
    
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating...';
});
</script>
@endpush
