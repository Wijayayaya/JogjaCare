@extends('dashboardadmin.layouts.app')

@section('title', 'Detail Artikel - Medical Services')
@section('page-title', 'Detail Artikel')
@section('page-description', 'Informasi lengkap artikel medis')

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
        <span class="text-gray-500">Detail Artikel</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    
    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 rounded-2xl shadow-xl overflow-hidden">
        <div class="px-8 py-6 text-white">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <i class="fas fa-newspaper text-2xl text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold mb-1">{{ $article->title }}</h1>
                        <div class="flex items-center space-x-4 text-blue-100">
                            <span class="flex items-center">
                                <i class="fas fa-user mr-2"></i>{{ $article->author }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-clock mr-2"></i>{{ $article->read_time }} min read
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-tag mr-2"></i>{{ $article->category }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    @if($article->is_active)
                        <span class="px-3 py-1 bg-green-500/20 text-green-100 rounded-full text-sm font-medium">
                            <i class="fas fa-eye mr-1"></i>Aktif
                        </span>
                    @else
                        <span class="px-3 py-1 bg-gray-500/20 text-gray-100 rounded-full text-sm font-medium">
                            <i class="fas fa-eye-slash mr-1"></i>Nonaktif
                        </span>
                    @endif
                    <span class="px-3 py-1 bg-white/20 text-white rounded-full text-sm font-medium">
                        <i class="fas fa-sort-numeric-up mr-1"></i>Urutan: {{ $article->order }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Article Content -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-100">
                    <h2 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-file-alt mr-3 text-blue-600"></i>
                        Konten Artikel
                    </h2>
                </div>
                <div class="p-6">
                    @if($article->excerpt)
                        <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg">
                            <h3 class="font-semibold text-blue-900 mb-2 flex items-center">
                                <i class="fas fa-quote-left mr-2"></i>Ringkasan
                            </h3>
                            <p class="text-blue-800 leading-relaxed">{{ $article->excerpt }}</p>
                        </div>
                    @endif
                    
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $article->content }}</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-green-100">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-cogs mr-3 text-green-600"></i>
                        Aksi Cepat
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('dashboardadmin.articles.edit', $article) }}" 
                       class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:from-blue-600 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-edit mr-2"></i>Edit Artikel
                    </a>
                    
                    <form action="{{ route('dashboardadmin.articles.toggle-status', $article) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-3 {{ $article->is_active ? 'bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600' : 'bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600' }} text-white rounded-xl transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-{{ $article->is_active ? 'eye-slash' : 'eye' }} mr-2"></i>
                            {{ $article->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                    
                    <form action="{{ route('dashboardadmin.articles.destroy', $article) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <i class="fas fa-trash mr-2"></i>Hapus Artikel
                        </button>
                    </form>
                </div>
            </div>

            <!-- Article Info -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-purple-100">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-info-circle mr-3 text-purple-600"></i>
                        Informasi Artikel
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <span class="text-gray-600 flex items-center">
                            <i class="fas fa-palette mr-2 text-{{ $article->icon_color }}-500"></i>Warna Icon
                        </span>
                        <div class="flex items-center space-x-2">
                            <div class="w-4 h-4 bg-{{ $article->icon_color }}-500 rounded-full"></div>
                            <span class="text-gray-900 font-medium capitalize">{{ $article->icon_color }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <span class="text-gray-600 flex items-center">
                            <i class="fas fa-calendar-plus mr-2 text-blue-500"></i>Dibuat
                        </span>
                        <span class="text-gray-900 font-medium">{{ $article->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <span class="text-gray-600 flex items-center">
                            <i class="fas fa-calendar-edit mr-2 text-green-500"></i>Diperbarui
                        </span>
                        <span class="text-gray-900 font-medium">{{ $article->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between py-3">
                        <span class="text-gray-600 flex items-center">
                            <i class="fas fa-hashtag mr-2 text-purple-500"></i>ID Artikel
                        </span>
                        <span class="text-gray-900 font-medium">#{{ $article->id }}</span>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                        <i class="fas fa-compass mr-3 text-gray-600"></i>
                        Navigasi
                    </h3>
                </div>
                <div class="p-6 space-y-3">
                    <a href="{{ route('dashboardadmin.articles.index') }}" 
                       class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-gray-500 to-gray-600 text-white rounded-xl hover:from-gray-600 hover:to-gray-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-list mr-2"></i>Kembali ke Daftar
                    </a>
                    
                    <a href="{{ route('dashboardadmin.articles.create') }}" 
                       class="w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <i class="fas fa-plus mr-2"></i>Tambah Artikel Baru
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

@if(session('success'))
<div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-bounce">
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif
@endsection
