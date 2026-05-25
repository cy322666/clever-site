@extends('site.layouts.app', [
    'title' => 'Страница не найдена | CleverCRM',
    'metaDescription' => 'Страница не найдена. Перейдите на главную, в услуги или кейсы CleverCRM.',
    'robots' => 'noindex,follow',
])

@section('content')
    <style>
        .error-page-404 {
            min-height: calc(100vh - 120px);
            padding: 112px 0 96px;
            background: linear-gradient(180deg, #f7f8fb 0%, #ffffff 100%);
            color: #111318;
        }

        .error-page-404 .error-shell {
            width: min(1120px, calc(100% - 40px));
            margin: 0 auto;
        }

        .error-page-404 .error-panel {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 360px;
            overflow: hidden;
            border: 1px solid rgba(17, 19, 24, .08);
            border-radius: 30px;
            background: rgba(255, 255, 255, .92);
            box-shadow: 0 26px 70px rgba(18, 22, 33, .10);
        }

        .error-page-404 .error-main {
            padding: clamp(34px, 5vw, 64px);
        }

        .error-page-404 .error-title {
            max-width: 740px;
            margin: 0;
            color: #0f1117;
            font-size: 72px;
            font-weight: 900;
            line-height: .96;
            letter-spacing: 0;
        }

        .error-page-404 .error-text {
            max-width: 610px;
            margin: 22px 0 0;
            color: rgba(17, 19, 24, .68);
            font-size: 18px;
            line-height: 1.6;
        }

        .error-page-404 .error-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 34px;
        }

        .error-page-404 .error-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
            padding: 0 20px;
            border: 1px solid rgba(17, 19, 24, .12);
            border-radius: 14px;
            background: #fff;
            color: #111318;
            font-weight: 850;
            text-decoration: none;
            transition: transform .18s ease, border-color .18s ease, background .18s ease;
        }

        .error-page-404 .error-btn:hover {
            transform: translateY(-1px);
            border-color: rgba(17, 19, 24, .24);
            background: #f6f7f9;
        }

        .error-page-404 .error-btn-primary {
            border-color: #111318;
            background: #111318;
            color: #fff;
        }

        .error-page-404 .error-btn-primary:hover {
            border-color: #111318;
            background: #242832;
        }

        .error-page-404 .error-side {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 34px;
            padding: 38px 34px;
            background: #111318;
            color: #fff;
        }

        .error-page-404 .error-number {
            margin: 0;
            color: #ff7a30;
            font-size: 112px;
            font-weight: 950;
            line-height: .82;
            letter-spacing: 0;
        }

        .error-page-404 .error-side-text {
            margin: 18px 0 0;
            color: rgba(255, 255, 255, .72);
            font-size: 15px;
            line-height: 1.55;
        }

        .error-page-404 .error-links-title {
            margin: 0 0 12px;
            color: rgba(255, 255, 255, .52);
            font-size: 12px;
            font-weight: 900;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .error-page-404 .error-links {
            display: grid;
            gap: 9px;
        }

        .error-page-404 .error-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            min-height: 54px;
            padding: 0 15px;
            border: 1px solid rgba(255, 255, 255, .10);
            border-radius: 15px;
            background: rgba(255, 255, 255, .06);
            color: #fff;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            transition: background .18s ease, border-color .18s ease;
        }

        .error-page-404 .error-link:hover {
            border-color: rgba(255, 122, 48, .55);
            background: rgba(255, 122, 48, .13);
        }

        .error-page-404 .error-link-mark {
            flex: 0 0 auto;
            color: #ff9a5d;
            font-weight: 900;
        }

        @media (max-width: 860px) {
            .error-page-404 {
                padding: 88px 0 72px;
            }

            .error-page-404 .error-shell {
                width: min(100% - 24px, 620px);
            }

            .error-page-404 .error-panel {
                grid-template-columns: 1fr;
                border-radius: 24px;
            }

            .error-page-404 .error-side {
                padding: 30px 24px;
            }

            .error-page-404 .error-title {
                font-size: 48px;
                line-height: 1;
            }

            .error-page-404 .error-number {
                font-size: 84px;
            }

            .error-page-404 .error-actions {
                flex-direction: column;
            }

            .error-page-404 .error-btn {
                width: 100%;
            }
        }
    </style>

    <section class="error-page-404">
        <div class="error-shell">
            <div class="error-panel">
                <div class="error-main">
                    <h1 class="error-title">Страница не найдена</h1>
                    <p class="error-text">
                        Ссылка устарела или адрес введен с ошибкой. Вернитесь в основные разделы сайта:
                        там услуги, кейсы и контакты без лишнего шума.
                    </p>

                    <div class="error-actions">
                        <a href="{{ route('site.home') }}" class="error-btn error-btn-primary">На главную</a>
                        <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}" class="error-btn">Услуги</a>
                        <a href="{{ route('site.case-studies.index') }}" class="error-btn">Кейсы</a>
                        <a href="{{ route('site.contacts') }}" class="error-btn">Контакты</a>
                    </div>
                </div>

                <aside class="error-side" aria-label="Быстрые ссылки">
                    <div>
                        <p class="error-number">404</p>
                        <p class="error-side-text">
                            CRM любит порядок. URL тоже. Ниже быстрые переходы к самым частым задачам.
                        </p>
                    </div>

                    <div>
                        <p class="error-links-title">Быстро перейти</p>
                        <div class="error-links">
                            <a href="{{ route('site.landings.show', 'perevnedrenie-amocrm') }}" class="error-link">
                                <span>Перевнедрение amoCRM</span>
                                <span class="error-link-mark">></span>
                            </a>
                            <a href="{{ route('site.landings.show', 'analitika-prodazh-v-amocrm') }}" class="error-link">
                                <span>Аналитика продаж</span>
                                <span class="error-link-mark">></span>
                            </a>
                            <a href="{{ route('site.landings.show', 'razrabotka-crm') }}" class="error-link">
                                <span>Разработка CRM</span>
                                <span class="error-link-mark">></span>
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
