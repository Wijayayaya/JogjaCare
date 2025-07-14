@extends('dashboardadmin.layouts.app')

@section('title', $medicalCenter->name . ' - Medical Centers')
@section('page-title', $medicalCenter->name)
@section('page-description', 'Medical Center Details')

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
        <a href="{{ route('dashboardadmin.services.medicalcenter.index') }}" class="text-gray-500 hover:text-gray-700">Medical Centers</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">{{ $medicalCenter->name }}</span>
    </div>
</li>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
            <div class="flex items-center space-x-4">
                @if($medicalCenter->image)
                    <img src="{{ asset($medicalCenter->image) }}" alt="{{ $medicalCenter->name }}" 
                         class="w-16 h-16 rounded-lg object-cover">
                @else
                    <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-hospital text-purple-600 text-2xl"></i>
                    </div>
                @endif
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">{{ $medicalCenter->name }}</h1>
                    <div class="flex items-center space-x-4 mt-2">
                        <span class="px-3 py-1 text-sm font-medium bg-purple-100 text-purple-800 rounded-full">
                            {{ $medicalCenter->type }}
                        </span>
                        @if($medicalCenter->status)
                            <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                                Active
                            </span>
                        @else
                            <span class="px-3 py-1 text-sm font-medium bg-red-100 text-red-800 rounded-full">
                                Inactive
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex space-x-2 mt-4 md:mt-0">
                <a href="{{ route('dashboardadmin.services.medicalcenter.edit', $medicalCenter->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('dashboardadmin.services.medicalcenter.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-info-circle text-purple-600 mr-2"></i>Basic Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Medical Center Name</label>
                        <p class="text-gray-900 font-medium">{{ $medicalCenter->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Type</label>
                        <p class="text-gray-900">{{ $medicalCenter->type }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                        <p class="text-gray-900">
                            @if($medicalCenter->status)
                                <span class="text-green-600 font-medium">Active</span>
                            @else
                                <span class="text-red-600 font-medium">Inactive</span>
                            @endif
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Created Date</label>
                        <p class="text-gray-900">{{ $medicalCenter->created_at->format('F d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-file-alt text-purple-600 mr-2"></i>Content
                </h2>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-500 mb-2">Introduction</label>
                    <p class="text-gray-900 leading-relaxed">{{ $medicalCenter->intro }}</p>
                </div>

                @if($medicalCenter->description)
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-2">Description</label>
                    <div class="text-gray-900 leading-relaxed prose max-w-none">
                        {!! nl2br(e($medicalCenter->description)) !!}
                    </div>
                </div>
                @endif
            </div>

            <!-- Location Information -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-map-marker-alt text-purple-600 mr-2"></i>Location Information
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">District</label>
                        <p class="text-gray-900">{{ $medicalCenter->district }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Sub District</label>
                        <p class="text-gray-900">{{ $medicalCenter->sub_district }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-500 mb-1">Address</label>
                        <p class="text-gray-900">{{ $medicalCenter->address }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Contact</label>
                        <p class="text-gray-900">{{ $medicalCenter->contact }}</p>
                    </div>
                    @if($medicalCenter->maps)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Maps</label>
                        <a href="{{ $medicalCenter->maps }}" target="_blank" 
                           class="text-purple-600 hover:text-purple-800 underline">
                            View on Google Maps
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- SEO Information -->
            @if($medicalCenter->meta_title || $medicalCenter->meta_description || $medicalCenter->meta_keywords)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-search text-purple-600 mr-2"></i>SEO Information
                </h2>
                <div class="space-y-4">
                    @if($medicalCenter->meta_title)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Meta Title</label>
                        <p class="text-gray-900">{{ $medicalCenter->meta_title }}</p>
                    </div>
                    @endif
                    
                    @if($medicalCenter->meta_description)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Meta Description</label>
                        <p class="text-gray-900">{{ $medicalCenter->meta_description }}</p>
                    </div>
                    @endif
                    
                    @if($medicalCenter->meta_keywords)
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Meta Keywords</label>
                        <p class="text-gray-900">{{ $medicalCenter->meta_keywords }}</p>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column - Image and Actions -->
        <div class="space-y-6">
            <!-- Image -->
            @if($medicalCenter->image)
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    <i class="fas fa-image text-purple-600 mr-2"></i>Image
                </h3>
                <img src="{{ asset($medicalCenter->image) }}" alt="{{ $medicalCenter->name }}" 
                     class="w-full h-64 object-cover rounded-lg border border-gray-200">
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    <i class="fas fa-cogs text-purple-600 mr-2"></i>Quick Actions
                </h3>
                <div class="space-y-3">
                    <a href="{{ route('dashboardadmin.services.medicalcenter.edit', $medicalCenter->id) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                        <i class="fas fa-edit mr-2"></i>Edit Medical Center
                    </a>
                    
                    <form action="{{ route('dashboardadmin.services.medicalcenter.destroy', $medicalCenter->id) }}" 
                          method="POST" class="w-full" 
                          onsubmit="return confirm('Are you sure you want to delete this medical center?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                            <i class="fas fa-trash mr-2"></i>Delete Medical Center
                        </button>
                    </form>
                </div>
            </div>

            <!-- Information -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    <i class="fas fa-info text-purple-600 mr-2"></i>Information
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Slug:</span>
                        <span class="text-gray-900 font-medium">{{ $medicalCenter->slug }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Created:</span>
                        <span class="text-gray-900">{{ $medicalCenter->created_at->format('M d, Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Updated:</span>
                        <span class="text-gray-900">{{ $medicalCenter->updated_at->format('M d, Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
