@extends('site.layouts.app', [
    'title' => $article->seoTitle(),
    'metaDescription' => $article->seoDescription(),
    'canonical' => $article->canonicalUrl(),
])

@push('meta')
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $article->seoTitle() }}">
    <meta property="og:description" content="{{ $article->seoDescription() }}">
    <meta property="og:url" content="{{ $article->canonicalUrl() }}">
    @if($article->coverImageUrl())
        <meta property="og:image" content="{{ $article->coverImageUrl() }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image" content="{{ $article->coverImageUrl() }}">
    @else
        <meta name="twitter:card" content="summary">
    @endif
    <meta name="twitter:title" content="{{ $article->seoTitle() }}">
    <meta name="twitter:description" content="{{ $article->seoDescription() }}">
    @if($article->publishedDate())
        <meta property="article:published_time" content="{{ $article->publishedDate()->toAtomString() }}">
    @endif
@endpush

@section('content')
    @php
        $articleExcerpt = $article->excerptText();
        $articleReadingSource = trim(strip_tags(($article->full_content ?: '').' '.collect($contentBlocks)->map(function (array $block): string {
            $data = $block['data'] ?? [];

            return collect([
                $data['text'] ?? null,
                $data['title'] ?? null,
                $data['caption'] ?? null,
                isset($data['items']) && is_array($data['items']) ? implode(' ', array_map(
                    static fn (mixed $item): string => is_array($item) ? (string) ($item['title'] ?? $item['text'] ?? '') : (string) $item,
                    $data['items']
                )) : null,
            ])->filter()->implode(' ');
        })->implode(' ')));
        $articleWords = preg_split('/\s+/u', $articleReadingSource, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $articleReadingMinutes = max(3, (int) ceil(count($articleWords) / 180));
        $articleSummaryItems = collect($contentBlocks)
            ->map(static fn (array $block): string => trim((string) ($block['data']['title'] ?? '')))
            ->filter()
            ->take(3)
            ->values();

        if ($articleSummaryItems->isEmpty()) {
            $articleSummaryItems = collect([
                'Почему CRM формально внедрена, но не помогает продажам.',
                'Какие ошибки чаще всего ломают работу отдела в amoCRM.',
                'С чего начать, если систему нужно вернуть в рабочее состояние.',
            ]);
        }
        $articleTocItems = collect($contentBlocks)
            ->map(static function (array $block, int $index): ?array {
                if (($block['data']['type'] ?? null) !== 'heading') {
                    return null;
                }

                $title = trim((string) ($block['data']['text'] ?? ''));

                if ($title === '') {
                    return null;
                }

                return [
                    'id' => 'article-section-'.($index + 1),
                    'title' => $title,
                ];
            })
            ->filter()
            ->values();
    @endphp

    <section class="article-executive-hero article-report-reveal">
        <div class="container-wrap">
            <div class="article-executive-grid">
                <div class="article-executive-copy">
                    <p class="article-executive-kicker">Статья / amoCRM</p>
                    <h1 class="article-executive-title">{{ $article->title }}</h1>
                    @if($articleExcerpt !== '')
                        <p class="article-executive-lead">{{ $articleExcerpt }}</p>
                    @endif
                    <p class="article-executive-meta">
                    @if($article->publishedDate())
                        <time datetime="{{ $article->publishedDate()->toDateString() }}">{{ $article->publishedDate()->format('d.m.Y') }}</time>
                    @endif
                        <span>{{ $articleReadingMinutes }} минут чтения</span>
                        <span>CRM-разбор</span>
                    </p>
                    <div class="article-executive-actions">
                        <a href="#article-content" class="article-executive-btn article-executive-btn-primary">Читать статью</a>
                        <a href="{{ route('site.articles.index') }}" class="article-executive-btn article-executive-btn-secondary">Все статьи</a>
                    </div>
                </div>

                <aside class="article-executive-card">
                    <p class="article-executive-card-kicker">Коротко</p>
                    <h2 class="article-executive-card-title">CRM не работает не из-за инструмента, а из-за процесса вокруг него</h2>
                    <ul class="article-executive-summary">
                        @foreach($articleSummaryItems as $item)
                            <li><i>{{ $loop->iteration }}</i><span>{{ Str::limit($item, 92) }}</span></li>
                        @endforeach
                    </ul>
                </aside>
            </div>
        </div>
    </section>

    <section class="article-content-section article-editorial-cascade" id="article-content">
        <div class="container-wrap article-content-layout">
            @if($articleTocItems->isNotEmpty())
                <aside class="article-content-toc" aria-label="Навигация по статье">
                    <p>В статье</p>
                    @foreach($articleTocItems as $item)
                        <a href="#{{ $item['id'] }}">{{ $item['title'] }}</a>
                    @endforeach
                </aside>
            @endif

            <article class="article-content-card prose-lite">
                <div class="space-y-6">
                    @foreach($contentBlocks as $block)
                        @php
                            $articleBlockId = ($block['data']['type'] ?? null) === 'heading' ? 'article-section-'.($loop->iteration) : null;
                        @endphp
                        <div @if($articleBlockId) id="{{ $articleBlockId }}" class="article-content-anchor" @endif>
                            @include($block['view'], ['block' => $block['data']])
                        </div>
                    @endforeach
                </div>
            </article>
        </div>
    </section>

    @if($relatedLandings->isNotEmpty())
        <section class="cases-related-section article-detail-related-section case-related-cascade">
            <div class="container-wrap">
                <div class="cases-rl-wrap">
                    <div class="cases-rl-head">
                        <div>
                            <p class="cases-rl-kicker">Читайте также</p>
                            <h3 class="cases-rl-title">Материалы <span>по теме</span></h3>
                        </div>
                        <a href="{{ route('site.contacts') }}" class="cases-rl-all">Обсудить задачу →</a>
                    </div>
                    <div class="cases-rl-grid">
                        @foreach($relatedLandings as $landing)
                            <a href="{{ route('site.landings.show', $landing->slug) }}" class="cases-rl-card">
                                <div class="cases-rl-cat">{{ $landing->pageTypeLabel() }}</div>
                                <h4 class="cases-rl-card-title">{{ $landing->displayTitle() }}</h4>
                                @if($landing->excerpt)
                                    <p class="cases-rl-card-desc">{{ $landing->excerpt }}</p>
                                @endif
                                <div class="cases-rl-meta">
                                    <span>{{ Str::limit($landing->slug, 22) }}</span>
                                    <span class="cases-rl-read">Открыть →</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="cases-related-section article-read-more-section case-related-cascade">
        <div class="container-wrap">
            <div class="cases-rl-wrap">
                <div class="cases-rl-head">
                    <div>
                        <p class="cases-rl-kicker">Читайте дальше</p>
                        <h3 class="cases-rl-title">Еще материалы <span>по CRM</span></h3>
                    </div>
                    <a href="{{ route('site.articles.index') }}" class="cases-rl-all">Все статьи →</a>
                </div>
                <div class="cases-rl-grid">
                    @foreach($moreArticles as $moreArticle)
                        <a href="{{ route('site.articles.show', $moreArticle->slug) }}" class="cases-rl-card">
                            <div class="cases-rl-cat">Статья</div>
                            <h4 class="cases-rl-card-title">{{ $moreArticle->title }}</h4>
                            <p class="cases-rl-card-desc">{{ $moreArticle->excerpt ?: $moreArticle->short_description }}</p>
                            <div class="cases-rl-meta">
                                <span>{{ $moreArticle->publishedDate()->format('d.m.Y') }}</span>
                                <span class="cases-rl-read">Открыть →</span>
                            </div>
                        </a>
                    @endforeach

                    <a href="{{ route('site.articles.index') }}" class="cases-rl-card">
                        <div class="cases-rl-cat">Раздел</div>
                        <h4 class="cases-rl-card-title">Все статьи</h4>
                        <p class="cases-rl-card-desc">Все материалы по amoCRM, продажам, автоматизации и внедрению CRM в одном разделе</p>
                        <div class="cases-rl-meta">
                            <span>База знаний</span>
                            <span class="cases-rl-read">Перейти →</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="article-read-more-gap" aria-hidden="true"></div>
    </section>
@endsection
