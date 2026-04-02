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
                    CRM есть, а выручка
                    <span>все равно утекает</span>
                </h1>

                <p class="future-home-subtitle">
                    Покажем, где бизнес теряет заявки, повторные продажи и контроль над отделом
                </p>

                <div class="future-home-actions">
                    <a class="future-btn future-btn-primary" href="#home-form">Разобрать CRM и потери</a>
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
                <div class="future-home-panel future-home-panel-back" aria-hidden="true"></div>
                <div class="future-home-panel future-home-panel-front" aria-hidden="true"></div>
                <div class="future-home-floating future-home-floating-top">Заявки и контроль в одной системе</div>
                <div class="future-home-floating future-home-floating-bottom">Потери видны сразу</div>

                <div class="future-home-core-card">
                    <div class="future-home-core-head">
                        <div class="future-home-core-title">Контур продаж</div>
                    </div>

                    <p class="future-home-core-text">
                        Продажи собраны в одну систему: от заявки и работы менеджеров до понятных цифр по выручке
                    </p>

                    <div class="future-home-core-grid">
                        <div class="future-home-core-item">
                            <div>
                                <span>Заявки</span>
                                <strong>Без потерь</strong>
                            </div>
                            <em aria-hidden="true">✓</em>
                        </div>
                        <div class="future-home-core-item">
                            <div>
                                <span>Контроль</span>
                                <strong>По этапам</strong>
                            </div>
                            <em aria-hidden="true">✓</em>
                        </div>
                        <div class="future-home-core-item">
                            <div>
                                <span>Аналитика</span>
                                <strong>По цифрам</strong>
                            </div>
                            <em aria-hidden="true">✓</em>
                        </div>
                    </div>

                </div>
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
                    <h3>Внедрить ИИ в продажи</h3>
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
                    <h3>Не хватает аналитики продаж</h3>
                </article>
            </div>
        </div>
    </section>

    <section class="future-section" id="home-directions">
        <div class="container-wrap">
            <div class="future-section-head">
                <div>
                    <h2 class="future-section-title">Где наводим порядок в продажах через amoCRM</h2>
                </div>
            </div>

            <div class="future-card-grid">
                <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}" class="future-service-card">
                    <div class="future-service-index">01</div>
                    <div class="future-service-copy">
                        <div class="future-service-kicker">Внедрение</div>
                        <h3>Соберем amoCRM под реальные продажи</h3>
                    </div>
                    <span class="future-service-link">Подробнее →</span>
                </a>
                <a href="{{ route('site.landings.show', 'perevnedrenie-amocrm') }}" class="future-service-card">
                    <div class="future-service-index">02</div>
                    <div class="future-service-copy">
                        <div class="future-service-kicker">Перевнедрение</div>
                        <h3>Переделаем CRM, если текущее внедрение не работает</h3>
                    </div>
                    <span class="future-service-link">Подробнее →</span>
                </a>
                <a href="{{ route('site.landings.show', 'analitika-prodazh-v-amocrm') }}" class="future-service-card">
                    <div class="future-service-index">03</div>
                    <div class="future-service-copy">
                        <div class="future-service-kicker">Аналитика</div>
                        <h3>Покажем цифры, на которые можно опираться</h3>
                    </div>
                    <span class="future-service-link">Подробнее →</span>
                </a>
                <a href="{{ route('site.landings.show', 'razrabotka-crm') }}" class="future-service-card">
                    <div class="future-service-index">04</div>
                    <div class="future-service-copy">
                        <div class="future-service-kicker">Разработка</div>
                        <h3>Доработаем CRM под вашу логику бизнеса</h3>
                    </div>
                    <span class="future-service-link">Подробнее →</span>
                </a>
            </div>

        </div>
    </section>

    <section class="future-section future-section-tight" id="home-responsibility">
        <div class="container-wrap">
            <div class="future-responsibility-panel">
                <div class="future-responsibility-topline" aria-hidden="true"></div>
                <div class="future-responsibility-grid">
                    <h2 class="future-responsibility-title">
                        Небольшая команда,
                        <span>высокая ответственность</span>
                    </h2>
                    <div class="future-responsibility-copy">
                        <p class="future-responsibility-text">
                            Работаем с ограниченным количеством проектов, чтобы не превращать внедрение в формальность
                        </p>
                    </div>
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
                        <img
                            class="future-founder-photo-image"
                            src="{{ asset('images/founder-photo.jpeg') }}"
                            alt="Вячеслав Трофимов"
                            loading="lazy"
                        >
                    </div>
                </div>

                <div class="future-founder-copy">
                    <h2 class="future-section-title">Каждый проект начинается с личного погружения в архитектуру продаж</h2>
                    <blockquote class="future-founder-quote">
                        «Сначала сам смотрю, что у вас вообще в CRM творится: где теряются заявки, где бардак и что там уже понастроили лишнего»
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
                    <h3>Интервью для amoCRM</h3>
                    <p>
                        О том, как я пришел в интеграцию, почему взял фокус на сложные проекты и как подхожу к внедрению и переделке CRM.
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
                    <h2 class="future-section-title">Проекты, где мы навели порядок в продажах</h2>
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

    <section class="future-section future-section-tight" id="home-reviews">
        <div class="container-wrap">
            <div class="future-section-head">
                <div>
                    <h2 class="future-section-title">Что говорят клиенты после проекта</h2>
                </div>
            </div>

            <div class="future-review-grid">
                <article class="future-review-card">
                    <p class="future-review-text">“До этого CRM была внедрена формально. После проекта стало понятно, как реально вести сделки и где у нас терялись заявки.”</p>
                    <p class="future-review-meta">Руководитель отдела продаж / образовательный проект</p>
                </article>
                <article class="future-review-card">
                    <p class="future-review-text">“Самое полезное было не в настройках, а в том, что наконец появилась понятная логика работы и контроль по менеджерам.”</p>
                    <p class="future-review-meta">Собственник / B2B-компания</p>
                </article>
                <article class="future-review-card">
                    <p class="future-review-text">“В CRM был бардак, цифрам нельзя было доверять. После внедрения стало видно, что происходит в продажах и где проседает выручка.”</p>
                    <p class="future-review-meta">Коммерческий директор / производственная компания</p>
                </article>
            </div>
        </div>
    </section>

    <section class="future-section future-section-tight" id="home-conversion">
        <div class="container-wrap">
            <div class="future-conversion-panel">
                <div class="future-conversion-copy">
                    <h2 class="future-conversion-title">
                        CRM есть,
                        <span>а выручка</span> все равно утекает
                    </h2>
                </div>

                <ul class="future-conversion-list">
                    <li>Разберем, где у вас теряются заявки и деньги</li>
                    <li>Покажем слабые места в текущей CRM</li>
                    <li>Дадим план, что исправить в первую очередь</li>
                </ul>

                <a class="future-btn future-btn-primary future-conversion-btn" href="#home-form">
                    Разобрать CRM и потери
                </a>
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
                    <p>Покажем, где CRM теряет заявки и деньги, и дадим план правок по приоритету</p>
                </a>
                <a href="{{ route('site.articles.index') }}" class="future-article-card">
                    <h3>Чек лист для проверки CRM</h3>
                    <p>Короткий список, чтобы понять: CRM помогает продажам или только создает видимость контроля</p>
                </a>
                <a href="{{ route('site.landings.show', 'skolko-stoit-amocrm') }}" class="future-article-card">
                    <h3>Купить amoCRM с бонусами</h3>
                    <p>Подберем тариф, оформим лицензии и поможем не переплатить при покупке</p>
                </a>
            </div>
        </div>
    </section>

    <section class="future-section future-section-tight" id="home-faq">
        <div class="container-wrap">
            <div class="future-section-head">
                <div>
                    <h2 class="future-section-title">Что важно понять до старта</h2>
                </div>
            </div>

            <div class="future-faq-grid">
                <article class="future-faq-card">
                    <h3>С чего начать, если CRM уже есть, но толку от нее нет</h3>
                    <p>Начинаем с разбора текущей CRM и потерь. Сначала смотрим, где ломается логика, а потом решаем, нужна доработка, перевнедрение или точечная настройка.</p>
                </article>
                <article class="future-faq-card">
                    <h3>Когда хватает доработки, а когда нужно перевнедрение</h3>
                    <p>Если проблема в отдельных функциях, хватает доработки. Если CRM не отражает реальную продажу и не дает контроля, обычно нужен перезапуск логики.</p>
                </article>
                <article class="future-faq-card">
                    <h3>Можно ли навести порядок без остановки отдела продаж</h3>
                    <p>Да. Обычно пересобираем систему поэтапно, чтобы команда продолжала работать, а изменения внедрялись без полной остановки отдела.</p>
                </article>
                <article class="future-faq-card">
                    <h3>Что вы даете на старте</h3>
                    <p>Показываем, где теряются заявки и деньги, что в CRM лишнее, что сломано и какой план действий даст эффект быстрее всего.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="future-section" id="home-form">
        <div class="container-wrap">
            <div class="future-contact-panel">
                <div>
                    <h2 class="future-contact-title">Покажем, где CRM съедает деньги в продажах</h2>
                </div>

                <div class="future-form-card">
                    @if(session('landing_form_success'))
                        <x-alert class="mb-4">{{ session('landing_form_success') }}</x-alert>
                    @endif

                    <form action="{{ route('site.inquiries.store') }}" method="POST" class="future-form-grid">
                        @csrf
                        <input type="hidden" name="landing_slug" value="home">
                        <input type="hidden" name="landing_title" value="Главная страница">
                        <input type="hidden" name="offer_type" value="Показать потери в CRM">
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
                            Показать потери в CRM
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
