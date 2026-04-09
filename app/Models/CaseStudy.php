<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CaseStudy extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'full_content',
        'cover_image',
        'status',
        'sort_order',
        'seo_title',
        'seo_description',
        'client_name',
        'niche',
        'result_summary',
        'problem_block',
        'solution_block',
        'result_block',
        'metrics_block',
        'published_at',
        'canonical_url',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->where('status', 'published')
            ->where(function (Builder $builder): void {
                $builder
                    ->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function seoTitle(): string
    {
        return trim((string) ($this->seo_title ?: $this->title));
    }

    public function seoDescription(): string
    {
        return trim((string) ($this->seo_description ?: $this->result_summary ?: $this->short_description ?: $this->title));
    }

    public function canonicalUrl(): string
    {
        $path = trim((string) $this->canonical_url);

        if ($path === '') {
            return route('site.case-studies.show', $this->slug);
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return url($path);
    }

    public function publishedDate(): ?Carbon
    {
        return $this->published_at ?: $this->updated_at;
    }

    public function coverImageUrl(): ?string
    {
        $path = trim((string) $this->cover_image);

        if ($path !== '') {
            return asset('storage/'.$path);
        }

        return null;
    }

    public function logoUrl(): ?string
    {
        return match ($this->slug) {
            'macromir-invest' => asset('images/cases/macromir-invest-logo.png'),
            'b2b-analitika-datalens' => asset('images/cases/datalens-logo.png'),
            default => $this->coverImageUrl(),
        };
    }
}
