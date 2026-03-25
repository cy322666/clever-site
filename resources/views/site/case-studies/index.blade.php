@extends('site.layouts.app', ['title' => 'Кейсы'])

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
                        <h2 class="site-card-title">{{ $case->title }}</h2>
                        <p class="site-card-text">{{ $case->result_summary }}</p>
                        <a href="{{ route('site.case-studies.show', $case->slug) }}" class="site-link">Открыть кейс</a>
                    </article>
                @endforeach
            </div>
            {{ $caseStudies->links() }}
        </div>
    </section>
@endsection
