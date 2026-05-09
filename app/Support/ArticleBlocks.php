<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMNode;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

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

    public static function fromRichText(string $content, ?string $title = null): array
    {
        $content = trim(str_replace(["\r\n", "\r"], "\n", $content));

        if ($content === '') {
            return [];
        }

        if (self::looksLikeHtml($content)) {
            $blocks = self::fromHtml($content, $title);

            if ($blocks !== []) {
                return $blocks;
            }
        }

        if (self::looksLikeMarkdown($content)) {
            $html = (string) Str::markdown($content, [
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ]);
            $blocks = self::fromHtml($html, $title);

            if ($blocks !== []) {
                return $blocks;
            }
        }

        return self::fromLegacyText($content, $title);
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

    private static function looksLikeHtml(string $content): bool
    {
        return preg_match('/<\s*\/?\s*[a-z][^>]*>/iu', $content) === 1;
    }

    private static function looksLikeMarkdown(string $content): bool
    {
        return preg_match('/(^|\n)\s*(#{1,6}\s+|[-*+]\s+|\d+\.\s+|>\s+|!\[[^\]]*]\([^)]+\)|\[[^\]]+]\([^)]+\))/u', $content) === 1;
    }

    private static function fromHtml(string $html, ?string $title = null): array
    {
        $wrapper = '<div id="article-root">'.$html.'</div>';
        $document = new DOMDocument();
        $prev = libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="utf-8" ?>'.$wrapper, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($prev);

        /** @var DOMElement|null $root */
        $root = $document->getElementById('article-root');
        if ($root === null) {
            return [];
        }

        $blocks = [];
        foreach ($root->childNodes as $node) {
            self::collectBlocksFromNode($node, $blocks, $title);
        }

        return self::normalize($blocks);
    }

    private static function collectBlocksFromNode(DOMNode $node, array &$blocks, ?string $title = null): void
    {
        if ($node->nodeType === XML_TEXT_NODE) {
            $text = trim(preg_replace('/\s+/u', ' ', (string) $node->textContent) ?? '');
            if ($text !== '') {
                $blocks[] = [
                    'type' => 'paragraph',
                    'text' => $text,
                ];
            }

            return;
        }

        if ($node->nodeType !== XML_ELEMENT_NODE) {
            return;
        }

        $tag = mb_strtolower($node->nodeName);

        if (in_array($tag, ['script', 'style', 'noscript'], true)) {
            return;
        }

        if (in_array($tag, ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true)) {
            $heading = self::inlineText($node);
            if ($heading !== '' && ($title === null || mb_strtolower($heading) !== mb_strtolower(trim($title)))) {
                $blocks[] = [
                    'type' => 'heading',
                    'text' => $heading,
                    'level' => in_array($tag, ['h1', 'h2'], true) ? 2 : 3,
                ];
            }

            return;
        }

        if ($tag === 'p') {
            if ($img = self::firstImage($node)) {
                $blocks[] = [
                    'type' => 'image',
                    'image_url' => $img['src'],
                    'alt' => $img['alt'],
                    'caption' => null,
                ];
                return;
            }

            $text = self::inlineText($node);
            if ($text !== '') {
                $blocks[] = [
                    'type' => 'paragraph',
                    'text' => $text,
                ];
            }

            return;
        }

        if (in_array($tag, ['ul', 'ol'], true)) {
            $items = [];
            foreach ($node->childNodes as $child) {
                if ($child->nodeType === XML_ELEMENT_NODE && mb_strtolower($child->nodeName) === 'li') {
                    $itemText = self::inlineText($child);
                    if ($itemText !== '') {
                        $items[] = $itemText;
                    }
                }
            }

            if ($items !== []) {
                $blocks[] = [
                    'type' => 'list',
                    'style' => $tag === 'ol' ? 'ordered' : 'unordered',
                    'items' => $items,
                ];
            }

            return;
        }

        if ($tag === 'blockquote') {
            $text = self::inlineText($node);
            if ($text !== '') {
                $blocks[] = [
                    'type' => 'quote',
                    'text' => $text,
                    'author' => null,
                ];
            }

            return;
        }

        if ($tag === 'figure') {
            $imgNode = null;
            $caption = null;
            foreach ($node->childNodes as $child) {
                if ($child->nodeType !== XML_ELEMENT_NODE) {
                    continue;
                }

                $childTag = mb_strtolower($child->nodeName);
                if ($childTag === 'img' && $imgNode === null) {
                    $imgNode = $child;
                } elseif ($childTag === 'figcaption') {
                    $caption = self::inlineText($child);
                }
            }

            if ($imgNode instanceof DOMElement) {
                $src = trim((string) $imgNode->getAttribute('src'));
                if ($src !== '') {
                    $blocks[] = [
                        'type' => 'image',
                        'image_url' => $src,
                        'alt' => trim((string) $imgNode->getAttribute('alt')) ?: null,
                        'caption' => $caption ?: null,
                    ];
                }
            }

            return;
        }

        if ($tag === 'img') {
            $src = trim((string) (($node instanceof DOMElement) ? $node->getAttribute('src') : ''));
            if ($src !== '') {
                $blocks[] = [
                    'type' => 'image',
                    'image_url' => $src,
                    'alt' => ($node instanceof DOMElement ? trim((string) $node->getAttribute('alt')) : '') ?: null,
                    'caption' => null,
                ];
            }

            return;
        }

        foreach ($node->childNodes as $child) {
            self::collectBlocksFromNode($child, $blocks, $title);
        }
    }

    private static function inlineText(DOMNode $node): string
    {
        $text = preg_replace('/\s+/u', ' ', trim((string) $node->textContent)) ?? '';
        return trim($text);
    }

    private static function firstImage(DOMNode $node): ?array
    {
        foreach ($node->childNodes as $child) {
            if ($child->nodeType === XML_ELEMENT_NODE && mb_strtolower($child->nodeName) === 'img' && $child instanceof DOMElement) {
                $src = trim((string) $child->getAttribute('src'));
                if ($src !== '') {
                    return [
                        'src' => $src,
                        'alt' => trim((string) $child->getAttribute('alt')) ?: null,
                    ];
                }
            }
        }

        return null;
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
