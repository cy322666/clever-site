<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use App\Support\ArticleBlocks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Article extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'full_content',
        'content_blocks',
        'cover_image',
        'status',
        'sort_order',
        'seo_title',
        'seo_description',
        'canonical_url',
        'excerpt',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'content_blocks' => 'array',
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
        return trim((string) ($this->seo_description ?: $this->excerpt ?: $this->short_description ?: $this->title));
    }

    public function canonicalUrl(): string
    {
        $path = trim((string) $this->canonical_url);

        if ($path === '') {
            return route('site.articles.show', $this->slug);
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return url($path);
    }

    public function excerptText(): string
    {
        return trim((string) ($this->excerpt ?: $this->short_description ?: ''));
    }

    public function coverImageUrl(): ?string
    {
        return $this->cover_image ? asset('storage/'.$this->cover_image) : null;
    }

    public function publishedDate(): ?Carbon
    {
        return $this->published_at ?: $this->updated_at;
    }

    public function resolvedContentBlocks(): array
    {
        return ArticleBlocks::resolved($this->content_blocks, $this->full_content, $this->title);
    }

    public function editorContentBlocks(): array
    {
        return ArticleBlocks::editorState($this->content_blocks, $this->full_content, $this->title);
    }
}
