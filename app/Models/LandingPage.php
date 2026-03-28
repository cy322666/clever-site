<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    private const SECTION_VIEW_MAP = [
        'hero' => 'site.landings.sections.hero',
        'benefits' => 'site.landings.sections.benefits',
        'steps' => 'site.landings.sections.steps',
        'faq' => 'site.landings.sections.faq',
        'cta' => 'site.landings.sections.cta',
    ];

    protected $fillable = [
        'page_type',
        'title',
        'slug',
        'short_title',
        'h1',
        'excerpt',
        'meta_title',
        'meta_description',
        'canonical_url',
        'status',
        'sort_order',
        'sections',
        'anchor_variants',
        'related_slugs',
    ];

    protected function casts(): array
    {
        return [
            'sections' => 'array',
            'anchor_variants' => 'array',
            'related_slugs' => 'array',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function seoTitle(): string
    {
        return $this->meta_title ?: $this->title;
    }

    public function seoDescription(): ?string
    {
        return $this->meta_description ?: $this->excerpt;
    }

    public function displayTitle(): string
    {
        return $this->short_title ?: ($this->h1 ?: $this->title);
    }

    public function canonicalUrl(): string
    {
        $path = $this->canonical_url ?: '/solutions/'.$this->slug;

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return url($path);
    }

    public function resolvedSections(): array
    {
        return collect($this->sections ?? [])
            ->filter(static fn (mixed $section): bool => is_array($section))
            ->map(function (array $section): ?array {
                $type = $section['type'] ?? null;
                $view = is_string($type) ? self::SECTION_VIEW_MAP[$type] ?? null : null;

                return $view === null ? null : [
                    'view' => $view,
                    'data' => $section,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }

    public function anchorCandidates(): array
    {
        $anchors = collect($this->anchor_variants ?? [])
            ->filter(static fn (mixed $value): bool => is_string($value) && trim($value) !== '')
            ->map(static fn (string $value): string => trim($value))
            ->unique()
            ->values();

        if ($anchors->isEmpty()) {
            return [$this->displayTitle()];
        }

        return $anchors
            ->push($this->displayTitle())
            ->unique()
            ->values()
            ->all();
    }

    public function pageTypeLabel(): string
    {
        return match ($this->page_type) {
            'service' => 'Услуга',
            'integration' => 'Интеграция',
            'problem' => 'Проблема',
            'task' => 'Задача',
            'analytics' => 'Аналитика',
            'comparison' => 'Сравнение',
            'niche' => 'Ниша',
            default => 'Решение',
        };
    }
}
