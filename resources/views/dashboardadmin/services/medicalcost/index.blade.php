@extends('dashboardadmin.layouts.app')

@section('title', 'Medical Cost - List')
@section('page-title', 'Medical Cost Management')
@section('page-description', 'Manage medical service costs and pricing')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('dashboardadmin.index') }}" class="text-gray-500 hover:text-gray-700">Dashboard</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Medical Cost</span>
    </div>
</li>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-lg">
    <!-- Header Section -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center mb-4 sm:mb-0">
                <div class="p-2 bg-red-100 rounded-lg mr-3">
                    <i class="fas fa-dollar-sign text-red-600 text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Medical Cost</h1>
                    <p class="text-sm text-gray-500">Manage medical service pricing</p>
                </div>
            </div>
            <a href="{{ route('dashboardadmin.services.medicalcost.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                <i class="fas fa-plus mr-2"></i>
                Add New Cost
            </a>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="p-6 bg-gray-50 border-b border-gray-200">
        <form method="GET" action="{{ route('dashboardadmin.services.medicalcost.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search by name..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="">All Status</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Min Price Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Min Price</label>
                    <input type="number" name="min_price" value="{{ request('min_price') }}" 
                           placeholder="0" min="0" step="0.01"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Max Price Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Max Price</label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" 
                           placeholder="999999" min="0" step="0.01"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Sort -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sort By</label>
                    <select name="sort_by" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500">
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date Created</option>
                        <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="lowest_price" {{ request('sort_by') == 'lowest_price' ? 'selected' : '' }}>Lowest Price</option>
                        <option value="highest_price" {{ request('sort_by') == 'highest_price' ? 'selected' : '' }}>Highest Price</option>
                        <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Status</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                <a href="{{ route('dashboardadmin.services.medicalcost.index') }}" 
                   class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200">
                    <i class="fas fa-times mr-2"></i>Clear
                </a>
                <input type="hidden" name="sort_order" value="{{ request('sort_order', 'desc') }}">
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'name', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" 
                           class="flex items-center hover:text-gray-700">
                            Service Name
                            @if(request('sort_by') == 'name')
                                <i class="fas fa-sort-{{ request('sort_order') == 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'lowest_price', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" 
                           class="flex items-center hover:text-gray-700">
                            Price Range
                            @if(request('sort_by') == 'lowest_price')
                                <i class="fas fa-sort-{{ request('sort_order') == 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'status', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" 
                           class="flex items-center hover:text-gray-700">
                            Status
                            @if(request('sort_by') == 'status')
                                <i class="fas fa-sort-{{ request('sort_order') == 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'created_at', 'sort_order' => request('sort_order') == 'asc' ? 'desc' : 'asc']) }}" 
                           class="flex items-center hover:text-gray-700">
                            Created Date
                            @if(request('sort_by') == 'created_at')
                                <i class="fas fa-sort-{{ request('sort_order') == 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @endif
                        </a>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($medicalCosts as $medicalCost)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $medicalCost->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            <span class="font-medium text-green-600">{{ $medicalCost->formatted_lowest_price }}</span>
                            <span class="text-gray-500 mx-2">-</span>
                            <span class="font-medium text-red-600">{{ $medicalCost->formatted_highest_price }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($medicalCost->status)
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                Active
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $medicalCost->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('dashboardadmin.services.medicalcost.show', $medicalCost->id) }}" 
                               class="text-blue-600 hover:text-blue-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('dashboardadmin.services.medicalcost.edit', $medicalCost->id) }}" 
                               class="text-green-600 hover:text-green-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dashboardadmin.services.medicalcost.destroy', $medicalCost->id) }}" 
                                  method="POST" class="inline-block" 
                                  onsubmit="return confirm('Are you sure you want to delete this medical cost?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-dollar-sign text-4xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Medical Costs Found</h3>
                            <p class="text-gray-500 mb-4">Get started by creating your first medical cost entry.</p>
                            <a href="{{ route('dashboardadmin.services.medicalcost.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                                <i class="fas fa-plus mr-2"></i>
                                Add Medical Cost
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($medicalCosts->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $medicalCosts->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Auto-submit form when sort order changes
    document.addEventListener('DOMContentLoaded', function() {
        const sortLinks = document.querySelectorAll('a[href*="sort_by"]');
        sortLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // Optional: Add loading state
                const icon = this.querySelector('i');
                if (icon) {
                    icon.className = 'fas fa-spinner fa-spin ml-1';
                }
            });
        });
    });
</script>
@endpush
