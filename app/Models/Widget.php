<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'state',
        'short_description',
        'full_content',
        'cover_image',
        'gallery_image_2',
        'gallery_image_3',
        'status',
        'sort_order',
        'seo_title',
        'seo_description',
        'price_text',
        'platform_compatibility',
        'external_link',
    ];

    public function coverImageUrl(): ?string
    {
        return $this->cover_image ? asset('storage/'.$this->cover_image) : null;
    }

    public function galleryImages(): array
    {
        return collect([
            $this->cover_image,
            $this->gallery_image_2,
            $this->gallery_image_3,
        ])
            ->filter(static fn (?string $path): bool => filled($path))
            ->map(static fn (string $path): string => asset('storage/'.$path))
            ->values()
            ->all();
    }
}
