@extends('dashboardadmin.layouts.app')

@section('title', 'Add Medical Point - Dashboard Admin')
@section('page-title', 'Add Medical Point')
@section('page-description', 'Create new medical service point')

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
        <a href="{{ route('dashboardadmin.services.medicalpoint.index') }}" class="text-gray-500 hover:text-gray-700">Medical Point</a>
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
    <form action="{{ route('dashboardadmin.services.medicalpoint.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-green-50">
                <h2 class="text-xl font-semibold text-gray-900">
                    <i class="fas fa-map-marker-alt mr-2 text-green-600"></i>Add New Medical Point
                </h2>
                <p class="text-sm text-gray-600 mt-1">Fill in the information below to create a new medical service point</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('name') border-red-500 @enderror"
                               placeholder="Enter medical point name" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Type <span class="text-red-500">*</span>
                        </label>
                        <select name="type" id="type" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('type') border-red-500 @enderror" required>
                            <option value="">Select Type</option>
                            <option value="Hospital" {{ old('type') == 'Hospital' ? 'selected' : '' }}>Hospital</option>
                            <option value="Clinic" {{ old('type') == 'Clinic' ? 'selected' : '' }}>Clinic</option>
                            <option value="Pharmacy" {{ old('type') == 'Pharmacy' ? 'selected' : '' }}>Pharmacy</option>
                            <option value="Laboratory" {{ old('type') == 'Laboratory' ? 'selected' : '' }}>Laboratory</option>
                            <option value="Emergency Center" {{ old('type') == 'Emergency Center' ? 'selected' : '' }}>Emergency Center</option>
                            <option value="Specialist Center" {{ old('type') == 'Specialist Center' ? 'selected' : '' }}>Specialist Center</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Location Information -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        <i class="fas fa-map mr-2 text-green-600"></i>Location Information
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="district" class="block text-sm font-medium text-gray-700 mb-2">
                                District <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="district" id="district" value="{{ old('district') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('district') border-red-500 @enderror"
                                   placeholder="Enter district" required>
                            @error('district')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="sub_district" class="block text-sm font-medium text-gray-700 mb-2">
                                Sub District <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="sub_district" id="sub_district" value="{{ old('sub_district') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('sub_district') border-red-500 @enderror"
                                   placeholder="Enter sub district" required>
                            @error('sub_district')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            Address <span class="text-red-500">*</span>
                        </label>
                        <textarea name="address" id="address" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('address') border-red-500 @enderror"
                                  placeholder="Enter complete address" required>{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <label for="contact" class="block text-sm font-medium text-gray-700 mb-2">
                                Contact <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="contact" id="contact" value="{{ old('contact') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('contact') border-red-500 @enderror"
                                   placeholder="Phone number or email" required>
                            @error('contact')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="maps" class="block text-sm font-medium text-gray-700 mb-2">Maps URL</label>
                            <input type="url" name="maps" id="maps" value="{{ old('maps') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                   placeholder="Google Maps or other map service URL">
                        </div>
                    </div>
                </div>

                <!-- Content Information -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        <i class="fas fa-file-alt mr-2 text-green-600"></i>Content Information
                    </h3>

                    <div>
                        <label for="intro" class="block text-sm font-medium text-gray-700 mb-2">
                            Introduction <span class="text-red-500">*</span>
                        </label>
                        <textarea name="intro" id="intro" rows="3" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('intro') border-red-500 @enderror"
                                  placeholder="Brief introduction about this medical point" required>{{ old('intro') }}</textarea>
                        @error('intro')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" id="description" rows="5" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                  placeholder="Detailed description of services and facilities">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="border-t border-gray-200 pt-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors duration-200">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-green-500">
                                    <span>Upload a file</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- SEO Section -->
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">
                        <i class="fas fa-search mr-2 text-green-600"></i>SEO Information
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                   placeholder="SEO meta title">
                        </div>

                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                      placeholder="SEO meta description">{{ old('meta_description') }}</textarea>
                        </div>

                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                                   placeholder="SEO keywords (comma separated)">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('dashboardadmin.services.medicalpoint.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-save mr-2"></i>Create Medical Point
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
