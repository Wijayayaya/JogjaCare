@extends('backend.layouts.app')

@section('title') {{ __('Create Destination') }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{route("backend.dashboard")}}' icon='fa-solid fa-cubes' >
        {{ __('Dashboard') }}
    </x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item route='{{route("backend.destinations.index")}}'>{{ __('Destinations') }}</x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active">{{ __('Create') }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="fa-solid fa-map-location-dot"></i> {{ __('Create Destination') }}
                </h4>
            </div>
            <div class="col-4">
                <div class="btn-toolbar float-end" role="toolbar">
                    <a href="{{ route('backend.destinations.index') }}" class="btn btn-secondary btn-sm ms-1">
                        <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                    </a>
                </div>
            </div>
        </div>
        <hr>
        
        <form method="POST" action="{{ route('backend.destinations.store') }}" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required maxlength="255">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required maxlength="1000">{{ old('description') }}</textarea>
                        <div class="form-text">
                            <small class="text-muted">
                                <span id="charCount">0</span>/1000 characters
                            </small>
                        </div>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="map_url" class="form-label">{{ __('Google Maps URL') }}</label>
                        <input type="url" class="form-control @error('map_url') is-invalid @enderror" id="map_url" name="map_url" value="{{ old('map_url') }}" maxlength="500">
                        @error('map_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">{{ __('Image') }}</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                        <div class="form-text">
                            <small class="text-muted">
                                <strong>{{ __('Image Requirements:') }}</strong><br>
                                • {{ __('Maximum file size: 512kb') }}<br>
                                • {{ __('Recommended size: 800x600 pixels') }}<br>
                                • {{ __('Supported formats: JPEG, PNG, JPG, GIF, WebP') }}<br>
                                • {{ __('Images will be automatically compressed') }}
                            </small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">{{ __('Image Preview') }}</h6>
                                </div>
                                <div class="card-body text-center">
                                    <img id="preview" src="/placeholder.svg" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                    <div id="imageInfo" class="mt-2">
                                        <small class="text-muted">
                                            <div id="imageSize"></div>
                                            <div id="imageDimensions"></div>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">{{ __('Sort Order') }}</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                {{ __('Active') }}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> {{ __('Create') }}
                    </button>
                    <a href="{{ route('backend.destinations.index') }}" class="btn btn-secondary">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Character counter for description
document.getElementById('description').addEventListener('input', function() {
    const charCount = this.value.length;
    document.getElementById('charCount').textContent = charCount;
    
    if (charCount > 900) {
        document.getElementById('charCount').style.color = 'red';
    } else if (charCount > 800) {
        document.getElementById('charCount').style.color = 'orange';
    } else {
        document.getElementById('charCount').style.color = 'inherit';
    }
});

function previewImage(input) {
    const preview = document.getElementById('preview');
    const imagePreview = document.getElementById('imagePreview');
    const imageSize = document.getElementById('imageSize');
    const imageDimensions = document.getElementById('imageDimensions');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const maxSize = 1 * 1024 * 1024; // 1MB in bytes
        
        // Check file size
        if (file.size > maxSize) {
            alert('File size must not exceed 1MB. Current size: ' + formatBytes(file.size));
            input.value = '';
            imagePreview.style.display = 'none';
            return;
        }
        
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            imagePreview.style.display = 'block';
            
            // Display file info
            imageSize.textContent = `Size: ${formatBytes(file.size)}`;
            
            // Get image dimensions
            const img = new Image();
            img.onload = function() {
                imageDimensions.textContent = `Dimensions: ${this.width} x ${this.height} pixels`;
                
                // Show warning if image is too large
                if (this.width > 1200 || this.height > 900) {
                    imageDimensions.innerHTML += '<br><span class="text-warning">⚠️ Large image will be resized to 800x600</span>';
                }
            };
            img.src = e.target.result;
        }
        
        reader.readAsDataURL(file);
    } else {
        imagePreview.style.display = 'none';
    }
}

function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

// Initialize character counter
document.addEventListener('DOMContentLoaded', function() {
    const description = document.getElementById('description');
    if (description.value) {
        document.getElementById('charCount').textContent = description.value.length;
    }
});
</script>
@endsection