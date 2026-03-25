@extends('site.layouts.app', ['title' => $widget->seo_title ?: $widget->title, 'metaDescription' => $widget->seo_description])

@section('content')
    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">Виджет</p>
                <h1 class="site-title">{{ $widget->title }}</h1>
                <p class="site-subtitle">{{ $widget->platform_compatibility }}</p>
                @if($widget->price_text)
                    <p class="mt-3 text-sm text-slate-500">{{ $widget->price_text }}</p>
                @endif
            </div>
        </div>
    </section>

    <section class="site-section">
        <article class="container-wrap card prose-lite">
            <div class="whitespace-pre-line">{{ $widget->full_content }}</div>
            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('site.widgets.index') }}" class="btn btn-secondary">Все виджеты</a>
                @if($widget->external_link)
                    <a class="btn btn-primary" href="{{ $widget->external_link }}" target="_blank" rel="noreferrer">Перейти к виджету</a>
                @endif
            </div>
        </article>
    </section>
@endsection
