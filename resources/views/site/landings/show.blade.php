@extends('site.layouts.app', [
    'title' => $landing->seoTitle(),
    'metaDescription' => $landing->seoDescription(),
    'canonical' => $landing->canonicalUrl(),
    'robots' => 'index,follow',
])

@section('content')
    <div class="container-wrap landing-shell">
        @foreach($sections as $section)
            @include($section['view'], [
                'landing' => $landing,
                'section' => $section['data'],
            ])
        @endforeach

        @include('site.partials.landing-form', [
            'landing' => $landing,
            'formConfig' => $formConfig,
        ])

        @if($relatedLandings->isNotEmpty())
            <section class="landing-section">
                <div class="site-page-hero-box">
                    <p class="site-kicker">Внутренняя перелинковка</p>
                    <h2 class="landing-section-heading !mb-2">Другие услуги и решения</h2>
                    <p class="landing-section-copy">Соседние решения по внедрению, перевнедрению, автоматизации и типовым проблемам в продажах.</p>

                    <div class="landing-related-grid mt-6">
                        @foreach($relatedLandings as $relatedLanding)
                            <article class="landing-card">
                                <p class="site-kicker">{{ $relatedLanding['page_type_label'] }}</p>
                                <h3 class="landing-card-title mt-3">{{ $relatedLanding['title'] }}</h3>
                                <p class="landing-card-text">{{ $relatedLanding['excerpt'] }}</p>
                                <a href="{{ $relatedLanding['url'] }}" class="site-link">{{ $relatedLanding['anchor_text'] }}</a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
