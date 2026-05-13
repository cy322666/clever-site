@extends('site.layouts.app', [
    'title' => 'О компании | Clever',
    'metaDescription' => 'Кто такая команда Clever: для кого работаем, что делаем с amoCRM, чем отличаемся и как начать проект.',
    'canonical' => route('site.about'),
])

@push('meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="О компании | Clever">
    <meta property="og:description" content="Кто такая команда Clever: для кого работаем, что делаем с amoCRM, чем отличаемся и как начать проект.">
    <meta property="og:url" content="{{ route('site.about') }}">
    <meta name="twitter:card" content="summary">
@endpush

@section('content')
    <style>
        .about-redesign {
            overflow: hidden;
            font-family: 'Manrope', system-ui, sans-serif;
        }

        .about-redesign .cases-hero {
            padding-bottom: 96px;
        }

        .about-hero-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) minmax(340px, 0.72fr);
            gap: 48px;
            align-items: end;
            margin-top: 32px;
            position: relative;
            z-index: 1;
        }

        .about-redesign .cases-hero .cases-hero-title[class] {
            max-width: 920px;
        }

        .about-system-card {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            padding: 24px;
            background:
                radial-gradient(circle at 100% 0%, rgba(249, 115, 22, 0.2), transparent 36%),
                linear-gradient(135deg, #171717 0%, #0c0c0c 100%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            box-shadow: 0 26px 70px rgba(15, 23, 42, 0.18);
        }

        .about-system-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                linear-gradient(rgba(255, 255, 255, 0.026) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.026) 1px, transparent 1px);
            background-size: 42px 42px;
            opacity: 0.55;
            pointer-events: none;
        }

        .about-system-card > * {
            position: relative;
            z-index: 1;
        }

        .about-system-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .about-system-label {
            color: #ff8a2a;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .about-system-title {
            margin-top: 8px;
            max-width: 300px;
            color: rgba(255, 255, 255, 0.86);
            font-size: 15px;
            font-weight: 700;
            line-height: 1.45;
        }

        .about-system-pill {
            flex: 0 0 auto;
            border-radius: 999px;
            padding: 8px 12px;
            background: rgba(249, 115, 22, 0.16);
            color: #ff9b3d;
            font-size: 11px;
            font-weight: 900;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .about-system-flow {
            display: grid;
            gap: 12px;
            margin-top: 18px;
        }

        .about-system-step {
            display: grid;
            grid-template-columns: 42px minmax(0, 1fr);
            gap: 13px;
            align-items: center;
            border-radius: 18px;
            padding: 13px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .about-system-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: #f97316;
            color: #fff;
            font-size: 12px;
            font-weight: 900;
        }

        .about-system-step strong {
            display: block;
            color: #fff;
            font-size: 15px;
            line-height: 1.25;
        }

        .about-system-step span {
            display: block;
            margin-top: 4px;
            color: rgba(255, 255, 255, 0.56);
            font-size: 13px;
            line-height: 1.4;
        }

        .about-strip {
            padding: 0 0 72px;
        }

        .about-strip-panel {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0;
            overflow: hidden;
            border-radius: 28px;
            border: 1px solid rgba(15, 23, 42, 0.06);
            background: rgba(255, 255, 255, 0.72);
            box-shadow: 0 14px 42px rgba(15, 23, 42, 0.06);
        }

        .about-strip-item {
            min-height: 152px;
            padding: 26px;
            border-right: 1px solid rgba(15, 23, 42, 0.06);
        }

        .about-strip-item:last-child {
            border-right: 0;
        }

        .about-strip-index {
            color: #f97316;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.1em;
        }

        .about-strip-title {
            margin-top: 18px;
            color: #111;
            font-size: 18px;
            font-weight: 800;
            line-height: 1.18;
            letter-spacing: -0.02em;
        }

        .about-strip-text {
            margin-top: 10px;
            color: rgba(15, 23, 42, 0.5);
            font-size: 14px;
            line-height: 1.55;
        }

        .about-timeline-section {
            padding-top: 0;
        }

        .about-tl-intro {
            margin-bottom: 44px;
        }

        .about-tl-intro .cases-hero-kicker {
            margin: 0;
        }

        .about-tl-title {
            margin-top: 10px;
            max-width: 760px;
            color: #111;
            font-size: clamp(32px, 4vw, 48px);
            font-weight: 900;
            line-height: 1.03;
            letter-spacing: -0.04em;
        }

        .about-tl-lead {
            margin-top: 16px;
            max-width: 660px;
            color: rgba(15, 23, 42, 0.48);
            font-size: 16px;
            line-height: 1.72;
        }

        .about-tl-list {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-top: 22px;
        }

        .about-tl-chip {
            position: relative;
            min-height: 100%;
            padding: 16px 16px 17px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 16px;
            background: linear-gradient(180deg, #fff, rgba(248, 250, 252, 0.75));
            color: rgba(15, 23, 42, 0.68);
            font-size: 14px;
            line-height: 1.6;
        }

        .about-tl-chip::before {
            content: '';
            position: absolute;
            inset: 0 auto 0 0;
            width: 3px;
            border-radius: 16px 0 0 16px;
            background: rgba(249, 115, 22, 0.28);
        }

        .about-case-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-top: 28px;
        }

        .about-case-card {
            width: auto;
            margin-right: 0;
        }

        .about-case-link {
            display: inline-flex;
            margin-top: 14px;
            color: #f97316;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
        }

        .about-cta-card {
            border-radius: 30px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .about-cta-actions {
            display: grid;
            gap: 12px;
        }

        .about-cta-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 56px;
            border-radius: 18px;
            padding: 0 24px;
            font-size: 15px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .about-cta-btn-primary {
            border: 0;
            background: #ff8a2a;
            color: #fff;
            cursor: pointer;
        }

        .about-cta-btn-primary:hover {
            background: #ff7a0a;
            transform: translateY(-1px);
            color: #fff;
        }

        .about-cta-btn-secondary {
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.06);
            color: #fff;
        }

        .about-cta-btn-secondary:hover {
            border-color: rgba(255, 255, 255, 0.22);
            color: #fff;
        }

        @media (max-width: 1000px) {
            .about-hero-layout,
            .about-strip-panel,
            .about-case-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .about-hero-layout {
                align-items: start;
            }

            .about-strip-item:nth-child(2) {
                border-right: 0;
            }

            .about-strip-item:nth-child(-n + 2) {
                border-bottom: 1px solid rgba(15, 23, 42, 0.06);
            }
        }

        @media (max-width: 760px) {
            .about-redesign .cases-hero {
                padding: 28px 0 56px;
            }

            .about-hero-layout,
            .about-strip-panel,
            .about-tl-list,
            .about-case-grid {
                grid-template-columns: 1fr;
            }

            .about-hero-layout {
                gap: 28px;
            }

            .about-system-card,
            .about-strip-panel,
            .about-cta-card {
                border-radius: 24px;
            }

            .about-strip {
                padding-bottom: 56px;
            }

            .about-strip-item,
            .about-strip-item:nth-child(2),
            .about-strip-item:nth-child(-n + 2) {
                border-right: 0;
                border-bottom: 1px solid rgba(15, 23, 42, 0.06);
            }

            .about-strip-item:last-child {
                border-bottom: 0;
            }
        }

        @media (max-width: 420px) {
            .about-system-card,
            .about-cta-card {
                padding: 20px;
            }

            .about-system-top {
                flex-direction: column;
            }

            .about-cta-btn {
                width: 100%;
            }
        }
    </style>

    <div class="about-redesign">
        <section class="cases-hero">
            <div class="container-wrap">
                <nav class="cases-bc" aria-label="breadcrumbs">
                    <a href="{{ route('site.home') }}">Главная</a>
                    <span class="cases-bc-sep">/</span>
                    <span>О компании</span>
                </nav>

                <div class="about-hero-layout">
                    <div>
                        <div class="cases-hero-top">
                            <h1 class="cases-hero-title">Clever —<br>CRM как <em>система продаж</em></h1>
                        </div>
                        <div class="cases-hero-row">
                            <p class="cases-hero-lead">Мы проектируем amoCRM вокруг реального процесса: заявки, этапы, роли, задачи, аналитика и контроль руководителя. Не продаем “настройку по списку” — собираем рабочий контур продаж.</p>
                            <div class="cases-hero-actions">
                                <a href="#" class="cases-hero-btn" data-lead-open data-lead-offer="Обсудить проект">Обсудить проект</a>
                            </div>
                        </div>
                    </div>

                    <aside class="about-system-card" aria-label="Схема работы Clever">
                        <div class="about-system-top">
                            <div>
                                <div class="about-system-label">Контур продаж</div>
                            </div>
                        </div>
                        <div class="about-system-flow">
                            <div class="about-system-step">
                                <span class="about-system-num">01</span>
                                <div><strong>Процесс</strong><span>разбираем реальную логику продаж</span></div>
                            </div>
                            <div class="about-system-step">
                                <span class="about-system-num">02</span>
                                <div><strong>amoCRM</strong><span>собираем под этапы, роли и контроль</span></div>
                            </div>
                            <div class="about-system-step">
                                <span class="about-system-num">03</span>
                                <div><strong>Команда</strong><span>запускаем менеджеров в единую систему</span></div>
                            </div>
                            <div class="about-system-step">
                                <span class="about-system-num">04</span>
                                <div><strong>Руководитель</strong><span>получает цифры и точки управления</span></div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <section class="about-strip">
            <div class="container-wrap">
                <div class="about-strip-panel">
                    <div class="about-strip-item">
                        <div class="about-strip-index">01</div>
                        <div class="about-strip-title">Сначала процесс</div>
                        <p class="about-strip-text">Не начинаем с полей и роботов. Фиксируем, как должна работать продажа.</p>
                    </div>
                    <div class="about-strip-item">
                        <div class="about-strip-index">02</div>
                        <div class="about-strip-title">Потом архитектура</div>
                        <p class="about-strip-text">Этапы, роли, задачи, интеграции и отчеты собираются в одну модель.</p>
                    </div>
                    <div class="about-strip-item">
                        <div class="about-strip-index">03</div>
                        <div class="about-strip-title">Запуск команды</div>
                        <p class="about-strip-text">Проверяем реальные сценарии и доводим систему до использования.</p>
                    </div>
                    <div class="about-strip-item">
                        <div class="about-strip-index">04</div>
                        <div class="about-strip-title">Контроль цифр</div>
                        <p class="about-strip-text">Руководитель видит потери, просрочки, конверсию и работу каналов.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="cases-timeline-section about-timeline-section">
            <div class="container-wrap">
                <div class="about-tl-intro">
                    <p class="cases-hero-kicker">Как работаем</p>
                    <h2 class="about-tl-title">Полезны там, где CRM должна управлять продажами, а не просто хранить сделки</h2>
                    <p class="about-tl-lead">Лучше всего мы раскрываемся в проектах, где несколько каналов заявок, длинный цикл сделки, разные роли в команде, интеграции и потребность видеть картину по цифрам.</p>
                </div>

                <div class="cases-timeline">
                    <div class="cases-tl-item">
                        <div class="cases-tl-dot"></div>
                        <article class="cases-tl-card">
                            <div class="cases-tl-top">
                                <div class="cases-tl-left">
                                    <div class="cases-tl-logo"><span>01</span></div>
                                    <div>
                                        <div class="cases-tl-company">Для кого</div>
                                        <div class="cases-tl-niche">Сложные продажи и рост команды</div>
                                    </div>
                                </div>
                            </div>
                            <h3 class="cases-tl-title">Для собственников и руководителей, которым нужна управляемость продаж</h3>
                            <div class="about-tl-list">
                                <div class="about-tl-chip">Отдел продаж от 10 менеджеров или несколько команд, работающих с разными типами клиентов.</div>
                                <div class="about-tl-chip">Несколько каналов заявок: сайт, звонки, мессенджеры, реклама, партнеры, повторные продажи.</div>
                                <div class="about-tl-chip">CRM уже есть, но в ней нет контроля, прозрачной аналитики и единой логики работы.</div>
                            </div>
                        </article>
                    </div>

                    <div class="cases-tl-item">
                        <div class="cases-tl-dot"></div>
                        <article class="cases-tl-card">
                            <div class="cases-tl-top">
                                <div class="cases-tl-left">
                                    <div class="cases-tl-logo"><span>02</span></div>
                                    <div>
                                        <div class="cases-tl-company">Что делаем</div>
                                        <div class="cases-tl-niche">Диагностика, архитектура, внедрение</div>
                                    </div>
                                </div>
                            </div>
                            <h3 class="cases-tl-title">Пересобираем CRM вокруг процесса продаж</h3>
                            <div class="about-tl-list">
                                <div class="about-tl-chip">Находим, где теряются заявки, контроль, скорость и деньги.</div>
                                <div class="about-tl-chip">Проектируем этапы, правила, роли, задачи, интеграции и отчеты.</div>
                                <div class="about-tl-chip">Настраиваем amoCRM и запускаем изменения без остановки отдела продаж.</div>
                            </div>
                        </article>
                    </div>

                    <div class="cases-tl-item">
                        <div class="cases-tl-dot"></div>
                        <article class="cases-tl-card">
                            <div class="cases-tl-top">
                                <div class="cases-tl-left">
                                    <div class="cases-tl-logo"><span>03</span></div>
                                    <div>
                                        <div class="cases-tl-company">Чем отличаемся</div>
                                        <div class="cases-tl-niche">Бизнес-логика вместо шаблонов</div>
                                    </div>
                                </div>
                            </div>
                            <h3 class="cases-tl-title">Мы смотрим на CRM как на систему управления продажами</h3>
                            <div class="about-tl-list">
                                <div class="about-tl-chip">Не переносим чужую воронку и не собираем “как обычно”.</div>
                                <div class="about-tl-chip">Переводим задачи собственника в этапы, правила, контроль и аналитику.</div>
                                <div class="about-tl-chip">Строим основу, которая выдерживает рост команды, новые каналы и отчеты.</div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="cases-ticker-section">
            <div class="container-wrap">
                <div class="about-tl-intro">
                    <p class="cases-hero-kicker">Кейсы</p>
                    <h2 class="about-tl-title">Как это выглядит в проектах</h2>
                    <p class="about-tl-lead">В кейсах видно, с какими задачами приходят компании и что меняется после пересборки amoCRM: контроль заявок, дисциплина работы, аналитика и понятная картина по продажам.</p>
                </div>

                <div class="about-case-grid">
                    @forelse($caseStudies as $case)
                        <a href="{{ route('site.case-studies.show', $case->slug) }}" class="cases-ticker-card about-case-card">
                            <div class="cases-tc-top">
                                <div class="cases-tc-logo">
                                    @if($case->logoUrl())
                                        <img src="{{ $case->logoUrl() }}" alt="{{ $case->client_name ?: $case->title }}" loading="lazy">
                                    @else
                                        <span>{{ mb_substr($case->client_name ?: $case->title, 0, 2) }}</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="cases-tc-name">{{ $case->client_name ?: $case->title }}</div>
                                    @if($case->niche)
                                        <div class="cases-tc-niche">{{ $case->niche }}</div>
                                    @endif
                                </div>
                            </div>
                            <p class="cases-tc-result">{{ Str::limit($case->result_summary ?: $case->short_description, 110) }}</p>
                            <span class="about-case-link">Открыть кейс →</span>
                        </a>
                    @empty
                        <a href="{{ route('site.case-studies.index') }}" class="cases-ticker-card about-case-card">
                            <div class="cases-tc-top">
                                <div class="cases-tc-logo"><span>CL</span></div>
                                <div>
                                    <div class="cases-tc-name">Кейсы Clever</div>
                                    <div class="cases-tc-niche">Проекты amoCRM</div>
                                </div>
                            </div>
                            <p class="cases-tc-result">Собрали примеры внедрений, пересборок и аналитики для компаний со сложными продажами.</p>
                            <span class="about-case-link">Смотреть кейсы →</span>
                        </a>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="cases-contact-section">
            <div class="container-wrap">
                <div class="cases-cp-panel">
                    <div>
                        <p class="cases-hero-kicker">Как начать</p>
                        <h2 class="cases-cp-title">Начинаем с разговора о <span>продажах</span></h2>
                        <p class="cases-cp-desc">На первой встрече разбираем, что сейчас происходит с заявками, командой, контролем и аналитикой. После этого понятно, нужен ли аудит, внедрение с нуля, пересборка или развитие текущей системы.</p>
                        <div class="cases-cp-trust">
                            <div class="cases-cp-trust-item">Без навязывания готового шаблона</div>
                            <div class="cases-cp-trust-item">Сначала процесс, потом настройки</div>
                            <div class="cases-cp-trust-item">Покажем ближайшие точки потерь</div>
                        </div>
                    </div>

                    <div class="about-cta-card">
                        <div class="about-cta-actions">
                            <button type="button" class="about-cta-btn about-cta-btn-primary" data-lead-open data-lead-offer="Обсудить проект">Обсудить проект</button>
                            <a href="{{ route('site.case-studies.index') }}" class="about-cta-btn about-cta-btn-secondary">Смотреть кейсы</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
