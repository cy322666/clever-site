<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\LandingPage;
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

        return view('site.articles.show', [
            'article' => $article,
            'contentBlocks' => $this->buildContentBlocks($article),
            'moreArticles' => Article::query()
                ->where('status', 'published')
                ->whereKeyNot($article->getKey())
                ->latest('published_at')
                ->take(2)
                ->get(),
        ]);
    }

    private function buildContentBlocks(Article $article): array
    {
        if (is_array($article->content_blocks) && $article->content_blocks !== []) {
            return $this->normalizeStoredBlocks($article->content_blocks);
        }

        $rawBlocks = preg_split('/(?:\r?\n){2,}/u', trim((string) $article->full_content)) ?: [];
        $blocks = [];
        $pendingLinks = [];

        foreach ($rawBlocks as $rawBlock) {
            $block = trim((string) $rawBlock);

            if ($block === '') {
                continue;
            }

            if (mb_strtolower($block) === mb_strtolower(trim((string) $article->title))) {
                continue;
            }

            $linkBlock = $this->resolveLinkBlock($block);

            if ($linkBlock !== null) {
                array_push($pendingLinks, ...$linkBlock);
                continue;
            }

            if ($pendingLinks !== []) {
                $blocks[] = [
                    'type' => 'links',
                    'items' => $pendingLinks,
                ];
                $pendingLinks = [];
            }

            if ($this->isHeading($block)) {
                $blocks[] = [
                    'type' => 'heading',
                    'text' => $block,
                ];

                continue;
            }

            $blocks[] = [
                'type' => 'paragraph',
                'text' => preg_replace('/\s*\R\s*/u', ' ', $block) ?: $block,
            ];
        }

        if ($pendingLinks !== []) {
            $blocks[] = [
                'type' => 'links',
                'items' => $pendingLinks,
            ];
        }

        return $blocks;
    }

    private function normalizeStoredBlocks(array $blocks): array
    {
        return collect($blocks)
            ->filter(static fn (mixed $block): bool => is_array($block))
            ->map(fn (array $block): ?array => $this->normalizeStoredBlock($block))
            ->filter()
            ->values()
            ->all();
    }

    private function normalizeStoredBlock(array $block): ?array
    {
        $type = $block['type'] ?? null;

        if (! is_string($type)) {
            return null;
        }

        return match ($type) {
            'heading' => $this->normalizeTextBlock($block, 'heading'),
            'paragraph' => $this->normalizeTextBlock($block, 'paragraph'),
            'links' => $this->normalizeLinksBlock($block),
            default => null,
        };
    }

    private function normalizeTextBlock(array $block, string $type): ?array
    {
        $text = trim((string) ($block['text'] ?? ''));

        if ($text === '') {
            return null;
        }

        return [
            'type' => $type,
            'text' => $text,
        ];
    }

    private function normalizeLinksBlock(array $block): ?array
    {
        $items = collect($block['items'] ?? [])
            ->map(fn (mixed $item): ?array => $this->normalizeLinkItem($item))
            ->filter()
            ->values()
            ->all();

        if ($items === []) {
            return null;
        }

        $title = trim((string) ($block['title'] ?? ''));

        return [
            'type' => 'links',
            'title' => $title !== '' ? $title : null,
            'items' => $items,
        ];
    }

    private function normalizeLinkItem(mixed $item): ?array
    {
        if (is_string($item)) {
            return $this->resolveLinkItem($item);
        }

        if (! is_array($item)) {
            return null;
        }

        $url = trim((string) ($item['url'] ?? ''));

        if ($url === '') {
            return null;
        }

        $resolved = $this->resolveLinkItem($url) ?? [
            'url' => $url,
            'badge' => null,
            'title' => $url,
            'description' => null,
        ];

        $title = trim((string) ($item['title'] ?? ''));
        $description = trim((string) ($item['description'] ?? ''));
        $badge = trim((string) ($item['badge'] ?? ''));

        if ($title !== '') {
            $resolved['title'] = $title;
        }

        if ($description !== '') {
            $resolved['description'] = $description;
        }

        if ($badge !== '') {
            $resolved['badge'] = $badge;
        }

        return $resolved;
    }

    private function resolveLinkBlock(string $block): ?array
    {
        $lines = collect(preg_split('/\R/u', $block) ?: [])
            ->map(static fn (string $line): string => trim($line))
            ->filter()
            ->values();

        if ($lines->isEmpty()) {
            return null;
        }

        $allLinks = $lines->every(static fn (string $line): bool => preg_match('#^(?:/|https?://)#', $line) === 1);

        if (! $allLinks) {
            return null;
        }

        return $lines
            ->map(fn (string $line): ?array => $this->resolveLinkItem($line))
            ->filter()
            ->values()
            ->all();
    }

    private function resolveLinkItem(string $path): ?array
    {
        if (str_starts_with($path, '/solutions/')) {
            $slug = $this->extractSlug($path);
            $landing = LandingPage::query()->published()->where('slug', $slug)->first();

            if ($landing === null) {
                return null;
            }

            return [
                'url' => $path,
                'badge' => $landing->pageTypeLabel(),
                'title' => $landing->displayTitle(),
                'description' => $landing->excerpt,
            ];
        }

        if (str_starts_with($path, '/case-studies/')) {
            $slug = $this->extractSlug($path);
            $caseStudy = CaseStudy::query()
                ->where('status', 'published')
                ->where('slug', $slug)
                ->first();

            if ($caseStudy === null) {
                return null;
            }

            return [
                'url' => $path,
                'badge' => 'Кейс',
                'title' => $caseStudy->title,
                'description' => $caseStudy->result_summary ?: $caseStudy->short_description,
            ];
        }

        if (preg_match('#^https?://#', $path) === 1) {
            return [
                'url' => $path,
                'badge' => 'Ссылка',
                'title' => $path,
                'description' => null,
            ];
        }

        return null;
    }

    private function extractSlug(string $path): string
    {
        $segments = array_values(array_filter(explode('/', trim($path, '/'))));

        return (string) end($segments);
    }

    private function isHeading(string $block): bool
    {
        if (preg_match('/\R/u', $block) === 1) {
            return false;
        }

        $normalized = trim($block);

        if ($normalized === '') {
            return false;
        }

        if (mb_strlen($normalized) > 90) {
            return false;
        }

        return ! preg_match('/[.:!?]$/u', $normalized);
    }
}
