@extends('site.layouts.app', [
    'title' => 'Статьи про amoCRM, продажи и автоматизацию',
    'metaDescription' => 'Публичные статьи про amoCRM, перевнедрение CRM, обработку заявок, базу клиентов, AI и контроль продаж',
    'canonical' => route('site.articles.index'),
])

@push('meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Статьи про amoCRM, продажи и автоматизацию">
    <meta property="og:description" content="Публичные статьи про amoCRM, перевнедрение CRM, обработку заявок, базу клиентов, AI и контроль продаж">
    <meta property="og:url" content="{{ route('site.articles.index') }}">
    <meta name="twitter:card" content="summary">
@endpush

@section('content')
    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">Раздел сайта</p>
                <h1 class="site-title">Статьи</h1>
                <p class="site-subtitle">Материалы про amoCRM, деньги внутри отдела продаж, клиентскую базу, автоматизацию и ситуации, когда CRM нужно не донастраивать, а пересобирать.</p>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-6">
            <div class="site-grid">
                @foreach($articles as $article)
                    <article class="site-card">
                        @if($article->publishedDate())
                            <p class="site-kicker">{{ $article->publishedDate()->format('d.m.Y') }}</p>
                        @endif
                        <h2 class="site-card-title">{{ $article->title }}</h2>
                        <p class="site-card-text">{{ $article->excerptText() }}</p>
                        <a href="{{ route('site.articles.show', $article->slug) }}" class="site-link">Читать статью</a>
                    </article>
                @endforeach
            </div>
            {{ $articles->links() }}
        </div>
    </section>
@endsection
