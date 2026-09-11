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

@php
    $caseImage = $caseStudy->coverImageUrl();
    $caseImageUrl = $caseImage && preg_match('#^https?://#', $caseImage) ? $caseImage : ($caseImage ? url($caseImage) : null);
    $caseStudySchema = [
        '@context' => 'https://schema.org',
        '@type' => 'CreativeWork',
        'name' => $caseStudy->seoTitle(),
        'description' => $caseStudy->seoDescription(),
        'url' => $caseStudy->canonicalUrl(),
        'datePublished' => optional($caseStudy->publishedDate())->toAtomString(),
        'dateModified' => optional($caseStudy->updated_at)->toAtomString(),
        'image' => $caseImageUrl,
        'about' => $caseStudy->niche,
        'provider' => [
            '@type' => 'Organization',
            'name' => $siteSettings->site_name ?? 'CleverCRM',
            'url' => route('site.home'),
        ],
    ];
    $caseStudySchema = array_filter($caseStudySchema, static fn ($value) => filled($value));
@endphp

@push('schema')
    <script type="application/ld+json">{!! json_encode($caseStudySchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@section('content')
    @php
        $extractPoints = static function (?string $text, int $max = 5): array {
            $raw = trim((string) $text);

            if ($raw === '') {
                return [];
            }

            $lines = preg_split('/\R+/u', $raw) ?: [];
            $items = [];

            foreach ($lines as $line) {
                $line = trim((string) preg_replace('/^[\-\*\•\—\–\d\.\)\s]+/u', '', (string) $line));

                if ($line !== '') {
                    $items[] = $line;
                }
            }

            if (count($items) < 2) {
                $sentences = preg_split('/(?<=[\.\!\?])\s+/u', preg_replace('/\s+/u', ' ', $raw)) ?: [];
                $items = array_filter(array_map(static fn ($item) => trim((string) $item, " \t\n\r\0\x0B."), $sentences));
            }

            return array_slice(array_values(array_unique($items)), 0, $max);
        };

        $problemItems = $extractPoints($caseStudy->problem_block, 4);
        $solutionItems = $extractPoints($caseStudy->solution_block, 4);
        $resultItems = $extractPoints($caseStudy->result_block ?: $caseStudy->result_summary, 4);
        $metricItems = $extractPoints($caseStudy->metrics_block, 6);

        $problemItems = $problemItems ?: ['Не было прозрачной картины по сделкам, задачам и потерям в продажах.'];
        $solutionItems = $solutionItems ?: ['Разобрали процесс, пересобрали логику CRM и закрепили контроль по ключевым этапам.'];
        $resultItems = $resultItems ?: ['CRM стала понятным инструментом для менеджеров и руководителя.'];
        $metricItems = $metricItems ?: array_slice($resultItems, 0, 3);
        $defaultMetrics = [
            $caseStudy->result_summary ?: 'Появилась понятная картина по продажам и потерям',
            'Менеджеры работают по единой логике без лишней ручной сверки',
            'Руководитель видит проблемные этапы и точки контроля',
        ];

        foreach ($defaultMetrics as $metric) {
            if (count($metricItems) >= 3) {
                break;
            }

            if (! in_array($metric, $metricItems, true)) {
                $metricItems[] = $metric;
            }
        }

        $clientName = $caseStudy->client_name ?: 'Клиент CleverCRM';
        $caseCoverImage = $caseStudy->coverImageUrl();
        $heroVisual = $caseCoverImage ?: asset('images/hero-sales-system-v3.png');
        $cleanFullContent = trim(strip_tags((string) $caseStudy->full_content));
        $showFullContent = $cleanFullContent !== '' && ! Str::startsWith($cleanFullContent, 'Подробное описание проекта');
        $processSteps = [
            ['label' => '01', 'title' => 'Диагностика', 'text' => $problemItems[0] ?? 'Нашли точки потерь и лишние действия в текущем процессе.'],
            ['label' => '02', 'title' => 'Архитектура', 'text' => $solutionItems[0] ?? 'Собрали новую логику воронок, ролей, задач и статусов.'],
            ['label' => '03', 'title' => 'Запуск', 'text' => $resultItems[0] ?? 'Передали команде рабочую систему контроля продаж.'],
        ];
    @endphp

    <section class="case-story-hero">
        <div class="container-wrap">
            <nav class="case-story-breadcrumb" aria-label="Навигация">
                <a href="{{ route('site.home') }}">Главная</a>
                <span>/</span>
                <a href="{{ route('site.case-studies.index') }}">Кейсы</a>
                <span>/</span>
                <span>{{ Str::limit($clientName, 34) }}</span>
            </nav>

            <div class="case-story-hero-grid">
                <div class="case-story-hero-copy">
                    <p class="case-story-kicker">Кейс amoCRM</p>
                    <h1 class="case-story-title">{{ $caseStudy->title }}</h1>
                    @if($caseStudy->short_description || $caseStudy->result_summary)
                        <p class="case-story-lead">{{ $caseStudy->short_description ?: $caseStudy->result_summary }}</p>
                    @endif

                    <div class="case-story-meta">
                        <div>
                            <span>Клиент</span>
                            <strong>{{ $clientName }}</strong>
                        </div>
                        <div>
                            <span>Отрасль</span>
                            <strong>{{ $caseStudy->niche ?: 'CRM-проект' }}</strong>
                        </div>
                        <div>
                            <span>Фокус</span>
                            <strong>Продажи и контроль</strong>
                        </div>
                    </div>

                    <div class="case-story-actions">
                        <button type="button" class="case-story-button case-story-button-primary" data-lead-open data-lead-offer="Разобрать похожую ситуацию">Разобрать похожую ситуацию</button>
                        <a href="{{ route('site.case-studies.index') }}" class="case-story-button case-story-button-secondary">Все кейсы</a>
                    </div>
                </div>

                <aside class="case-story-hero-panel" aria-label="Краткий итог проекта">
                    <div class="case-story-visual">
                        <img src="{{ $heroVisual }}" alt="{{ $caseStudy->title }}" loading="eager">
                    </div>
                    <div class="case-story-result-card">
                        <span>Главный результат</span>
                        <strong>{{ $caseStudy->result_summary ?: $resultItems[0] }}</strong>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    @if($caseCoverImage)
        <section class="case-cover-section">
            <div class="container-wrap">
                <figure class="case-cover-frame case-story-cover-frame">
                    <img src="{{ $caseCoverImage }}" alt="{{ $caseStudy->title }}" loading="lazy">
                </figure>
            </div>
        </section>
    @endif

    <section class="case-story-section case-story-metrics-section">
        <div class="container-wrap">
            <div class="case-story-section-head">
                <p class="case-story-kicker">Цифры и метрики</p>
                <h2 class="case-story-section-title">Что стало видно после проекта</h2>
            </div>
            <div class="case-story-metrics">
                @foreach($metricItems as $item)
                    <article class="case-story-metric">
                        <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <p>{{ $item }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="case-story-section">
        <div class="container-wrap">
            <div class="case-story-before-after">
                <article class="case-story-column">
                    <p class="case-story-kicker">Ситуация до</p>
                    <h2>Где бизнес терял управление</h2>
                    <ul>
                        @foreach($problemItems as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </article>

                <article class="case-story-column case-story-column-accent">
                    <p class="case-story-kicker">Что стало</p>
                    <h2>Что изменилось после внедрения</h2>
                    <ul>
                        @foreach($resultItems as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section class="case-story-section case-story-process-section">
        <div class="container-wrap">
            <div class="case-story-section-head case-story-section-head-wide">
                <p class="case-story-kicker">Что сделали</p>
                <h2 class="case-story-section-title">Сначала разобрали процесс, потом трогали CRM</h2>
            </div>

            <div class="case-story-process">
                @foreach($processSteps as $step)
                    <article class="case-story-step">
                        <span>{{ $step['label'] }}</span>
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['text'] }}</p>
                    </article>
                @endforeach
            </div>

            <div class="case-story-solution-list">
                @foreach($solutionItems as $item)
                    <div>
                        <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <p>{{ $item }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if($showFullContent)
        <section class="case-story-section">
            <div class="container-wrap">
                <article class="case-story-editorial">
                    <p class="case-story-kicker">Детали проекта</p>
                    <div class="case-story-editorial-content">
                        @foreach(preg_split('/\R{2,}/u', trim((string) $caseStudy->full_content)) ?: [] as $paragraph)
                            @if(trim(strip_tags($paragraph)) !== '')
                                <p>{{ trim(strip_tags($paragraph)) }}</p>
                            @endif
                        @endforeach
                    </div>
                </article>
            </div>
        </section>
    @endif

    <section class="case-story-section case-story-cta-section">
        <div class="container-wrap">
            <article class="case-story-cta">
                <div>
                    <p class="case-story-kicker">Заявка на разбор</p>
                    <h2>Хотите такой же порядок в CRM?</h2>
                    <p>Опишите, что сейчас не устраивает в продажах. Мы посмотрим на задачу и подскажем, с чего начинать: аудит, доработка или полноценное перевнедрение.</p>
                </div>
                <form action="{{ route('site.inquiries.store') }}" method="POST" class="case-story-form">
                    @csrf
                    <input type="hidden" name="landing_title" value="{{ $caseStudy->title }}">
                    <input type="hidden" name="offer_type" value="Разобрать мою ситуацию по кейсу">
                    <input type="hidden" name="calculator_snapshot" value="">
                    <input type="hidden" name="page_url" value="{{ request()->fullUrl() }}">
                    <input type="hidden" name="form_anchor" value="case-study-detail">

                    <label>
                        <span>Имя</span>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Как к вам обращаться" autocomplete="name">
                    </label>
                    <label>
                        <span>Контакт</span>
                        <input type="text" name="contact" value="{{ old('contact') }}" placeholder="Телефон или Telegram" autocomplete="tel">
                    </label>
                    <label>
                        <span>Что происходит в CRM</span>
                        <textarea name="message" rows="4" placeholder="Например: теряются заявки, нет контроля по менеджерам, отчеты не сходятся">{{ old('message') }}</textarea>
                    </label>
                    <button type="submit">Получить разбор</button>
                </form>
            </article>
        </div>
    </section>

    @if(($relatedCaseStudies ?? collect())->isNotEmpty())
        <section class="cases-related-section case-detail-related-section">
            <div class="container-wrap">
                <div class="cases-rl-wrap">
                    <div class="cases-rl-head">
                        <div>
                            <p class="cases-rl-kicker">Похожие проекты</p>
                            <h3 class="cases-rl-title">Другие кейсы <span>по CRM</span></h3>
                        </div>
                        <a href="{{ route('site.case-studies.index') }}" class="cases-rl-all">Все кейсы →</a>
                    </div>
                    <div class="cases-rl-grid">
                        @foreach($relatedCaseStudies as $relatedCase)
                            <a href="{{ route('site.case-studies.show', $relatedCase->slug) }}" class="cases-rl-card">
                                <div class="cases-rl-card-top">
                                    <div class="cases-rl-logo">
                                        @if($relatedCase->logoUrl())
                                            <img src="{{ $relatedCase->logoUrl() }}" alt="{{ $relatedCase->client_name ?: $relatedCase->title }}" loading="lazy">
                                        @else
                                            <span>{{ mb_substr($relatedCase->client_name ?: $relatedCase->title, 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="cases-rl-cat">{{ $relatedCase->niche ?: 'CRM-проект' }}</div>
                                        <h4 class="cases-rl-card-title">{{ $relatedCase->title }}</h4>
                                    </div>
                                </div>
                                @if($relatedCase->short_description || $relatedCase->result_summary)
                                    <p class="cases-rl-card-desc">{{ Str::limit($relatedCase->short_description ?: $relatedCase->result_summary, 140) }}</p>
                                @endif
                                <div class="cases-rl-meta">
                                    <span>{{ $relatedCase->client_name ?: 'Кейс amoCRM' }}</span>
                                    <span class="cases-rl-read">Смотреть кейс →</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
