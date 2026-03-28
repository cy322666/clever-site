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
    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">Статья</p>
                <h1 class="site-title">{{ $article->title }}</h1>
                <div class="mt-3 flex flex-wrap items-center gap-3 text-sm text-slate-500">
                    @if($article->publishedDate())
                        <time datetime="{{ $article->publishedDate()->toDateString() }}">{{ $article->publishedDate()->format('d.m.Y') }}</time>
                    @endif
                    @if($article->excerptText() !== '')
                        <span class="hidden h-1 w-1 rounded-full bg-slate-300 md:block"></span>
                        <span class="max-w-3xl">{{ $article->excerptText() }}</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <article class="container-wrap card prose-lite">
            <div class="space-y-6">
                @foreach($contentBlocks as $block)
                    @include($block['view'], ['block' => $block['data']])
                @endforeach
            </div>
        </article>
    </section>

    @if($relatedLandings->isNotEmpty())
        <section class="site-section pt-0">
            <div class="container-wrap">
                <div class="space-y-4">
                    <p class="site-kicker">По теме</p>
                    <div class="grid gap-4 md:grid-cols-3">
                        @foreach($relatedLandings as $landing)
                            <article class="site-card">
                                <p class="site-kicker">{{ $landing->pageTypeLabel() }}</p>
                                <h2 class="site-card-title mt-3">{{ $landing->displayTitle() }}</h2>
                                <p class="site-card-text">{{ $landing->excerpt }}</p>
                                <a href="{{ route('site.landings.show', $landing->slug) }}" class="site-link">Открыть страницу</a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="site-section pt-0">
        <div class="container-wrap">
            <div class="space-y-4">
                <p class="site-kicker">Читайте дальше</p>
                <div class="grid gap-4 md:grid-cols-3">
                    @foreach($moreArticles as $moreArticle)
                        <article class="site-card">
                            <p class="site-kicker">Статья</p>
                            <h2 class="site-card-title mt-3">{{ $moreArticle->title }}</h2>
                            <p class="site-card-text">{{ $moreArticle->excerpt ?: $moreArticle->short_description }}</p>
                            <a href="{{ route('site.articles.show', $moreArticle->slug) }}" class="site-link">Открыть статью</a>
                        </article>
                    @endforeach

                    <article class="site-card">
                        <p class="site-kicker">Раздел</p>
                        <h2 class="site-card-title mt-3">Все статьи</h2>
                        <p class="site-card-text">Все материалы по amoCRM, продажам, автоматизации и внедрению CRM в одном разделе</p>
                        <a href="{{ route('site.articles.index') }}" class="site-link">Перейти в статьи</a>
                    </article>
                </div>
            </div>
        </div>
    </section>
@endsection
