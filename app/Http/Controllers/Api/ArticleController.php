<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        try {
            $articles = Article::active()->ordered()->get();
            
            \Log::info('Articles API called, found: ' . $articles->count() . ' articles');
            
            return response()->json($articles);
        } catch (\Exception $e) {
            \Log::error('Articles API Error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load articles data',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
