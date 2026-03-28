<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\LandingPage;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LandingController extends Controller
{
    private const MAX_RELATED_LINKS = 6;
    private const SAME_TYPE_LIMIT = 3;
    private const SERVICE_LIMIT = 2;
    private const PROBLEM_LIMIT = 1;
    private const SERVICE_PRIORITY_SLUGS = [
        'vnedrenie-amocrm',
        'audit-amocrm',
        'perevnedrenie-amocrm',
    ];
    private const PROBLEM_PRIORITY_SLUGS = [
        'zayavki-ne-obrabatyvayutsya',
        'nizkaya-konversiya-prodazh',
        'net-kontrolya-prodazh',
    ];

    public function show(string $slug): View
    {
        $landing = LandingPage::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.landings.show', [
            'landing' => $landing,
            'sections' => $landing->resolvedSections(),
            'relatedLandings' => $this->buildRelatedLinks($landing, $this->resolveRelatedLandings($landing)),
        ]);
    }

    private function resolveRelatedLandings(LandingPage $landing): Collection
    {
        $relatedSlugs = collect($landing->related_slugs)
            ->filter(static fn (mixed $slug): bool => is_string($slug) && $slug !== '')
            ->unique()
            ->values();

        if ($relatedSlugs->isNotEmpty()) {
            $related = LandingPage::query()
                ->published()
                ->whereIn('slug', $relatedSlugs)
                ->get()
                ->keyBy('slug');

            return $relatedSlugs
                ->map(static fn (string $slug) => $related->get($slug))
                ->filter()
                ->reject(static fn (LandingPage $page): bool => $page->is($landing))
                ->take(self::MAX_RELATED_LINKS)
                ->values();
        }

        $pages = LandingPage::query()
            ->published()
            ->whereKeyNot($landing->getKey())
            ->orderBy('sort_order')
            ->get();

        $selected = collect();

        $appendPages = function (Collection $candidates, int $limit) use (&$selected): void {
            if ($limit <= 0 || $selected->count() >= self::MAX_RELATED_LINKS) {
                return;
            }

            $selectedSlugs = $selected->pluck('slug');

            $selected = $selected->concat(
                $candidates
                    ->reject(static fn (LandingPage $page): bool => $selectedSlugs->contains($page->slug))
                    ->take(min($limit, self::MAX_RELATED_LINKS - $selected->count()))
            );
        };

        $appendPages(
            $pages->where('page_type', $landing->page_type)->values(),
            self::SAME_TYPE_LIMIT
        );

        if ($landing->page_type !== 'service') {
            $appendPages(
                $this->prioritizedPages($pages, self::SERVICE_PRIORITY_SLUGS, 'service'),
                self::SERVICE_LIMIT
            );
        }

        if ($landing->page_type !== 'problem') {
            $appendPages(
                $this->prioritizedPages($pages, self::PROBLEM_PRIORITY_SLUGS, 'problem'),
                self::PROBLEM_LIMIT
            );
        }

        $appendPages($pages->values(), self::MAX_RELATED_LINKS);

        return $selected->take(self::MAX_RELATED_LINKS)->values();
    }

    private function prioritizedPages(Collection $pages, array $prioritySlugs, string $pageType): Collection
    {
        $typedPages = $pages->where('page_type', $pageType)->values();
        $typedBySlug = $typedPages->keyBy('slug');

        $priorityPages = collect($prioritySlugs)
            ->map(static fn (string $slug) => $typedBySlug->get($slug))
            ->filter();

        return $priorityPages->concat(
            $typedPages->reject(
                static fn (LandingPage $page): bool => in_array($page->slug, $prioritySlugs, true)
            )
        )->values();
    }

    private function buildRelatedLinks(LandingPage $landing, Collection $pages): Collection
    {
        $forbiddenAnchors = collect($landing->anchorCandidates())
            ->map(fn (string $anchor): string => $this->normalizeAnchor($anchor))
            ->filter()
            ->values();

        $usedAnchors = collect();

        return $pages
            ->map(function (LandingPage $page) use ($landing, $forbiddenAnchors, &$usedAnchors): array {
                $anchorText = $this->selectAnchorText($landing, $page, $forbiddenAnchors, $usedAnchors);
                $usedAnchors->push($this->normalizeAnchor($anchorText));

                return [
                    'slug' => $page->slug,
                    'url' => route('site.landings.show', $page->slug),
                    'anchor_text' => $anchorText,
                    'page_type_label' => $page->pageTypeLabel(),
                    'title' => $page->h1 ?: $page->title,
                    'excerpt' => $page->excerpt,
                ];
            })
            ->values();
    }

    private function selectAnchorText(
        LandingPage $currentLanding,
        LandingPage $page,
        Collection $forbiddenAnchors,
        Collection $usedAnchors
    ): string
    {
        $candidates = $this->orderedAnchorCandidates($currentLanding, $page);

        $preferred = $candidates->first(function (string $anchor) use ($forbiddenAnchors, $usedAnchors): bool {
            $normalized = $this->normalizeAnchor($anchor);

            return $normalized !== ''
                && ! $forbiddenAnchors->contains($normalized)
                && ! $usedAnchors->contains($normalized);
        });

        if (is_string($preferred) && $preferred !== '') {
            return $preferred;
        }

        $fallback = $candidates->first(function (string $anchor) use ($usedAnchors): bool {
            $normalized = $this->normalizeAnchor($anchor);

            return $normalized !== '' && ! $usedAnchors->contains($normalized);
        });

        return is_string($fallback) && $fallback !== ''
            ? $fallback
            : $page->displayTitle();
    }

    private function orderedAnchorCandidates(LandingPage $currentLanding, LandingPage $relatedLanding): Collection
    {
        $candidates = collect($relatedLanding->anchorCandidates())->values();

        if ($candidates->count() <= 1) {
            return $candidates;
        }

        $offset = abs(crc32($currentLanding->slug.'|'.$relatedLanding->slug)) % $candidates->count();

        return $candidates
            ->slice($offset)
            ->concat($candidates->slice(0, $offset))
            ->values();
    }

    private function normalizeAnchor(string $anchor): string
    {
        return Str::of($anchor)
            ->lower()
            ->squish()
            ->toString();
    }
}
