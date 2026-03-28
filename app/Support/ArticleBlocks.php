<?php

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ArticleBlocks
{
    private const VIEW_MAP = [
        'heading' => 'site.articles.blocks.heading',
        'paragraph' => 'site.articles.blocks.paragraph',
        'list' => 'site.articles.blocks.list',
        'quote' => 'site.articles.blocks.quote',
        'cta' => 'site.articles.blocks.cta',
        'image' => 'site.articles.blocks.image',
        'links' => 'site.articles.blocks.links',
    ];

    public static function resolved(?array $storedBlocks, ?string $legacyContent = null, ?string $title = null): array
    {
        $blocks = self::normalize($storedBlocks ?? []);

        if ($blocks === [] && filled($legacyContent)) {
            $blocks = self::fromLegacyText($legacyContent, $title);
        }

        return collect($blocks)
            ->map(function (array $block): ?array {
                $view = self::VIEW_MAP[$block['type']] ?? null;

                return $view === null ? null : [
                    'view' => $view,
                    'data' => $block,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }

    public static function editorState(?array $storedBlocks, ?string $legacyContent = null, ?string $title = null): array
    {
        $blocks = self::normalize($storedBlocks ?? []);

        if ($blocks === [] && filled($legacyContent)) {
            $blocks = self::fromLegacyText($legacyContent, $title);
        }

        return $blocks;
    }

    public static function normalize(array $blocks): array
    {
        return collect($blocks)
            ->filter(static fn (mixed $block): bool => is_array($block))
            ->map(static fn (array $block): ?array => self::normalizeBlock($block))
            ->filter()
            ->values()
            ->all();
    }

    public static function fromPayload(?string $payload): array
    {
        if (! is_string($payload) || trim($payload) === '') {
            return [];
        }

        $decoded = json_decode($payload, true);

        return is_array($decoded) ? self::normalize($decoded) : [];
    }

    public static function fromLegacyText(string $content, ?string $title = null): array
    {
        $rawBlocks = array_values(array_filter(
            preg_split('/(?:\r?\n){2,}/u', trim($content)) ?: [],
            static fn (mixed $block): bool => trim((string) $block) !== ''
        ));

        $blocks = [];
        $pendingLinks = [];

        foreach ($rawBlocks as $index => $rawBlock) {
            $block = trim((string) $rawBlock);

            if ($block === '') {
                continue;
            }

            if ($title !== null && mb_strtolower($block) === mb_strtolower(trim($title))) {
                continue;
            }

            $linkBlock = self::resolveLinkBlock($block);

            if ($linkBlock !== null) {
                array_push($pendingLinks, ...$linkBlock);
                continue;
            }

            if ($pendingLinks !== []) {
                $blocks[] = [
                    'type' => 'links',
                    'items' => $pendingLinks,
                ];
                $pendingLinks = [];
            }

            if (self::isHeading($block, $rawBlocks[$index + 1] ?? null)) {
                $blocks[] = [
                    'type' => 'heading',
                    'text' => self::normalizeHeading($block),
                    'level' => 2,
                ];
                continue;
            }

            if ($listBlock = self::resolveListBlock($block)) {
                $blocks[] = $listBlock;
                continue;
            }

            if ($quoteBlock = self::resolveQuoteBlock($block)) {
                $blocks[] = $quoteBlock;
                continue;
            }

            $blocks[] = [
                'type' => 'paragraph',
                'text' => preg_replace('/\s*\R\s*/u', ' ', $block) ?: $block,
            ];
        }

        if ($pendingLinks !== []) {
            $blocks[] = [
                'type' => 'links',
                'items' => $pendingLinks,
            ];
        }

        return self::normalize($blocks);
    }

    private static function normalizeBlock(array $block): ?array
    {
        $type = $block['type'] ?? null;

        if (! is_string($type)) {
            return null;
        }

        return match ($type) {
            'heading' => self::normalizeHeadingBlock($block),
            'paragraph' => self::normalizeParagraphBlock($block),
            'list' => self::normalizeListBlock($block),
            'quote' => self::normalizeQuoteBlock($block),
            'cta' => self::normalizeCtaBlock($block),
            'image' => self::normalizeImageBlock($block),
            'links' => self::normalizeLinksBlock($block),
            default => null,
        };
    }

    private static function normalizeHeadingBlock(array $block): ?array
    {
        $text = trim((string) Arr::get($block, 'text', ''));

        if ($text === '') {
            return null;
        }

        $level = (int) Arr::get($block, 'level', 2);
        $level = $level >= 2 && $level <= 3 ? $level : 2;

        return [
            'type' => 'heading',
            'text' => $text,
            'level' => $level,
        ];
    }

    private static function normalizeParagraphBlock(array $block): ?array
    {
        $text = trim((string) Arr::get($block, 'text', ''));

        if ($text === '') {
            return null;
        }

        return [
            'type' => 'paragraph',
            'text' => $text,
        ];
    }

    private static function normalizeListBlock(array $block): ?array
    {
        $items = collect(Arr::get($block, 'items', []))
            ->map(static fn (mixed $item): string => trim((string) $item))
            ->filter()
            ->values()
            ->all();

        if ($items === []) {
            return null;
        }

        $style = Arr::get($block, 'style', 'unordered');
        $style = in_array($style, ['unordered', 'ordered'], true) ? $style : 'unordered';

        return [
            'type' => 'list',
            'style' => $style,
            'items' => $items,
        ];
    }

    private static function normalizeQuoteBlock(array $block): ?array
    {
        $text = trim((string) Arr::get($block, 'text', ''));

        if ($text === '') {
            return null;
        }

        $author = trim((string) Arr::get($block, 'author', ''));

        return [
            'type' => 'quote',
            'text' => $text,
            'author' => $author !== '' ? $author : null,
        ];
    }

    private static function normalizeCtaBlock(array $block): ?array
    {
        $title = trim((string) Arr::get($block, 'title', ''));
        $text = trim((string) Arr::get($block, 'text', ''));
        $buttonLabel = trim((string) Arr::get($block, 'button_label', ''));
        $buttonUrl = trim((string) Arr::get($block, 'button_url', ''));

        if ($title === '' || $buttonLabel === '' || $buttonUrl === '') {
            return null;
        }

        return [
            'type' => 'cta',
            'title' => $title,
            'text' => $text !== '' ? $text : null,
            'button_label' => $buttonLabel,
            'button_url' => $buttonUrl,
        ];
    }

    private static function normalizeImageBlock(array $block): ?array
    {
        $imageUrl = trim((string) Arr::get($block, 'image_url', ''));

        if ($imageUrl === '') {
            return null;
        }

        $alt = trim((string) Arr::get($block, 'alt', ''));
        $caption = trim((string) Arr::get($block, 'caption', ''));

        return [
            'type' => 'image',
            'image_url' => $imageUrl,
            'alt' => $alt !== '' ? $alt : null,
            'caption' => $caption !== '' ? $caption : null,
        ];
    }

    private static function normalizeLinksBlock(array $block): ?array
    {
        $items = collect(Arr::get($block, 'items', []))
            ->map(static fn (mixed $item): ?array => self::normalizeLinkItem($item))
            ->filter()
            ->values()
            ->all();

        if ($items === []) {
            return null;
        }

        $title = trim((string) Arr::get($block, 'title', ''));

        return [
            'type' => 'links',
            'title' => $title !== '' ? $title : null,
            'items' => $items,
        ];
    }

    private static function normalizeLinkItem(mixed $item): ?array
    {
        if (is_string($item)) {
            $url = trim($item);

            return $url !== '' ? [
                'url' => $url,
                'badge' => null,
                'title' => $url,
                'description' => null,
            ] : null;
        }

        if (! is_array($item)) {
            return null;
        }

        $url = trim((string) Arr::get($item, 'url', ''));

        if ($url === '') {
            return null;
        }

        $title = trim((string) Arr::get($item, 'title', $url));
        $badge = trim((string) Arr::get($item, 'badge', ''));
        $description = trim((string) Arr::get($item, 'description', ''));

        return [
            'url' => $url,
            'badge' => $badge !== '' ? $badge : null,
            'title' => $title,
            'description' => $description !== '' ? $description : null,
        ];
    }

    private static function resolveLinkBlock(string $block): ?array
    {
        $lines = collect(preg_split('/\R/u', $block) ?: [])
            ->map(static fn (string $line): string => trim($line))
            ->filter()
            ->values();

        if ($lines->isEmpty()) {
            return null;
        }

        $allLinks = $lines->every(static fn (string $line): bool => preg_match('#^(?:/|https?://)#', $line) === 1);

        if (! $allLinks) {
            return null;
        }

        return $lines
            ->map(static fn (string $line): array => [
                'url' => $line,
                'badge' => null,
                'title' => $line,
                'description' => null,
            ])
            ->all();
    }

    private static function resolveListBlock(string $block): ?array
    {
        $lines = collect(preg_split('/\R/u', $block) ?: [])
            ->map(static fn (string $line): string => trim($line))
            ->filter()
            ->values();

        if ($lines->count() < 2) {
            return null;
        }

        $unordered = $lines->every(static fn (string $line): bool => preg_match('/^[-*•]\s+/u', $line) === 1);
        $ordered = $lines->every(static fn (string $line): bool => preg_match('/^\d+\.\s+/u', $line) === 1);

        if (! $unordered && ! $ordered) {
            return null;
        }

        return [
            'type' => 'list',
            'style' => $ordered ? 'ordered' : 'unordered',
            'items' => $lines
                ->map(static fn (string $line): string => trim((string) preg_replace('/^(?:[-*•]|\d+\.)\s+/u', '', $line)))
                ->filter()
                ->all(),
        ];
    }

    private static function resolveQuoteBlock(string $block): ?array
    {
        $lines = collect(preg_split('/\R/u', $block) ?: [])
            ->map(static fn (string $line): string => trim($line))
            ->filter()
            ->values();

        if ($lines->isEmpty() || ! $lines->every(static fn (string $line): bool => str_starts_with($line, '>'))) {
            return null;
        }

        $items = $lines
            ->map(static fn (string $line): string => trim(ltrim($line, '> ')))
            ->filter()
            ->values();

        if ($items->isEmpty()) {
            return null;
        }

        $text = $items->first();
        $author = $items->count() > 1 ? $items->slice(1)->implode(' ') : null;

        return [
            'type' => 'quote',
            'text' => $text,
            'author' => $author,
        ];
    }

    private static function isHeading(string $block, ?string $nextBlock = null): bool
    {
        $normalized = trim($block);

        if ($normalized === '') {
            return false;
        }

        if (preg_match('/^#{1,3}\s+/u', $normalized) === 1) {
            return true;
        }

        if (preg_match('/\R/u', $normalized) === 1) {
            return false;
        }

        if (preg_match('#^(?:/|https?://)#', $normalized) === 1) {
            return false;
        }

        if (mb_strlen($normalized) > 80) {
            return false;
        }

        if (preg_match('/[.:!?]$/u', $normalized) === 1) {
            return false;
        }

        return $nextBlock !== null && trim($nextBlock) !== '';
    }

    private static function normalizeHeading(string $heading): string
    {
        return trim((string) preg_replace('/^#{1,3}\s+/u', '', trim($heading)));
    }
}
