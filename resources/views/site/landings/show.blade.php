@extends('site.layouts.app', [
    'title' => $landing->seoTitle(),
    'metaDescription' => $landing->seoDescription(),
    'canonical' => $landing->canonicalUrl(),
    'robots' => 'index,follow',
])

@php
    $landingTitle = strip_tags($landing->h1 ?: $landing->title);
    $landingDescription = $landing->seoDescription();
    $landingUrl = $landing->canonicalUrl();
    $faqSection = collect($sections)->firstWhere('data.type', 'faq');
    $faqItems = collect($faqSection['data']['items'] ?? [])
        ->filter(fn ($item) => is_array($item) && filled($item['question'] ?? null) && filled($item['answer'] ?? null))
        ->values();

    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $landingTitle,
        'description' => $landingDescription,
        'url' => $landingUrl,
        'serviceType' => $landing->pageTypeLabel(),
        'provider' => [
            '@type' => 'Organization',
            'name' => $siteSettings->site_name ?? 'CleverCRM',
            'url' => route('site.home'),
        ],
        'areaServed' => [
            '@type' => 'Country',
            'name' => 'Россия',
        ],
    ];

    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Главная',
                'item' => route('site.home'),
            ],
            [
                '@type' => 'ListItem',
                'position' => 2,
                'name' => $landingTitle,
                'item' => $landingUrl,
            ],
        ],
    ];

    $faqSchema = $faqItems->isEmpty() ? null : [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqItems
            ->map(fn ($item) => [
                '@type' => 'Question',
                'name' => $item['question'],
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $item['answer'],
                ],
            ])
            ->all(),
    ];
@endphp

@push('meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $landing->seoTitle() }}">
    <meta property="og:description" content="{{ $landingDescription }}">
    <meta property="og:url" content="{{ $landingUrl }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $landing->seoTitle() }}">
    <meta name="twitter:description" content="{{ $landingDescription }}">
@endpush

@push('schema')
    <script type="application/ld+json">{!! json_encode($serviceSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    <script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @if($faqSchema)
        <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @endif
@endpush

@section('content')
    @foreach($sections as $section)
        @if(($section['data']['type'] ?? '') === 'steps')
            @include($section['view'], [
                'landing' => $landing,
                'section' => $section['data'],
            ])
        @else
            <div class="container-wrap landing-shell">
                @include($section['view'], [
                    'landing' => $landing,
                    'section' => $section['data'],
                ])
            </div>
        @endif
    @endforeach

    <div class="container-wrap landing-shell">
        @unless($landing->slug === 'razrabotka-crm')
            @include('site.partials.landing-form', [
                'landing' => $landing,
                'formConfig' => $formConfig,
            ])
        @endunless

        @if($relatedLandings->isNotEmpty())
            <style>
                .rl-section { padding:48px 0; }
                .rl-kicker { font-family:'Manrope',system-ui,sans-serif; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.14em; color:#f97316; }
                .rl-title { font-family:'Manrope',system-ui,sans-serif; font-size:clamp(28px,3.5vw,42px); font-weight:800; letter-spacing:-.03em; line-height:1.1; color:#111; margin-top:10px; }
                .rl-desc { font-family:'Manrope',system-ui,sans-serif; font-size:15px; line-height:1.7; color:rgba(17,17,17,.45); margin-top:8px; }
                .rl-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-top:28px; }
                .rl-card { background:#fff; border:1px solid rgba(0,0,0,.04); border-radius:22px; padding:28px; box-shadow:0 8px 32px rgba(0,0,0,.06), 0 2px 8px rgba(0,0,0,.03); transition:all .3s; text-decoration:none; display:flex; flex-direction:column; }
                .rl-card:hover { transform:translateY(-4px); box-shadow:0 16px 48px rgba(0,0,0,.1); border-color:rgba(249,115,22,.12); }
                .rl-card-kicker { font-family:'Manrope',system-ui,sans-serif; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:#f97316; }
                .rl-card-title { font-family:'Manrope',system-ui,sans-serif; font-size:18px; font-weight:700; letter-spacing:-.02em; color:#111; margin-top:12px; }
                .rl-card-text { font-family:'Manrope',system-ui,sans-serif; font-size:14px; line-height:1.6; color:rgba(17,17,17,.45); margin-top:8px; flex:1; }
                .rl-card-link { font-family:'Manrope',system-ui,sans-serif; font-size:14px; font-weight:600; color:#f97316; text-decoration:none; display:inline-flex; align-items:center; gap:4px; margin-top:16px; transition:gap .2s; }
                .rl-card-link:hover { gap:8px; }
                .rl-card-link::after { content:'→'; }

                .rl-anim { opacity:0; transform:translateY(28px); transition:opacity .7s cubic-bezier(.23,1,.32,1), transform .7s cubic-bezier(.23,1,.32,1); }
                .rl-section.rl-visible .rl-anim { opacity:1; transform:translateY(0); }

                @media (max-width:767px) {
                    .rl-grid { grid-template-columns:1fr; }
                }
            </style>

            <section class="rl-section" id="rl-section">
                <div class="rl-kicker rl-anim" style="transition-delay:.2s">Ещё</div>
                <h2 class="rl-title rl-anim" style="transition-delay:.35s">Другие услуги и решения</h2>
                <p class="rl-desc rl-anim" style="transition-delay:.45s">Соседние решения по внедрению, автоматизации и типовым проблемам в продажах.</p>

                <div class="rl-grid">
                    @foreach($relatedLandings as $index => $relatedLanding)
                        <div class="rl-card rl-anim" style="transition-delay:{{ 0.6 + $index * 0.15 }}s">
                            <div class="rl-card-kicker">{{ $relatedLanding['page_type_label'] }}</div>
                            <h3 class="rl-card-title">{{ strip_tags($relatedLanding['title']) }}</h3>
                            <p class="rl-card-text">{{ $relatedLanding['excerpt'] }}</p>
                            <a href="{{ $relatedLanding['url'] }}" class="rl-card-link">{{ $relatedLanding['anchor_text'] }}</a>
                        </div>
                    @endforeach
                </div>
            </section>

            <script>
            (function() {
                var section = document.getElementById('rl-section');
                if (!section) return;
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            section.classList.add('rl-visible');
                            observer.unobserve(section);
                        }
                    });
                }, { threshold: 0.2 });
                observer.observe(section);
            })();
            </script>
        @endif
    </div>
@endsection
