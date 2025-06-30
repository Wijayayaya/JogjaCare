@extends('dashboardadmin.layouts.app')

@section('title', 'Quiz Management - Medical Services')
@section('page-title', 'Quiz Management')
@section('page-description', 'Kelola Quiz Kesehatan')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Quiz Management</span>
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
                    <i class="fas fa-question-circle mr-2 text-blue-600"></i>
                    Daftar Quiz Kesehatan
                </h2>
                <p class="text-sm text-gray-600 mt-1">Kelola pertanyaan quiz untuk edukasi kesehatan</p>
            </div>
            <a href="{{ route('dashboardadmin.quiz.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                <i class="fas fa-plus mr-2"></i>Tambah Quiz
            </a>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mx-6 mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Quiz Table -->
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        #
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Pertanyaan
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Jawaban
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
                @forelse($quizzes as $quiz)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $loop->iteration + ($quizzes->currentPage() - 1) * $quizzes->perPage() }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900">
                            {{ Str::limit($quiz->question, 80) }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($quiz->answer === 'Fakta')
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                <i class="fas fa-check mr-1"></i>Fakta
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded-full">
                                <i class="fas fa-times mr-1"></i>Mitos
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($quiz->is_active)
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
                        {{ $quiz->order }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('dashboardadmin.quiz.show', $quiz) }}" 
                               class="text-blue-600 hover:text-blue-900" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('dashboardadmin.quiz.edit', $quiz) }}" 
                               class="text-green-600 hover:text-green-900" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('dashboardadmin.quiz.toggle-status', $quiz) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="text-yellow-600 hover:text-yellow-900" 
                                        title="{{ $quiz->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <i class="fas fa-{{ $quiz->is_active ? 'toggle-on' : 'toggle-off' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('dashboardadmin.quiz.destroy', $quiz) }}" 
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus quiz ini?')">
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
                    <td colspan="6" class="px-6 py-12 text-center">
                        <div class="text-gray-400">
                            <i class="fas fa-question-circle text-4xl mb-4"></i>
                            <p class="text-lg font-medium">Belum ada quiz</p>
                            <p class="text-sm">Mulai dengan menambahkan quiz pertama Anda</p>
                            <a href="{{ route('dashboardadmin.quiz.create') }}" 
                               class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                <i class="fas fa-plus mr-2"></i>Tambah Quiz
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($quizzes->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $quizzes->links() }}
        </div>
    @endif
</div>
@endsection
