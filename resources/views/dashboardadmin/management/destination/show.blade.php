@extends('dashboardadmin.layouts.app')

@section('title', $destination->title . ' - Medical Services')
@section('page-title', 'Destination Details')
@section('page-description', 'View destination information')

@push('styles')
<style>
    .detail-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .detail-card {
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95);
    }
    
    .destination-image {
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .info-card {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-left: 4px solid #3b82f6;
    }
    
    .status-indicator {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
</style>
@endpush

@section('content')
<div class="detail-container min-h-screen py-8">
    <div class="max-w-6xl mx-auto">
        <div class="detail-card rounded-2xl shadow-2xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white p-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">{{ $destination->title }}</h1>
                        <div class="flex items-center space-x-4">
                            <span class="flex items-center">
                                <i class="fas fa-calendar mr-2"></i>
                                Created {{ $destination->created_at->format('M d, Y') }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-clock mr-2"></i>
                                Updated {{ $destination->updated_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                    <div class="text-right">
                        @if($destination->is_active)
                            <span class="status-indicator bg-green-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                <i class="fas fa-check mr-2"></i>Active
                            </span>
                        @else
                            <span class="status-indicator bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                <i class="fas fa-times mr-2"></i>Inactive
                            </span>
                        @endif
                        <div class="mt-2">
                            <span class="bg-white bg-opacity-20 text-white px-3 py-1 rounded-full text-sm">
                                Sort Order: #{{ $destination->sort_order }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column - Image and Map -->
                    <div class="space-y-6">
                        <!-- Image -->
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-image mr-3 text-blue-600"></i>
                                Destination Image
                            </h3>
                            @if($destination->hasImage())
                                <div class="relative">
                                    <img src="{{ $destination->image_url }}" alt="{{ $destination->title }}" 
                                         class="destination-image w-full">
                                    <div class="absolute top-4 right-4">
                                        <span class="bg-black bg-opacity-50 text-white px-3 py-1 rounded-full text-sm">
                                            {{ $destination->image_size }}
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="destination-image w-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-image text-6xl text-gray-400 mb-4"></i>
                                        <p class="text-gray-500">No image available</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Map -->
                        @if($destination->map_url)
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-map-marker-alt mr-3 text-blue-600"></i>
                                Location Map
                            </h3>
                            <div class="bg-gray-100 rounded-lg p-6 text-center">
                                <i class="fas fa-external-link-alt text-3xl text-blue-600 mb-4"></i>
                                <p class="text-gray-700 mb-4">View this destination on the map</p>
                                <a href="{{ $destination->map_url }}" target="_blank" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition-colors inline-flex items-center">
                                    <i class="fas fa-map mr-2"></i>
                                    Open in Maps
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Right Column - Details -->
                    <div class="space-y-6">
                        <!-- Description -->
                        <div class="info-card p-6 rounded-lg">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-align-left mr-3 text-blue-600"></i>
                                Description
                            </h3>
                            <div class="prose prose-blue max-w-none">
                                <p class="text-gray-700 leading-relaxed">{{ $destination->description }}</p>
                            </div>
                        </div>

                        <!-- Details Grid -->
                        <div class="grid grid-cols-2 gap-4">
                            <div class="info-card p-4 rounded-lg text-center">
                                <i class="fas fa-sort-numeric-up text-2xl text-blue-600 mb-2"></i>
                                <h4 class="font-semibold text-gray-900">Sort Order</h4>
                                <p class="text-2xl font-bold text-blue-600">#{{ $destination->sort_order }}</p>
                            </div>
                            
                            <div class="info-card p-4 rounded-lg text-center">
                                <i class="fas fa-toggle-{{ $destination->is_active ? 'on' : 'off' }} text-2xl {{ $destination->is_active ? 'text-green-600' : 'text-red-600' }} mb-2"></i>
                                <h4 class="font-semibold text-gray-900">Status</h4>
                                <p class="text-lg font-bold {{ $destination->is_active ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $destination->is_active ? 'Active' : 'Inactive' }}
                                </p>
                            </div>
                        </div>

                        <!-- Metadata -->
                        <div class="info-card p-6 rounded-lg">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-info-circle mr-3 text-blue-600"></i>
                                Metadata
                            </h3>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">ID:</span>
                                    <span class="font-semibold">{{ $destination->id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Created:</span>
                                    <span class="font-semibold">{{ $destination->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Last Updated:</span>
                                    <span class="font-semibold">{{ $destination->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                                @if($destination->hasImage())
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Image Size:</span>
                                    <span class="font-semibold">{{ $destination->image_size }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Image Type:</span>
                                    <span class="font-semibold">{{ $destination->image_mime_type }}</span>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="info-card p-6 rounded-lg">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                <i class="fas fa-bolt mr-3 text-blue-600"></i>
                                Quick Actions
                            </h3>
                            <div class="grid grid-cols-2 gap-3">
                                <button onclick="toggleStatus({{ $destination->id }})" 
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition-colors flex items-center justify-center">
                                    <i class="fas fa-toggle-{{ $destination->is_active ? 'off' : 'on' }} mr-2"></i>
                                    {{ $destination->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                                
                                <button onclick="duplicateDestination({{ $destination->id }})" 
                                        class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg transition-colors flex items-center justify-center">
                                    <i class="fas fa-copy mr-2"></i>
                                    Duplicate
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-8 border-t border-gray-200 mt-8">
                    <a href="{{ route('dashboardadmin.management.destination.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition-colors flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to List
                    </a>
                    
                    <div class="flex space-x-4">
                        <a href="{{ route('dashboardadmin.management.destination.edit', $destination) }}" 
                           class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition-colors flex items-center">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Destination
                        </a>
                        
                        <button onclick="deleteDestination({{ $destination->id }})" 
                                class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg transition-colors flex items-center">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Destination
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Toggle Status
function toggleStatus(destinationId) {
    if (confirm('Are you sure you want to change the status of this destination?')) {
        fetch(`/dashboardadmin/management/destination/${destinationId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating status');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating status');
        });
    }
}

// Delete Destination
function deleteDestination(destinationId) {
    if (confirm('Are you sure you want to delete this destination? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/dashboardadmin/management/destination/${destinationId}`;
        form.innerHTML = `
            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
            <input type="hidden" name="_method" value="DELETE">
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Duplicate Destination (placeholder)
function duplicateDestination(destinationId) {
    alert('Duplicate functionality will be implemented soon!');
}
</script>
@endpush
