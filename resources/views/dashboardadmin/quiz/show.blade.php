@extends('dashboardadmin.layouts.app')

@section('title', 'Detail Quiz - Medical Services')
@section('page-title', 'Detail Quiz')
@section('page-description', 'Lihat detail pertanyaan quiz')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('dashboardadmin.quiz.index') }}" class="text-blue-600 hover:text-blue-800">Quiz Management</a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Detail Quiz</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-eye mr-2 text-blue-600"></i>
                        Detail Quiz
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Informasi lengkap pertanyaan quiz</p>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('dashboardadmin.quiz.edit', $quiz) }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <a href="{{ route('dashboardadmin.quiz.index') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <!-- Question -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                    <i class="fas fa-question-circle mr-2 text-blue-600"></i>Pertanyaan
                </h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-800 text-lg leading-relaxed">{{ $quiz->question }}</p>
                </div>
            </div>

            <!-- Answer -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                    <i class="fas fa-check-circle mr-2 text-green-600"></i>Jawaban Benar
                </h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    @if($quiz->answer === 'Fakta')
                        <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full font-medium">
                            <i class="fas fa-check mr-2"></i>FAKTA
                        </span>
                    @else
                        <span class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded-full font-medium">
                            <i class="fas fa-times mr-2"></i>MITOS
                        </span>
                    @endif
                </div>
            </div>

            <!-- Explanation -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i>Penjelasan
                </h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-800 leading-relaxed">{{ $quiz->explanation }}</p>
                </div>
            </div>

            <!-- Meta Information -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Status & Order -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-3">
                        <i class="fas fa-cog mr-2 text-purple-600"></i>Pengaturan
                    </h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            @if($quiz->is_active)
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                    <i class="fas fa-eye mr-1"></i>Aktif
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">
                                    <i class="fas fa-eye-slash mr-1"></i>Nonaktif
                                </span>
                            @endif
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Urutan:</span>
                            <span class="font-medium">{{ $quiz->order }}</span>
                        </div>
                    </div>
                </div>

                <!-- Timestamps -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-3">
                        <i class="fas fa-clock mr-2 text-orange-600"></i>Waktu
                    </h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Dibuat:</span>
                            <span class="font-medium">{{ $quiz->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Diperbarui:</span>
                            <span class="font-medium">{{ $quiz->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
