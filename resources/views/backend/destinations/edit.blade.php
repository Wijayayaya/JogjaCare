@extends('backend.layouts.app')

@section('title') {{ __('Edit Destination') }} @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs>
    <x-backend.breadcrumb-item route='{{route("backend.dashboard")}}' icon='fa-solid fa-cubes' >
        {{ __('Dashboard') }}
    </x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item route='{{route("backend.destinations.index")}}'>{{ __('Destinations') }}</x-backend.breadcrumb-item>
    <x-backend.breadcrumb-item type="active">{{ __('Edit') }}</x-backend.breadcrumb-item>
</x-backend.breadcrumbs>
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8">
                <h4 class="card-title mb-0">
                    <i class="fa-solid fa-map-location-dot"></i> {{ __('Edit Destination') }}
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
        
        <form method="POST" action="{{ route('backend.destinations.update', $destination) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">{{ __('Title') }} <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $destination->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">{{ __('Description') }} <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $destination->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="map_url" class="form-label">{{ __('Google Maps URL') }}</label>
                        <input type="url" class="form-control @error('map_url') is-invalid @enderror" id="map_url" name="map_url" value="{{ old('map_url', $destination->map_url) }}">
                        @error('map_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="image" class="form-label">{{ __('Image') }}</label>
                        
                        @if($destination->hasImage())
                        <div class="mb-2">
                            <img src="{{ $destination->image_url }}" alt="{{ $destination->title }}" class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                            <div class="mt-1">
                                <small class="text-muted">{{ __('Current image size') }}: {{ $destination->image_size }}</small>
                            </div>
                        </div>
                        @endif
                        
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" onchange="previewImage(this)">
                        <div class="form-text">
                            <small class="text-muted">
                                {{ __('Maximum file size: 2MB') }}<br>
                                {{ __('Supported formats: JPEG, PNG, JPG, GIF, WebP') }}<br>
                                {{ __('Leave empty to keep current image') }}
                            </small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                        <!-- New Image Preview -->
                        <div id="imagePreview" class="mt-2" style="display: none;">
                            <div class="alert alert-info">
                                <strong>{{ __('New Image Preview:') }}</strong>
                            </div>
                            <img id="preview" src="/placeholder.svg" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 150px;">
                            <div id="imageInfo" class="mt-1">
                                <small class="text-muted" id="imageSize"></small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="sort_order" class="form-label">{{ __('Sort Order') }}</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $destination->sort_order) }}" min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $destination->is_active) ? 'checked' : '' }}>
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
                        <i class="fas fa-save"></i> {{ __('Update') }}
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
function previewImage(input) {
    const preview = document.getElementById('preview');
    const imagePreview = document.getElementById('imagePreview');
    const imageSize = document.getElementById('imageSize');
    
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB in bytes
        
        // Check file size
        if (file.size > maxSize) {
            alert('File size must not exceed 2MB');
            input.value = '';
            imagePreview.style.display = 'none';
            return;
        }
        
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            imagePreview.style.display = 'block';
            
            // Display file size
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
            imageSize.textContent = `Size: ${sizeInMB} MB`;
        }
        
        reader.readAsDataURL(file);
    } else {
        imagePreview.style.display = 'none';
    }
}
</script>
@endsection