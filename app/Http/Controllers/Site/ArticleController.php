<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('site.articles.index', [
            'articles' => Article::query()
                ->where('status', 'published')
                ->latest('published_at')
                ->paginate(9),
        ]);
    }

    public function show(string $slug): View
    {
        $article = Article::query()
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.articles.show', compact('article'));
    }
}
