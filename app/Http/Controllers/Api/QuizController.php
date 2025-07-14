<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        try {
            $quizzes = Quiz::active()->ordered()->get();
            
            \Log::info('Quiz API called, found: ' . $quizzes->count() . ' quizzes');
            
            return response()->json($quizzes);
        } catch (\Exception $e) {
            \Log::error('Quiz API Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load quiz data',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
