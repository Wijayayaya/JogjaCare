@extends('dashboardadmin.layouts.app')

@section('title', 'Medical Cost - Edit')
@section('page-title', 'Edit Medical Cost')
@section('page-description', 'Update medical service cost information')

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
        <span class="text-gray-500">Edit</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="p-2 bg-red-100 rounded-lg mr-3">
                        <i class="fas fa-edit text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Edit Medical Cost</h1>
                        <p class="text-sm text-gray-500">Update medical service cost information</p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">ID: {{ $medicalCost->id }}</p>
                    <p class="text-sm text-gray-500">Created: {{ $medicalCost->created_at->format('M d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('dashboardadmin.services.medicalcost.update', $medicalCost->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Service Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Service Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name', $medicalCost->name) }}"
                               placeholder="e.g., General Consultation, Blood Test, X-Ray"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" 
                                name="status" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('status') border-red-500 @enderror">
                            <option value="">Select Status</option>
                            <option value="1" {{ old('status', $medicalCost->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $medicalCost->status) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Lowest Price -->
                    <div>
                        <label for="lowest_price" class="block text-sm font-medium text-gray-700 mb-2">
                            Lowest Price (Rp) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-500">Rp</span>
                            <input type="number" 
                                   id="lowest_price" 
                                   name="lowest_price" 
                                   value="{{ old('lowest_price', $medicalCost->lowest_price) }}"
                                   placeholder="0"
                                   min="0"
                                   step="0.01"
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('lowest_price') border-red-500 @enderror">
                        </div>
                        @error('lowest_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Highest Price -->
                    <div>
                        <label for="highest_price" class="block text-sm font-medium text-gray-700 mb-2">
                            Highest Price (Rp) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-3 text-gray-500">Rp</span>
                            <input type="number" 
                                   id="highest_price" 
                                   name="highest_price" 
                                   value="{{ old('highest_price', $medicalCost->highest_price) }}"
                                   placeholder="0"
                                   min="0"
                                   step="0.01"
                                   class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 @error('highest_price') border-red-500 @enderror">
                        </div>
                        @error('highest_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-sm text-gray-500">Must be greater than or equal to lowest price</p>
                    </div>
                </div>
            </div>

            <!-- Price Range Preview -->
            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Price Range Preview</h3>
                <div class="flex items-center space-x-2">
                    <span class="text-lg font-semibold text-green-600" id="preview-lowest">{{ $medicalCost->formatted_lowest_price }}</span>
                    <span class="text-gray-500">-</span>
                    <span class="text-lg font-semibold text-red-600" id="preview-highest">{{ $medicalCost->formatted_highest_price }}</span>
                </div>
                <p class="text-sm text-gray-500 mt-1" id="price-validation-message"></p>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('dashboardadmin.services.medicalcost.index') }}" 
                   class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                    <i class="fas fa-times mr-2"></i>Cancel
                </a>
                <a href="{{ route('dashboardadmin.services.medicalcost.show', $medicalCost->id) }}" 
                   class="px-6 py-3 border border-blue-300 text-blue-700 rounded-lg hover:bg-blue-50 transition duration-200">
                    <i class="fas fa-eye mr-2"></i>View Details
                </a>
                <button type="submit" 
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition duration-200">
                    <i class="fas fa-save mr-2"></i>Update Medical Cost
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const lowestPriceInput = document.getElementById('lowest_price');
    const highestPriceInput = document.getElementById('highest_price');
    const previewLowest = document.getElementById('preview-lowest');
    const previewHighest = document.getElementById('preview-highest');
    const validationMessage = document.getElementById('price-validation-message');

    function formatCurrency(amount) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount || 0);
    }

    function updatePreview() {
        const lowestPrice = parseFloat(lowestPriceInput.value) || 0;
        const highestPrice = parseFloat(highestPriceInput.value) || 0;

        previewLowest.textContent = formatCurrency(lowestPrice);
        previewHighest.textContent = formatCurrency(highestPrice);

        // Validation
        if (lowestPrice > 0 && highestPrice > 0) {
            if (highestPrice < lowestPrice) {
                validationMessage.textContent = '⚠️ Highest price must be greater than or equal to lowest price';
                validationMessage.className = 'text-sm text-red-500 mt-1';
                highestPriceInput.classList.add('border-red-500');
            } else {
                validationMessage.textContent = '✅ Price range is valid';
                validationMessage.className = 'text-sm text-green-500 mt-1';
                highestPriceInput.classList.remove('border-red-500');
            }
        } else {
            validationMessage.textContent = '';
            highestPriceInput.classList.remove('border-red-500');
        }
    }

    lowestPriceInput.addEventListener('input', updatePreview);
    highestPriceInput.addEventListener('input', updatePreview);

    // Initial preview update
    updatePreview();

    // Form validation before submit
    document.querySelector('form').addEventListener('submit', function(e) {
        const lowestPrice = parseFloat(lowestPriceInput.value) || 0;
        const highestPrice = parseFloat(highestPriceInput.value) || 0;

        if (lowestPrice > 0 && highestPrice > 0 && highestPrice < lowestPrice) {
            e.preventDefault();
            alert('Highest price must be greater than or equal to lowest price');
            highestPriceInput.focus();
        }
    });
});
</script>
@endpush
