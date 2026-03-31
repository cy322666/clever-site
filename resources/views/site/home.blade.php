@extends('site.layouts.app', [
    'title' => $seoTitle,
    'metaDescription' => $metaDescription,
    'canonical' => $canonicalUrl,
])

@push('meta')
    <meta property="og:locale" content="ru_RU">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $ogImageUrl }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $ogImageUrl }}">
@endpush

@section('content')
    <section class="future-home-hero">
        <div class="container-wrap future-home-hero-grid">
            <div class="future-home-copy">
                <h1 class="future-home-title">
                    Строим систему продаж,
                    <span>а не просто CRM</span>
                </h1>

                <p class="future-home-subtitle">
                    Снижаем потери в продажах, убираем ручной хаос и возвращаем управляемость
                </p>

                <div class="future-home-actions">
                    <a class="future-btn future-btn-primary" href="#home-form">Обсудить проект</a>
                </div>
            </div>

            <div class="future-home-visual">
                <div class="future-home-orb"></div>
                <div class="future-home-orb-lines">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div class="future-home-core-card">
                    <div class="future-home-core-head">
                        <div class="future-home-core-title">System Core</div>
                        <div class="future-home-badge">Online</div>
                    </div>

                    <div class="future-home-core-grid">
                        <div class="future-home-core-item">
                            <span>CRM</span>
                            <strong>Flow</strong>
                        </div>
                        <div class="future-home-core-item">
                            <span>AI</span>
                            <strong>Logic</strong>
                        </div>
                        <div class="future-home-core-item">
                            <span>Ops</span>
                            <strong>Auto</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="future-section" id="home-directions">
        <div class="container-wrap">
            <div class="future-section-head">
                <div>
                    <h2 class="future-section-title">Где усиливаем продажи через amoCRM</h2>
                </div>
            </div>

            <div class="future-card-grid">
                <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}" class="future-service-card">
                    <div class="future-service-index">01</div>
                    <div>
                        <div class="future-service-kicker">Внедрение</div>
                        <h3>Соберем amoCRM под реальные процессы продаж</h3>
                    </div>
                </a>
                <a href="{{ route('site.landings.show', 'perevnedrenie-amocrm') }}" class="future-service-card">
                    <div class="future-service-index">02</div>
                    <div>
                        <div class="future-service-kicker">Перевнедрение</div>
                        <h3>Переделаем amoCRM под реальную работу отдела продаж</h3>
                    </div>
                </a>
                <a href="{{ route('site.landings.show', 'analitika-prodazh-v-amocrm') }}" class="future-service-card">
                    <div class="future-service-index">03</div>
                    <div>
                        <div class="future-service-kicker">Аналитика</div>
                        <h3>Настраиваем DataLens для контроля продаж и каналов</h3>
                    </div>
                </a>
                <a href="{{ route('site.landings.show', 'razrabotka-crm') }}" class="future-service-card">
                    <div class="future-service-index">04</div>
                    <div>
                        <div class="future-service-kicker">Разработка</div>
                        <h3>Делаем доработки, интеграции и виджеты</h3>
                    </div>
                </a>
            </div>

            <div class="future-why-block">
                <div class="future-section-head future-section-head-center">
                    <div>
                        <h2 class="future-section-title">Почему нам доверяют архитектуру продаж</h2>
                    </div>
                </div>

                <div class="future-why-grid">
                    <article class="future-why-card">
                        <h3>Лично вникаем в проект</h3>
                        <p>На старте разбираем процессы, находим где теряются деньги и ломается логика продаж</p>
                    </article>
                    <article class="future-why-card">
                        <h3>Сильны в переделке CRM</h3>
                        <p>Пересобираем систему, если текущая CRM мешает работать и создает хаос</p>
                    </article>
                    <article class="future-why-card">
                        <h3>Проектируем под бизнес</h3>
                        <p>Собираем CRM под реальные процессы, роли в команде и задачи руководителя</p>
                    </article>
                    <article class="future-why-card">
                        <h3>Решаем сложные задачи</h3>
                        <p>Делаем интеграции, кастомную логику и автоматизацию там, где типовые решения не работают</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="future-section future-section-tight" id="home-founder">
        <div class="container-wrap">
            <div class="future-founder-grid">
                <div class="future-founder-visual">
                    <div class="future-founder-photo-card">
                        <div class="future-founder-photo-glow"></div>
                        <div class="future-founder-photo-label">Вячеслав Трофимов</div>
                        <div class="future-founder-photo-role">Основатель компании</div>
                    </div>
                </div>

                <div class="future-founder-copy">
                    <h2 class="future-section-title">Каждый проект начинается с личного погружения в архитектуру продаж</h2>
                    <blockquote class="future-founder-quote">
                        «На старте лично разбираю процессы, точки потерь, логику CRM и требования к автоматизации, чтобы система строилась под реальную задачу бизнеса»
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <section class="future-section future-section-tight" id="home-interview">
        <div class="container-wrap">
            <div class="future-section-head">
                <div>
                    <h2 class="future-section-title">Интервью для amoCRM</h2>
                </div>
            </div>

            <a class="future-interview-card" href="https://vkvideo.ru/video-216419758_456239030" target="_blank" rel="noreferrer">
                <div class="future-interview-meta">
                    <h3>Открыть интервью прямо на сайте</h3>
                    <p>
                        Короткий разбор подхода к внедрению, автоматизации и сложным CRM-проектам.
                        Откроется видео с интервью без лишних переходов по сайту.
                    </p>
                    <span class="future-btn future-btn-secondary">Смотреть</span>
                </div>
                <div class="future-interview-preview" aria-hidden="true">
                    <div class="future-interview-play">▶</div>
                </div>
            </a>
        </div>
    </section>

    <section class="future-section future-section-tight" id="home-cases">
        <div class="container-wrap">
            <div class="future-section-head">
                <div>
                    <h2 class="future-section-title">Кейсы</h2>
                </div>
                <a class="future-text-link" href="{{ route('site.case-studies.index') }}">Все кейсы</a>
            </div>

            <div class="future-case-grid">
                @foreach($compactCaseStudies as $caseStudy)
                    <a href="{{ $caseStudy['url'] }}" class="future-case-card">
                        <h3>{{ $caseStudy['title'] }}</h3>
                        <p>{{ $caseStudy['text'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="future-section future-section-tight" id="home-process">
        <div class="container-wrap">
            <div class="future-section-head">
                <div>
                    <h2 class="future-section-title">Когда к нам обращаются</h2>
                </div>
            </div>

            <div class="future-process-grid">
                <article class="future-process-card">
                    <div class="future-service-index">01</div>
                    <h3>Внедрить amoCRM с нуля</h3>
                </article>
                <article class="future-process-card">
                    <div class="future-service-index">02</div>
                    <h3>Переделать после слабого внедрения</h3>
                </article>
                <article class="future-process-card">
                    <div class="future-service-index">03</div>
                    <h3>Внедрить ИИ инструменты в продажи</h3>
                </article>
                <article class="future-process-card">
                    <div class="future-service-index">04</div>
                    <h3>Бизнес вырос, а в CRM начался хаос</h3>
                </article>
                <article class="future-process-card">
                    <div class="future-service-index">05</div>
                    <h3>Нужна доработка или интеграция</h3>
                </article>
                <article class="future-process-card">
                    <div class="future-service-index">06</div>
                    <h3>Не хватает аналитики<br>и контроля продаж</h3>
                </article>
            </div>
        </div>
    </section>

    <section class="future-section future-section-tight" id="home-articles">
        <div class="container-wrap">
            <div class="future-section-head">
                <div>
                    <h2 class="future-section-title">Полезное для бизнеса</h2>
                </div>
            </div>

            <div class="future-article-grid">
                <a href="{{ route('site.landings.show', 'audit-amocrm') }}" class="future-article-card">
                    <h3>Аудит вашей CRM (бесплатно)</h3>
                    <p>Покажем слабые места в текущей CRM и дадим понятный план, что нужно исправить в первую очередь</p>
                </a>
                <a href="{{ route('site.articles.index') }}" class="future-article-card">
                    <h3>Чек лист для проверки CRM</h3>
                    <p>Короткий практический список для проверки CRM перед внедрением, переделкой или масштабированием</p>
                </a>
                <a href="{{ route('site.landings.show', 'skolko-stoit-amocrm') }}" class="future-article-card">
                    <h3>Купить amoCRM с бонусами</h3>
                    <p>Поможем подобрать тариф, оформить лицензии и получить бонусы при покупке через нашу команду</p>
                </a>
            </div>
        </div>
    </section>

    <section class="future-section" id="home-form">
        <div class="container-wrap">
            <div class="future-contact-panel">
                <div>
                    <h2 class="future-contact-title">Покажем, где вы теряете деньги в продажах</h2>
                </div>

                <div class="future-form-card">
                    @if(session('landing_form_success'))
                        <x-alert class="mb-4">{{ session('landing_form_success') }}</x-alert>
                    @endif

                    <form action="{{ route('site.inquiries.store') }}" method="POST" class="future-form-grid">
                        @csrf
                        <input type="hidden" name="landing_slug" value="home">
                        <input type="hidden" name="landing_title" value="Главная страница">
                        <input type="hidden" name="offer_type" value="Разобрать мою ситуацию">
                        <input type="hidden" name="page_url" value="{{ request()->fullUrl() }}">

                        <label class="future-form-field">
                            <span>Имя</span>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Как к вам обращаться">
                        </label>

                        <label class="future-form-field">
                            <span>Контакт</span>
                            <input type="text" name="contact" value="{{ old('contact') }}" placeholder="Телефон, Telegram или email">
                        </label>

                        <label class="future-form-field future-form-field-full">
                            <span>Коротко о задаче</span>
                            <textarea name="message" rows="5" placeholder="Например: дорогие лиды, CRM есть но не дает контроля, нужно внедрение AI">{{ old('message') }}</textarea>
                        </label>

                        <button type="submit" class="future-btn future-btn-primary future-form-submit">
                            Разобрать мою ситуацию
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
