@extends('dashboardadmin.layouts.app')

@section('title', 'Article Management - Medical Services')
@section('page-title', 'Article Management')
@section('page-description', 'Kelola Artikel Medis')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Article Management</span>
    </div>
</li>
@endsection

@section('content')
<div class="bg-white rounded-lg shadow-lg">
    <!-- Header -->
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-gray-900">
                    <i class="fas fa-newspaper mr-2 text-blue-600"></i>
                    Daftar Artikel Medis
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola artikel untuk edukasi kesehatan</p>
            </div>
            <a href="{{ route('dashboardadmin.articles.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                <i class="fas fa-plus mr-2"></i>Tambah Artikel
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mx-6 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Articles Table -->
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        #
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Artikel
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Kategori
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Penulis
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Urutan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($articles as $article)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $loop->iteration + ($articles->currentPage() - 1) * $articles->perPage() }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-{{ $article->icon_color }}-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-newspaper text-{{ $article->icon_color }}-600"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">
                                    {{ Str::limit($article->title, 50) }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $article->read_time }} min read
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                            {{ $article->category }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $article->author }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($article->is_active)
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                <i class="fas fa-eye mr-1"></i>Aktif
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                <i class="fas fa-eye-slash mr-1"></i>Nonaktif
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $article->order }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('dashboardadmin.articles.show', $article) }}" 
                               class="text-blue-600 hover:text-blue-900" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('dashboardadmin.articles.edit', $article) }}" 
                               class="text-green-600 hover:text-green-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dashboardadmin.articles.toggle-status', $article) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="text-yellow-600 hover:text-yellow-900" 
                                        title="{{ $article->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <i class="fas fa-{{ $article->is_active ? 'toggle-on' : 'toggle-off' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('dashboardadmin.articles.destroy', $article) }}" 
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <i class="fas fa-newspaper text-4xl mb-4"></i>
                            <p class="text-lg font-medium">Belum ada artikel</p>
                            <p class="text-sm">Mulai dengan menambahkan artikel pertama Anda</p>
                            <a href="{{ route('dashboardadmin.articles.create') }}" 
                               class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-plus mr-2"></i>Tambah Artikel
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection
