@extends('site.layouts.app', [
    'title' => 'Кейсы внедрения amoCRM и автоматизации продаж',
    'metaDescription' => 'Подборка кейсов clevercrm.pro: внедрение amoCRM, перевнедрение CRM, автоматизация продаж и понятные результаты для бизнеса.',
    'canonical' => route('site.case-studies.index'),
])

@push('meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Кейсы внедрения amoCRM и автоматизации продаж">
    <meta property="og:description" content="Подборка кейсов clevercrm.pro: внедрение amoCRM, перевнедрение CRM, автоматизация продаж и понятные результаты для бизнеса.">
    <meta property="og:url" content="{{ route('site.case-studies.index') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Кейсы внедрения amoCRM и автоматизации продаж">
    <meta name="twitter:description" content="Подборка кейсов clevercrm.pro: внедрение amoCRM, перевнедрение CRM, автоматизация продаж и понятные результаты для бизнеса.">
@endpush

@section('content')
    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">Раздел сайта</p>
                <h1 class="site-title">Кейсы</h1>
                <p class="site-subtitle">Реальные проекты с понятной бизнес-логикой: задача, решение и итоговый результат.</p>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-6">
            <div class="site-grid">
                @foreach($caseStudies as $case)
                    <article class="site-card">
                        @if($case->logoUrl())
                            <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                                <img src="{{ $case->logoUrl() }}" alt="{{ $case->client_name ?: $case->title }}" class="h-10 w-10 object-contain" loading="lazy">
                            </div>
                        @endif
                        <p class="site-kicker">Кейс</p>
                        <h2 class="site-card-title">{{ $case->title }}</h2>
                        <p class="site-card-text">{{ $case->result_summary ?: $case->short_description }}</p>
                        @if($case->niche || $case->publishedDate())
                            <p class="mt-3 text-xs uppercase tracking-[0.16em] text-slate-400">
                                {{ $case->niche ?: 'Кейс' }}@if($case->niche && $case->publishedDate()) · @endif{{ optional($case->publishedDate())->format('d.m.Y') }}
                            </p>
                        @endif
                        <a href="{{ route('site.case-studies.show', $case->slug) }}" class="site-link">Открыть кейс</a>
                    </article>
                @endforeach
            </div>
            {{ $caseStudies->links() }}
        </div>
    </section>
@endsection
