@extends('dashboardadmin.layouts.app')

@section('title', $medicalCare->name . ' - Medical Care Details')
@section('page-title', 'Medical Care Details')
@section('page-description', 'View medical care service information')

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
        <a href="{{ route('dashboardadmin.services.medicalcare.index') }}" class="text-gray-500 hover:text-gray-700">Medical Care</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">{{ Str::limit($medicalCare->name, 30) }}</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $medicalCare->name }}</h1>
                    <div class="flex items-center space-x-4">
                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                            {{ $medicalCare->type }}
                        </span>
                        @if($medicalCare->status)
                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        @else
                            <span class="px-3 py-1 text-sm font-medium rounded-full bg-red-100 text-red-800">
                                Inactive
                            </span>
                        @endif
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('dashboardadmin.services.medicalcare.edit', $medicalCare->id) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <form action="{{ route('dashboardadmin.services.medicalcare.destroy', $medicalCare->id) }}" 
                          method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this medical care service?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center">
                            <i class="fas fa-trash mr-2"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Image Section -->
        @if($medicalCare->image)
        <div class="px-6 py-4">
            <img src="{{ asset($medicalCare->image) }}" alt="{{ $medicalCare->name }}" 
                 class="w-full h-64 object-cover rounded-lg border border-gray-200">
        </div>
        @endif

        <!-- Content -->
        <div class="px-6 py-4 space-y-6">
            <!-- Introduction -->
            @if($medicalCare->intro)
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i>Introduction
                </h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 leading-relaxed">{{ $medicalCare->intro }}</p>
                </div>
            </div>
            @endif

            <!-- Description -->
            @if($medicalCare->description)
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                    <i class="fas fa-file-alt mr-2 text-blue-600"></i>Description
                </h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $medicalCare->description }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Details Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-info mr-2 text-blue-600"></i>Basic Information
            </h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Name</dt>
                    <dd class="text-sm text-gray-900">{{ $medicalCare->name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Slug</dt>
                    <dd class="text-sm text-gray-900">{{ $medicalCare->slug ?: 'Not set' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Type</dt>
                    <dd class="text-sm text-gray-900">{{ $medicalCare->type }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="text-sm">
                        @if($medicalCare->status)
                            <span class="text-green-600 font-medium">Active</span>
                        @else
                            <span class="text-red-600 font-medium">Inactive</span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

        <!-- SEO Information -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-search mr-2 text-blue-600"></i>SEO Information
            </h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Meta Title</dt>
                    <dd class="text-sm text-gray-900">{{ $medicalCare->meta_title ?: 'Not set' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Meta Description</dt>
                    <dd class="text-sm text-gray-900">{{ $medicalCare->meta_description ?: 'Not set' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Meta Keywords</dt>
                    <dd class="text-sm text-gray-900">{{ $medicalCare->meta_keywords ?: 'Not set' }}</dd>
                </div>
            </dl>
        </div>

        <!-- Timestamps -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-clock mr-2 text-blue-600"></i>Timestamps
            </h3>
            <dl class="space-y-3">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Created At</dt>
                    <dd class="text-sm text-gray-900">{{ $medicalCare->created_at->format('F d, Y \a\t g:i A') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Updated At</dt>
                    <dd class="text-sm text-gray-900">{{ $medicalCare->updated_at->format('F d, Y \a\t g:i A') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Last Modified</dt>
                    <dd class="text-sm text-gray-900">{{ $medicalCare->updated_at->diffForHumans() }}</dd>
                </div>
            </dl>
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                <i class="fas fa-cogs mr-2 text-blue-600"></i>Quick Actions
            </h3>
            <div class="space-y-3">
                <a href="{{ route('dashboardadmin.services.medicalcare.edit', $medicalCare->id) }}" 
                   class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                    <i class="fas fa-edit mr-2"></i>Edit Medical Care
                </a>
                <a href="{{ route('dashboardadmin.services.medicalcare.index') }}" 
                   class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                    <i class="fas fa-list mr-2"></i>Back to List
                </a>
                <form action="{{ route('dashboardadmin.services.medicalcare.destroy', $medicalCare->id) }}" 
                      method="POST" onsubmit="return confirm('Are you sure you want to delete this medical care service?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                        <i class="fas fa-trash mr-2"></i>Delete Medical Care
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
