@extends('site.layouts.app', [
    'title' => $caseStudy->seoTitle(),
    'metaDescription' => $caseStudy->seoDescription(),
    'canonical' => $caseStudy->canonicalUrl(),
])

@push('meta')
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $caseStudy->seoTitle() }}">
    <meta property="og:description" content="{{ $caseStudy->seoDescription() }}">
    <meta property="og:url" content="{{ $caseStudy->canonicalUrl() }}">
    @if($caseStudy->cover_image)
        <meta property="og:image" content="{{ asset('storage/'.$caseStudy->cover_image) }}">
    @endif
    @if($caseStudy->publishedDate())
        <meta property="article:published_time" content="{{ $caseStudy->publishedDate()->toAtomString() }}">
    @endif
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $caseStudy->seoTitle() }}">
    <meta name="twitter:description" content="{{ $caseStudy->seoDescription() }}">
@endpush

@section('content')
    @php
        $extractPoints = static function (?string $text, int $max = 4): array {
            $raw = trim((string) $text);
            if ($raw === '') {
                return [];
            }

            $lines = preg_split('/\R+/u', $raw) ?: [];
            $items = [];

            foreach ($lines as $line) {
                $line = trim((string) $line);
                $line = preg_replace('/^[\-\*\•\—\–\d\.\)\s]+/u', '', $line ?? '');
                $line = trim((string) $line);
                if ($line !== '') {
                    $items[] = $line;
                }
            }

            if (count($items) < 2) {
                $single = preg_replace('/\s+/u', ' ', $raw);
                $sentences = preg_split('/(?<=[\.\!\?])\s+/u', (string) $single) ?: [];
                $items = [];
                foreach ($sentences as $sentence) {
                    $sentence = trim((string) $sentence);
                    $sentence = rtrim($sentence, '. ');
                    if ($sentence !== '') {
                        $items[] = $sentence;
                    }
                }
            }

            $items = array_values(array_unique(array_filter(array_map(
                static fn ($item) => trim((string) preg_replace('/\s+/u', ' ', (string) $item)),
                $items
            ))));

            return array_slice($items, 0, $max);
        };

        $problemItems = $extractPoints($caseStudy->problem_block, 5);
        $solutionItems = $extractPoints($caseStudy->solution_block, 4);
        $resultItems = $extractPoints($caseStudy->result_block ?: $caseStudy->result_summary, 4);
        $heroResults = array_slice($resultItems, 0, 3);

        if (empty($problemItems)) {
            $problemItems = ['Сделки застревали между этапами без понятной причины.', 'Лиды терялись из-за ручной работы и разрозненных каналов.', 'Руководитель не видел реальную картину по отделу продаж.'];
        }

        if (empty($solutionItems)) {
            $solutionItems = ['Провели разбор текущей логики продаж и точек потерь.', 'Пересобрали воронки и структуру карточек под фактический процесс.', 'Настроили ключевую автоматизацию и интеграции.', 'Закрепили контроль по этапам, задачам и потерям.'];
        }

        if (empty($resultItems)) {
            $resultItems = ['Убрали потери лидов на ключевых этапах.', 'Сделали движение сделок прозрачным для руководителя.', 'Команда начала работать в CRM по единой логике.'];
        }

        if (empty($heroResults)) {
            $heroResults = array_slice($resultItems, 0, 3);
        }

        $solutionTitles = ['Разбор и приоритизация', 'Логика продаж', 'Автоматизация и интеграции', 'Контроль и запуск'];
        $whyWorkedItems = [
            'Сначала разобрали реальные процессы, а не внедряли шаблон.',
            'Убрали лишнее и оставили только рабочую логику сделки.',
            'Собрали автоматизацию под фактическую нагрузку команды.',
            'Закрепили контроль по этапам, срокам и потерям.',
        ];
        $metricItems = $extractPoints($caseStudy->metrics_block, 6);
    @endphp

    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">Кейс</p>
                <h1 class="site-title">{{ $caseStudy->title }}</h1>
                <p class="site-subtitle">{{ $caseStudy->short_description ?: $caseStudy->result_summary }}</p>
                <p class="mt-4 text-sm text-slate-500">
                    Контекст: {{ $caseStudy->client_name ?: 'Клиент не указан' }}{{ $caseStudy->niche ? ' / ' . $caseStudy->niche : '' }}
                    @if($caseStudy->publishedDate())
                        <span class="mx-2">•</span>{{ $caseStudy->publishedDate()->format('d.m.Y') }}
                    @endif
                </p>

                <ul class="mt-5 grid gap-2 text-sm text-slate-700 md:grid-cols-3">
                    @foreach($heroResults as $item)
                        <li class="rounded-xl border border-slate-200 bg-white px-3 py-2">— {{ $item }}</li>
                    @endforeach
                </ul>

                <div class="mt-6">
                    <x-button variant="secondary" :href="route('site.contacts')">Разобрать мою ситуацию</x-button>
                </div>
            </div>
        </div>
    </section>

    @if($metricItems !== [])
        <section class="site-section">
            <div class="container-wrap">
                <div class="service-section-head">
                    <h2 class="site-title service-section-title">Цифры и метрики</h2>
                </div>
                <div class="service-cards-grid service-cards-grid--4">
                    @foreach($metricItems as $item)
                        <article class="site-card service-clean-card">
                            <p class="service-clean-card-text">— {{ $item }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="site-section">
        <div class="container-wrap">
            <div class="service-section-head">
                <h2 class="site-title service-section-title">Ситуация до</h2>
            </div>
            <div class="service-cards-grid service-cards-grid--4">
                @foreach($problemItems as $item)
                    <article class="site-card service-clean-card">
                        <p class="service-clean-card-text">— {{ $item }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <div class="service-section-head">
                <h2 class="site-title service-section-title">Что сделали</h2>
            </div>
            <div class="service-cards-grid service-cards-grid--4">
                @foreach($solutionItems as $index => $item)
                    <article class="site-card service-step-card">
                        <span class="service-step-number">{{ $index + 1 }}</span>
                        <p class="service-clean-card-title">{{ $solutionTitles[$index] ?? ('Шаг ' . ($index + 1)) }}</p>
                        <p class="service-clean-card-text">{{ $item }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <div class="service-section-head">
                <h2 class="site-title service-section-title">Результат</h2>
            </div>
            <article class="site-card service-clean-card">
                <ul class="space-y-2 text-sm text-slate-700 md:text-base">
                    @foreach($resultItems as $item)
                        <li>— {{ $item }}</li>
                    @endforeach
                </ul>
            </article>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <div class="service-section-head">
                <h2 class="site-title service-section-title">Почему это сработало</h2>
            </div>
            <div class="service-cards-grid service-cards-grid--4">
                @foreach($whyWorkedItems as $item)
                    <article class="site-card service-clean-card">
                        <p class="service-clean-card-text">— {{ $item }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <article class="site-card service-clean-card">
                <p class="site-kicker">Разбор ситуации</p>
                <h2 class="site-card-title">Если у вас похожая картина, покажем где теряются деньги и что исправить в CRM в первую очередь</h2>
                <a href="{{ route('site.contacts') }}" class="site-link">Разобрать мою ситуацию</a>
            </article>
        </div>
    </section>

    <section class="site-section service-cta">
        <div class="container-wrap">
            <div class="site-cta-panel">
                <div class="site-cta-grid">
                    <div>
                        <p class="site-dark-kicker">По итогам кейса</p>
                        <h2 class="site-cta-title">Покажем, где вы теряете деньги в продажах</h2>
                        <p class="site-cta-text">Разбираем текущую ситуацию, находим слабые места и показываем, как выстроить систему продаж под ваш бизнес без лишней сложности</p>
                        <div class="mt-8 flex flex-wrap gap-3">
                            <a href="{{ route('site.contacts') }}" class="btn bg-[#ff9b3d] text-slate-950 hover:bg-[#ffb15f]">Разобрать мою ситуацию</a>
                            <a href="{{ route('site.landings.show', 'audit-amocrm') }}" class="btn border border-white/20 bg-white/8 text-white hover:bg-white/14">Смотреть аудит CRM</a>
                        </div>
                    </div>

                    <div class="site-cta-side">
                        <article class="site-cta-note">
                            <p class="site-cta-note-title">Формат</p>
                            <p class="site-cta-note-text">Без перегруза и без продажи ради продажи. Сначала смотрим, где у вас реальные потери, и только потом говорим про внедрение или перевнедрение</p>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <a href="{{ route('site.case-studies.index') }}" class="site-link">Все кейсы</a>
        </div>
    </section>
@endsection
