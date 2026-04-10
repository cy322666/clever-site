@extends('site.layouts.app', ['title' => $title ?? 'Предварительная оценка CRM-проекта'])

@section('content')
    <section class="ccalc-page">
        <div class="container-wrap">
            <div class="ccalc-head">
                <h1>Предварительная оценка проекта</h1>
                <p>
                    Оцените ориентир по бюджету и срокам, поймите состав работ и факторы стоимости
                    Точный расчет фиксируем после короткой диагностики вашего процесса продаж
                </p>
            </div>

            <div class="ccalc-layout" id="ccalcRoot">
                <section class="ccalc-card ccalc-main">
                    <div class="ccalc-steps" id="ccalcStepper"></div>
                    <div class="ccalc-progress"><span id="ccalcProgress"></span></div>

                    <form id="ccalcForm" novalidate>
                        <div class="ccalc-step is-active" data-step="1">
                            <h2>Что нужно сделать</h2>
                            <p>Выберите ключевой тип проекта</p>
                            <div class="ccalc-grid" id="projectTypeChoices"></div>
                        </div>

                        <div class="ccalc-step" data-step="2">
                            <h2>В каком состоянии сейчас система</h2>
                            <p>Это напрямую влияет на объем разбора и пересборки</p>
                            <div class="ccalc-grid" id="crmStateChoices"></div>
                        </div>

                        <div class="ccalc-step" data-step="3">
                            <h2>Размер команды продаж</h2>
                            <p>Число менеджеров влияет на сложность процессов и контроля</p>
                            <div class="ccalc-grid" id="teamSizeChoices"></div>
                        </div>

                        <div class="ccalc-step" data-step="4">
                            <h2>Какие модули нужны дополнительно</h2>
                            <p>Отметьте нужные модули для расширенного контура работ</p>
                            <div class="ccalc-grid ccalc-grid-compact" id="extrasChoices"></div>
                        </div>

                        <div class="ccalc-step" data-step="5">
                            <h2>Насколько срочный проект</h2>
                            <p>Сжатые сроки требуют усиленной загрузки команды</p>
                            <div class="ccalc-grid" id="urgencyChoices"></div>
                        </div>

                        <div class="ccalc-actions">
                            <button type="button" class="ccalc-btn ccalc-btn-ghost" id="backBtn">Назад</button>
                            <button type="button" class="ccalc-btn ccalc-btn-accent" id="nextBtn">Далее</button>
                        </div>
                        <p class="ccalc-error" id="stepError" aria-live="polite"></p>
                    </form>

                    <section id="ccalcResult" class="ccalc-result" hidden>
                        <h2>Ориентир по вашему проекту</h2>

                        <div class="ccalc-result-metrics">
                            <article class="ccalc-metric">
                                <p>Предварительный бюджет</p>
                                <strong id="resultBudget">—</strong>
                            </article>
                            <article class="ccalc-metric">
                                <p>Ориентир по срокам</p>
                                <strong id="resultTimeline">—</strong>
                            </article>
                        </div>

                        <div class="ccalc-result-block">
                            <h3>Что войдет в работу</h3>
                            <ul id="resultWorks"></ul>
                        </div>

                        <div class="ccalc-result-block">
                            <h3>Что влияет на стоимость</h3>
                            <ul id="resultFactors"></ul>
                        </div>

                        <div class="ccalc-actions ccalc-result-actions">
                            <button
                                type="button"
                                id="calcLeadBtn"
                                class="ccalc-btn ccalc-btn-accent"
                                data-lead-open
                                data-lead-offer="Точный расчет CRM-проекта"
                            >
                                Получить точный расчет
                            </button>
                            <button type="button" class="ccalc-btn ccalc-btn-ghost" id="editBtn">Изменить параметры</button>
                        </div>
                    </section>
                </section>

                <aside class="ccalc-card ccalc-side">
                    <h3>Черновик оценки</h3>
                    <ul id="previewList"></ul>

                    <div class="ccalc-preview-metric">
                        <span>Ориентир бюджета</span>
                        <strong id="previewBudget">Заполните шаги 1–3</strong>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <style>
        .ccalc-page {
            padding: 44px 0 78px;
            background:
                radial-gradient(820px 420px at -5% -15%, #fff4ea 0%, transparent 68%),
                radial-gradient(780px 380px at 120% -5%, #fff1e7 0%, transparent 65%);
        }

        .ccalc-head {
            margin: 0 0 44px;
            max-width: 860px;
            text-align: left;
        }

        .ccalc-head h1 {
            margin: 0;
            font-size: clamp(30px, 4vw, 52px);
            line-height: 1.04;
            color: #111827;
            letter-spacing: -.02em;
        }

        .ccalc-head p {
            margin: 14px 0 0;
            font-size: 18px;
            line-height: 1.55;
            color: #4b5563;
            max-width: 780px;
        }

        .ccalc-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.7fr) minmax(280px, 1fr);
            gap: 22px;
            align-items: start;
        }

        .ccalc-card {
            border: 1px solid #e7e9ee;
            background: #fff;
            border-radius: 32px;
            box-shadow: 0 18px 52px rgba(17, 24, 39, 0.08);
        }

        .ccalc-main {
            padding: 24px 24px 28px;
        }

        .ccalc-side {
            position: sticky;
            top: 84px;
            padding: 24px;
        }

        .ccalc-steps {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 8px;
            margin-bottom: 14px;
        }

        .ccalc-chip {
            padding: 10px 12px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: #fff;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
            font-weight: 400;
            transition: all .24s ease;
        }

        .ccalc-chip.is-active {
            color: #9a3412;
            border-color: #fdba74;
            background: #fff7ed;
            box-shadow: none;
        }

        .ccalc-chip.is-done {
            color: #1f2937;
            border-color: #d1d5db;
            background: #f9fafb;
        }

        .ccalc-progress {
            height: 6px;
            border-radius: 6px;
            background: #eef0f3;
            overflow: hidden;
            margin-bottom: 24px;
        }

        .ccalc-progress span {
            display: block;
            height: 100%;
            width: 20%;
            border-radius: inherit;
            background: linear-gradient(90deg, #f97316, #fb923c);
            transition: width .28s ease;
        }

        .ccalc-step {
            display: none;
        }

        .ccalc-step.is-active {
            display: block;
        }

        .ccalc-step h2 {
            margin: 0;
            font-size: clamp(22px, 2.8vw, 34px);
            line-height: 1.12;
            letter-spacing: -.01em;
            color: #0f172a;
            font-weight: 400;
        }

        .ccalc-step p {
            margin: 10px 0 20px;
            color: #6b7280;
            font-size: 16px;
            line-height: 1.52;
        }

        .ccalc-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .ccalc-grid-compact {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .ccalc-choice {
            width: 100%;
            border: 1px solid #e5e7eb;
            background: #fff;
            border-radius: 18px;
            padding: 16px;
            text-align: left;
            cursor: pointer;
            transition: all .2s ease;
        }

        .ccalc-choice:hover {
            transform: translateY(-2px);
            border-color: #d1d5db;
            box-shadow: 0 9px 18px rgba(15, 23, 42, .07);
        }

        .ccalc-choice.is-selected {
            border-color: #fdba74;
            background: #fffaf5;
            box-shadow: 0 8px 16px rgba(249, 115, 22, .16);
        }

        .ccalc-choice-title {
            display: block;
            font-size: 17px;
            line-height: 1.35;
            font-weight: 400;
            color: #111827;
        }

        .ccalc-choice-sub {
            display: block;
            margin-top: 6px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.44;
        }

        .ccalc-actions {
            margin-top: 26px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .ccalc-btn {
            appearance: none;
            border-radius: 12px;
            padding: 14px 24px;
            font-size: 16px;
            line-height: 1;
            font-weight: 400;
            cursor: pointer;
            transition: all .2s ease;
        }

        .ccalc-btn-accent {
            color: #fff;
            border: 1px solid #f97316;
            background: #f97316;
            box-shadow: 0 8px 16px rgba(249, 115, 22, .24);
        }

        .ccalc-btn-accent:hover {
            background: #ea580c;
            border-color: #ea580c;
            transform: translateY(-1px);
        }

        .ccalc-btn-ghost {
            color: #1f2937;
            background: #fff;
            border: 1px solid #d1d5db;
        }

        .ccalc-btn-ghost:hover {
            border-color: #9ca3af;
        }

        .ccalc-error {
            min-height: 22px;
            margin: 10px 0 0;
            color: #c2410c;
            font-weight: 400;
            font-size: 14px;
        }

        .ccalc-side h3 {
            margin: 0 0 16px;
            color: #0f172a;
            font-size: 24px;
            line-height: 1.2;
            font-weight: 400;
        }

        .ccalc-side ul {
            list-style: none;
            margin: 0;
            padding: 0;
            border-top: 1px solid #e5e7eb;
        }

        .ccalc-side li {
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 15px;
        }

        .ccalc-side li span:first-child {
            color: #6b7280;
        }

        .ccalc-side li span:last-child {
            color: #111827;
            font-weight: 400;
            text-align: right;
        }

        .ccalc-preview-metric {
            margin-top: 18px;
            border: 1px solid #fed7aa;
            background: #fff7ed;
            border-radius: 18px;
            padding: 14px 16px;
        }

        .ccalc-preview-metric span {
            display: block;
            margin-bottom: 6px;
            font-size: 12px;
            color: #9a3412;
            text-transform: uppercase;
            letter-spacing: .06em;
            font-weight: 400;
        }

        .ccalc-preview-metric strong {
            display: block;
            font-size: clamp(24px, 3vw, 34px);
            color: #111827;
            line-height: 1.15;
            letter-spacing: -.01em;
        }

        #previewBudget {
            font-size: clamp(22px, 3vw, 32px);
        }

        .ccalc-result h2 {
            margin: 0 0 18px;
            color: #0f172a;
            font-size: clamp(26px, 3vw, 38px);
            line-height: 1.12;
        }

        .ccalc-result-metrics {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 16px;
        }

        .ccalc-metric {
            margin: 0;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            border-radius: 18px;
            padding: 14px 16px;
        }

        .ccalc-metric p {
            margin: 0 0 8px;
            color: #64748b;
            font-size: 14px;
        }

        .ccalc-metric strong {
            font-size: clamp(24px, 3vw, 36px);
            color: #0f172a;
            line-height: 1.12;
            letter-spacing: -.01em;
        }

        #resultBudget {
            font-size: clamp(22px, 3vw, 34px);
        }

        .ccalc-result-block {
            margin-top: 14px;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 14px 16px;
            background: #fff;
        }

        .ccalc-result-block h3 {
            margin: 0 0 10px;
            font-size: 17px;
            color: #111827;
        }

        .ccalc-result-block ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .ccalc-result-block li {
            margin: 8px 0;
            padding-left: 30px;
            position: relative;
            color: #1f2937;
            line-height: 1.45;
        }

        .ccalc-result-block li::before {
            content: "✓";
            position: absolute;
            left: 0;
            top: 1px;
            width: 20px;
            height: 20px;
            border-radius: 6px;
            border: 1px solid #fdba74;
            background: #fff7ed;
            color: #ea580c;
            font-size: 12px;
            line-height: 20px;
            text-align: center;
        }

        .ccalc-result-actions {
            justify-content: flex-start;
            flex-wrap: wrap;
        }

        @media (max-width: 1080px) {
            .ccalc-layout {
                grid-template-columns: 1fr;
            }

            .ccalc-side {
                position: static;
            }
        }

        @media (max-width: 760px) {
            .ccalc-page {
                padding-top: 28px;
            }

            .ccalc-head {
                margin-bottom: 30px;
            }

            .ccalc-card {
                border-radius: 24px;
            }

            .ccalc-main,
            .ccalc-side {
                padding: 18px;
            }

            .ccalc-grid,
            .ccalc-grid-compact,
            .ccalc-result-metrics {
                grid-template-columns: 1fr;
            }

            .ccalc-btn {
                width: 100%;
            }

            .ccalc-actions {
                flex-direction: column;
            }

            .ccalc-steps {
                grid-template-columns: repeat(5, minmax(72px, 1fr));
                overflow-x: auto;
                padding-bottom: 4px;
            }

            .ccalc-chip {
                white-space: nowrap;
            }
        }
    </style>

    <script>
        (function () {
            const SETTINGS = {
                roundBudgetTo: 5000,
                projectTypes: [
                    {
                        id: "implementation",
                        label: "Внедрение amoCRM",
                        description: "Сборка CRM под процессы с нуля",
                        baseBudget: [120000, 220000],
                        baseWeeks: [4, 7],
                        works: [
                            "Диагностика логики продаж и воронок",
                            "Проектирование этапов, полей и регламентов",
                            "Настройка автоматизации и базового контроля",
                            "Запуск единого контура работы с лидами"
                        ]
                    },
                    {
                        id: "reimplementation",
                        label: "Перевнедрение amoCRM",
                        description: "Пересборка и наведение порядка",
                        baseBudget: [180000, 320000],
                        baseWeeks: [5, 9],
                        works: [
                            "Разбор текущей архитектуры и узких мест",
                            "Чистка дублей, хаотичных этапов и лишних полей",
                            "Пересборка воронок и правил обработки",
                            "Настройка управляемого контура контроля"
                        ]
                    },
                    {
                        id: "audit",
                        label: "Аудит CRM",
                        description: "Ревизия CRM и продаж",
                        baseBudget: [50000, 90000],
                        baseWeeks: [2, 4],
                        works: [
                            "Аудит карточек, статусов и качества данных",
                            "Проверка воронки на точки потери лидов",
                            "Оценка дисциплины менеджеров",
                            "Пошаговый план исправлений"
                        ]
                    },
                    {
                        id: "analytics",
                        label: "Аналитика / DataLens",
                        description: "Прозрачные дашборды и KPI",
                        baseBudget: [120000, 240000],
                        baseWeeks: [3, 6],
                        works: [
                            "Проектирование аналитической модели",
                            "Сбор данных из CRM и смежных источников",
                            "Построение дашбордов DataLens",
                            "Настройка отчетов для управления продажами"
                        ]
                    },
                    {
                        id: "integrations",
                        label: "Разработка / Интеграции",
                        description: "Кастомные связки и сценарии",
                        baseBudget: [180000, 420000],
                        baseWeeks: [5, 10],
                        works: [
                            "Проектирование интеграционной архитектуры",
                            "Разработка нестандартной логики обмена",
                            "Синхронизация данных между системами",
                            "Тестирование и стабилизация сценариев"
                        ]
                    }
                ],
                crmStates: [
                    {
                        id: "no_crm",
                        label: "CRM нет",
                        budgetFactor: 1.18,
                        durationFactor: 1.12,
                        impact: "Проектирование с нуля добавляет этап архитектуры процессов",
                        works: ["Формализация процесса продаж перед стартом внедрения"]
                    },
                    {
                        id: "need_order",
                        label: "CRM есть, но нужен порядок",
                        budgetFactor: 1.0,
                        durationFactor: 1.0,
                        impact: "Базовый уровень сложности с фокусом на систематизацию",
                        works: ["Унификация этапов и правил обработки заявок"]
                    },
                    {
                        id: "chaos",
                        label: "CRM в хаосе",
                        budgetFactor: 1.3,
                        durationFactor: 1.25,
                        impact: "Объем исправлений, чистки и пересборки повышает бюджет",
                        works: ["Глубокая ревизия текущего контура, ролей и автоматизаций"]
                    },
                    {
                        id: "refine_only",
                        label: "Нужна только доработка",
                        budgetFactor: 0.82,
                        durationFactor: 0.88,
                        impact: "Локальный формат работ обычно сокращает диапазон",
                        works: ["Точечные улучшения в существующей архитектуре"]
                    }
                ],
                teamSizes: [
                    {
                        id: "up_to_5",
                        label: "До 5 человек",
                        budgetFactor: 0.9,
                        durationFactor: 0.92,
                        impact: "Небольшая команда требует меньше ролевых сценариев"
                    },
                    {
                        id: "from_5_to_15",
                        label: "5–15",
                        budgetFactor: 1.0,
                        durationFactor: 1.0,
                        impact: "Стандартная сложность внедрения"
                    },
                    {
                        id: "from_15_to_30",
                        label: "15–30",
                        budgetFactor: 1.18,
                        durationFactor: 1.14,
                        impact: "Растут требования к контролю и автоматизации"
                    },
                    {
                        id: "more_30",
                        label: "30+",
                        budgetFactor: 1.4,
                        durationFactor: 1.26,
                        impact: "Нужна более сложная структура прав, отчетов и регламентов"
                    }
                ],
                extras: [
                    {
                        id: "telephony",
                        label: "Телефония",
                        description: "Подключение IP-телефонии, запись и контроль звонков",
                        addBudget: [20000, 45000],
                        addWeeks: [0.5, 1],
                        work: "Интеграция телефонии в CRM-контур",
                        impact: "Телефония добавляет интеграционные работы"
                    },
                    {
                        id: "messengers",
                        label: "WhatsApp / Мессенджеры",
                        description: "Единая лента диалогов и маршрутизация обращений",
                        addBudget: [18000, 40000],
                        addWeeks: [0.5, 1],
                        work: "Подключение мессенджеров в общий канал продаж",
                        impact: "Мессенджеры добавляют сценарии маршрутизации коммуникаций"
                    },
                    {
                        id: "email",
                        label: "Email Коммуникации",
                        description: "Почта в CRM, шаблоны и контроль переписки",
                        addBudget: [12000, 28000],
                        addWeeks: [0.5, 1],
                        work: "Настройка email-канала и шаблонов",
                        impact: "Email-канал требует отдельной настройки логики"
                    },
                    {
                        id: "auto_mail_funnel",
                        label: "Воронка авторассылок",
                        description: "Автоматические цепочки писем и касаний по этапам воронки",
                        addBudget: [25000, 60000],
                        addWeeks: [1, 2],
                        work: "Настройка автоворонки рассылок и триггеров",
                        impact: "Авторассылки добавляют сценарии коммуникаций и контента"
                    },
                    {
                        id: "repeat_sales_funnel",
                        label: "Воронка повторных продаж",
                        description: "Сегментация базы, реактивация и сценарии повторных сделок",
                        addBudget: [30000, 75000],
                        addWeeks: [1, 2],
                        work: "Сборка воронки повторных продаж и реактивации клиентов",
                        impact: "Повторные продажи требуют отдельной логики сегментации и триггеров"
                    },
                    {
                        id: "analytics_extra",
                        label: "Сквозная аналитика",
                        description: "Отчеты по воронке, источникам и конверсии",
                        addBudget: [30000, 70000],
                        addWeeks: [1, 2],
                        work: "Расширенная система аналитики и отчетов",
                        impact: "Глубина аналитики заметно влияет на бюджет"
                    },
                    {
                        id: "site_integration",
                        label: "Интеграция с сайтом",
                        description: "Формы, события и передача лидов без потерь",
                        addBudget: [25000, 55000],
                        addWeeks: [1, 2],
                        work: "Связка сайта и CRM по формам и событиям",
                        impact: "Интеграция с сайтом добавляет проверку источников и сценариев"
                    },
                    {
                        id: "custom_dev",
                        label: "Кастомная разработка",
                        description: "Нестандартная логика под реальные процессы продаж",
                        addBudget: [60000, 170000],
                        addWeeks: [2, 3],
                        work: "Разработка нестандартных модулей и логики",
                        impact: "Кастомная разработка ключевой фактор роста бюджета"
                    },
                    {
                        id: "ai_extra",
                        label: "AI / ИИ для продаж",
                        description: "Сценарии AI для контроля, классификации и подсказок",
                        addBudget: [55000, 140000],
                        addWeeks: [1, 3],
                        work: "AI-блоки для обработки лидов и контроля продаж",
                        impact: "AI-сценарии усиливают требования к данным и тестированию"
                    },
                    {
                        id: "training",
                        label: "Обучение команды",
                        description: "Обучение менеджеров и внедрение рабочих регламентов",
                        addBudget: [20000, 50000],
                        addWeeks: [0.5, 1],
                        work: "Обучение команды и настройка рабочих регламентов",
                        impact: "Обучение повышает результат проекта и добавляет отдельный этап"
                    }
                ],
                urgency: [
                    {
                        id: "no_rush",
                        label: "Без спешки",
                        budgetFactor: 1.0,
                        durationFactor: 1.0,
                        impact: "Стандартный темп работ без ускоряющей надбавки"
                    },
                    {
                        id: "month",
                        label: "В ближайший месяц",
                        budgetFactor: 1.1,
                        durationFactor: 0.92,
                        impact: "Сжатие плана увеличивает нагрузку на команду"
                    },
                    {
                        id: "urgent",
                        label: "Срочно",
                        budgetFactor: 1.23,
                        durationFactor: 0.86,
                        impact: "Срочный режим требует приоритетных ресурсов"
                    }
                ]
            };

            const root = document.getElementById("ccalcRoot");
            if (!root) return;

            const titles = ["Запрос", "Система", "Команда", "Модули", "Срочность"];
            const state = {
                step: 1,
                projectType: null,
                crmState: null,
                teamSize: null,
                extras: [],
                urgency: null
            };

            const map = {
                projectTypes: indexById(SETTINGS.projectTypes),
                crmStates: indexById(SETTINGS.crmStates),
                teamSizes: indexById(SETTINGS.teamSizes),
                extras: indexById(SETTINGS.extras),
                urgency: indexById(SETTINGS.urgency)
            };

            const formView = document.getElementById("ccalcForm");
            const resultView = document.getElementById("ccalcResult");
            const steps = Array.from(root.querySelectorAll(".ccalc-step"));
            const stepper = document.getElementById("ccalcStepper");
            const progress = document.getElementById("ccalcProgress");
            const errorNode = document.getElementById("stepError");
            const nextBtn = document.getElementById("nextBtn");
            const backBtn = document.getElementById("backBtn");
            const editBtn = document.getElementById("editBtn");
            const previewList = document.getElementById("previewList");
            const previewBudget = document.getElementById("previewBudget");

            const resultBudget = document.getElementById("resultBudget");
            const resultTimeline = document.getElementById("resultTimeline");
            const resultWorks = document.getElementById("resultWorks");
            const resultFactors = document.getElementById("resultFactors");
            const calcLeadBtn = document.getElementById("calcLeadBtn");

            renderChoices();
            renderStepper();
            updateStepView();
            renderPreview();

            root.addEventListener("click", function (event) {
                const card = event.target.closest(".ccalc-choice");
                if (!card) return;

                const group = card.dataset.group;
                const value = card.dataset.value;

                if (group === "extras") {
                    state.extras = state.extras.includes(value)
                        ? state.extras.filter((id) => id !== value)
                        : state.extras.concat(value);
                } else {
                    state[group] = value;
                }

                clearError();
                paintSelected();
                renderPreview();
            });

            backBtn.addEventListener("click", function () {
                if (state.step <= 1) return;
                state.step -= 1;
                updateStepView();
            });

            nextBtn.addEventListener("click", function () {
                if (!validateStep(state.step)) return;

                if (state.step < 5) {
                    state.step += 1;
                    updateStepView();
                    return;
                }

                const estimate = calculate(state);
                resultBudget.textContent = formatRange(estimate.budgetMin, estimate.budgetMax) + " ₽";
                resultTimeline.textContent = estimate.weeksMin + "–" + estimate.weeksMax + " недель";
                resultWorks.innerHTML = estimate.works.map((item) => "<li>" + item + "</li>").join("");
                resultFactors.innerHTML = estimate.factors.map((item) => "<li>" + item + "</li>").join("");

                if (calcLeadBtn) {
                    calcLeadBtn.setAttribute("data-lead-calculator", buildCalculatorSnapshot(state, estimate));
                }

                formView.hidden = true;
                resultView.hidden = false;
            });

            editBtn.addEventListener("click", function () {
                resultView.hidden = true;
                formView.hidden = false;
                state.step = 1;
                updateStepView();
            });

            function renderStepper() {
                stepper.innerHTML = titles
                    .map(function (title, i) {
                        return '<div class="ccalc-chip" data-chip-step="' + (i + 1) + '">' + title + "</div>";
                    })
                    .join("");
            }

            function renderChoices() {
                mountChoices("projectTypeChoices", SETTINGS.projectTypes, "projectType");
                mountChoices("crmStateChoices", SETTINGS.crmStates, "crmState");
                mountChoices("teamSizeChoices", SETTINGS.teamSizes, "teamSize");
                mountChoices("extrasChoices", SETTINGS.extras, "extras");
                mountChoices("urgencyChoices", SETTINGS.urgency, "urgency");
            }

            function mountChoices(containerId, list, group) {
                const node = document.getElementById(containerId);
                node.innerHTML = list.map(function (item) {
                    const subtitle = item.description
                        ? '<span class="ccalc-choice-sub">' + item.description + "</span>"
                        : "";
                    return (
                        '<button type="button" class="ccalc-choice" data-group="' + group + '" data-value="' + item.id + '">' +
                        '<span class="ccalc-choice-title">' + item.label + "</span>" +
                        subtitle +
                        "</button>"
                    );
                }).join("");
            }

            function updateStepView() {
                steps.forEach(function (stepEl) {
                    stepEl.classList.toggle("is-active", Number(stepEl.dataset.step) === state.step);
                });

                Array.from(root.querySelectorAll("[data-chip-step]")).forEach(function (chip) {
                    const step = Number(chip.dataset.chipStep);
                    chip.classList.toggle("is-active", step === state.step);
                    chip.classList.toggle("is-done", step < state.step);
                });

                progress.style.width = (state.step / 5 * 100) + "%";
                backBtn.style.visibility = state.step === 1 ? "hidden" : "visible";
                nextBtn.textContent = state.step === 5 ? "Показать оценку" : "Далее";
                clearError();
                paintSelected();
            }

            function paintSelected() {
                Array.from(root.querySelectorAll(".ccalc-choice")).forEach(function (card) {
                    const group = card.dataset.group;
                    const value = card.dataset.value;

                    if (group === "extras") {
                        card.classList.toggle("is-selected", state.extras.includes(value));
                    } else {
                        card.classList.toggle("is-selected", state[group] === value);
                    }
                });
            }

            function validateStep(step) {
                const required = {
                    1: "projectType",
                    2: "crmState",
                    3: "teamSize",
                    5: "urgency"
                };

                const field = required[step];
                if (!field) return true;
                if (state[field]) return true;

                errorNode.textContent = "Выберите вариант, чтобы продолжить";
                return false;
            }

            function clearError() {
                errorNode.textContent = "";
            }

            function calculate(input) {
                const project = map.projectTypes[input.projectType];
                const crm = map.crmStates[input.crmState];
                const team = map.teamSizes[input.teamSize];
                const urgency = map.urgency[input.urgency || "no_rush"];
                const extras = input.extras.map((id) => map.extras[id]).filter(Boolean);

                const budgetFactor = crm.budgetFactor * team.budgetFactor * urgency.budgetFactor;
                const durationFactor = crm.durationFactor * team.durationFactor * urgency.durationFactor;

                const extrasMin = sum(extras.map((item) => item.addBudget[0]));
                const extrasMax = sum(extras.map((item) => item.addBudget[1]));
                const budgetMin = roundMoney(project.baseBudget[0] * budgetFactor + extrasMin);
                const budgetMax = roundMoney(project.baseBudget[1] * budgetFactor + extrasMax);

                const weeksMinRaw = project.baseWeeks[0] * durationFactor + sum(extras.map((item) => item.addWeeks[0]));
                const weeksMaxRaw = project.baseWeeks[1] * durationFactor + sum(extras.map((item) => item.addWeeks[1]));
                const weeksMin = Math.max(1, Math.round(weeksMinRaw));
                const weeksMax = Math.max(weeksMin + 1, Math.round(weeksMaxRaw));

                const works = uniq([].concat(project.works, crm.works, extras.map((item) => item.work))).slice(0, 8);
                const factors = [crm.impact, team.impact, urgency.impact]
                    .concat(extras.map((item) => item.impact));

                if (!extras.length) {
                    factors.push("Дополнительные блоки не выбраны: расчет отражает базовый контур проекта");
                }

                return { budgetMin, budgetMax, weeksMin, weeksMax, works, factors };
            }

            function renderPreview() {
                const rows = [
                    { label: "Запрос", value: state.projectType ? map.projectTypes[state.projectType].label : "—" },
                    { label: "Состояние", value: state.crmState ? map.crmStates[state.crmState].label : "—" },
                    { label: "Команда", value: state.teamSize ? map.teamSizes[state.teamSize].label : "—" },
                    { label: "Модули", value: state.extras.length ? state.extras.length + " выбрано" : "Базовый набор" },
                    { label: "Срочность", value: state.urgency ? map.urgency[state.urgency].label : "—" }
                ];

                previewList.innerHTML = rows
                    .map((row) => "<li><span>" + row.label + "</span><span>" + row.value + "</span></li>")
                    .join("");

                if (state.projectType && state.crmState && state.teamSize) {
                    const estimate = calculate(Object.assign({}, state, { urgency: state.urgency || "no_rush" }));
                    previewBudget.textContent = formatRange(estimate.budgetMin, estimate.budgetMax) + " ₽";
                } else {
                    previewBudget.textContent = "Заполните шаги 1–3";
                }
            }

            function buildCalculatorSnapshot(currentState, estimate) {
                const project = map.projectTypes[currentState.projectType];
                const crm = map.crmStates[currentState.crmState];
                const team = map.teamSizes[currentState.teamSize];
                const urgency = map.urgency[currentState.urgency || "no_rush"];
                const extras = currentState.extras.map((id) => map.extras[id]).filter(Boolean);

                const lines = [
                    "Калькулятор: Предварительная оценка проекта",
                    "Тип проекта: " + (project ? project.label : "—"),
                    "Состояние CRM: " + (crm ? crm.label : "—"),
                    "Команда продаж: " + (team ? team.label : "—"),
                    "Срочность: " + (urgency ? urgency.label : "—"),
                    "Модули: " + (extras.length ? extras.map((item) => item.label).join(", ") : "Базовый набор"),
                    "Бюджет: " + formatRange(estimate.budgetMin, estimate.budgetMax) + " ₽",
                    "Срок: " + estimate.weeksMin + "–" + estimate.weeksMax + " недель"
                ];

                return lines.join("\n");
            }

            function indexById(list) {
                const index = {};
                list.forEach(function (item) {
                    index[item.id] = item;
                });
                return index;
            }

            function sum(list) {
                return list.reduce(function (acc, n) { return acc + n; }, 0);
            }

            function uniq(list) {
                return Array.from(new Set(list));
            }

            function roundMoney(value) {
                const step = SETTINGS.roundBudgetTo || 1000;
                return Math.round(value / step) * step;
            }

            function formatMoney(value) {
                return new Intl.NumberFormat("ru-RU").format(value);
            }

            function formatRange(min, max) {
                return formatMoney(min) + " – " + formatMoney(max);
            }
        })();
    </script>
@endsection
