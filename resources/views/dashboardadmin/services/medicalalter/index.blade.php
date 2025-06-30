@extends('dashboardadmin.layouts.app')

@section('title', 'Medical Alter - Dashboard Admin')
@section('page-title', 'Medical Alter')
@section('page-description', 'Manage Alternative Medical Treatments')

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
        <span class="text-gray-500">Medical Alter</span>
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
                    <i class="fas fa-pills mr-2 text-yellow-600"></i>Medical Alter List
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage alternative medical treatments and therapies</p>
            </div>
            <a href="{{ route('dashboardadmin.services.medicalalter.create') }}" 
               class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                <i class="fas fa-plus mr-2"></i>Add Medical Alter
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
                    <input type="text" placeholder="Search medical alter..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <select class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                    <option value="">All Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div class="text-sm text-gray-600">
                Total: {{ $medicalAlters->total() }} medical alters
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input type="checkbox" class="rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($medicalAlters as $medicalAlter)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="rounded border-gray-300 text-yellow-600 focus:ring-yellow-500">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($medicalAlter->image)
                                <img class="h-10 w-10 rounded-full object-cover mr-4" src="{{ asset($medicalAlter->image) }}" alt="{{ $medicalAlter->name }}">
                            @else
                                <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center mr-4">
                                    <i class="fas fa-pills text-yellow-600"></i>
                                </div>
                            @endif
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $medicalAlter->name }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($medicalAlter->intro, 50) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            {{ $medicalAlter->type }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($medicalAlter->status)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $medicalAlter->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('dashboardadmin.services.medicalalter.show', $medicalAlter->id) }}" 
                               class="text-blue-600 hover:text-blue-900" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('dashboardadmin.services.medicalalter.edit', $medicalAlter->id) }}" 
                               class="text-green-600 hover:text-green-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dashboardadmin.services.medicalalter.destroy', $medicalAlter->id) }}" 
                                  method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this medical alter?')">
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
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-pills text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No Medical Alters Found</h3>
                            <p class="text-gray-500 mb-4">Get started by creating your first alternative medical treatment.</p>
                            <a href="{{ route('dashboardadmin.services.medicalalter.create') }}" 
                               class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                <i class="fas fa-plus mr-2"></i>Add Medical Alter
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($medicalAlters->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $medicalAlters->links() }}
    </div>
    @endif
</div>
@endsection
