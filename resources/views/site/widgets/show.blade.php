@extends('site.layouts.app', [
    'title' => $widget->seo_title ?: $widget->title,
    'metaDescription' => $widget->seo_description,
    'canonical' => route('site.widgets.show', $widget->slug),
])

@push('meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $widget->seo_title ?: $widget->title }}">
    <meta property="og:description" content="{{ $widget->seo_description ?: $widget->short_description ?: $widget->title }}">
    <meta property="og:url" content="{{ route('site.widgets.show', $widget->slug) }}">
    @if($widget->coverImageUrl())
        <meta property="og:image" content="{{ $widget->coverImageUrl() }}">
        <meta name="twitter:image" content="{{ $widget->coverImageUrl() }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $widget->seo_title ?: $widget->title }}">
    <meta name="twitter:description" content="{{ $widget->seo_description ?: $widget->short_description ?: $widget->title }}">
@endpush

@section('content')
    @php($galleryImages = $widget->galleryImages())

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
            {!! $widget->renderedContent() !!}

            @if(! empty($galleryImages))
                <div class="widget-gallery mb-8">
                    @foreach($galleryImages as $index => $imageUrl)
                        <div class="widget-gallery-item">
                            <img
                                src="{{ $imageUrl }}"
                                alt="{{ $widget->title }} — изображение {{ $index + 1 }}"
                                class="widget-gallery-image"
                                loading="lazy"
                            >
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="mt-6 flex flex-wrap gap-3">
                <a href="{{ route('site.widgets.index') }}" class="btn btn-secondary">Все виджеты</a>
                @if($widget->external_link)
                    <a class="btn btn-primary" href="{{ $widget->external_link }}" target="_blank" rel="noreferrer">Перейти к виджету</a>
                @endif
            </div>
        </article>
    </section>

    <section class="site-section pt-0">
        <div class="container-wrap">
            <div class="site-cta-panel">
                <div class="site-cta-grid">
                    <div>
                        <p class="site-dark-kicker">Нужна доработка под ваш CRM-стек</p>
                        <h2 class="site-cta-title">Покажем, как встроить виджет в amoCRM без хаоса в продажах</h2>
                        <p class="site-cta-text">Если нужен не просто отдельный модуль, а рабочая связка с CRM, отделом продаж и текущими каналами, разберем задачу и предложим короткий путь запуска</p>
                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="{{ route('site.contacts') }}" class="btn bg-[#ff9b3d] text-slate-950 hover:bg-[#ffb15f]">Разобрать задачу</a>
                            <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}" class="btn border border-white/20 bg-white/8 text-white hover:bg-white/14">Смотреть внедрение</a>
                        </div>
                    </div>

                    <div class="site-cta-side">
                        <article class="site-cta-note">
                            <p class="site-cta-note-title">Когда это особенно полезно</p>
                            <p class="site-cta-note-text">Когда виджет должен не просто работать сам по себе, а давать деньги через CRM, заявки и клиентскую базу</p>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
