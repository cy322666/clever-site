<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

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

    public function renderedContent(): HtmlString
    {
        $content = $this->normalizeMarkdown((string) $this->full_content);

        if ($content === '') {
            return new HtmlString('');
        }

        return new HtmlString(Str::markdown($content, [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]));
    }

    protected function normalizeMarkdown(string $content): string
    {
        $content = trim(str_replace(["\r\n", "\r"], "\n", $content));

        if ($content === '') {
            return '';
        }

        // If the text was pasted as one long line, restore the most common markdown breaks.
        if (substr_count($content, "\n") <= 3) {
            // A lot of admin text is pasted with double spaces instead of real line breaks.
            $content = preg_replace("/[\\t ]{2,}/u", "\n", $content) ?? $content;

            // Headings.
            $content = preg_replace('/(?<!\n)(#{1,6}\h+)/u', "\n\n$1", $content) ?? $content;

            // Bullets and numbered lists that were glued to the previous phrase.
            $content = preg_replace('/(?<!\n)\h*(-\h+)/u', "\n$1", $content) ?? $content;
            $content = preg_replace('/(?<!\n)\h*(\d+\.\h+)/u', "\n\n$1", $content) ?? $content;

            // Common helper lines.
            $content = preg_replace('/(?<!\n)(Важно:)/u', "\n\n$1", $content) ?? $content;
            $content = preg_replace('/(?<!\n)(Откройте:\h*`[^`]+`)/u', "\n\n$1", $content) ?? $content;
            $content = preg_replace('/(?<!\n)(Заполните блоки:)/u', "\n\n$1", $content) ?? $content;

            // Restore headings like "## 1. ..." after numbered-list splitting.
            $content = preg_replace('/^(#{1,6})\s*\n+\s*(\d+\.\h+)/mu', '$1 $2', $content) ?? $content;
        }

        $lines = preg_split("/\n/u", $content) ?: [];
        $rebuilt = [];

        for ($i = 0; $i < count($lines); $i++) {
            $line = trim($lines[$i]);
            $nextIndex = $i + 1;

            while (isset($lines[$nextIndex]) && trim($lines[$nextIndex]) === '') {
                $nextIndex++;
            }

            $next = isset($lines[$nextIndex]) ? trim($lines[$nextIndex]) : null;

            if (
                preg_match('/^#+$/u', $line) &&
                is_string($next) &&
                preg_match('/^#+\s+\d+\./u', $next)
            ) {
                $rebuilt[] = $line.$next;
                $i = $nextIndex;
                continue;
            }

            if (
                preg_match('/^#+$/u', $line) &&
                is_string($next) &&
                preg_match('/^#\s+\d+\./u', $next)
            ) {
                $rebuilt[] = $line.ltrim($next, '#');
                $i = $nextIndex;
                continue;
            }

            if (
                preg_match('/^##$/u', $line) &&
                is_string($next) &&
                preg_match('/^\d+\./u', $next)
            ) {
                $rebuilt[] = $line.' '.$next;
                $i = $nextIndex;
                continue;
            }

            $rebuilt[] = $lines[$i];
        }

        $content = implode("\n", $rebuilt);

        return preg_replace("/\n{3,}/u", "\n\n", $content) ?? $content;
    }
}
