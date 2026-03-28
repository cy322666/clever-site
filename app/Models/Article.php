<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
