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
        $solutionImpacts = ['Диагностика', 'Архитектура', 'Автоматизация', 'Запуск'];
        $resultImpacts = ['Контроль', 'Скорость', 'Прозрачность', 'Управляемость'];
        $whyWorkedItems = [
            'Сначала разобрали реальные процессы, а не внедряли шаблон.',
            'Убрали лишнее и оставили только рабочую логику сделки.',
            'Собрали автоматизацию под фактическую нагрузку команды.',
            'Закрепили контроль по этапам, срокам и потерям.',
        ];
        $metricItems = $extractPoints($caseStudy->metrics_block, 6);
        $diagnosisItems = array_slice($problemItems, 0, 3);
        $diagnosisImpacts = ['Потеря скорости', 'Потеря заявок', 'Потеря контроля'];
        $heroTitleWords = preg_split('/\s+/u', trim($caseStudy->title)) ?: [];
        $caseCoverImage = $caseStudy->coverImageUrl();
    @endphp

    <section class="case-executive-hero case-executive-word-reveal">
        <div class="container-wrap">
            <div class="case-executive-hero-grid">
                <div class="case-executive-copy">
                    <p class="case-executive-kicker">Кейс amoCRM</p>
                    <h1 class="case-executive-title" aria-label="{{ $caseStudy->title }}">
                        @foreach($heroTitleWords as $index => $word)
                            <span class="case-executive-title-word" style="--word-index: {{ $index }}">{{ $word }}</span>{{ $loop->last ? '' : ' ' }}
                        @endforeach
                    </h1>
                    <p class="case-executive-lead">{{ $caseStudy->short_description ?: $caseStudy->result_summary }}</p>
                    <div class="case-executive-client-strip">
                        @if($caseStudy->logoUrl())
                            <div class="case-executive-logo">
                                <img src="{{ $caseStudy->logoUrl() }}" alt="{{ $caseStudy->client_name ?: $caseStudy->title }}" loading="lazy">
                            </div>
                        @else
                            <div class="case-executive-logo case-executive-logo-fallback">{{ mb_strtoupper(mb_substr($caseStudy->client_name ?: $caseStudy->title, 0, 1)) }}</div>
                        @endif
                        <div class="case-executive-meta-tags" aria-label="{{ $caseStudy->client_name ?: $caseStudy->title }}">
                            @if($caseStudy->niche)
                                <span>{{ $caseStudy->niche }}</span>
                            @endif
                            <span>amoCRM</span>
                        </div>
                    </div>

                    <div class="case-executive-actions">
                        <button type="button" class="case-executive-btn case-executive-btn-primary" data-lead-open data-lead-offer="Разобрать мою ситуацию по кейсу">Разобрать похожую ситуацию</button>
                        <a href="{{ route('site.case-studies.index') }}" class="case-executive-btn case-executive-btn-secondary">Все кейсы</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($caseCoverImage)
        <section class="case-cover-section">
            <div class="container-wrap">
                <figure class="case-cover-frame">
                    <img src="{{ $caseCoverImage }}" alt="{{ $caseStudy->title }}" loading="lazy">
                </figure>
            </div>
        </section>
    @endif

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

    <section class="case-diagnosis-section case-diagnosis-note-first">
        <div class="container-wrap">
            <div class="case-diagnosis-head">
                <div>
                    <p class="case-diagnosis-kicker">Ситуация до</p>
                    <h2 class="case-diagnosis-title">CRM была внедрена, но не управляла продажами</h2>
                    <p class="case-diagnosis-lead">Перед изменениями фиксируем не просто список жалоб, а управленческий диагноз: где именно система теряла скорость, заявки и контроль.</p>
                </div>
            </div>

            <div class="case-diagnosis-grid">
                @foreach($diagnosisItems as $index => $item)
                    <article class="case-diagnosis-card">
                        <div class="case-diagnosis-num">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</div>
                        <h3>{{ Str::limit(strip_tags($item), 72) }}</h3>
                        <p>{{ $item }}</p>
                        <div class="case-diagnosis-impact">{{ $diagnosisImpacts[$index] ?? 'Зона риска' }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="case-diagnosis-section case-diagnosis-section--solution case-diagnosis-note-first">
        <div class="container-wrap">
            <div class="case-diagnosis-head">
                <div>
                    <p class="case-diagnosis-kicker">Что сделали</p>
                    <h2 class="case-diagnosis-title">Сначала процесс, потом настройки</h2>
                    <p class="case-diagnosis-lead">Пересобрали CRM не как набор отдельных доработок, а как последовательную систему управления продажами.</p>
                </div>
            </div>

            <div class="case-diagnosis-grid">
                @foreach($solutionItems as $index => $item)
                    <article class="case-diagnosis-card">
                        <div class="case-diagnosis-num">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</div>
                        <h3>{{ $solutionTitles[$index] ?? ('Шаг ' . ($index + 1)) }}</h3>
                        <p>{{ $item }}</p>
                        <div class="case-diagnosis-impact">{{ $solutionImpacts[$index] ?? 'Этап проекта' }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="case-diagnosis-section case-diagnosis-section--result case-diagnosis-note-first">
        <div class="container-wrap">
            <div class="case-diagnosis-head">
                <div>
                    <p class="case-diagnosis-kicker">Что стало</p>
                    <h2 class="case-diagnosis-title">CRM снова стала рабочим инструментом продаж</h2>
                    <p class="case-diagnosis-lead">После перезапуска стало понятно, где теряются заявки, почему сделки зависают и какой следующий шаг нужен команде.</p>
                </div>
            </div>

            <div class="case-diagnosis-grid">
                @foreach($resultItems as $item)
                    <article class="case-diagnosis-card">
                        <div class="case-diagnosis-num">{{ str_pad((string) ($loop->index + 1), 2, '0', STR_PAD_LEFT) }}</div>
                        <h3>{{ Str::limit(strip_tags($item), 72) }}</h3>
                        <p>{{ $item }}</p>
                        <div class="case-diagnosis-impact">{{ $resultImpacts[$loop->index] ?? 'Итог проекта' }}</div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section case-why-table-line">
        <div class="container-wrap">
            <div class="case-why-compare-head">
                <p class="case-why-compare-kicker">Почему это сработало</p>
                <h2 class="case-why-compare-title">Мы не усиливали хаос автоматизацией</h2>
                <p class="case-why-compare-lead">Проект сработал, потому что сначала разобрали реальную логику продаж, а уже потом меняли структуру CRM.</p>
            </div>

            <div class="case-why-compare-table">
                <div class="case-why-compare-row">
                    <div>
                        <small>Не делали</small>
                        <h3>Не переносили старый хаос в новые настройки</h3>
                        <p>Автоматизация без разбора процесса только ускорила бы ошибки и потери.</p>
                    </div>
                    <div>
                        <small>Сделали</small>
                        <h3>{{ $whyWorkedItems[0] ?? 'Сначала разобрали реальные процессы, а не внедряли шаблон.' }}</h3>
                        <p>После этого стало понятно, какие этапы, поля и задачи действительно нужны.</p>
                    </div>
                </div>
                <div class="case-why-compare-row">
                    <div>
                        <small>Не делали</small>
                        <h3>Не усложняли CRM дополнительными сущностями</h3>
                        <p>Лишние элементы мешали бы менеджерам работать регулярно и одинаково.</p>
                    </div>
                    <div>
                        <small>Сделали</small>
                        <h3>{{ $whyWorkedItems[1] ?? 'Убрали лишнее и оставили только рабочую логику сделки.' }}</h3>
                        <p>Команда получила понятный следующий шаг по сделке и меньше ручной сверки.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section case-situation-form-section case-situation-quiet-scan">
        <div class="container-wrap">
            <article class="case-situation-form">
                <div class="case-situation-form-content">
                    <p class="case-situation-form-kicker">Заявка на разбор</p>
                    <h2 class="case-situation-form-title">Опишите задачу коротко, остальное уточним на звонке</h2>
                    <p class="case-situation-form-lead">Покажем, где в CRM теряются заявки, контроль и скорость продаж, а затем предложим первый понятный шаг без лишней перестройки.</p>
                </div>
                <form action="{{ route('site.inquiries.store') }}" method="POST" class="case-situation-form-card">
                    @csrf
                    <input type="hidden" name="name" value="Заявка с сайта">
                    <input type="hidden" name="landing_title" value="{{ $caseStudy->title }}">
                    <input type="hidden" name="offer_type" value="Разобрать мою ситуацию по кейсу">
                    <input type="hidden" name="calculator_snapshot" value="">
                    <input type="hidden" name="page_url" value="{{ request()->fullUrl() }}">
                    <input type="hidden" name="form_anchor" value="case-situation-form">

                    <input class="case-situation-form-field" type="text" name="contact_name" placeholder="Ваше имя" autocomplete="name">
                    <input class="case-situation-form-field" type="text" name="contact" placeholder="Телефон или мессенджер" autocomplete="tel">
                    <textarea class="case-situation-form-field case-situation-form-textarea" name="message" rows="3" placeholder="Что сейчас не устраивает в CRM"></textarea>
                    <button type="submit" class="case-situation-form-button">Отправить заявку</button>
                </form>
            </article>
        </div>
    </section>

    <section class="site-section case-final-panel-section case-final-panel-cascade">
        <div class="container-wrap">
            <div class="case-final-panel">
                <div class="case-final-panel-grid">
                    <div class="case-final-panel-content">
                        <p class="case-final-panel-kicker">По итогам кейса</p>
                        <h2 class="case-final-panel-title">Покажем, где вы теряете деньги в продажах</h2>
                        <p class="case-final-panel-text">Разбираем текущую ситуацию, находим слабые места и показываем, как выстроить систему продаж под ваш бизнес без лишней сложности.</p>
                        <div class="case-final-panel-actions">
                            <a href="#" data-lead-open data-lead-offer="Разобрать мою ситуацию по кейсу" class="case-final-panel-button case-final-panel-button-primary">Разобрать мою ситуацию</a>
                            <a href="{{ route('site.landings.show', 'audit-amocrm') }}" class="case-final-panel-button case-final-panel-button-secondary">Смотреть аудит CRM</a>
                        </div>
                    </div>

                    <aside class="case-final-panel-note">
                        <p class="case-final-panel-note-title">Формат</p>
                        <p class="case-final-panel-note-text">Без перегруза и без продажи ради продажи. Сначала смотрим, где у вас реальные потери, и только потом говорим про внедрение или перевнедрение.</p>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    @if(($relatedCaseStudies ?? collect())->isNotEmpty())
        <section class="cases-related-section case-detail-related-section case-related-cascade">
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

@push('scripts')
    <script>
        (function () {
            var sections = document.querySelectorAll('.case-diagnosis-note-first, .case-editorial-steps-fade, .case-result-list-cascade, .case-why-table-line, .case-situation-quiet-scan, .case-final-panel-cascade, .case-related-cascade');
            if (!sections.length) return;

            if (!('IntersectionObserver' in window)) {
                sections.forEach(function (section) {
                    section.classList.add('is-animated');
                });
                return;
            }

            var observer = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;

                    entry.target.classList.add('is-animated');
                    observer.unobserve(entry.target);
                });
            }, {
                threshold: 0.28,
                rootMargin: '0px 0px -12% 0px'
            });

            sections.forEach(function (section) {
                observer.observe(section);
            });
        })();
    </script>
@endpush
