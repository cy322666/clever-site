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
            <div class="whitespace-pre-line">{{ $article->full_content }}</div>
            <a href="{{ route('site.articles.index') }}" class="site-link">Все статьи</a>
        </article>
    </section>
@endsection
