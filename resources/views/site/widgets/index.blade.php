@extends('site.layouts.app', ['title' => 'Виджеты', 'canonical' => route('site.widgets.index')])

@section('content')
    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">Раздел сайта</p>
                <h1 class="site-title">Виджеты</h1>
                <p class="site-subtitle">Готовые CRM-виджеты и плагины, которые ускоряют процессы и добавляют нужную бизнес-логику.</p>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-6">
            <div class="site-grid">
                @foreach($widgets as $widget)
                    <article class="site-card">
                        <p class="site-kicker">Виджет</p>
                        <h2 class="site-card-title">{{ $widget->title }}</h2>
                        <p class="site-card-text">{{ $widget->short_description }}</p>
                        @if($widget->price_text)
                            <p class="mt-2 text-xs font-medium uppercase tracking-wide text-slate-500">{{ $widget->price_text }}</p>
                        @endif
                        <a href="{{ route('site.widgets.show', $widget->slug) }}" class="site-link">Подробнее</a>
                    </article>
                @endforeach
            </div>
            {{ $widgets->links() }}
        </div>
    </section>
@endsection
