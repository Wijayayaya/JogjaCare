@extends('dashboardadmin.layouts.app')

@section('title', 'Tambah Artikel - Medical Services')
@section('page-title', 'Tambah Artikel')
@section('page-description', 'Buat artikel medis baru')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('dashboardadmin.articles.index') }}" class="text-blue-600 hover:text-blue-800">Article Management</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Tambah Artikel</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">
                <i class="fas fa-plus-circle mr-2 text-green-600"></i>
                Tambah Artikel Baru
            </h2>
            <p class="text-sm text-gray-600 mt-1">Buat artikel medis untuk edukasi kesehatan</p>
        </div>

        <!-- Form -->
        <form action="{{ route('dashboardadmin.articles.store') }}" method="POST" class="p-6">
            @csrf
            
            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-heading mr-2 text-blue-600"></i>Judul Artikel
                </label>
                <input type="text" name="title" id="title" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                       value="{{ old('title') }}" placeholder="Masukkan judul artikel...">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Author -->
            <div class="mb-6">
                <label for="author" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user mr-2 text-green-600"></i>Penulis
                </label>
                <input type="text" name="author" id="author" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('author') border-red-500 @enderror"
                       value="{{ old('author') }}" placeholder="Nama penulis artikel...">
                @error('author')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category and Icon Color -->
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-tag mr-2 text-purple-600"></i>Kategori
                    </label>
                    <input type="text" name="category" id="category" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('category') border-red-500 @enderror"
                           value="{{ old('category') }}" placeholder="Kategori artikel...">
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="icon_color" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-palette mr-2 text-orange-600"></i>Warna Icon
                    </label>
                    <select name="icon_color" id="icon_color" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('icon_color') border-red-500 @enderror">
                        <option value="blue" {{ old('icon_color') === 'blue' ? 'selected' : '' }}>Biru</option>
                        <option value="green" {{ old('icon_color') === 'green' ? 'selected' : '' }}>Hijau</option>
                        <option value="purple" {{ old('icon_color') === 'purple' ? 'selected' : '' }}>Ungu</option>
                        <option value="orange" {{ old('icon_color') === 'orange' ? 'selected' : '' }}>Orange</option>
                        <option value="red" {{ old('icon_color') === 'red' ? 'selected' : '' }}>Merah</option>
                        <option value="indigo" {{ old('icon_color') === 'indigo' ? 'selected' : '' }}>Indigo</option>
                        <option value="pink" {{ old('icon_color') === 'pink' ? 'selected' : '' }}>Pink</option>
                        <option value="yellow" {{ old('icon_color') === 'yellow' ? 'selected' : '' }}>Kuning</option>
                    </select>
                    @error('icon_color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Read Time and Order -->
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="read_time" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-clock mr-2 text-blue-600"></i>Waktu Baca (menit)
                    </label>
                    <input type="number" name="read_time" id="read_time" min="1" max="60"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('read_time') border-red-500 @enderror"
                           value="{{ old('read_time', 5) }}">
                    @error('read_time')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-sort-numeric-up mr-2 text-purple-600"></i>Urutan Tampil
                    </label>
                    <input type="number" name="order" id="order" min="0" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('order') border-red-500 @enderror"
                           value="{{ old('order', 0) }}">
                    <p class="mt-1 text-xs text-gray-500">Semakin kecil angka, semakin awal ditampilkan</p>
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Excerpt -->
            <div class="mb-6">
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-quote-left mr-2 text-indigo-600"></i>Ringkasan Artikel
                </label>
                <textarea name="excerpt" id="excerpt" rows="3" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('excerpt') border-red-500 @enderror"
                          placeholder="Ringkasan singkat artikel yang akan ditampilkan...">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-file-alt mr-2 text-blue-600"></i>Konten Artikel
                </label>
                <textarea name="content" id="content" rows="15" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror"
                          placeholder="Tulis konten artikel lengkap di sini...">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" 
                           class="text-green-600 focus:ring-green-500 rounded"
                           {{ old('is_active', true) ? 'checked' : '' }}>
                    <span class="ml-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-eye mr-1 text-green-600"></i>Aktifkan artikel ini
                    </span>
                </label>
                <p class="mt-1 text-xs text-gray-500">Artikel yang aktif akan ditampilkan di frontend</p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('dashboardadmin.articles.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-save mr-2"></i>Simpan Artikel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
