@extends('dashboardadmin.layouts.app')

@section('title', 'Edit Artikel - Medical Services')
@section('page-title', 'Edit Artikel')
@section('page-description', 'Perbarui artikel medis')

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
        <span class="text-gray-500">Edit Artikel</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="grid lg:grid-cols-3 gap-8">
        
        <!-- Main Form -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header -->
                <div class="px-8 py-6 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600">
                    <div class="flex items-center text-white">
                        <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-edit text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold">Edit Artikel</h1>
                            <p class="text-blue-100 mt-1">Perbarui informasi artikel medis</p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('dashboardadmin.articles.update', $article) }}" method="POST" class="p-8 space-y-8">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-info-circle text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Informasi Dasar</h2>
                                <p class="text-gray-600 text-sm">Data utama artikel</p>
                            </div>
                        </div>

                        <!-- Title -->
                        <div class="space-y-2">
                            <label for="title" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-heading mr-2 text-blue-500"></i>Judul Artikel
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="title" id="title" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('title') border-red-500 @enderror"
                                   value="{{ old('title', $article->title) }}" 
                                   placeholder="Masukkan judul artikel yang menarik...">
                            @error('title')
                                <p class="text-red-500 text-sm flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Author -->
                        <div class="space-y-2">
                            <label for="author" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-user mr-2 text-green-500"></i>Penulis
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="author" id="author" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('author') border-red-500 @enderror"
                                   value="{{ old('author', $article->author) }}" 
                                   placeholder="Dr. John Doe">
                            @error('author')
                                <p class="text-red-500 text-sm flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Category and Icon Color -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="category" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-tag mr-2 text-purple-500"></i>Kategori
                                    <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="category" id="category" 
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('category') border-red-500 @enderror"
                                       value="{{ old('category', $article->category) }}" 
                                       placeholder="Kardiologi, Neurologi, dll">
                                @error('category')
                                    <p class="text-red-500 text-sm flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="icon_color" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-palette mr-2 text-orange-500"></i>Warna Icon
                                </label>
                                <select name="icon_color" id="icon_color" 
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('icon_color') border-red-500 @enderror">
                                    <option value="blue" {{ old('icon_color', $article->icon_color) === 'blue' ? 'selected' : '' }}>🔵 Biru</option>
                                    <option value="green" {{ old('icon_color', $article->icon_color) === 'green' ? 'selected' : '' }}>🟢 Hijau</option>
                                    <option value="purple" {{ old('icon_color', $article->icon_color) === 'purple' ? 'selected' : '' }}>🟣 Ungu</option>
                                    <option value="orange" {{ old('icon_color', $article->icon_color) === 'orange' ? 'selected' : '' }}>🟠 Orange</option>
                                    <option value="red" {{ old('icon_color', $article->icon_color) === 'red' ? 'selected' : '' }}>🔴 Merah</option>
                                    <option value="indigo" {{ old('icon_color', $article->icon_color) === 'indigo' ? 'selected' : '' }}>🟦 Indigo</option>
                                    <option value="pink" {{ old('icon_color', $article->icon_color) === 'pink' ? 'selected' : '' }}>🩷 Pink</option>
                                    <option value="yellow" {{ old('icon_color', $article->icon_color) === 'yellow' ? 'selected' : '' }}>🟡 Kuning</option>
                                </select>
                                @error('icon_color')
                                    <p class="text-red-500 text-sm flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <!-- Read Time and Order -->
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="read_time" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-clock mr-2 text-blue-500"></i>Waktu Baca (menit)
                                </label>
                                <input type="number" name="read_time" id="read_time" min="1" max="60"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('read_time') border-red-500 @enderror"
                                       value="{{ old('read_time', $article->read_time) }}">
                                @error('read_time')
                                    <p class="text-red-500 text-sm flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="order" class="block text-sm font-semibold text-gray-700">
                                    <i class="fas fa-sort-numeric-up mr-2 text-purple-500"></i>Urutan Tampil
                                </label>
                                <input type="number" name="order" id="order" min="0" 
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 @error('order') border-red-500 @enderror"
                                       value="{{ old('order', $article->order) }}">
                                <p class="text-xs text-gray-500 mt-1">Semakin kecil angka, semakin awal ditampilkan</p>
                                @error('order')
                                    <p class="text-red-500 text-sm flex items-center mt-1">
                                        <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Content Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-r from-green-500 to-emerald-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Konten Artikel</h2>
                                <p class="text-gray-600 text-sm">Ringkasan dan isi artikel</p>
                            </div>
                        </div>

                        <!-- Excerpt -->
                        <div class="space-y-2">
                            <label for="excerpt" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-quote-left mr-2 text-indigo-500"></i>Ringkasan Artikel
                            </label>
                            <textarea name="excerpt" id="excerpt" rows="4" 
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 resize-none @error('excerpt') border-red-500 @enderror"
                                      placeholder="Ringkasan singkat yang menarik untuk artikel ini...">{{ old('excerpt', $article->excerpt) }}</textarea>
                            @error('excerpt')
                                <p class="text-red-500 text-sm flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="space-y-2">
                            <label for="content" class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-file-alt mr-2 text-blue-500"></i>Konten Artikel
                                <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content" id="content" rows="20" 
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-500 transition-all duration-200 resize-none @error('content') border-red-500 @enderror"
                                      placeholder="Tulis konten artikel lengkap di sini...">{{ old('content', $article->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-sm flex items-center mt-1">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Settings Section -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-cog text-white"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900">Pengaturan</h2>
                                <p class="text-gray-600 text-sm">Status dan visibilitas artikel</p>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" 
                                       class="w-5 h-5 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2"
                                       {{ old('is_active', $article->is_active) ? 'checked' : '' }}>
                                <div class="ml-3">
                                    <span class="text-sm font-semibold text-gray-700 flex items-center">
                                        <i class="fas fa-eye mr-2 text-green-500"></i>Aktifkan artikel ini
                                    </span>
                                    <p class="text-xs text-gray-500 mt-1">Artikel yang aktif akan ditampilkan di frontend</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end space-x-4 pt-8 border-t border-gray-200">
                        <a href="{{ route('dashboardadmin.articles.show', $article) }}" 
                           class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200 font-medium">
                            <i class="fas fa-eye mr-2"></i>Lihat Detail
                        </a>
                        <a href="{{ route('dashboardadmin.articles.index') }}" 
                           class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition-all duration-200 font-medium">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                        <button type="submit" 
                                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 font-medium">
                            <i class="fas fa-save mr-2"></i>Perbarui Artikel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Current Data Preview -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-indigo-100">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-eye mr-3 text-indigo-600"></i>
                        Data Saat Ini
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-{{ $article->icon_color }}-100 rounded-lg flex items-center justify-center">
                            <i class="fas fa-newspaper text-{{ $article->icon_color }}-600 text-sm"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">{{ $article->title }}</p>
                            <p class="text-xs text-gray-500">{{ $article->category }}</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-blue-600">{{ $article->read_time }}</p>
                            <p class="text-xs text-gray-500">Menit Baca</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-purple-600">{{ $article->order }}</p>
                            <p class="text-xs text-gray-500">Urutan</p>
                        </div>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Status</span>
                            @if($article->is_active)
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                    <i class="fas fa-eye mr-1"></i>Aktif
                                </span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">
                                    <i class="fas fa-eye-slash mr-1"></i>Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Live Preview -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-desktop mr-3 text-green-600"></i>
                        Preview Live
                    </h3>
                </div>
                <div class="p-6">
                    <div id="live-preview" class="border-2 border-dashed border-gray-200 rounded-xl p-4 min-h-[200px]">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-newspaper text-blue-600 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900 text-sm" id="preview-title">{{ $article->title }}</h4>
                                <p class="text-xs text-gray-500" id="preview-category">{{ $article->category }}</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-600 mb-2" id="preview-excerpt">{{ $article->excerpt }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span id="preview-author">{{ $article->author }}</span>
                            <span id="preview-read-time">{{ $article->read_time }} min</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-link mr-3 text-gray-600"></i>
                        Tautan Cepat
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('dashboardadmin.articles.index') }}" 
                       class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:from-gray-600 hover:to-gray-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-list mr-2"></i>Daftar Artikel
                    </a>
                    
                    <a href="{{ route('dashboardadmin.articles.create') }}" 
                       class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-plus mr-2"></i>Artikel Baru
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
// Live Preview Update
document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const categoryInput = document.getElementById('category');
    const authorInput = document.getElementById('author');
    const excerptInput = document.getElementById('excerpt');
    const readTimeInput = document.getElementById('read_time');
    
    const previewTitle = document.getElementById('preview-title');
    const previewCategory = document.getElementById('preview-category');
    const previewAuthor = document.getElementById('preview-author');
    const previewExcerpt = document.getElementById('preview-excerpt');
    const previewReadTime = document.getElementById('preview-read-time');
    
    function updatePreview() {
        previewTitle.textContent = titleInput.value || 'Judul Artikel';
        previewCategory.textContent = categoryInput.value || 'Kategori';
        previewAuthor.textContent = authorInput.value || 'Penulis';
        previewExcerpt.textContent = excerptInput.value || 'Ringkasan artikel akan muncul di sini...';
        previewReadTime.textContent = (readTimeInput.value || '5') + ' min';
    }
    
    titleInput.addEventListener('input', updatePreview);
    categoryInput.addEventListener('input', updatePreview);
    authorInput.addEventListener('input', updatePreview);
    excerptInput.addEventListener('input', updatePreview);
    readTimeInput.addEventListener('input', updatePreview);
});
</script>

@if(session('success'))
<div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-bounce">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif
@endsection
