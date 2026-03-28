@extends('site.layouts.app', ['title' => 'Главная'])

@section('content')
    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">CRM и продажи</p>
                <h1 class="site-title">{{ $siteSettings->hero_title ?? 'Внедрение amoCRM, аналитика и автоматизация продаж' }}</h1>
                <p class="site-subtitle">{{ $siteSettings->hero_subtitle ?? 'Помогаем бизнесу не терять заявки, поднимать деньги из базы и наводить порядок в продажах через amoCRM, интеграции и AI-сценарии' }}</p>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}" class="btn btn-primary">Смотреть решения</a>
                    <a href="{{ route('site.contacts') }}" class="btn btn-secondary">Обсудить задачу</a>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-10">
            <div>
                <p class="site-kicker">Основные направления</p>
                <h2 class="site-title">Что можно запустить через CRM, интеграции и AI</h2>
                <p class="site-subtitle">На главной теперь только реальные материалы из базы, без статики и ручных заглушек</p>
            </div>

            <div class="site-grid">
                @foreach($featuredLandings as $landing)
                    <article class="site-card">
                        <p class="site-kicker">{{ $landing->pageTypeLabel() }}</p>
                        <h3 class="site-card-title mt-3">{{ $landing->displayTitle() }}</h3>
                        <p class="site-card-text">{{ $landing->excerpt }}</p>
                        <a href="{{ route('site.landings.show', $landing->slug) }}" class="site-link">Открыть страницу</a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-8">
            <div>
                <p class="site-kicker">Кейсы</p>
                <h2 class="site-title">Последние проекты</h2>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                @forelse($caseStudies as $caseStudy)
                    <article class="site-card">
                        <p class="site-kicker">Кейс</p>
                        <h3 class="site-card-title mt-3">{{ $caseStudy->title }}</h3>
                        <p class="site-card-text">{{ $caseStudy->result_summary ?: $caseStudy->short_description }}</p>
                        <a href="{{ route('site.case-studies.show', $caseStudy->slug) }}" class="site-link">Открыть кейс</a>
                    </article>
                @empty
                    <article class="site-card">
                        <h3 class="site-card-title">Кейсы появятся здесь</h3>
                        <p class="site-card-text">Добавьте опубликованные кейсы в админке</p>
                    </article>
                @endforelse
            </div>

            <a href="{{ route('site.case-studies.index') }}" class="site-link">Все кейсы</a>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-8">
            <div>
                <p class="site-kicker">Статьи</p>
                <h2 class="site-title">Материалы по CRM, продажам и автоматизации</h2>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                @forelse($articles as $article)
                    <article class="site-card">
                        <p class="site-kicker">Статья</p>
                        <h3 class="site-card-title mt-3">{{ $article->title }}</h3>
                        <p class="site-card-text">{{ $article->excerpt ?: $article->short_description }}</p>
                        <a href="{{ route('site.articles.show', $article->slug) }}" class="site-link">Читать статью</a>
                    </article>
                @empty
                    <article class="site-card">
                        <h3 class="site-card-title">Статьи появятся здесь</h3>
                        <p class="site-card-text">Добавьте опубликованные статьи в админке</p>
                    </article>
                @endforelse
            </div>

            <a href="{{ route('site.articles.index') }}" class="site-link">Все статьи</a>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-8">
            <div>
                <p class="site-kicker">Виджеты</p>
                <h2 class="site-title">Готовые решения и интеграции</h2>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                @forelse($widgets as $widget)
                    <article class="site-card">
                        <p class="site-kicker">Виджет</p>
                        <h3 class="site-card-title mt-3">{{ $widget->title }}</h3>
                        <p class="site-card-text">{{ $widget->short_description }}</p>
                        <a href="{{ route('site.widgets.show', $widget->slug) }}" class="site-link">Открыть виджет</a>
                    </article>
                @empty
                    <article class="site-card">
                        <h3 class="site-card-title">Виджеты появятся здесь</h3>
                        <p class="site-card-text">Добавьте опубликованные виджеты в админке</p>
                    </article>
                @endforelse
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-8">
            <div>
                <p class="site-kicker">Отзывы</p>
                <h2 class="site-title">Что говорят клиенты</h2>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                @forelse($testimonials as $testimonial)
                    <article class="site-card">
                        <p class="site-card-text">{{ $testimonial->quote }}</p>
                        <p class="mt-4 text-sm font-medium text-slate-900">{{ $testimonial->author_name }}</p>
                        <p class="text-sm text-slate-500">{{ $testimonial->company_name }}{{ $testimonial->role ? ' · ' . $testimonial->role : '' }}</p>
                    </article>
                @empty
                    <article class="site-card">
                        <h3 class="site-card-title">Отзывы появятся здесь</h3>
                        <p class="site-card-text">Добавьте опубликованные отзывы в админке</p>
                    </article>
                @endforelse
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-8">
            <div>
                <p class="site-kicker">FAQ</p>
                <h2 class="site-title">Частые вопросы</h2>
            </div>

            <div class="space-y-2" x-data="{open: null}">
                @foreach($faqs as $faq)
                    <div class="card p-0">
                        <button class="flex w-full items-center justify-between px-4 py-3 text-left" @click="open = open === {{ $faq->id }} ? null : {{ $faq->id }}">
                            <span class="font-medium">{{ $faq->question }}</span>
                            <span x-text="open === {{ $faq->id }} ? '-' : '+'"></span>
                        </button>
                        <div x-show="open === {{ $faq->id }}" class="px-4 pb-4 text-sm leading-7 text-slate-600" x-cloak>
                            {{ $faq->answer }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
