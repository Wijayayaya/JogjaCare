@extends('dashboardadmin.layouts.app')

@section('title', 'Edit Medical Center - Medical Services')
@section('page-title', 'Edit Medical Center')
@section('page-description', 'Update medical center information')

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
        <span class="text-gray-500">Edit</span>
    </div>
</li>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-lg">
    <!-- Header -->
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">
                    <i class="fas fa-hospital text-purple-600 mr-2"></i>Edit Medical Center
                </h2>
                <p class="text-gray-600 mt-1">Update the information below to modify the medical center</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('dashboardadmin.services.medicalcenter.show', $medicalCenter->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-eye mr-2"></i>View
                </a>
                <a href="{{ route('dashboardadmin.services.medicalcenter.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('dashboardadmin.services.medicalcenter.update', $medicalCenter->id) }}" method="POST" enctype="multipart/form-data" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div class="space-y-6">
                <!-- Basic Information -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h3>
                    
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Medical Center Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $medicalCenter->name) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div class="mb-4">
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Type <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="type" name="type" value="{{ old('type', $medicalCenter->type) }}" required
                               placeholder="e.g., Hospital, Clinic, Health Center"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('type') border-red-500 @enderror">
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" name="status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('status') border-red-500 @enderror">
                            <option value="1" {{ old('status', $medicalCenter->status) == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $medicalCenter->status) == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Location Information -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Location Information</h3>
                    
                    <!-- District -->
                    <div class="mb-4">
                        <label for="district" class="block text-sm font-medium text-gray-700 mb-2">
                            District <span class="text-red-500">*</span>
                        </label>
                        <select id="district" name="district" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('district') border-red-500 @enderror">
                            <option value="">Select District</option>
                            @foreach($districts as $district)
                                <option value="{{ $district }}" {{ old('district', $medicalCenter->district) == $district ? 'selected' : '' }}>
                                    {{ $district }}
                                </option>
                            @endforeach
                        </select>
                        @error('district')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sub District -->
                    <div class="mb-4">
                        <label for="sub_district" class="block text-sm font-medium text-gray-700 mb-2">
                            Sub District <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="sub_district" name="sub_district" value="{{ old('sub_district', $medicalCenter->sub_district) }}" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('sub_district') border-red-500 @enderror">
                        @error('sub_district')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            Address <span class="text-red-500">*</span>
                        </label>
                        <textarea id="address" name="address" rows="3" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('address') border-red-500 @enderror">{{ old('address', $medicalCenter->address) }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Maps URL -->
                    <div class="mb-4">
                        <label for="maps" class="block text-sm font-medium text-gray-700 mb-2">
                            Google Maps URL
                        </label>
                        <input type="url" id="maps" name="maps" value="{{ old('maps', $medicalCenter->maps) }}"
                               placeholder="https://maps.google.com/..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('maps') border-red-500 @enderror">
                        @error('maps')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact -->
                    <div class="mb-4">
                        <label for="contact" class="block text-sm font-medium text-gray-700 mb-2">
                            Contact <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="contact" name="contact" value="{{ old('contact', $medicalCenter->contact) }}" required
                               placeholder="Phone number or email"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('contact') border-red-500 @enderror">
                        @error('contact')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <!-- Image Upload -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Image</h3>
                    
                    @if($medicalCenter->image)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                            <img src="{{ asset($medicalCenter->image) }}" alt="{{ $medicalCenter->name }}" 
                                 class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                        </div>
                    @endif
                    
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $medicalCenter->image ? 'Change Image' : 'Medical Center Image' }}
                        </label>
                        <input type="file" id="image" name="image" accept="image/*"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('image') border-red-500 @enderror">
                        <p class="text-sm text-gray-500 mt-1">Supported formats: JPEG, PNG, JPG, GIF. Max size: 2MB</p>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Content -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Content</h3>
                    
                    <!-- Intro -->
                    <div class="mb-4">
                        <label for="intro" class="block text-sm font-medium text-gray-700 mb-2">
                            Introduction <span class="text-red-500">*</span>
                        </label>
                        <textarea id="intro" name="intro" rows="3" required
                                  placeholder="Brief introduction about the medical center"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('intro') border-red-500 @enderror">{{ old('intro', $medicalCenter->intro) }}</textarea>
                        @error('intro')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea id="description" name="description" rows="5"
                                  placeholder="Detailed description about the medical center"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $medicalCenter->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- SEO Information -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO Information</h3>
                    
                    <!-- Meta Title -->
                    <div class="mb-4">
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Title
                        </label>
                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $medicalCenter->meta_title) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('meta_title') border-red-500 @enderror">
                        @error('meta_title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Description -->
                    <div class="mb-4">
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Description
                        </label>
                        <textarea id="meta_description" name="meta_description" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('meta_description') border-red-500 @enderror">{{ old('meta_description', $medicalCenter->meta_description) }}</textarea>
                        @error('meta_description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Meta Keywords -->
                    <div class="mb-4">
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Keywords
                        </label>
                        <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $medicalCenter->meta_keywords) }}"
                               placeholder="keyword1, keyword2, keyword3"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('meta_keywords') border-red-500 @enderror">
                        @error('meta_keywords')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
            <a href="{{ route('dashboardadmin.services.medicalcenter.index') }}" 
               class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-200">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition duration-200">
                <i class="fas fa-save mr-2"></i>Update Medical Center
            </button>
        </div>
    </form>
</div>
@endsection
