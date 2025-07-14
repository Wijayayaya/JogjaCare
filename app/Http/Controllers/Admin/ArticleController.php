<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::ordered()->paginate(10);
        return view('dashboardadmin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('dashboardadmin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:100',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'icon_color' => ['required', Rule::in(['blue', 'green', 'purple', 'orange', 'red', 'indigo', 'pink', 'yellow'])],
            'read_time' => 'required|integer|min:1|max:60',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Article::create($validated);

        return redirect()->route('dashboardadmin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function show(Article $article)
    {
        return view('dashboardadmin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('dashboardadmin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:100',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'icon_color' => ['required', Rule::in(['blue', 'green', 'purple', 'orange', 'red', 'indigo', 'pink', 'yellow'])],
            'read_time' => 'required|integer|min:1|max:60',
            'is_active' => 'boolean',
            'order' => 'integer|min:0'
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $article->update($validated);

        return redirect()->route('dashboardadmin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('dashboardadmin.articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }

    public function toggleStatus(Article $article)
    {
        $article->update(['is_active' => !$article->is_active]);

        $status = $article->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()
            ->with('success', "Artikel berhasil {$status}!");
    }
}
