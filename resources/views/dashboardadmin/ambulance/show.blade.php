@extends('dashboardadmin.layouts.app')

@section('title', 'Ambulance Details - ' . $ambulance->name)
@section('page-title', 'Ambulance Details')
@section('page-description', 'View detailed information about ' . $ambulance->name)

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('dashboardadmin.ambulance.index') }}" class="text-blue-600 hover:text-blue-800">Ambulance Management</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">{{ $ambulance->name }}</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="bg-white rounded-lg shadow-lg mb-6">
        <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-t-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4">
                        <i class="fas fa-ambulance text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">{{ $ambulance->name }}</h1>
                        <div class="flex items-center space-x-4 mt-1">
                            {!! $ambulance->type_badge !!}
                            {!! $ambulance->status_badge !!}
                        </div>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('dashboardadmin.ambulance.edit', $ambulance) }}" 
                       class="px-4 py-2 bg-white bg-opacity-20 text-white rounded-lg hover:bg-opacity-30 transition-all duration-200">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <a href="{{ route('dashboardadmin.ambulance.index') }}" 
                       class="px-4 py-2 bg-white bg-opacity-20 text-white rounded-lg hover:bg-opacity-30 transition-all duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        Basic Information
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Service Name</label>
                            <p class="text-lg font-semibold text-gray-900">{{ $ambulance->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Service Type</label>
                            <div>{!! $ambulance->type_badge !!}</div>
                        </div>
                        @if($ambulance->description)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500 mb-1">Description</label>
                            <p class="text-gray-900">{{ $ambulance->description }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-phone text-green-600 mr-2"></i>
                        Contact Information
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Phone Number</label>
                            <div class="flex items-center">
                                <i class="fas fa-phone text-blue-600 mr-2"></i>
                                <a href="tel:{{ $ambulance->phone }}" class="text-lg font-semibold text-blue-600 hover:text-blue-800">
                                    {{ $ambulance->phone }}
                                </a>
                            </div>
                        </div>
                        @if($ambulance->whatsapp)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">WhatsApp</label>
                            <div class="flex items-center">
                                <i class="fab fa-whatsapp text-green-600 mr-2"></i>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ambulance->whatsapp) }}" 
                                   target="_blank" 
                                   class="text-lg font-semibold text-green-600 hover:text-green-800">
                                    {{ $ambulance->whatsapp }}
                                </a>
                            </div>
                        </div>
                        @endif
                        @if($ambulance->address)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500 mb-1">Address</label>
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-red-600 mr-2 mt-1"></i>
                                <p class="text-gray-900">{{ $ambulance->address }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Service Details -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-cogs text-purple-600 mr-2"></i>
                        Service Details
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @if($ambulance->coverage_area)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Coverage Area</label>
                            <div class="flex items-center">
                                <i class="fas fa-map text-blue-600 mr-2"></i>
                                <p class="text-gray-900">{{ $ambulance->coverage_area }}</p>
                            </div>
                        </div>
                        @endif
                        @if($ambulance->response_time)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Response Time</label>
                            <div class="flex items-center">
                                <i class="fas fa-clock text-yellow-600 mr-2"></i>
                                <p class="text-gray-900">{{ $ambulance->response_time }}</p>
                            </div>
                        </div>
                        @endif
                        @if($ambulance->distance_from_malioboro)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Distance from Malioboro</label>
                            <div class="flex items-center">
                                <i class="fas fa-route text-green-600 mr-2"></i>
                                <p class="text-gray-900">{{ $ambulance->distance_from_malioboro }}</p>
                            </div>
                        </div>
                        @endif
                        @if($ambulance->tariff_range)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Tariff Range</label>
                            <div class="flex items-center">
                                <i class="fas fa-dollar-sign text-red-600 mr-2"></i>
                                <p class="text-gray-900">{{ $ambulance->tariff_range }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Facilities -->
            @if($ambulance->facilities && count($ambulance->facilities) > 0)
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900 flex items-center">
                        <i class="fas fa-medical-kit text-red-600 mr-2"></i>
                        Facilities & Equipment
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        @foreach($ambulance->facilities as $facility)
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-check-circle text-green-600 mr-2"></i>
                            <span class="text-sm text-gray-900">{{ $facility }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="tel:{{ $ambulance->phone }}" 
                       class="w-full flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-phone mr-2"></i>
                        Call Now
                    </a>
                    @if($ambulance->whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ambulance->whatsapp) }}" 
                       target="_blank"
                       class="w-full flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fab fa-whatsapp mr-2"></i>
                        WhatsApp
                    </a>
                    @endif
                    <a href="{{ route('dashboardadmin.ambulance.edit', $ambulance) }}" 
                       class="w-full flex items-center justify-center px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors">
                        <i class="fas fa-edit mr-2"></i>
                        Edit Details
                    </a>
                </div>
            </div>

            <!-- Status Information -->
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Status Information</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Current Status</span>
                        {!! $ambulance->status_badge !!}
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Service Type</span>
                        {!! $ambulance->type_badge !!}
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Created</span>
                        <span class="text-sm text-gray-900">{{ $ambulance->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Last Updated</span>
                        <span class="text-sm text-gray-900">{{ $ambulance->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Emergency Notice -->
            <div class="bg-red-50 border border-red-200 rounded-lg">
                <div class="px-6 py-4 border-b border-red-200">
                    <h3 class="text-lg font-semibold text-red-900 flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Emergency Notice
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-red-800 mb-3">
                        <strong>For life-threatening emergencies:</strong>
                    </p>
                    <div class="space-y-2">
                        <div class="flex items-center">
                            <i class="fas fa-phone text-red-600 mr-2"></i>
                            <span class="text-sm text-red-800">Call 118 (National Ambulance)</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-red-600 mr-2"></i>
                            <span class="text-sm text-red-800">Call 119 (Fire & Rescue)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
