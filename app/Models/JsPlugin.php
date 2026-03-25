<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JsPlugin extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'placement',
        'script_snippet',
        'status',
        'sort_order',
    ];

    public function renderedSnippet(): string
    {
        $snippet = trim((string) $this->script_snippet);

        if ($snippet === '') {
            return '';
        }

        if (Str::contains(Str::lower($snippet), '<script')) {
            return $snippet;
        }

        return "<script>\n{$snippet}\n</script>";
    }
}
