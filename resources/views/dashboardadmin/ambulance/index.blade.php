@extends('dashboardadmin.layouts.app')

@section('title', 'Ambulance Management')
@section('page-title', 'Ambulance Management')
@section('page-description', 'Manage ambulance services and emergency contacts')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Ambulance Management</span>
    </div>
</li>
@endsection

@section('content')
<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-ambulance text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900">Total</h3>
                <p class="text-3xl font-bold text-blue-600">{{ number_format($stats['total']) }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-check-circle text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900">Active</h3>
                <p class="text-3xl font-bold text-green-600">{{ number_format($stats['active']) }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                <i class="fas fa-exclamation-triangle text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900">Emergency</h3>
                <p class="text-3xl font-bold text-red-600">{{ number_format($stats['emergency']) }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i class="fas fa-hospital text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900">Hospital</h3>
                <p class="text-3xl font-bold text-purple-600">{{ number_format($stats['hospital']) }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-lg">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-user-md text-2xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900">Private</h3>
                <p class="text-3xl font-bold text-yellow-600">{{ number_format($stats['private']) }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-white rounded-lg shadow-lg">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-ambulance text-white text-sm"></i>
                    </div>
                    Ambulance Services
                </h2>
                <p class="mt-1 text-sm text-gray-600">Manage all ambulance services and emergency contacts</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('dashboardadmin.ambulance.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-medium rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-plus mr-2"></i>
                    Add New Ambulance
                </a>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <form method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Search ambulances..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <select name="type" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Types</option>
                    <option value="emergency" {{ request('type') === 'emergency' ? 'selected' : '' }}>Emergency</option>
                    <option value="hospital" {{ request('type') === 'hospital' ? 'selected' : '' }}>Hospital</option>
                    <option value="private" {{ request('type') === 'private' ? 'selected' : '' }}>Private</option>
                </select>
            </div>
            <div>
                <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
            @if(request()->hasAny(['search', 'type', 'status']))
                <a href="{{ route('dashboardadmin.ambulance.index') }}" 
                   class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                    <i class="fas fa-times mr-2"></i>Clear
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coverage</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Response Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($ambulances as $ambulance)
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-ambulance text-white text-sm"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $ambulance->name }}</div>
                                @if($ambulance->distance_from_malioboro)
                                    <div class="text-sm text-gray-500">📍 {{ $ambulance->distance_from_malioboro }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {!! $ambulance->type_badge !!}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">📞 {{ $ambulance->phone }}</div>
                        @if($ambulance->whatsapp)
                            <div class="text-sm text-gray-500">💬 {{ $ambulance->whatsapp }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $ambulance->coverage_area ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $ambulance->response_time ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {!! $ambulance->status_badge !!}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('dashboardadmin.ambulance.show', $ambulance) }}" 
                           class="text-blue-600 hover:text-blue-900 transition-colors" 
                           data-tooltip="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('dashboardadmin.ambulance.edit', $ambulance) }}" 
                           class="text-green-600 hover:text-green-900 transition-colors" 
                           data-tooltip="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button onclick="confirmDelete({{ $ambulance->id }}, '{{ $ambulance->name }}')" 
                                class="text-red-600 hover:text-red-900 transition-colors" 
                                data-tooltip="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-ambulance text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No ambulances found</h3>
                            <p class="text-gray-500 mb-4">Get started by creating your first ambulance service.</p>
                            <a href="{{ route('dashboardadmin.ambulance.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-plus mr-2"></i>
                                Add First Ambulance
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($ambulances->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $ambulances->links() }}
    </div>
    @endif
</div>

<!-- Delete Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Delete Ambulance</h3>
                    <p class="text-sm text-gray-500">This action cannot be undone</p>
                </div>
            </div>
            <p class="text-gray-700 mb-6">Are you sure you want to delete <strong id="deleteItemName"></strong>?</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" 
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id, name) {
    document.getElementById('deleteItemName').textContent = name;
    document.getElementById('deleteForm').action = `/dashboardadmin/ambulance/${id}`;
    document.getElementById('deleteModal').classList.remove('hidden');
    document.getElementById('deleteModal').classList.add('flex');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deleteModal').classList.remove('flex');
}

// Auto-hide alerts
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert-auto-hide');
    alerts.forEach(alert => {
        alert.style.transition = 'opacity 0.5s';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
    });
}, 5000);
</script>
@endpush
