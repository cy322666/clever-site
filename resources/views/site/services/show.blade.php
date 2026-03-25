@extends('site.layouts.app', ['title' => $service->seo_title ?: $service->title, 'metaDescription' => $service->seo_description])

@section('content')
    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">Услуга</p>
                <h1 class="site-title">{{ $service->title }}</h1>
                <p class="site-subtitle">{{ $service->short_description }}</p>
            </div>
        </div>
    </section>

    <section class="site-section">
        <article class="container-wrap card prose-lite">
            <div class="whitespace-pre-line">{{ $service->full_content }}</div>
            <a href="{{ route('site.services.index') }}" class="site-link">Все услуги</a>
        </article>
    </section>
@endsection
