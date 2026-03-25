@extends('site.layouts.app', ['title' => 'Услуги'])

@section('content')
    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">Раздел сайта</p>
                <h1 class="site-title">Услуги</h1>
                <p class="site-subtitle">Практические услуги CRM-интегратора: от внедрения и перевнедрения до аналитики и сопровождения.</p>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-6">
            <div class="site-grid">
                @foreach($services as $service)
                    <article class="site-card">
                        <h2 class="site-card-title">{{ $service->title }}</h2>
                        <p class="site-card-text">{{ $service->short_description }}</p>
                        <a href="{{ route('site.services.show', $service->slug) }}" class="site-link">Подробнее</a>
                    </article>
                @endforeach
            </div>
            {{ $services->links() }}
        </div>
    </section>
@endsection
