@extends('site.layouts.app', [
    'title' => 'Статьи про amoCRM, продажи и автоматизацию',
    'metaDescription' => 'Публичные статьи про amoCRM, перевнедрение CRM, обработку заявок, базу клиентов, AI и контроль продаж',
    'canonical' => route('site.articles.index'),
])

@push('meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Статьи про amoCRM, продажи и автоматизацию">
    <meta property="og:description" content="Публичные статьи про amoCRM, перевнедрение CRM, обработку заявок, базу клиентов, AI и контроль продаж">
    <meta property="og:url" content="{{ route('site.articles.index') }}">
    <meta name="twitter:card" content="summary">
@endpush

@section('content')
    <section class="articles-hero articles-hero-anim" id="articles-hero">
        <div class="container-wrap">
            <nav class="articles-hero-bc" aria-label="breadcrumbs">
                <a href="{{ route('site.home') }}">Главная</a>
                <span class="articles-hero-bc-sep">/</span>
                <span>Статьи</span>
            </nav>
            <div class="articles-hero-grid">
                <div>
                    <p class="articles-hero-kicker">Редакция CleverCRM</p>
                    <h1 class="articles-hero-title">Продажи, CRM<br>и <span class="articles-hero-title-accent">деньги</span>, которые они приносят</h1>
                    <p class="articles-hero-lead">Материалы про amoCRM, работу отдела продаж, клиентскую базу, автоматизацию и ситуации, когда CRM нужно не донастраивать, а пересобирать с нуля.</p>
                    <div class="articles-hero-actions">
                        <a class="articles-hero-btn-primary" href="{{ route('site.contacts') }}">Обсудить проект</a>
                    </div>
                </div>
                @if($featuredArticle)
                    <a href="{{ route('site.articles.show', $featuredArticle->slug) }}" class="articles-hero-featured">
                        <div class="articles-hero-featured-cover">
                            <span class="articles-hero-featured-badge">Свежее</span>
                            @if($featuredArticle->coverImageUrl())
                                <img src="{{ $featuredArticle->coverImageUrl() }}" alt="{{ $featuredArticle->title }}">
                            @endif
                        </div>
                        <div class="articles-hero-featured-body">
                            <div class="articles-hero-featured-meta">
                                @if($featuredArticle->publishedDate())
                                    <span>{{ $featuredArticle->publishedDate()->format('d.m.Y') }}</span>
                                    <span class="articles-hero-featured-meta-dot">•</span>
                                @endif
                                <span>{{ max(2, (int) round(str_word_count(strip_tags((string) $featuredArticle->full_content)) / 180)) }} мин чтения</span>
                            </div>
                            <div class="articles-hero-featured-title">{{ $featuredArticle->title }}</div>
                            <span class="articles-hero-featured-link">Читать статью →</span>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </section>

    <section class="articles-list-section articles-list-anim" id="articles-list">
        <div class="container-wrap">
            <div class="articles-list-panel">
                <div class="articles-list-head">
                    <div>
                        <p class="articles-list-kicker">Материалы</p>
                        <h2 class="articles-list-title">Свежие статьи и разборы</h2>
                    </div>
                </div>

                @if($articles->count() === 0)
                    <p class="articles-list-empty">Статьи скоро появятся.</p>
                @else
                    @php
                        $main = $articles[0];
                        $side = collect($articles->items())->slice(1, 3)->values();
                        $rest = collect($articles->items())->slice(4)->values();
                        $readMinutes = fn ($article) => max(2, (int) round(str_word_count(strip_tags((string) $article->full_content)) / 180));
                    @endphp

                    <div class="articles-mag-grid">
                        <a href="{{ route('site.articles.show', $main->slug) }}" class="articles-mag-feat">
                            <span class="articles-mag-feat-badge">Главное</span>
                            <div class="articles-mag-feat-meta">
                                @if($main->publishedDate())
                                    <span>{{ $main->publishedDate()->format('d.m.Y') }}</span>
                                    <span>·</span>
                                @endif
                                <span>{{ $readMinutes($main) }} мин чтения</span>
                            </div>
                            <div class="articles-mag-feat-title">{{ $main->title }}</div>
                            @if($main->excerptText() !== '')
                                <div class="articles-mag-feat-excerpt">{{ $main->excerptText() }}</div>
                            @endif
                            <span class="articles-mag-feat-link">Читать статью →</span>
                        </a>

                        @if($side->isNotEmpty())
                            <div class="articles-mag-side">
                                @foreach($side as $article)
                                    <a href="{{ route('site.articles.show', $article->slug) }}" class="articles-mag-small">
                                        <div class="articles-mag-small-meta">
                                            @if($article->publishedDate())
                                                <span>{{ $article->publishedDate()->format('d.m.Y') }}</span>
                                                <span>·</span>
                                            @endif
                                            <span>{{ $readMinutes($article) }} мин</span>
                                        </div>
                                        <div class="articles-mag-small-title">{{ $article->title }}</div>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if($rest->isNotEmpty())
                        <div class="articles-mag-rest">
                            @foreach($rest as $article)
                                <a href="{{ route('site.articles.show', $article->slug) }}" class="articles-mag-small">
                                    <div class="articles-mag-small-meta">
                                        <b>Статья</b>
                                        @if($article->publishedDate())
                                            <span>·</span>
                                            <span>{{ $article->publishedDate()->format('d.m') }}</span>
                                        @endif
                                        <span>·</span>
                                        <span>{{ $readMinutes($article) }} мин</span>
                                    </div>
                                    <div class="articles-mag-small-title">{{ $article->title }}</div>
                                </a>
                            @endforeach
                        </div>
                    @endif

                    @if($articles->hasPages())
                        <div class="articles-list-pager">
                            {{ $articles->links() }}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </section>

    @if($topicLandings->isNotEmpty())
        <section class="articles-topics-section articles-topics-anim" id="articles-topics">
            <div class="container-wrap">
                <div class="articles-topics-head">
                    <p class="articles-topics-kicker">По теме</p>
                    <h2 class="articles-topics-title">Связанные <span>направления</span></h2>
                    <p class="articles-topics-sub">Если после материала хочется перейти к решению — выберите направление. Всё, чем мы занимаемся.</p>
                </div>
                <div class="articles-topics-grid">
                    @foreach($topicLandings as $landing)
                        <a href="{{ route('site.landings.show', $landing->slug) }}" class="articles-topics-card">
                            <div class="articles-topics-card-top">
                                <span class="articles-topics-card-badge">{{ $landing->pageTypeLabel() }}</span>
                                <span class="articles-topics-card-index">0{{ $loop->iteration }}</span>
                            </div>
                            <h3 class="articles-topics-card-title">{{ $landing->displayTitle() }}</h3>
                            @if($landing->excerpt)
                                <p class="articles-topics-card-desc">{{ $landing->excerpt }}</p>
                            @endif
                            <span class="articles-topics-card-link">Перейти на страницу →</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="articles-faq-section articles-faq-anim" id="articles-faq" x-data="{ open: null }">
        <div class="container-wrap">
            <div class="articles-faq-grid">
                <div class="articles-faq-aside">
                    <p class="articles-faq-kicker">О блоге</p>
                    <h2 class="articles-faq-title">Короткие ответы про наш <span>редакционный</span> подход</h2>
                    <p class="articles-faq-sub">Если не нашли ответ — напишите, добавим в подборку.</p>
                </div>
                <div class="articles-faq-list">
                    @php
                        $faqs = [
                            ['q' => 'Как часто выходят новые материалы?', 'a' => 'В среднем 2–3 статьи в месяц. Не гонимся за объёмом — пишем, когда есть конкретный опыт с проектов, а не пересказ чужих статей.'],
                            ['q' => 'Кто пишет статьи?', 'a' => 'Команда CleverCRM — интеграторы и аналитики, которые каждый день внедряют и пересобирают amoCRM для b2b-компаний. Никакого внешнего копирайта.'],
                            ['q' => 'Можно ли задать вопрос автору или предложить тему?', 'a' => 'Да. Напишите в Telegram или через форму контактов — если вопрос «в тему», сделаем из него разбор.'],
                            ['q' => 'Где ещё можно читать и смотреть?', 'a' => 'Короткие разборы — в Telegram-канале, большие видео-кейсы — на YouTube, длинные тексты — в Teletype. Ссылки ниже в блоке «Остаться на связи».'],
                            ['q' => 'Можно ли использовать ваши материалы?', 'a' => 'Да, со ссылкой на источник. Для перепечатки на отраслевых площадках — напишите, согласуем формат.'],
                        ];
                    @endphp
                    @foreach($faqs as $i => $faq)
                        <div class="articles-faq-item" :class="open === {{ $i }} ? 'open' : ''">
                            <button type="button" class="articles-faq-q" @click="open = (open === {{ $i }} ? null : {{ $i }})">
                                <span>{{ $faq['q'] }}</span>
                                <span class="articles-faq-toggle" aria-hidden="true"></span>
                            </button>
                            <div class="articles-faq-a">
                                <p>{{ $faq['a'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="articles-subscribe-section articles-subscribe-anim" id="articles-subscribe">
        <div class="container-wrap">
            <div class="articles-subscribe-panel">
                <div class="articles-subscribe-text">
                    <p class="articles-subscribe-kicker">Остаться на связи</p>
                    <h2 class="articles-subscribe-title">Пишем о CRM раньше, чем выходит статья</h2>
                    <p class="articles-subscribe-sub">Короткие заметки, анонсы материалов и наблюдения с проектов — в Telegram и других каналах.</p>
                </div>
                <div class="articles-subscribe-links">
                    @if(!empty($siteSettings?->telegram_link))
                        <a href="{{ $siteSettings->telegram_link }}" class="articles-subscribe-link" target="_blank" rel="noopener">
                            <span class="articles-subscribe-link-ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M21.2 4.4 2.4 10.8c-.6.2-.6.6 0 .8l4.8 1.8 1.8 5.8c.1.4.5.5.8.2l2.6-2.2 4.8 3.6c.4.3 1 .1 1.1-.4L22 5.2c.1-.6-.4-1-.8-.8Z"/>
                                    <path d="m9 13.6 8.4-6.4"/>
                                </svg>
                            </span>
                            <span class="articles-subscribe-link-txt"><b>Telegram</b><em>канал редакции</em></span>
                        </a>
                    @endif
                    @if(!empty($siteSettings?->youtube_link))
                        <a href="{{ $siteSettings->youtube_link }}" class="articles-subscribe-link" target="_blank" rel="noopener">
                            <span class="articles-subscribe-link-ico">
                                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814ZM9.545 15.568V8.432L15.818 12l-6.273 3.568Z"/>
                                </svg>
                            </span>
                            <span class="articles-subscribe-link-txt"><b>YouTube</b><em>видео-разборы</em></span>
                        </a>
                    @endif
                    @if(!empty($siteSettings?->teletype_link))
                        <a href="{{ $siteSettings->teletype_link }}" class="articles-subscribe-link" target="_blank" rel="noopener">
                            <span class="articles-subscribe-link-ico">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M4 6h16M4 6v2M20 6v2M12 6v14M9 20h6"/>
                                </svg>
                            </span>
                            <span class="articles-subscribe-link-txt"><b>Teletype</b><em>длинные тексты</em></span>
                        </a>
                    @endif
                    @if(!empty($siteSettings?->vk_link))
                        <a href="{{ $siteSettings->vk_link }}" class="articles-subscribe-link" target="_blank" rel="noopener">
                            <span class="articles-subscribe-link-ico">
                                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M12.785 16.146s.382-.042.578-.252c.18-.193.174-.556.174-.556s-.025-1.698.764-1.95c.778-.247 1.777 1.645 2.836 2.373.8.55 1.41.43 1.41.43l2.83-.04s1.48-.09.778-1.247c-.058-.095-.41-.858-2.107-2.425-1.777-1.64-1.538-1.373.602-4.208 1.303-1.726 1.824-2.78 1.66-3.23-.155-.432-1.115-.318-1.115-.318l-3.19.02s-.236-.033-.412.073c-.173.103-.284.345-.284.345s-.51 1.357-1.19 2.512c-1.434 2.436-2.008 2.564-2.242 2.413-.545-.352-.408-1.415-.408-2.17 0-2.36.357-3.342-.697-3.598-.35-.085-.607-.14-1.5-.15-1.148-.013-2.12.004-2.67.274-.367.18-.65.58-.477.603.213.028.696.13.952.48.33.453.32 1.472.32 1.472s.188 2.78-.443 3.123c-.434.236-1.03-.245-2.31-2.448-.654-1.127-1.15-2.373-1.15-2.373s-.095-.233-.266-.358C5.17 5.4 4.9 5.36 4.9 5.36l-3.03.02s-.456.013-.623.21c-.149.177-.012.542-.012.542s2.395 5.606 5.107 8.432c2.486 2.594 5.31 2.424 5.31 2.424h1.134Z"/>
                                </svg>
                            </span>
                            <span class="articles-subscribe-link-txt"><b>ВКонтакте</b><em>сообщество</em></span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        var hero = document.getElementById('articles-hero');
        if (!hero) return;
        var titleEl = hero.querySelector('.articles-hero-title');
        if (titleEl) {
            // Split text nodes into letter spans, preserve <br> and accent <span>.
            var letterIndex = 0;
            var splitNode = function (node, isAccent) {
                if (node.nodeType === 3) {
                    var text = node.nodeValue;
                    var frag = document.createDocumentFragment();
                    for (var i = 0; i < text.length; i++) {
                        var ch = text[i];
                        if (ch === ' ') { frag.appendChild(document.createTextNode(' ')); continue; }
                        var s = document.createElement('span');
                        s.className = 'articles-hero-title-letter';
                        s.style.transitionDelay = (letterIndex * 28 + 350) + 'ms';
                        s.textContent = ch;
                        frag.appendChild(s);
                        letterIndex++;
                    }
                    node.parentNode.replaceChild(frag, node);
                } else if (node.nodeType === 1) {
                    if (node.tagName === 'BR') return;
                    // recurse — accent <span class="articles-hero-title-accent"> is preserved as wrapper,
                    // its inner text gets split into letters too
                    Array.prototype.slice.call(node.childNodes).forEach(function (n) { splitNode(n, false); });
                }
            };
            Array.prototype.slice.call(titleEl.childNodes).forEach(function (n) { splitNode(n, false); });
        }

        var play = function () { hero.classList.add('play'); };

        if ('IntersectionObserver' in window) {
            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (e) { if (e.isIntersecting) { play(); io.disconnect(); } });
            }, { threshold: 0.15 });
            io.observe(hero);
        }
        // Fallback: also play after load in case observer doesn't fire (already in view).
        window.addEventListener('load', function () { setTimeout(play, 60); });

        // Helper: trigger .play on a section when it scrolls into view
        var addPlayOnView = function (id, threshold) {
            var el = document.getElementById(id);
            if (!el) return;
            var run = function () { el.classList.add('play'); };
            if ('IntersectionObserver' in window) {
                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (e) { if (e.isIntersecting) { run(); observer.disconnect(); } });
                }, { threshold: threshold || 0.18 });
                observer.observe(el);
            } else { run(); }
        };

        addPlayOnView('articles-list', 0.18);
        addPlayOnView('articles-topics', 0.2);
        addPlayOnView('articles-faq', 0.2);
        addPlayOnView('articles-subscribe', 0.25);
        addPlayOnView('articles-readnext', 0.2);
    });
    </script>

    @if(!empty($readNextArticles) && $readNextArticles->isNotEmpty())
        <section class="articles-readnext-section articles-readnext-anim" id="articles-readnext">
            <div class="container-wrap">
                <div class="articles-readnext-head">
                    <div>
                        <p class="articles-readnext-kicker">Читайте дальше</p>
                        <h2 class="articles-readnext-title">Ещё материалы по теме</h2>
                    </div>
                </div>
                <div class="articles-readnext-grid">
                    @foreach($readNextArticles as $rn)
                        @php
                            $rnRead = max(2, (int) round(str_word_count(strip_tags((string) $rn->full_content)) / 180));
                        @endphp
                        <a href="{{ route('site.articles.show', $rn->slug) }}" class="articles-readnext-card">
                            <div class="articles-readnext-meta">
                                @if($rn->publishedDate())
                                    <span>{{ $rn->publishedDate()->format('d.m.Y') }}</span>
                                    <span>·</span>
                                @endif
                                <span>{{ $rnRead }} мин</span>
                            </div>
                            <div class="articles-readnext-card-title">{{ $rn->title }}</div>
                            <div class="articles-readnext-excerpt">{{ $rn->excerptText() ?: $rn->short_description }}</div>
                            <div class="articles-readnext-foot">
                                <span>Читать</span>
                                <span class="articles-readnext-arrow">→</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
