@extends('dashboardadmin.layouts.app')

@section('title', 'Medical Centers - Medical Services')
@section('page-title', 'Medical Centers')
@section('page-description', 'Manage Medical Centers')

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
        <span class="text-gray-500">Medical Centers</span>
    </div>
</li>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-lg">
    <!-- Header Section -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex-1">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">
                    <i class="fas fa-hospital text-purple-600 mr-2"></i>Medical Centers
                </h2>
                <p class="text-gray-600">Manage and organize medical centers information</p>
            </div>
            <div class="mt-4 md:mt-0">
                <a href="{{ route('dashboardadmin.services.medicalcenter.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                    <i class="fas fa-plus mr-2"></i>Add New Medical Center
                </a>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="p-6 bg-gray-50 border-b border-gray-200">
        <form method="GET" action="{{ route('dashboardadmin.services.medicalcenter.index') }}" class="space-y-4 md:space-y-0 md:flex md:items-center md:space-x-4">
            <!-- Search -->
            <div class="flex-1">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search medical centers..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                </div>
            </div>

            <!-- Type Filter -->
            <div class="md:w-48">
                <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">All Types</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- District Filter -->
            <div class="md:w-48">
                <select name="district" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">All Districts</option>
                    @foreach($districts as $district)
                        <option value="{{ $district }}" {{ request('district') == $district ? 'selected' : '' }}>
                            {{ $district }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div class="md:w-32">
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="">All Status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Filter Button -->
            <div class="flex space-x-2">
                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                    <i class="fas fa-filter mr-1"></i>Filter
                </button>
                <a href="{{ route('dashboardadmin.services.medicalcenter.index') }}" 
                   class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">
                    <i class="fas fa-times mr-1"></i>Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Medical Center</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($medicalCenters as $medicalCenter)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($medicalCenter->image)
                                <img src="{{ asset($medicalCenter->image) }}" alt="{{ $medicalCenter->name }}" 
                                     class="w-12 h-12 rounded-lg object-cover mr-4">
                            @else
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-hospital text-purple-600"></i>
                                </div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $medicalCenter->name }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($medicalCenter->intro, 50) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-purple-100 text-purple-800 rounded-full">
                            {{ $medicalCenter->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">{{ $medicalCenter->district }}</div>
                        <div class="text-sm text-gray-500">{{ $medicalCenter->sub_district }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $medicalCenter->contact }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($medicalCenter->status)
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
                        {{ $medicalCenter->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('dashboardadmin.services.medicalcenter.show', $medicalCenter->id) }}" 
                               class="text-blue-600 hover:text-blue-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('dashboardadmin.services.medicalcenter.edit', $medicalCenter->id) }}" 
                               class="text-green-600 hover:text-green-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dashboardadmin.services.medicalcenter.destroy', $medicalCenter->id) }}" 
                                  method="POST" class="inline-block" 
                                  onsubmit="return confirm('Are you sure you want to delete this medical center?')">
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
                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-hospital text-4xl text-gray-300 mb-4"></i>
                        <p class="text-lg font-medium mb-2">No medical centers found</p>
                        <p class="text-sm">Get started by creating your first medical center.</p>
                        <a href="{{ route('dashboardadmin.services.medicalcenter.create') }}" 
                           class="inline-flex items-center mt-4 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                            <i class="fas fa-plus mr-2"></i>Add Medical Center
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($medicalCenters->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $medicalCenters->links() }}
    </div>
    @endif
</div>
@endsection
