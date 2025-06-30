@extends('dashboardadmin.layouts.app')

@section('title', 'Destinations - Medical Services')
@section('page-title', 'Destinations')
@section('page-description', 'Manage medical service destinations')

@push('styles')
<style>
    .destination-card {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .destination-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-color: #3b82f6;
    }
    
    .destination-image {
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .status-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 10;
    }
    
    .sort-order-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 10;
    }
    
    .action-buttons {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .destination-card:hover .action-buttons {
        opacity: 1;
    }
    
    .grid-view .destination-card {
        min-height: 400px;
    }
    
    .list-view .destination-card {
        display: flex;
        align-items: center;
        min-height: 120px;
    }
</style>
@endpush

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center">
                <i class="fas fa-map-marked-alt text-blue-600 mr-3"></i>
                Medical Destinations
            </h1>
            <p class="text-gray-600 mt-1">Manage and organize medical service destinations</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-2">
                <button id="gridView" class="p-2 text-gray-600 hover:text-blue-600 transition-colors">
                    <i class="fas fa-th-large"></i>
                </button>
                <button id="listView" class="p-2 text-gray-600 hover:text-blue-600 transition-colors">
                    <i class="fas fa-list"></i>
                </button>
            </div>
            <a href="{{ route('dashboardadmin.management.destination.create') }}" 
               class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-6 py-3 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl flex items-center">
                <i class="fas fa-plus mr-2"></i>
                Add New Destination
            </a>
        </div>
    </div>
</div>

<!-- Filters and Search -->
<div class="bg-white p-6 rounded-lg shadow-lg mb-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" id="searchInput" placeholder="Search destinations..." 
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <select id="statusFilter" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="flex items-center space-x-2 text-sm text-gray-600">
            <span>Total: {{ $destinations->total() }} destinations</span>
            <span class="text-gray-400">|</span>
            <span>Active: {{ $destinations->where('is_active', true)->count() }}</span>
        </div>
    </div>
</div>

<!-- Destinations Grid/List -->
<div id="destinationsContainer" class="grid-view">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="destinationsGrid">
        @forelse($destinations as $destination)
        <div class="destination-card bg-white rounded-xl shadow-lg overflow-hidden relative" 
             data-title="{{ strtolower($destination->title) }}" 
             data-status="{{ $destination->is_active ? 'active' : 'inactive' }}">
            
            <!-- Status Badge -->
            <div class="status-badge">
                @if($destination->is_active)
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                        <i class="fas fa-check mr-1"></i>Active
                    </span>
                @else
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                        <i class="fas fa-times mr-1"></i>Inactive
                    </span>
                @endif
            </div>

            <!-- Sort Order Badge -->
            <div class="sort-order-badge">
                <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-bold shadow-lg">
                    #{{ $destination->sort_order }}
                </span>
            </div>

            <!-- Image -->
            <div class="relative">
                @if($destination->hasImage())
                    <img src="{{ $destination->image_url }}" alt="{{ $destination->title }}" 
                         class="destination-image w-full">
                @else
                    <div class="destination-image w-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                        <i class="fas fa-image text-4xl text-gray-400"></i>
                    </div>
                @endif
                
                <!-- Action Buttons Overlay -->
                <div class="action-buttons absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center space-x-3">
                    <a href="{{ route('dashboardadmin.management.destination.show', $destination) }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white p-3 rounded-full transition-colors shadow-lg">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('dashboardadmin.management.destination.edit', $destination) }}" 
                       class="bg-green-500 hover:bg-green-600 text-white p-3 rounded-full transition-colors shadow-lg">
                        <i class="fas fa-edit"></i>
                    </a>
                    <button onclick="toggleStatus({{ $destination->id }})" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white p-3 rounded-full transition-colors shadow-lg">
                        <i class="fas fa-toggle-{{ $destination->is_active ? 'on' : 'off' }}"></i>
                    </button>
                    <button onclick="deleteDestination({{ $destination->id }})" 
                            class="bg-red-500 hover:bg-red-600 text-white p-3 rounded-full transition-colors shadow-lg">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="flex items-start justify-between mb-3">
                    <h3 class="text-xl font-bold text-gray-900 line-clamp-2">{{ $destination->title }}</h3>
                </div>
                
                <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit($destination->description, 120) }}</p>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-sm text-gray-500">
                        <i class="fas fa-calendar mr-2"></i>
                        {{ $destination->created_at->format('M d, Y') }}
                    </div>
                    @if($destination->map_url)
                        <a href="{{ $destination->map_url }}" target="_blank" 
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            <i class="fas fa-map-marker-alt mr-1"></i>View Map
                        </a>
                    @endif
                </div>
                
                @if($destination->hasImage())
                    <div class="mt-3 text-xs text-gray-400">
                        <i class="fas fa-file-image mr-1"></i>
                        Image: {{ $destination->image_size }}
                    </div>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                <i class="fas fa-map-marked-alt text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No destinations found</h3>
                <p class="text-gray-500 mb-6">Get started by creating your first medical destination</p>
                <a href="{{ route('dashboardadmin.management.destination.create') }}" 
                   class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition-colors inline-flex items-center">
                    <i class="fas fa-plus mr-2"></i>
                    Create First Destination
                </a>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Pagination -->
@if($destinations->hasPages())
<div class="mt-8">
    {{ $destinations->links() }}
</div>
@endif
@endsection

@push('scripts')
<script>
// View Toggle
document.getElementById('gridView').addEventListener('click', function() {
    document.getElementById('destinationsContainer').className = 'grid-view';
    document.getElementById('destinationsGrid').className = 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6';
    this.classList.add('text-blue-600');
    document.getElementById('listView').classList.remove('text-blue-600');
});

document.getElementById('listView').addEventListener('click', function() {
    document.getElementById('destinationsContainer').className = 'list-view';
    document.getElementById('destinationsGrid').className = 'space-y-4';
    this.classList.add('text-blue-600');
    document.getElementById('gridView').classList.remove('text-blue-600');
});

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    filterDestinations();
});

document.getElementById('statusFilter').addEventListener('change', function() {
    filterDestinations();
});

function filterDestinations() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    const cards = document.querySelectorAll('.destination-card');
    
    cards.forEach(card => {
        const title = card.dataset.title;
        const status = card.dataset.status;
        
        const matchesSearch = title.includes(searchTerm);
        const matchesStatus = !statusFilter || status === statusFilter;
        
        if (matchesSearch && matchesStatus) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

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

// Initialize grid view as default
document.getElementById('gridView').classList.add('text-blue-600');
</script>
@endpush
