<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\LandingPage;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        return view('site.articles.index', [
            'articles' => Article::query()
                ->published()
                ->latest('published_at')
                ->latest('updated_at')
                ->paginate(9),
        ]);
    }

    public function show(string $slug): View
    {
        $article = Article::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $contentBlocks = $this->prepareContentBlocks($article);

        return view('site.articles.show', [
            'article' => $article,
            'contentBlocks' => $contentBlocks,
            'relatedLandings' => $this->resolveRelatedLandings($article, $contentBlocks),
            'moreArticles' => Article::query()
                ->published()
                ->whereKeyNot($article->getKey())
                ->latest('published_at')
                ->latest('updated_at')
                ->take(2)
                ->get(),
        ]);
    }

    private function prepareContentBlocks(Article $article): array
    {
        return collect($article->resolvedContentBlocks())
            ->map(function (array $block): array {
                return [
                    'view' => $block['view'],
                    'data' => $this->prepareBlockData($block['data']),
                ];
            })
            ->filter(static function (array $block): bool {
                return ($block['data']['type'] ?? null) !== 'links' || ! empty($block['data']['items']);
            })
            ->values()
            ->all();
    }

    private function prepareBlockData(array $block): array
    {
        if (($block['type'] ?? null) === 'links') {
            $items = collect($block['items'] ?? [])
                ->map(fn (mixed $item): ?array => $this->normalizeLinkItem($item))
                ->filter()
                ->values()
                ->all();

            return [
                'type' => 'links',
                'title' => filled($block['title'] ?? null) ? trim((string) $block['title']) : null,
                'items' => $items,
            ];
        }

        return $block;
    }

    private function normalizeLinkItem(mixed $item): ?array
    {
        if (is_string($item)) {
            return $this->resolveLinkItem($item);
        }

        if (! is_array($item)) {
            return null;
        }

        $url = trim((string) Arr::get($item, 'url', ''));

        if ($url === '') {
            return null;
        }

        $resolved = $this->resolveLinkItem($url) ?? [
            'url' => $url,
            'badge' => null,
            'title' => $url,
            'description' => null,
        ];

        $title = trim((string) Arr::get($item, 'title', ''));
        $description = trim((string) Arr::get($item, 'description', ''));
        $badge = trim((string) Arr::get($item, 'badge', ''));

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

    private function resolveRelatedLandings(Article $article, array $contentBlocks): Collection
    {
        $directSlugs = collect($contentBlocks)
            ->filter(static fn (array $block): bool => ($block['data']['type'] ?? null) === 'links')
            ->flatMap(function (array $block): Collection {
                return collect($block['data']['items'] ?? [])
                    ->map(static function (array $item): ?string {
                        $url = (string) ($item['url'] ?? '');

                        if (! str_starts_with($url, '/solutions/')) {
                            return null;
                        }

                        $segments = array_values(array_filter(explode('/', trim($url, '/'))));

                        return (string) end($segments);
                    })
                    ->filter();
            })
            ->unique()
            ->values();

        if ($directSlugs->isNotEmpty()) {
            return LandingPage::query()
                ->published()
                ->whereIn('slug', $directSlugs->all())
                ->get()
                ->sortBy(fn (LandingPage $landing): int => $directSlugs->search($landing->slug))
                ->take(3)
                ->values();
        }

        $haystack = mb_strtolower(implode(' ', array_filter([
            $article->title,
            $article->excerpt,
            $article->short_description,
            $article->full_content,
            collect($contentBlocks)->map(function (array $block): string {
                $data = $block['data'] ?? [];

                return collect([
                    $data['text'] ?? null,
                    $data['title'] ?? null,
                    $data['caption'] ?? null,
                    $data['author'] ?? null,
                    isset($data['items']) && is_array($data['items']) ? implode(' ', array_map(
                        static fn (mixed $item): string => is_array($item) ? (string) ($item['title'] ?? $item['text'] ?? '') : (string) $item,
                        $data['items']
                    )) : null,
                ])->filter()->implode(' ');
            })->implode(' '),
        ])));

        $keywordMap = [
            'audit-amocrm' => ['аудит', 'crm', 'амоcrm', 'amo', 'проблем', 'не работает', 'провер'],
            'perevnedrenie-amocrm' => ['перевнедрен', 'донастро', 'crm уже', 'не помогает', 'формально'],
            'vnedrenie-amocrm' => ['внедрен', 'запуск crm', 'amo', 'воронк', 'отдел продаж'],
            'crm-ne-rabotaet' => ['crm не работает', 'не работает', 'хаос', 'не дает результат'],
            'teryayutsya-zayavki' => ['теряют', 'заявк', 'лид', 'первый контакт'],
            'net-analitiki-v-crm' => ['аналитик', 'отчет', 'цифр', 'конверс'],
            'povtornye-prodazhi-amocrm' => ['повторн', 'база клиентов', 'возврат'],
            'ai-avtomatizaciya-prodazh' => ['ai', 'ии', 'openai', 'n8n', 'автоматизац'],
        ];

        $scored = collect($keywordMap)
            ->map(function (array $keywords, string $slug) use ($haystack): array {
                $score = collect($keywords)
                    ->sum(static fn (string $keyword): int => mb_stripos($haystack, $keyword) !== false ? 1 : 0);

                return [
                    'slug' => $slug,
                    'score' => $score,
                ];
            })
            ->filter(static fn (array $item): bool => $item['score'] > 0)
            ->sortByDesc('score')
            ->pluck('slug')
            ->values();

        $fallbackSlugs = collect([
            'audit-amocrm',
            'perevnedrenie-amocrm',
            'vnedrenie-amocrm',
        ]);

        $slugs = $scored
            ->concat($fallbackSlugs)
            ->unique()
            ->take(3)
            ->values();

        return LandingPage::query()
            ->published()
            ->whereIn('slug', $slugs->all())
            ->get()
            ->sortBy(fn (LandingPage $landing): int => $slugs->search($landing->slug))
            ->values();
    }
}
