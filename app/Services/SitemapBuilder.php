<?php

namespace App\Services;

use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\LandingPage;
use App\Models\SiteSetting;
use App\Models\Widget;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class SitemapBuilder
{
    public function build(): array
    {
        $landings = LandingPage::query()
            ->published()
            ->get(['slug', 'updated_at', 'sort_order']);

        $articles = Article::query()
            ->published()
            ->get(['slug', 'published_at', 'updated_at']);

        $caseStudies = CaseStudy::query()
            ->published()
            ->get(['slug', 'published_at', 'updated_at']);

        $widgets = Widget::query()
            ->where('status', 'published')
            ->get(['slug', 'updated_at']);

        $siteSettingsUpdatedAt = SiteSetting::query()->value('updated_at');

        $items = collect([
            $this->makeItem(
                url('/'),
                $this->latestDate([
                    $siteSettingsUpdatedAt,
                    $landings->max('updated_at'),
                    $articles->max('updated_at'),
                    $caseStudies->max('updated_at'),
                    $widgets->max('updated_at'),
                ]),
                'weekly',
                '1.0',
            ),
            $this->makeItem(
                route('site.contacts'),
                $this->asCarbon($siteSettingsUpdatedAt),
                'monthly',
                '0.6',
            ),
            $this->makeItem(
                route('site.landings.show', 'vnedrenie-amocrm'),
                $this->findLandingDate($landings, 'vnedrenie-amocrm'),
                'weekly',
                '0.9',
            ),
            $this->makeItem(
                route('site.articles.index'),
                $this->latestDate([$articles->max('updated_at')]),
                'weekly',
                '0.8',
            ),
            $this->makeItem(
                route('site.case-studies.index'),
                $this->latestDate([$caseStudies->max('updated_at')]),
                'weekly',
                '0.8',
            ),
            $this->makeItem(
                route('site.widgets.index'),
                $this->latestDate([$widgets->max('updated_at')]),
                'monthly',
                '0.7',
            ),
        ])->filter();

        $items = $items
            ->concat($landings->map(fn (LandingPage $landing): array => $this->makeItem(
                route('site.landings.show', $landing->slug),
                $this->asCarbon($landing->updated_at),
                'weekly',
                '0.8',
            )))
            ->concat($articles->map(fn (Article $article): array => $this->makeItem(
                route('site.articles.show', $article->slug),
                $this->asCarbon($article->published_at ?: $article->updated_at),
                'monthly',
                '0.7',
            )))
            ->concat($caseStudies->map(fn (CaseStudy $caseStudy): array => $this->makeItem(
                route('site.case-studies.show', $caseStudy->slug),
                $this->asCarbon($caseStudy->published_at ?: $caseStudy->updated_at),
                'monthly',
                '0.7',
            )))
            ->concat($widgets->map(fn (Widget $widget): array => $this->makeItem(
                route('site.widgets.show', $widget->slug),
                $this->asCarbon($widget->updated_at),
                'monthly',
                '0.6',
            )))
            ->unique('loc')
            ->values();

        return [
            'items' => $items,
        ];
    }

    private function makeItem(
        string $loc,
        ?CarbonInterface $lastmod,
        ?string $changefreq = null,
        ?string $priority = null
    ): array {
        return [
            'loc' => $loc,
            'lastmod' => $lastmod,
            'changefreq' => $changefreq,
            'priority' => $priority,
        ];
    }

    private function latestDate(array $dates): ?CarbonInterface
    {
        return collect($dates)
            ->map(fn (mixed $value): ?CarbonInterface => $this->asCarbon($value))
            ->filter()
            ->sortByDesc(fn (CarbonInterface $date): int => $date->getTimestamp())
            ->first();
    }

    private function asCarbon(mixed $value): ?CarbonInterface
    {
        if ($value instanceof CarbonInterface) {
            return $value;
        }

        if (is_string($value) || is_numeric($value)) {
            return Carbon::parse($value);
        }

        return null;
    }

    private function findLandingDate(Collection $landings, string $slug): ?CarbonInterface
    {
        $landing = $landings->firstWhere('slug', $slug);

        return $landing instanceof LandingPage ? $this->asCarbon($landing->updated_at) : null;
    }
}
