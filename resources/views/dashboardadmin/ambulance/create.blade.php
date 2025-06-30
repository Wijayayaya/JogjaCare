@extends('dashboardadmin.layouts.app')

@section('title', 'Add New Ambulance')
@section('page-title', 'Add New Ambulance')
@section('page-description', 'Create a new ambulance service')

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
        <span class="text-gray-500">Add New</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-3">
                    <i class="fas fa-plus text-sm"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold">Add New Ambulance Service</h2>
                    <p class="text-blue-100 text-sm">Fill in the details below to create a new ambulance service</p>
                </div>
            </div>
        </div>

        <form action="{{ route('dashboardadmin.ambulance.store') }}" method="POST" class="p-6">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                            Basic Information
                        </h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    Service Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                       placeholder="e.g., RSUP Dr. Sardjito Ambulance" required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Service Type <span class="text-red-500">*</span>
                                </label>
                                <select id="type" name="type" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('type') border-red-500 @enderror" required>
                                    <option value="">Select Type</option>
                                    <option value="emergency" {{ old('type') === 'emergency' ? 'selected' : '' }}>Emergency</option>
                                    <option value="hospital" {{ old('type') === 'hospital' ? 'selected' : '' }}>Hospital</option>
                                    <option value="private" {{ old('type') === 'private' ? 'selected' : '' }}>Private</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    Description
                                </label>
                                <textarea id="description" name="description" rows="3" 
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                                          placeholder="Brief description of the ambulance service">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-phone text-green-600 mr-2"></i>
                            Contact Information
                        </h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Phone Number <span class="text-red-500">*</span>
                                </label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror"
                                       placeholder="e.g., (0274) 587333" required>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-2">
                                    WhatsApp Number
                                </label>
                                <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('whatsapp') border-red-500 @enderror"
                                       placeholder="e.g., 0812-3456-7890">
                                @error('whatsapp')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                    Address
                                </label>
                                <textarea id="address" name="address" rows="3" 
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror"
                                          placeholder="Full address of the ambulance service">{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Service Details -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-cogs text-purple-600 mr-2"></i>
                            Service Details
                        </h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="coverage_area" class="block text-sm font-medium text-gray-700 mb-2">
                                    Coverage Area
                                </label>
                                <input type="text" id="coverage_area" name="coverage_area" value="{{ old('coverage_area') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('coverage_area') border-red-500 @enderror"
                                       placeholder="e.g., Yogyakarta & sekitarnya">
                                @error('coverage_area')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="response_time" class="block text-sm font-medium text-gray-700 mb-2">
                                    Response Time
                                </label>
                                <input type="text" id="response_time" name="response_time" value="{{ old('response_time') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('response_time') border-red-500 @enderror"
                                       placeholder="e.g., 10-15 menit">
                                @error('response_time')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="distance_from_malioboro" class="block text-sm font-medium text-gray-700 mb-2">
                                    Distance from Malioboro
                                </label>
                                <input type="text" id="distance_from_malioboro" name="distance_from_malioboro" value="{{ old('distance_from_malioboro') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('distance_from_malioboro') border-red-500 @enderror"
                                       placeholder="e.g., 3.2 km">
                                @error('distance_from_malioboro')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tariff_range" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tariff Range
                                </label>
                                <input type="text" id="tariff_range" name="tariff_range" value="{{ old('tariff_range') }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tariff_range') border-red-500 @enderror"
                                       placeholder="e.g., Rp 200.000 - Rp 500.000">
                                @error('tariff_range')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-medical-kit text-red-600 mr-2"></i>
                            Facilities & Equipment
                        </h3>
                        
                        <div class="space-y-3">
                            <div class="grid grid-cols-2 gap-3">
                                <label class="flex items-center">
                                    <input type="checkbox" name="facilities[]" value="ICU Mobile" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                           {{ in_array('ICU Mobile', old('facilities', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">ICU Mobile</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="facilities[]" value="Ventilator" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                           {{ in_array('Ventilator', old('facilities', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Ventilator</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="facilities[]" value="Defibrillator" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                           {{ in_array('Defibrillator', old('facilities', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Defibrillator</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="facilities[]" value="Oksigen" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                           {{ in_array('Oksigen', old('facilities', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Oksigen</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="facilities[]" value="Stretcher" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                           {{ in_array('Stretcher', old('facilities', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Stretcher</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="facilities[]" value="Cardiac Monitor" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                           {{ in_array('Cardiac Monitor', old('facilities', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Cardiac Monitor</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="facilities[]" value="Suction" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                           {{ in_array('Suction', old('facilities', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Suction</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="facilities[]" value="Basic Life Support" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                           {{ in_array('Basic Life Support', old('facilities', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Basic Life Support</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" name="facilities[]" value="Advanced Life Support" 
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                           {{ in_array('Advanced Life Support', old('facilities', [])) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm text-gray-700">Advanced Life Support</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-toggle-on text-green-600 mr-2"></i>
                            Status
                        </h3>
                        
                        <div class="flex items-center">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" id="is_active" name="is_active" value="1" 
                                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                   {{ old('is_active', '1') ? 'checked' : '' }}>
                            <label for="is_active" class="ml-2 text-sm text-gray-700">
                                Active (visible to users)
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('dashboardadmin.ambulance.index') }}" 
                   class="px-6 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition-colors">
                    Cancel
                </a>
                <button type="reset" 
                        class="px-6 py-2 text-yellow-700 bg-yellow-100 rounded-lg hover:bg-yellow-200 transition-colors">
                    Reset
                </button>
                <button type="submit" 
                        class="px-6 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i>
                    Create Ambulance
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Form validation and enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Auto-format phone numbers
    const phoneInputs = document.querySelectorAll('input[name="phone"], input[name="whatsapp"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', function() {
            // Remove non-numeric characters except parentheses, spaces, and dashes
            this.value = this.value.replace(/[^\d$$$$\s\-\+]/g, '');
        });
    });

    // Preview selected facilities
    const facilityCheckboxes = document.querySelectorAll('input[name="facilities[]"]');
    facilityCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateFacilityPreview();
        });
    });

    function updateFacilityPreview() {
        const selected = Array.from(facilityCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);
        
        console.log('Selected facilities:', selected);
    }
});
</script>
@endpush
