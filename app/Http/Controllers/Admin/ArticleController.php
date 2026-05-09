<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Support\ArticleBlocks;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Article::query()
            ->latest('published_at')
            ->latest('updated_at');

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($builder) use ($q): void {
                $builder
                    ->where('title', 'like', "%{$q}%")
                    ->orWhere('slug', 'like', "%{$q}%");
            });
        }

        $articles = $query->paginate(15)->withQueryString();

        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        $article = new Article();

        return view('admin.articles.create', compact('article'));
    }

    public function store(ArticleRequest $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('uploads/articles', 'public');
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Статья создана.');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(ArticleRequest $request, Article $article): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            if ($article->cover_image) {
                Storage::disk('public')->delete($article->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('uploads/articles', 'public');
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Статья обновлена.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->cover_image) {
            Storage::disk('public')->delete($article->cover_image);
        }

        $article->delete();

        return back()->with('success', 'Статья удалена.');
    }

    public function uploadImage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:8192'],
        ]);

        $path = $validated['image']->store('uploads/articles/content', 'public');

        return response()->json([
            'url' => asset('storage/'.$path),
            'path' => $path,
        ]);
    }

    private function validatedData(ArticleRequest $request): array
    {
        $data = $request->validated();
        $data['content_blocks'] = ArticleBlocks::fromRichText(
            (string) ($data['full_content'] ?? ''),
            (string) ($data['title'] ?? '')
        );

        if ($data['content_blocks'] === []) {
            $data['content_blocks'] = null;
        }

        return $data;
    }
}
