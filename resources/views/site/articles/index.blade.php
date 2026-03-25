@extends('site.layouts.app', ['title' => 'Статьи'])

@section('content')
    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">Раздел сайта</p>
                <h1 class="site-title">Статьи</h1>
                <p class="site-subtitle">Экспертные материалы и практические рекомендации по CRM, автоматизации и росту продаж.</p>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-6">
            <div class="site-grid">
                @foreach($articles as $article)
                    <article class="site-card">
                        <h2 class="site-card-title">{{ $article->title }}</h2>
                        <p class="site-card-text">{{ $article->excerpt ?: $article->short_description }}</p>
                        <a href="{{ route('site.articles.show', $article->slug) }}" class="site-link">Читать статью</a>
                    </article>
                @endforeach
            </div>
            {{ $articles->links() }}
        </div>
    </section>
@endsection
