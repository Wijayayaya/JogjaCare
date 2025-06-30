@extends('dashboardadmin.layouts.app')

@section('title', 'Edit Quiz - Medical Services')
@section('page-title', 'Edit Quiz')
@section('page-description', 'Perbarui pertanyaan quiz')

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
        <span class="text-gray-500">Edit Quiz</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">
                <i class="fas fa-edit mr-2 text-blue-600"></i>
                Edit Quiz
            </h2>
            <p class="text-sm text-gray-600 mt-1">Perbarui pertanyaan quiz untuk edukasi kesehatan</p>
        </div>

        <!-- Form -->
        <form action="{{ route('dashboardadmin.quiz.update', $quiz) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')
            
            <!-- Question -->
            <div class="mb-6">
                <label for="question" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-question mr-2 text-blue-600"></i>Pertanyaan Quiz
                </label>
                <textarea name="question" id="question" rows="3" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('question') border-red-500 @enderror"
                          placeholder="Masukkan pertanyaan quiz...">{{ old('question', $quiz->question) }}</textarea>
                @error('question')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Answer -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-check-circle mr-2 text-green-600"></i>Jawaban Benar
                </label>
                <div class="flex space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="answer" value="Fakta" 
                               class="text-green-600 focus:ring-green-500 @error('answer') border-red-500 @enderror"
                               {{ old('answer', $quiz->answer) === 'Fakta' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm font-medium text-green-700">
                            <i class="fas fa-check mr-1"></i>Fakta
                        </span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="answer" value="Mitos" 
                               class="text-red-600 focus:ring-red-500 @error('answer') border-red-500 @enderror"
                               {{ old('answer', $quiz->answer) === 'Mitos' ? 'checked' : '' }}>
                        <span class="ml-2 text-sm font-medium text-red-700">
                            <i class="fas fa-times mr-1"></i>Mitos
                        </span>
                    </label>
                </div>
                @error('answer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Explanation -->
            <div class="mb-6">
                <label for="explanation" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-info-circle mr-2 text-blue-600"></i>Penjelasan
                </label>
                <textarea name="explanation" id="explanation" rows="4" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('explanation') border-red-500 @enderror"
                          placeholder="Berikan penjelasan mengapa jawaban tersebut benar...">{{ old('explanation', $quiz->explanation) }}</textarea>
                @error('explanation')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order -->
            <div class="mb-6">
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-sort-numeric-up mr-2 text-purple-600"></i>Urutan Tampil
                </label>
                <input type="number" name="order" id="order" min="0" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('order') border-red-500 @enderror"
                       value="{{ old('order', $quiz->order) }}" placeholder="0">
                <p class="mt-1 text-xs text-gray-500">Semakin kecil angka, semakin awal ditampilkan</p>
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" 
                           class="text-green-600 focus:ring-green-500 rounded"
                           {{ old('is_active', $quiz->is_active) ? 'checked' : '' }}>
                    <span class="ml-2 text-sm font-medium text-gray-700">
                        <i class="fas fa-eye mr-1 text-green-600"></i>Aktifkan quiz ini
                    </span>
                </label>
                <p class="mt-1 text-xs text-gray-500">Quiz yang aktif akan ditampilkan di frontend</p>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('dashboardadmin.quiz.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-200">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-save mr-2"></i>Update Quiz
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
