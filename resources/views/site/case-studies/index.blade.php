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
    <section class="cases-hero cases-anim" id="cases-hero-anim">
        <div class="container-wrap">
            <nav class="cases-bc">
                <a href="/">Главная</a>
                <span class="cases-bc-sep">/</span>
                <span>Кейсы</span>
            </nav>
            <div class="cases-hero-top">
                <p class="cases-hero-kicker">Портфолио</p>
                <h1 class="cases-hero-title">Наши <em>кейсы</em> —<br>история роста клиентов</h1>
            </div>
            <div class="cases-hero-row">
                <p class="cases-hero-lead">{{ $caseStudies->total() }}+ проектов в разных отраслях. Каждый кейс — задача, решение и измеримый результат для бизнеса.</p>
                <div class="cases-hero-actions">
                    <a href="#" class="cases-hero-btn" data-lead-open data-lead-offer="Обсудить проект">Обсудить проект</a>
                </div>
            </div>

            <div class="cases-hero-quote">
                <div class="cases-hq-left">
                    <div class="cases-hq-avatar">ВТ</div>
                    <div>
                        <div class="cases-hq-name">Вячеслав Трофимов</div>
                        <div class="cases-hq-role">Основатель, CRM-архитектор</div>
                        <span class="cases-hq-cert">★ amoCRM Gold Partner</span>
                    </div>
                </div>
                <p class="cases-hq-text">Мы измеряем успех не часами разработки, а деньгами, которые клиент не теряет после внедрения. Это главный критерий качества.</p>
            </div>
        </div>

    </section>

    @if($caseStudies->count() > 0)
    <section class="cases-ticker-section cases-tk-anim" id="cases-ticker">
        <div class="cases-ticker-wrap">
            <div class="cases-ticker">
                @for($i = 0; $i < 2; $i++)
                    @foreach($caseStudies as $tickerCase)
                        <a href="{{ route('site.case-studies.show', $tickerCase->slug) }}" class="cases-ticker-card">
                            <div class="cases-tc-top">
                                <div class="cases-tc-logo">
                                    @if($tickerCase->logoUrl())
                                        <img src="{{ $tickerCase->logoUrl() }}" alt="{{ $tickerCase->client_name ?: $tickerCase->title }}" loading="lazy">
                                    @else
                                        <span>{{ mb_substr($tickerCase->client_name ?: $tickerCase->title, 0, 2) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="cases-tc-name">{{ $tickerCase->client_name ?: $tickerCase->title }}</div>
                                    @if($tickerCase->niche)
                                        <div class="cases-tc-niche">{{ $tickerCase->niche }}</div>
                                    @endif
                                </div>
                            </div>
                            <p class="cases-tc-result">{{ Str::limit($tickerCase->short_description ?: $tickerCase->result_summary, 90) }}</p>
                            @if($tickerCase->result_summary && $tickerCase->short_description)
                                <span class="cases-tc-metric">{{ Str::limit($tickerCase->result_summary, 30) }}</span>
                            @endif
                        </a>
                    @endforeach
                @endfor
            </div>
        </div>
        <div class="container-wrap"><div class="cases-hero-divider"></div></div>
    </section>
    @endif

    @php $totalCases = $caseStudies->count(); @endphp
    <section class="cases-timeline-section cases-tl-anim" id="cases-list" style="--tl-total: {{ max($totalCases, 1) }};">
        <div class="container-wrap">
            <div class="cases-timeline">
                @foreach($caseStudies as $case)
                    <div class="cases-tl-item" style="--i: {{ $loop->index }};">
                        <div class="cases-tl-dot"></div>
                        <article class="cases-tl-card">
                            <div class="cases-tl-top">
                                <div class="cases-tl-left">
                                    <div class="cases-tl-logo">
                                        @if($case->logoUrl())
                                            <img src="{{ $case->logoUrl() }}" alt="{{ $case->client_name ?: $case->title }}" loading="lazy">
                                        @else
                                            <span>{{ mb_substr($case->client_name ?: $case->title, 0, 2) }}</span>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="cases-tl-company">{{ $case->client_name ?: $case->title }}</div>
                                        @if($case->niche)
                                            <div class="cases-tl-niche">{{ $case->niche }}</div>
                                        @endif
                                    </div>
                                </div>
                                @if($case->publishedDate())
                                    <div class="cases-tl-date">{{ optional($case->publishedDate())->format('d.m.Y') }}</div>
                                @endif
                            </div>

                            <h3 class="cases-tl-title">{{ $case->title }}</h3>

                            <div class="cases-tl-body">
                                @if($case->problem_block)
                                    <div class="cases-tl-block">
                                        <div class="cases-tl-block-label problem">Проблема</div>
                                        <p>{{ Str::limit(strip_tags($case->problem_block), 140) }}</p>
                                    </div>
                                @endif
                                @if($case->solution_block)
                                    <div class="cases-tl-block">
                                        <div class="cases-tl-block-label solution">Решение</div>
                                        <p>{{ Str::limit(strip_tags($case->solution_block), 140) }}</p>
                                    </div>
                                @endif
                                @if($case->result_block || $case->result_summary)
                                    <div class="cases-tl-block">
                                        <div class="cases-tl-block-label result">Результат</div>
                                        <p>{{ Str::limit(strip_tags($case->result_block ?: $case->result_summary), 140) }}</p>
                                    </div>
                                @endif
                            </div>

                            <div class="cases-tl-bottom">
                                @if($case->result_summary)
                                    <div class="cases-tl-metrics">
                                        <span class="cases-tl-metric">{{ $case->result_summary }}</span>
                                    </div>
                                @else
                                    <span></span>
                                @endif
                                <a href="{{ route('site.case-studies.show', $case->slug) }}" class="cases-tl-link">
                                    Полный кейс
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
            {{ $caseStudies->links() }}
        </div>
    </section>

    <section class="cases-contact-section cases-cp-anim" id="cases-contact">
        <div class="container-wrap">
            <div class="cases-cp-panel">
                <div>
                    @if(session('landing_form_success'))
                        <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700 relative z-10">
                            {{ session('landing_form_success') }}
                        </div>
                    @endif
                    <h2 class="cases-cp-title">Расскажите о задаче — <span>покажем, как решить</span></h2>
                    <p class="cases-cp-desc">Обсудим вашу CRM, найдём точки потерь и предложим план. Бесплатно, без навязчивости.</p>
                </div>
                <div class="cases-cp-card">
                    <form action="{{ route('site.inquiries.store') }}" method="POST" class="cases-cp-grid">
                        @csrf
                        <input type="hidden" name="landing_title" value="Кейсы — форма обратной связи">
                        <input type="hidden" name="offer_type" value="Обсудить проект">
                        <input type="hidden" name="page_url" value="{{ request()->fullUrl() }}">
                        <input type="hidden" name="form_anchor" value="cases-contact">

                        <label class="cases-cp-field">
                            <span>Имя</span>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Как к вам обращаться">
                        </label>
                        <label class="cases-cp-field">
                            <span>Контакт</span>
                            <input type="text" name="contact" value="{{ old('contact') }}" placeholder="Телефон или email">
                        </label>
                        <label class="cases-cp-field cases-cp-field-full">
                            <span>О задаче</span>
                            <textarea name="message" rows="3" placeholder="Что у вас сейчас с CRM и продажами">{{ old('message') }}</textarea>
                        </label>
                        <button type="submit" class="cases-cp-submit">Получить диагностику</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @if(($relatedServices ?? collect())->isNotEmpty() || ($relatedArticles ?? collect())->isNotEmpty())
    <section class="cases-related-section cases-rl-anim" id="cases-related">
        <div class="container-wrap">
            <div class="cases-rl-wrap">
                <div class="cases-rl-head">
                    <div>
                        <p class="cases-rl-kicker">Читайте также</p>
                        <h3 class="cases-rl-title">Вам может <span>понравиться</span></h3>
                    </div>
                    <a href="{{ route('site.articles.index') }}" class="cases-rl-all">Все материалы →</a>
                </div>
                <div class="cases-rl-grid">
                    @php
                        $items = collect();
                        foreach(($relatedServices ?? []) as $s) {
                            $items->push([
                                'cat' => 'Услуга',
                                'title' => $s->title,
                                'desc' => $s->short_description ?: '',
                                'url' => route('site.services.show', $s->slug),
                                'meta' => $s->short_label ?? 'Популярно',
                                'read' => 'Подробнее',
                            ]);
                        }
                        foreach(($relatedArticles ?? []) as $a) {
                            $items->push([
                                'cat' => 'Статья',
                                'title' => $a->title,
                                'desc' => $a->short_description ?: '',
                                'url' => route('site.articles.show', $a->slug),
                                'meta' => optional($a->publishedDate())->format('d.m.Y') ?: 'Материал',
                                'read' => 'Читать',
                            ]);
                        }
                        $items = $items->take(3);
                    @endphp
                    @foreach($items as $item)
                        <a href="{{ $item['url'] }}" class="cases-rl-card">
                            <div class="cases-rl-cat">{{ $item['cat'] }}</div>
                            <h4 class="cases-rl-card-title">{{ $item['title'] }}</h4>
                            @if($item['desc'])
                                <p class="cases-rl-card-desc">{{ Str::limit($item['desc'], 120) }}</p>
                            @endif
                            <div class="cases-rl-meta">
                                <span>{{ $item['meta'] }}</span>
                                <span class="cases-rl-read">{{ $item['read'] }} →</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <script>
    (function(){
        var hero = document.getElementById('cases-hero-anim');
        if (hero) {
            var triggerHero = function(){ hero.classList.add('play'); };
            if ('IntersectionObserver' in window) {
                var ioHero = new IntersectionObserver(function(entries){
                    entries.forEach(function(e){ if (e.isIntersecting) { triggerHero(); ioHero.disconnect(); } });
                }, { threshold: 0.15 });
                ioHero.observe(hero);
            }
            window.addEventListener('load', function(){ setTimeout(triggerHero, 50); });
        }

        var tl = document.getElementById('cases-list');
        if (tl && 'IntersectionObserver' in window) {
            var ioTl = new IntersectionObserver(function(entries){
                entries.forEach(function(e){ if (e.isIntersecting) { e.target.classList.add('play'); ioTl.disconnect(); } });
            }, { threshold: 0.12 });
            ioTl.observe(tl);
        }

        var cp = document.getElementById('cases-contact');
        if (cp && 'IntersectionObserver' in window) {
            var ioCp = new IntersectionObserver(function(entries){
                entries.forEach(function(e){ if (e.isIntersecting) { e.target.classList.add('play'); ioCp.disconnect(); } });
            }, { threshold: 0.2 });
            ioCp.observe(cp);
        }

        var tk = document.getElementById('cases-ticker');
        if (tk && 'IntersectionObserver' in window) {
            var ioTk = new IntersectionObserver(function(entries){
                entries.forEach(function(e){ if (e.isIntersecting) { e.target.classList.add('play'); ioTk.disconnect(); } });
            }, { threshold: 0.1 });
            ioTk.observe(tk);
        }

        var rl = document.getElementById('cases-related');
        if (rl && 'IntersectionObserver' in window) {
            var ioRl = new IntersectionObserver(function(entries){
                entries.forEach(function(e){ if (e.isIntersecting) { e.target.classList.add('play'); ioRl.disconnect(); } });
            }, { threshold: 0.15 });
            ioRl.observe(rl);
        }
    })();
    </script>
@endsection
