@extends('site.layouts.app', [
    'title' => 'О CleverCRM | amoCRM для управляемых продаж',
    'metaDescription' => 'CleverCRM: кто отвечает за проект, как мы подходим к amoCRM, почему начинаем с процесса продаж и доводим CRM до управляемости.',
    'canonical' => route('site.about'),
])

@push('meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="О CleverCRM | amoCRM для управляемых продаж">
    <meta property="og:description" content="Кто отвечает за проект, как мы подходим к amoCRM и почему начинаем не с настроек, а с процесса продаж.">
    <meta property="og:url" content="{{ route('site.about') }}">
    <meta name="twitter:card" content="summary">
@endpush

@section('content')
    <style>
        .about-page {
            overflow: hidden;
            background: #f6f7f9;
            color: #111318;
            font-family: 'Manrope', system-ui, sans-serif;
        }

        .about-page a {
            color: inherit;
        }

        .about-page .about-hero {
            padding: 112px 0 84px;
            background: linear-gradient(180deg, #ffffff 0%, #f6f7f9 100%);
        }

        .about-page .about-hero-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.05fr) 420px;
            gap: 56px;
            align-items: center;
        }

        .about-page .about-kicker {
            margin: 0 0 18px;
            color: #f97316;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .about-page .about-title {
            max-width: 850px;
            margin: 0;
            color: #101116;
            font-size: 72px;
            font-weight: 950;
            line-height: .98;
            letter-spacing: 0;
        }

        .about-page .about-title span {
            color: #f97316;
        }

        .about-page .about-lead {
            max-width: 690px;
            margin: 28px 0 0;
            color: rgba(17, 19, 24, .72);
            font-size: 20px;
            line-height: 1.65;
        }

        .about-page .about-hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 34px;
        }

        .about-page .about-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 52px;
            padding: 0 22px;
            border-radius: 999px;
            border: 1px solid rgba(17, 19, 24, .14);
            background: #fff;
            color: #111318;
            font-size: 15px;
            font-weight: 850;
            text-decoration: none;
            transition: transform .18s ease, background .18s ease, border-color .18s ease;
        }

        .about-page .about-btn:hover {
            transform: translateY(-1px);
            border-color: rgba(17, 19, 24, .24);
            background: #f3f4f6;
        }

        .about-page .about-btn-primary {
            border-color: #111318;
            background: #111318;
            color: #fff;
        }

        .about-page .about-btn-primary:hover {
            background: #262a33;
            color: #fff;
        }

        .about-page .about-founder {
            overflow: hidden;
            border-radius: 8px;
            border: 1px solid rgba(17, 19, 24, .08);
            background: #fff;
            box-shadow: 0 24px 64px rgba(17, 19, 24, .12);
        }

        .about-page .about-founder-photo {
            aspect-ratio: 4 / 5;
            overflow: hidden;
            background: #dde2e0;
        }

        .about-page .about-founder-photo img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: 50% 34%;
        }

        .about-page .about-founder-body {
            padding: 22px;
        }

        .about-page .about-founder-name {
            margin: 0;
            color: #101116;
            font-size: 22px;
            font-weight: 900;
            line-height: 1.15;
        }

        .about-page .about-founder-role {
            margin: 7px 0 0;
            color: rgba(17, 19, 24, .54);
            font-size: 14px;
            font-weight: 750;
        }

        .about-page .about-founder-quote {
            margin: 18px 0 0;
            padding-top: 18px;
            border-top: 1px solid rgba(17, 19, 24, .08);
            color: rgba(17, 19, 24, .74);
            font-size: 15px;
            line-height: 1.65;
        }

        .about-page .about-section {
            padding: 84px 0;
        }

        .about-page .about-section-white {
            background: #fff;
        }

        .about-page .about-section-head {
            max-width: 760px;
            margin-bottom: 36px;
        }

        .about-page .about-section-title {
            margin: 0;
            color: #101116;
            font-size: 44px;
            font-weight: 930;
            line-height: 1.05;
            letter-spacing: 0;
        }

        .about-page .about-section-text {
            margin: 16px 0 0;
            color: rgba(17, 19, 24, .62);
            font-size: 17px;
            line-height: 1.7;
        }

        .about-page .about-principles {
            display: grid;
            gap: 0;
            overflow: hidden;
            border: 1px solid rgba(17, 19, 24, .08);
            border-radius: 8px;
            background: #fff;
        }

        .about-page .about-principle {
            display: grid;
            grid-template-columns: 240px minmax(0, 1fr);
            gap: 32px;
            padding: 30px 34px;
            border-bottom: 1px solid rgba(17, 19, 24, .08);
        }

        .about-page .about-principle:last-child {
            border-bottom: 0;
        }

        .about-page .about-principle-title {
            color: #101116;
            font-size: 19px;
            font-weight: 900;
            line-height: 1.25;
        }

        .about-page .about-principle-text {
            margin: 0;
            color: rgba(17, 19, 24, .68);
            font-size: 16px;
            line-height: 1.7;
        }

        .about-page .about-dark {
            background: #111318;
            color: #fff;
        }

        .about-page .about-dark .about-kicker {
            color: #ff9a4f;
        }

        .about-page .about-dark .about-section-title {
            color: #fff;
        }

        .about-page .about-dark .about-section-text {
            color: rgba(255, 255, 255, .68);
        }

        .about-page .about-work-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .about-page .about-work-item {
            min-height: 236px;
            padding: 24px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, .10);
            background: rgba(255, 255, 255, .06);
        }

        .about-page .about-work-number {
            color: #ff9a4f;
            font-size: 13px;
            font-weight: 900;
            letter-spacing: .08em;
        }

        .about-page .about-work-title {
            margin: 42px 0 0;
            color: #fff;
            font-size: 22px;
            font-weight: 900;
            line-height: 1.15;
        }

        .about-page .about-work-text {
            margin: 14px 0 0;
            color: rgba(255, 255, 255, .66);
            font-size: 15px;
            line-height: 1.65;
        }

        .about-page .about-fit {
            display: grid;
            grid-template-columns: 360px minmax(0, 1fr);
            gap: 36px;
            align-items: start;
        }

        .about-page .about-fit-note {
            position: sticky;
            top: 110px;
            border-radius: 8px;
            padding: 26px;
            background: #111318;
            color: #fff;
        }

        .about-page .about-fit-note strong {
            display: block;
            font-size: 26px;
            line-height: 1.12;
        }

        .about-page .about-fit-note span {
            display: block;
            margin-top: 16px;
            color: rgba(255, 255, 255, .66);
            font-size: 15px;
            line-height: 1.65;
        }

        .about-page .about-fit-list {
            display: grid;
            gap: 12px;
        }

        .about-page .about-fit-row {
            display: grid;
            grid-template-columns: 30px minmax(0, 1fr);
            gap: 16px;
            padding: 22px 0;
            border-bottom: 1px solid rgba(17, 19, 24, .10);
        }

        .about-page .about-fit-row:first-child {
            padding-top: 0;
        }

        .about-page .about-fit-mark {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: rgba(249, 115, 22, .13);
            color: #f97316;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
        }

        .about-page .about-fit-row strong {
            display: block;
            color: #101116;
            font-size: 20px;
            line-height: 1.25;
        }

        .about-page .about-fit-row p {
            margin: 8px 0 0;
            color: rgba(17, 19, 24, .62);
            font-size: 16px;
            line-height: 1.65;
        }

        .about-page .about-proof-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .about-page .about-proof-card {
            display: flex;
            min-height: 210px;
            flex-direction: column;
            justify-content: space-between;
            padding: 22px;
            border-radius: 8px;
            border: 1px solid rgba(17, 19, 24, .08);
            background: #fff;
            text-decoration: none;
            transition: transform .18s ease, border-color .18s ease, box-shadow .18s ease;
        }

        .about-page .about-proof-card:hover {
            transform: translateY(-2px);
            border-color: rgba(249, 115, 22, .36);
            box-shadow: 0 16px 42px rgba(17, 19, 24, .08);
        }

        .about-page .about-proof-logo {
            width: 54px;
            height: 54px;
            border-radius: 8px;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f3f4f6;
            color: #f97316;
            font-weight: 900;
        }

        .about-page .about-proof-logo img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .about-page .about-proof-title {
            margin: 18px 0 0;
            color: #101116;
            font-size: 18px;
            font-weight: 900;
            line-height: 1.25;
        }

        .about-page .about-proof-text {
            margin: 10px 0 0;
            color: rgba(17, 19, 24, .58);
            font-size: 14px;
            line-height: 1.55;
        }

        .about-page .about-proof-link {
            margin-top: 18px;
            color: #f97316;
            font-size: 14px;
            font-weight: 850;
        }

        .about-page .about-cta {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 32px;
            align-items: end;
            border-radius: 8px;
            padding: 42px;
            background: #111318;
            color: #fff;
        }

        .about-page .about-cta .about-section-title {
            color: #fff;
        }

        .about-page .about-cta .about-section-text {
            max-width: 660px;
            color: rgba(255, 255, 255, .68);
        }

        .about-page .about-cta-actions {
            display: grid;
            gap: 10px;
            min-width: 220px;
        }

        @media (max-width: 1020px) {
            .about-page .about-hero-grid,
            .about-page .about-fit,
            .about-page .about-cta {
                grid-template-columns: 1fr;
            }

            .about-page .about-founder {
                max-width: 460px;
            }

            .about-page .about-work-grid,
            .about-page .about-proof-grid {
                grid-template-columns: 1fr;
            }

            .about-page .about-fit-note {
                position: static;
            }
        }

        @media (max-width: 760px) {
            .about-page .about-hero {
                padding: 88px 0 58px;
            }

            .about-page .about-section {
                padding: 58px 0;
            }

            .about-page .about-title {
                font-size: 46px;
                line-height: 1.02;
            }

            .about-page .about-lead {
                font-size: 17px;
            }

            .about-page .about-section-title {
                font-size: 34px;
                line-height: 1.08;
            }

            .about-page .about-principle {
                grid-template-columns: 1fr;
                gap: 10px;
                padding: 24px;
            }

            .about-page .about-hero-actions,
            .about-page .about-cta-actions {
                width: 100%;
            }

            .about-page .about-btn {
                width: 100%;
            }

            .about-page .about-cta {
                padding: 28px;
            }
        }
    </style>

    <div class="about-page">
        <section class="about-hero">
            <div class="container-wrap">
                <div class="about-hero-grid">
                    <div>
                        <p class="about-kicker">CleverCRM</p>
                        <h1 class="about-title">Не просто настраиваем amoCRM. <span>Берем ответственность за систему продаж</span></h1>
                        <p class="about-lead">
                            Эта страница не про красивую легенду компании. Она про то, как мы думаем в проекте:
                            сначала разбираем продажи, потом проектируем CRM, потом доводим ее до состояния,
                            где менеджеры работают, а руководитель видит контроль.
                        </p>
                        <div class="about-hero-actions">
                            <a href="#" class="about-btn about-btn-primary" data-lead-open data-lead-offer="Обсудить проект">Обсудить проект</a>
                            <a href="{{ route('site.case-studies.index') }}" class="about-btn">Смотреть кейсы</a>
                        </div>
                    </div>

                    <aside class="about-founder" aria-label="Основатель CleverCRM">
                        <div class="about-founder-photo">
                            <img src="{{ asset('images/founder-interview.png') }}" alt="Вячеслав Трофимов" loading="lazy">
                        </div>
                        <div class="about-founder-body">
                            <h2 class="about-founder-name">Вячеслав Трофимов</h2>
                            <p class="about-founder-role">Основатель CleverCRM, 8+ лет в amoCRM</p>
                            <p class="about-founder-quote">
                                “Я смотрю на CRM как на управленческую систему: где берется заявка,
                                кто за нее отвечает, что должен сделать менеджер и какие цифры видит руководитель.”
                            </p>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="container-wrap">
                <div class="about-section-head">
                    <p class="about-kicker">Позиция</p>
                    <h2 class="about-section-title">Почему мы не начинаем проект с настроек</h2>
                    <p class="about-section-text">
                        Если сразу идти в поля, роботов и права доступа, легко получить аккуратную CRM,
                        которая не управляет продажами. Поэтому сначала фиксируем реальную логику работы.
                    </p>
                </div>

                <div class="about-principles">
                    <div class="about-principle">
                        <div class="about-principle-title">Продажи важнее интерфейса</div>
                        <p class="about-principle-text">Нам важно понять, как приходит заявка, как она проходит этапы, где зависает, кто принимает решение и что должно быть видно руководителю.</p>
                    </div>
                    <div class="about-principle">
                        <div class="about-principle-title">CRM должна быть понятной менеджеру</div>
                        <p class="about-principle-text">Система не должна ломать рабочий день. Она должна помогать менеджеру не забывать задачи, видеть приоритеты и вести клиента без хаоса.</p>
                    </div>
                    <div class="about-principle">
                        <div class="about-principle-title">Руководитель должен видеть управление</div>
                        <p class="about-principle-text">Не просто количество сделок, а потери по этапам, скорость реакции, качество обработки, просрочки, источники и реальную картину по команде.</p>
                    </div>
                    <div class="about-principle">
                        <div class="about-principle-title">После запуска проект не бросается</div>
                        <p class="about-principle-text">Мы проверяем сценарии на живой работе, исправляем сопротивление и доводим систему до использования, а не до формального “настроено”.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-section about-dark">
            <div class="container-wrap">
                <div class="about-section-head">
                    <p class="about-kicker">Как устроена работа</p>
                    <h2 class="about-section-title">В проекте есть три слоя ответственности</h2>
                    <p class="about-section-text">
                        Мы не делаем вид, что CRM решается одной настройкой. Нормальный результат появляется,
                        когда бизнес-логика, техническая реализация и запуск команды собраны вместе.
                    </p>
                </div>

                <div class="about-work-grid">
                    <div class="about-work-item">
                        <div class="about-work-number">01</div>
                        <h3 class="about-work-title">Бизнес-логика</h3>
                        <p class="about-work-text">Разбираем путь клиента, роли в команде, правила передачи, контроль задач, причины потерь и точки, где нужны цифры.</p>
                    </div>
                    <div class="about-work-item">
                        <div class="about-work-number">02</div>
                        <h3 class="about-work-title">Архитектура amoCRM</h3>
                        <p class="about-work-text">Проектируем воронки, поля, статусы, автоматизацию, интеграции и аналитику так, чтобы система выдерживала реальную работу.</p>
                    </div>
                    <div class="about-work-item">
                        <div class="about-work-number">03</div>
                        <h3 class="about-work-title">Запуск людей</h3>
                        <p class="about-work-text">Проверяем сценарии, обучаем, исправляем слабые места и помогаем команде перейти из старого хаоса в новый порядок.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-section about-section-white">
            <div class="container-wrap">
                <div class="about-fit">
                    <div class="about-fit-note">
                        <strong>Мы полезны, когда CRM уже влияет на деньги</strong>
                        <span>Не беремся делать “просто красиво в amoCRM”. Наша зона: продажи, контроль, аналитика, интеграции и управляемость.</span>
                    </div>

                    <div>
                        <div class="about-section-head">
                            <p class="about-kicker">Кому подходим</p>
                            <h2 class="about-section-title">Обычно к нам приходят не за кнопками, а за порядком</h2>
                        </div>

                        <div class="about-fit-list">
                            <div class="about-fit-row">
                                <span class="about-fit-mark">1</span>
                                <div>
                                    <strong>CRM есть, но руководитель ей не доверяет</strong>
                                    <p>Менеджеры ведут сделки по-разному, отчеты не сходятся, задачи теряются, а реальные проблемы видно только вручную.</p>
                                </div>
                            </div>
                            <div class="about-fit-row">
                                <span class="about-fit-mark">2</span>
                                <div>
                                    <strong>Продажи выросли, старая логика перестала держать нагрузку</strong>
                                    <p>Появились новые каналы, роли, отделы, повторные продажи, но CRM осталась на уровне первого внедрения.</p>
                                </div>
                            </div>
                            <div class="about-fit-row">
                                <span class="about-fit-mark">3</span>
                                <div>
                                    <strong>Нужна аналитика, а не выгрузки ради выгрузок</strong>
                                    <p>Важно видеть, где деньги, где потери, как работает команда и какие действия реально меняют продажи.</p>
                                </div>
                            </div>
                            <div class="about-fit-row">
                                <span class="about-fit-mark">4</span>
                                <div>
                                    <strong>Был неудачный интегратор или внедрение по шаблону</strong>
                                    <p>Мы спокойно разбираем, что уже сделано, что мешает работе и как пересобрать систему без лишнего разрушения.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-section">
            <div class="container-wrap">
                <div class="about-section-head">
                    <p class="about-kicker">Доказательства</p>
                    <h2 class="about-section-title">Лучше всего подход виден в кейсах</h2>
                    <p class="about-section-text">
                        На странице “О компании” можно написать что угодно. Поэтому ниже не обещания,
                        а проекты, где видно, какие задачи мы разбираем и какой порядок собираем в amoCRM.
                    </p>
                </div>

                <div class="about-proof-grid">
                    @forelse($caseStudies as $case)
                        <a href="{{ route('site.case-studies.show', $case->slug) }}" class="about-proof-card">
                            <div>
                                <div class="about-proof-logo">
                                    @if($case->logoUrl())
                                        <img src="{{ $case->logoUrl() }}" alt="{{ $case->client_name ?: $case->title }}" loading="lazy">
                                    @else
                                        <span>{{ mb_substr($case->client_name ?: $case->title, 0, 2) }}</span>
                                    @endif
                                </div>
                                <h3 class="about-proof-title">{{ $case->title }}</h3>
                                <p class="about-proof-text">{{ \Illuminate\Support\Str::limit(strip_tags($case->result_summary ?: $case->short_description), 120) }}</p>
                            </div>
                            <span class="about-proof-link">Открыть кейс</span>
                        </a>
                    @empty
                        <a href="{{ route('site.case-studies.index') }}" class="about-proof-card">
                            <div>
                                <div class="about-proof-logo"><span>CL</span></div>
                                <h3 class="about-proof-title">Кейсы CleverCRM</h3>
                                <p class="about-proof-text">Примеры внедрений, пересборок и аналитики для компаний со сложными продажами.</p>
                            </div>
                            <span class="about-proof-link">Смотреть кейсы</span>
                        </a>
                    @endforelse
                </div>
            </div>
        </section>

        <section class="about-section about-section-white">
            <div class="container-wrap">
                <div class="about-cta">
                    <div>
                        <p class="about-kicker">Старт проекта</p>
                        <h2 class="about-section-title">Начинаем с разговора о продажах</h2>
                        <p class="about-section-text">
                            На первой встрече разбираем, что происходит с заявками, командой,
                            контролем и аналитикой. После этого понятно, нужен аудит, внедрение,
                            пересборка или развитие текущей amoCRM.
                        </p>
                    </div>
                    <div class="about-cta-actions">
                        <a href="#" class="about-btn about-btn-primary" data-lead-open data-lead-offer="Обсудить проект">Обсудить проект</a>
                        <a href="https://t.me/integrator" class="about-btn" target="_blank" rel="noreferrer">Написать в Telegram</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
