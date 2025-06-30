@extends('dashboardadmin.layouts.app')

@section('title', 'Medical Cost - Details')
@section('page-title', 'Medical Cost Details')
@section('page-description', 'View medical service cost information')

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
        <a href="{{ route('dashboardadmin.services.medicalcost.index') }}" class="text-gray-500 hover:text-gray-700">Medical Cost</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Details</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header Card -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 rounded-lg mr-4">
                        <i class="fas fa-dollar-sign text-red-600 text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $medicalCost->name }}</h1>
                        <div class="flex items-center mt-2">
                            @if($medicalCost->status)
                                <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 rounded-full">
                                    <i class="fas fa-check-circle mr-1"></i>Active
                                </span>
                            @else
                                <span class="px-3 py-1 text-sm font-medium bg-red-100 text-red-800 rounded-full">
                                    <i class="fas fa-times-circle mr-1"></i>Inactive
                                </span>
                            @endif
                            <span class="ml-4 text-sm text-gray-500">ID: {{ $medicalCost->id }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboardadmin.services.medicalcost.edit', $medicalCost->id) }}" 
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <form action="{{ route('dashboardadmin.services.medicalcost.destroy', $medicalCost->id) }}" 
                          method="POST" class="inline-block" 
                          onsubmit="return confirm('Are you sure you want to delete this medical cost?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                            <i class="fas fa-trash mr-2"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Price Range Display -->
        <div class="p-6">
            <div class="bg-gradient-to-r from-green-50 to-red-50 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Price Range</h2>
                <div class="flex items-center justify-center space-x-8">
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-1">Lowest Price</p>
                        <p class="text-3xl font-bold text-green-600">{{ $medicalCost->formatted_lowest_price }}</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-16 h-1 bg-gradient-to-r from-green-400 to-red-400 rounded"></div>
                    </div>
                    <div class="text-center">
                        <p class="text-sm text-gray-600 mb-1">Highest Price</p>
                        <p class="text-3xl font-bold text-red-600">{{ $medicalCost->formatted_highest_price }}</p>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Price difference: 
                        <span class="font-semibold text-gray-900">
                            Rp {{ number_format($medicalCost->highest_price - $medicalCost->lowest_price, 0, ',', '.') }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>Basic Information
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Service Name:</span>
                    <span class="text-sm text-gray-900 font-semibold">{{ $medicalCost->name }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Status:</span>
                    <span>
                        @if($medicalCost->status)
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                Active
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                Inactive
                            </span>
                        @endif
                    </span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Lowest Price:</span>
                    <span class="text-sm font-bold text-green-600">{{ $medicalCost->formatted_lowest_price }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Highest Price:</span>
                    <span class="text-sm font-bold text-red-600">{{ $medicalCost->formatted_highest_price }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm font-medium text-gray-600">Average Price:</span>
                    <span class="text-sm font-bold text-blue-600">
                        Rp {{ number_format(($medicalCost->lowest_price + $medicalCost->highest_price) / 2, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-cog text-gray-600 mr-2"></i>System Information
                </h2>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">ID:</span>
                    <span class="text-sm text-gray-900 font-mono">{{ $medicalCost->id }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Created Date:</span>
                    <span class="text-sm text-gray-900">{{ $medicalCost->created_at->format('F d, Y H:i') }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Last Updated:</span>
                    <span class="text-sm text-gray-900">{{ $medicalCost->updated_at->format('F d, Y H:i') }}</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Created By:</span>
                    <span class="text-sm text-gray-900">{{ $medicalCost->created_by ?? 'System' }}</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm font-medium text-gray-600">Updated By:</span>
                    <span class="text-sm text-gray-900">{{ $medicalCost->updated_by ?? 'N/A' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center justify-between">
            <a href="{{ route('dashboardadmin.services.medicalcost.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                <i class="fas fa-arrow-left mr-2"></i>Back to List
            </a>
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboardadmin.services.medicalcost.edit', $medicalCost->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                    <i class="fas fa-edit mr-2"></i>Edit Medical Cost
                </a>
                <form action="{{ route('dashboardadmin.services.medicalcost.destroy', $medicalCost->id) }}" 
                      method="POST" class="inline-block" 
                      onsubmit="return confirm('Are you sure you want to delete this medical cost? This action cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                        <i class="fas fa-trash mr-2"></i>Delete Medical Cost
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add any interactive features here if needed
    console.log('Medical Cost details page loaded');
});
</script>
@endpush
