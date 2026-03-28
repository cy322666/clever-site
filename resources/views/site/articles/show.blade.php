@extends('site.layouts.app', ['title' => $article->seo_title ?: $article->title, 'metaDescription' => $article->seo_description])

@section('content')
    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">Статья</p>
                <h1 class="site-title">{{ $article->title }}</h1>
                <p class="mt-3 text-sm text-slate-500">{{ optional($article->published_at)->format('d.m.Y') }}</p>
            </div>
        </div>
    </section>

    <section class="site-section">
        <article class="container-wrap card prose-lite">
            <div class="space-y-6">
                @foreach($contentBlocks as $block)
                    @if($block['type'] === 'heading')
                        <h2 class="text-2xl font-semibold tracking-tight text-slate-900 md:text-3xl">{{ $block['text'] }}</h2>
                    @elseif($block['type'] === 'paragraph')
                        <p class="text-base leading-8 text-slate-700">{{ $block['text'] }}</p>
                    @elseif($block['type'] === 'links')
                        <div class="space-y-4">
                            @if(!empty($block['title']))
                                <h3 class="text-xl font-semibold tracking-tight text-slate-900">{{ $block['title'] }}</h3>
                            @endif

                            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                                @foreach($block['items'] as $item)
                                    <a href="{{ $item['url'] }}" class="site-card no-underline">
                                        @if(!empty($item['badge']))
                                            <p class="site-kicker">{{ $item['badge'] }}</p>
                                        @endif
                                        <h3 class="site-card-title mt-3">{{ $item['title'] }}</h3>
                                        @if(!empty($item['description']))
                                            <p class="site-card-text">{{ $item['description'] }}</p>
                                        @endif
                                        <span class="site-link">Открыть</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </article>
    </section>

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
