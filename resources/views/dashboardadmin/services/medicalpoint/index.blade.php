@extends('dashboardadmin.layouts.app')

@section('title', 'Medical Point - Dashboard Admin')
@section('page-title', 'Medical Point')
@section('page-description', 'Manage Medical Service Points')

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
        <span class="text-gray-500">Medical Point</span>
    </div>
</li>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-lg">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">
                    <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>Medical Point List
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage medical service points and locations</p>
            </div>
            <a href="{{ route('dashboardadmin.services.medicalpoint.create') }}" 
               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Medical Point
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mx-6 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Search and Filter -->
    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Search medical point..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="">All Types</option>
                    <option value="Hospital">Hospital</option>
                    <option value="Clinic">Clinic</option>
                    <option value="Pharmacy">Pharmacy</option>
                    <option value="Laboratory">Laboratory</option>
                </select>
            </div>
            <div class="text-sm text-gray-600">
                Total: {{ $medicalPoints->total() }} medical points
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input type="checkbox" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($medicalPoints as $medicalPoint)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($medicalPoint->image)
                                <img class="h-10 w-10 rounded-full object-cover mr-4" src="{{ asset($medicalPoint->image) }}" alt="{{ $medicalPoint->name }}">
                            @else
                                <div class="h-10 w-10 rounded-full bg-green-100 flex items-center justify-center mr-4">
                                    <i class="fas fa-map-marker-alt text-green-600"></i>
                                </div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $medicalPoint->name }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($medicalPoint->intro, 50) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $medicalPoint->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $medicalPoint->district }}</div>
                        <div class="text-sm text-gray-500">{{ $medicalPoint->sub_district }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $medicalPoint->contact }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $medicalPoint->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('dashboardadmin.services.medicalpoint.show', $medicalPoint->id) }}" 
                               class="text-blue-600 hover:text-blue-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('dashboardadmin.services.medicalpoint.edit', $medicalPoint->id) }}" 
                               class="text-green-600 hover:text-green-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dashboardadmin.services.medicalpoint.destroy', $medicalPoint->id) }}" 
                                  method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this medical point?')">
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
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-map-marker-alt text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Medical Points Found</h3>
                            <p class="text-gray-500 mb-4">Get started by creating your first medical point.</p>
                            <a href="{{ route('dashboardadmin.services.medicalpoint.create') }}" 
                               class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-plus mr-2"></i>Add Medical Point
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($medicalPoints->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $medicalPoints->links() }}
    </div>
    @endif
</div>
@endsection
