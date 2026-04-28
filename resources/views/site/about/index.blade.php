@extends('site.layouts.app', [
    'title' => 'О компании | Clever',
    'metaDescription' => 'Clever проектирует и пересобирает amoCRM под реальную систему продаж: контроль, аналитика и управляемое внедрение.'
])

@section('content')
    <style>
        .about-page {
            padding: 18px 0 0;
        }

        .about-hero {
            position: relative;
            overflow: hidden;
            border-radius: 36px;
            padding: 46px;
            background:
                radial-gradient(circle at 88% 0%, rgba(255, 155, 61, 0.22), transparent 34%),
                radial-gradient(circle at 10% 100%, rgba(59, 130, 246, 0.12), transparent 32%),
                linear-gradient(135deg, #171717 0%, #0f0f0f 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.2);
        }

        .about-hero-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(300px, 0.82fr);
            gap: 30px;
            align-items: center;
        }

        .about-kicker {
            margin: 0;
            color: rgba(255, 255, 255, 0.66);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .about-title {
            margin: 12px 0 0;
            max-width: 12ch;
            color: #fff;
            font-size: clamp(38px, 5.2vw, 68px);
            line-height: 0.96;
            letter-spacing: -0.045em;
        }

        .about-subtitle {
            margin: 18px 0 0;
            max-width: 640px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 16px;
            line-height: 1.72;
        }

        .about-hero-note {
            margin-top: 22px;
            display: inline-flex;
            align-items: center;
            gap: 9px;
            border-radius: 999px;
            padding: 8px 14px;
            border: 1px solid rgba(255, 255, 255, 0.14);
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.86);
            font-size: 13px;
        }

        .about-hero-note::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #ff9b3d;
            box-shadow: 0 0 0 5px rgba(255, 155, 61, 0.2);
        }

        .about-hero-card {
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.07);
            backdrop-filter: blur(10px);
            padding: 18px;
            color: #fff;
        }

        .about-hero-card-head {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.58);
        }

        .about-hero-card-grid {
            margin-top: 12px;
            display: grid;
            gap: 10px;
        }

        .about-hero-chip {
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(15, 23, 42, 0.46);
            padding: 10px 12px;
        }

        .about-hero-chip strong {
            display: block;
            font-size: 17px;
            line-height: 1.08;
            letter-spacing: -0.02em;
            color: #fff;
        }

        .about-hero-chip span {
            display: block;
            margin-top: 6px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.72);
            line-height: 1.4;
        }

        .about-steps {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .about-step {
            border-radius: 24px;
            border: 1px solid #dbe4f0;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.07);
            padding: 22px;
        }

        .about-step-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 24px;
            border-radius: 999px;
            padding: 0 9px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #c2410c;
            background: rgba(255, 138, 42, 0.12);
            border: 1px solid rgba(255, 138, 42, 0.24);
        }

        .about-step h2 {
            margin: 12px 0 0;
            color: #0f172a;
            font-size: 25px;
            line-height: 1.08;
            letter-spacing: -0.03em;
        }

        .about-step p {
            margin: 12px 0 0;
            color: rgba(15, 23, 42, 0.7);
            font-size: 14px;
            line-height: 1.65;
        }

        .about-founder {
            margin-top: 16px;
            border-radius: 30px;
            border: 1px solid rgba(148, 163, 184, 0.2);
            background:
                radial-gradient(380px 160px at 100% 0%, rgba(255, 138, 42, 0.1), transparent 72%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.95) 100%);
            box-shadow: 0 20px 44px rgba(15, 23, 42, 0.08);
            padding: 24px;
        }

        .about-founder-grid {
            display: grid;
            grid-template-columns: 120px minmax(0, 1fr);
            gap: 18px;
            align-items: start;
        }

        .about-founder-photo {
            width: 120px;
            height: 120px;
            border-radius: 22px;
            object-fit: cover;
            border: 1px solid rgba(148, 163, 184, 0.32);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
        }

        .about-founder h3 {
            margin: 0;
            color: #0f172a;
            font-size: 28px;
            line-height: 1.08;
            letter-spacing: -0.03em;
        }

        .about-founder blockquote {
            margin: 14px 0 0;
            border-left: 4px solid #ff9b3d;
            padding: 2px 0 2px 14px;
            color: #0f172a;
            font-size: 17px;
            line-height: 1.62;
            letter-spacing: -0.01em;
        }

        .about-founder-meta {
            margin-top: 10px;
            color: rgba(15, 23, 42, 0.58);
            font-size: 13px;
            line-height: 1.45;
        }

        .about-founder-actions {
            margin-top: 16px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .about-btn-dark {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 16px;
            border-radius: 12px;
            background: #0f172a;
            border: 1px solid #0f172a;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: .2s ease;
        }

        .about-btn-dark:hover {
            background: #1e293b;
            border-color: #1e293b;
            color: #fff;
        }

        .about-btn-light {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 0 16px;
            border-radius: 12px;
            background: #fff;
            border: 1px solid rgba(148, 163, 184, 0.28);
            color: #0f172a;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            transition: .2s ease;
        }

        .about-btn-light:hover {
            border-color: rgba(148, 163, 184, 0.44);
            color: #0f172a;
        }

        @media (max-width: 980px) {
            .about-hero-grid,
            .about-steps {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 760px) {
            .about-page {
                padding-top: 10px;
            }

            .about-hero {
                border-radius: 24px;
                padding: 26px 22px;
            }

            .about-step {
                border-radius: 20px;
                padding: 18px;
            }

            .about-founder {
                border-radius: 22px;
                padding: 18px;
            }

            .about-founder-grid {
                grid-template-columns: 1fr;
            }

            .about-founder-photo {
                width: 96px;
                height: 96px;
            }
        }
    </style>

    <section class="site-section about-page">
        <div class="container-wrap">
            <div class="about-hero">
                <div class="about-hero-grid">
                    <div>
                        <p class="about-kicker">О компании</p>
                        <h1 class="about-title">Clever</h1>
                        <p class="about-subtitle">Пересобираем amoCRM в рабочую систему продаж: с контролем, понятной логикой менеджеров и управленческой аналитикой.</p>
                        <div class="about-hero-note">Системные проекты для B2B-команд</div>
                    </div>
                    <div class="about-hero-card">
                        <div class="about-hero-card-head">Фокус команды</div>
                        <div class="about-hero-card-grid">
                            <div class="about-hero-chip">
                                <strong>150+ проектов</strong>
                                <span>Внедрения и пересборки amoCRM</span>
                            </div>
                            <div class="about-hero-chip">
                                <strong>С 2020 года</strong>
                                <span>Работаем с процессами, а не с шаблонами</span>
                            </div>
                            <div class="about-hero-chip">
                                <strong>Сложные внедрения</strong>
                                <span>Интеграции, аналитика, контроль руководителя</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="about-steps">
                <article class="about-step">
                    <span class="about-step-num">01</span>
                    <h2>Диагностика</h2>
                    <p>Сначала разбираем процесс продаж, точки потерь, роли менеджеров и текущую CRM, чтобы зафиксировать реальную проблему.</p>
                </article>
                <article class="about-step">
                    <span class="about-step-num">02</span>
                    <h2>Проектирование</h2>
                    <p>Собираем архитектуру продаж: этапы, правила, контроль, задачи, интеграции и отчетность, а не просто набор полей.</p>
                </article>
                <article class="about-step">
                    <span class="about-step-num">03</span>
                    <h2>Запуск и развитие</h2>
                    <p>Внедряем изменения поэтапно, обучаем команду и доводим систему до состояния, где руководитель видит цифры и управляет.</p>
                </article>
            </div>

            <section class="about-founder">
                <div class="about-founder-grid">
                    <img src="/images/founder-v2.jpg" alt="Вячеслав Трофимов" class="about-founder-photo">
                    <div>
                        <h3>Каждый проект начинается с погружения в бизнес-логику</h3>
                        <blockquote>«Мы не продаем абстрактное внедрение. Наша задача — собрать рабочий контур продаж, где команда действует в одной системе, а руководитель получает управляемость по цифрам»</blockquote>
                        <div class="about-founder-meta">Вячеслав Трофимов, основатель Clever</div>
                        <div class="about-founder-actions">
                            <button type="button" class="about-btn-dark" data-lead-open data-lead-offer="Обсудить проект">Обсудить проект</button>
                            <a href="{{ route('site.case-studies.index') }}" class="about-btn-light">Смотреть кейсы</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
@endsection

