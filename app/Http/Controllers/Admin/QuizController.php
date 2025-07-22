<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::ordered()->paginate(10);
        return view('dashboardadmin.quiz.index', compact('quizzes'));
    }

    public function create()
    {
        return view('dashboardadmin.quiz.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => ['required', Rule::in(['Mitos', 'Fakta'])],
            'explanation' => 'required|string|max:1000',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Quiz::create($validated);

        return redirect()->route('dashboardadmin.quiz.index')
            ->with('success', 'Quiz berhasil ditambahkan!');
    }

    public function show(Quiz $quiz)
    {
        return view('dashboardadmin.quiz.show', compact('quiz'));
    }

    public function edit(Quiz $quiz)
    {
        return view('dashboardadmin.quiz.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => ['required', Rule::in(['Mitos', 'Fakta'])],
            'explanation' => 'required|string|max:1000',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $quiz->update($validated);

        return redirect()->route('dashboardadmin.quiz.index')
            ->with('success', 'Quiz berhasil diperbarui!');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('dashboardadmin.quiz.index')
            ->with('success', 'Quiz berhasil dihapus!');
    }

    public function toggleStatus(Quiz $quiz)
    {
        $quiz->update(['is_active' => !$quiz->is_active]);

        $status = $quiz->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()
            ->with('success', "Quiz berhasil {$status}!");
    }

    // API method untuk frontend
    public function getQuizData()
    {
        try {
            $quizzes = Quiz::where('is_active', true)
                ->orderBy('order')
                ->orderBy('created_at')
                ->get(['question', 'answer', 'explanation']);

            return response()->json($quizzes);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to load quiz data',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
