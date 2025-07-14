@extends('dashboardadmin.layouts.app')

@section('title', 'Add Medical Alter - Dashboard Admin')
@section('page-title', 'Add Medical Alter')
@section('page-description', 'Create new alternative medical treatment')

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
        <a href="{{ route('dashboardadmin.services.medicalalter.index') }}" class="text-gray-500 hover:text-gray-700">Medical Alter</a>
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
    <form action="{{ route('dashboardadmin.services.medicalalter.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-200 bg-yellow-50">
                <h2 class="text-xl font-semibold text-gray-900">
                    <i class="fas fa-pills mr-2 text-yellow-600"></i>Add New Medical Alter
                </h2>
                <p class="text-sm text-gray-600 mt-1">Fill in the information below to create a new alternative medical treatment</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 @error('name') border-red-500 @enderror"
                               placeholder="Enter medical alter name" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Type <span class="text-red-500">*</span>
                        </label>
                        <select name="type" id="type" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 @error('type') border-red-500 @enderror" required>
                            <option value="">Select Type</option>
                            <option value="Herbal Medicine" {{ old('type') == 'Herbal Medicine' ? 'selected' : '' }}>Herbal Medicine</option>
                            <option value="Acupuncture" {{ old('type') == 'Acupuncture' ? 'selected' : '' }}>Acupuncture</option>
                            <option value="Massage Therapy" {{ old('type') == 'Massage Therapy' ? 'selected' : '' }}>Massage Therapy</option>
                            <option value="Aromatherapy" {{ old('type') == 'Aromatherapy' ? 'selected' : '' }}>Aromatherapy</option>
                            <option value="Homeopathy" {{ old('type') == 'Homeopathy' ? 'selected' : '' }}>Homeopathy</option>
                            <option value="Chiropractic" {{ old('type') == 'Chiropractic' ? 'selected' : '' }}>Chiropractic</option>
                            <option value="Other" {{ old('type') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('type')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Introduction -->
                <div>
                    <label for="intro" class="block text-sm font-medium text-gray-700 mb-2">Introduction</label>
                    <textarea name="intro" id="intro" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 @error('intro') border-red-500 @enderror"
                              placeholder="Brief introduction about this medical alter">{{ old('intro') }}</textarea>
                    @error('intro')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Benefits -->
                <div>
                    <label for="benefits" class="block text-sm font-medium text-gray-700 mb-2">Benefits</label>
                    <textarea name="benefits" id="benefits" rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 @error('benefits') border-red-500 @enderror"
                              placeholder="List the benefits of this alternative treatment">{{ old('benefits') }}</textarea>
                    @error('benefits')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="5" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 @error('description') border-red-500 @enderror"
                              placeholder="Detailed description of the medical alter">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-yellow-400 transition-colors duration-200">
                        <div class="space-y-1 text-center">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-yellow-600 hover:text-yellow-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-yellow-500">
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
                        <i class="fas fa-search mr-2 text-yellow-600"></i>SEO Information
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                                   placeholder="SEO meta title">
                        </div>

                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                                      placeholder="SEO meta description">{{ old('meta_description') }}</textarea>
                        </div>

                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                                   placeholder="SEO keywords (comma separated)">
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="status" id="status" value="1" {{ old('status', 1) ? 'checked' : '' }}
                               class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded">
                        <label for="status" class="ml-2 block text-sm text-gray-900">
                            Active Status
                        </label>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Enable this medical alter to be visible to users</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('dashboardadmin.services.medicalalter.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors duration-200">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-save mr-2"></i>Create Medical Alter
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
