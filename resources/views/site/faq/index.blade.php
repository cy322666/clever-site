@extends('site.layouts.app', [
    'title' => $title,
    'metaDescription' => $metaDescription,
])

@section('content')
    @php
        $faqItems = [
            [
                'question' => 'Сколько стоит внедрение amoCRM?',
                'answer' => 'Стоимость зависит от состава проекта: количества воронок, ролей, источников заявок, интеграций, автоматизаций, отчетов и объема обучения команды. После первичного разбора мы фиксируем понятный диапазон, а после аудита или проектирования даем точную смету по этапам.',
            ],
            [
                'question' => 'Почему нельзя назвать точную цену сразу?',
                'answer' => 'Одинаковая фраза «внедрить amoCRM» у разных компаний означает разный объем работ. Где-то достаточно настроить одну воронку и телефонию, а где-то нужно пересобрать процесс продаж, интегрировать сайт, мессенджеры, учетную систему и аналитику. Если назвать цену без разбора, это будет не оценка, а предположение.',
            ],
            [
                'question' => 'Сколько длится проект?',
                'answer' => 'Небольшая настройка обычно занимает от 1 до 3 недель. Полноценное внедрение с проектированием, интеграциями, тестированием и обучением команды чаще занимает от 1 до 2 месяцев. Если проект большой, мы делим его на этапы, чтобы бизнес быстрее получил рабочий результат.',
            ],
            [
                'question' => 'Можно ли начать без аудита?',
                'answer' => 'Можно, если задача простая и хорошо описана: например, подключить конкретный канал заявок или настроить понятную автоматизацию. Но для внедрения с нуля, перевнедрения или исправления хаоса в действующей CRM аудит помогает не потратить бюджет на настройки, которые потом придется переделывать.',
            ],
            [
                'question' => 'Вы работаете по часам или фиксированной цене?',
                'answer' => 'Для понятного объема работ мы обычно фиксируем стоимость этапа. Если задача исследовательская, связана с доработками, поддержкой или меняющимися вводными, можем работать по часам или через согласованный лимит. Формат выбираем так, чтобы клиент видел бюджет и границы работ заранее.',
            ],
            [
                'question' => 'Что нужно от клиента?',
                'answer' => 'Нужны доступы к amoCRM и связанным сервисам, контакт ответственного за проект, описание текущего процесса продаж и быстрые ответы по спорным вопросам. Еще важно участие руководителя или человека, который принимает решения по логике продаж, иначе CRM получится технически настроенной, но не управленческой.',
            ],
            [
                'question' => 'Что если в процессе появятся новые задачи?',
                'answer' => 'Мы фиксируем их отдельно: оцениваем влияние на сроки и бюджет, после чего согласуем, добавлять задачу в текущий этап или вынести в следующий. Так проект не расползается незаметно, а клиент понимает, за что платит и что получает на каждом шаге.',
            ],
        ];
    @endphp

    <style>
        .client-faq-page {
            font-family: 'Manrope', system-ui, sans-serif;
        }

        .client-faq-hero {
            position: relative;
            overflow: hidden;
            padding: 32px 0 72px;
        }

        .client-faq-hero::after {
            content: '';
            position: absolute;
            top: -60px;
            right: -120px;
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, rgba(255, 138, 42, 0.09), transparent 70%);
            pointer-events: none;
        }

        .client-faq-bc {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 6px;
            color: rgba(15, 23, 42, 0.35);
            font-size: 13px;
        }

        .client-faq-bc a {
            color: rgba(15, 23, 42, 0.35);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .client-faq-bc a:hover {
            color: #f97316;
        }

        .client-faq-bc span {
            color: rgba(15, 23, 42, 0.2);
        }

        .client-faq-hero-grid {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(300px, 0.48fr);
            gap: 56px;
            align-items: center;
            min-height: 430px;
            margin-top: 28px;
        }

        .client-faq-title {
            margin: 0;
            max-width: 820px;
            color: #111;
            font-size: clamp(44px, 5.3vw, 72px);
            font-weight: 900;
            line-height: 0.96;
            letter-spacing: -0.04em;
        }

        .client-faq-title span {
            color: #ff6a00;
        }

        .client-faq-lead {
            margin: 22px 0 0;
            max-width: 620px;
            color: rgba(15, 23, 42, 0.48);
            font-size: 17px;
            line-height: 1.7;
        }

        .client-faq-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 30px;
        }

        .client-faq-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #f97316;
            padding: 15px 28px;
            color: #fff;
            font-size: 15px;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.25s ease, transform 0.25s ease;
        }

        .client-faq-btn:hover {
            background: #ea6c0e;
            transform: translateY(-1px);
        }

        .client-faq-hero-panel {
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 28px;
            background: linear-gradient(180deg, #fff 0%, #fefefe 100%);
            padding: 28px;
            box-shadow: 0 24px 56px rgba(15, 23, 42, 0.08), 0 4px 14px rgba(15, 23, 42, 0.04);
        }

        .client-faq-hero-panel::before {
            content: '';
            position: absolute;
            top: -120px;
            right: -120px;
            width: 280px;
            height: 280px;
            background: radial-gradient(circle, rgba(249, 115, 22, 0.16) 0%, rgba(249, 115, 22, 0) 72%);
            pointer-events: none;
        }

        .client-faq-panel-label {
            position: relative;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: 1px solid rgba(249, 115, 22, 0.22);
            border-radius: 999px;
            background: rgba(249, 115, 22, 0.12);
            padding: 7px 12px;
            color: #c75c0c;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .client-faq-panel-label::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #f97316;
            box-shadow: 0 0 0 6px rgba(249, 115, 22, 0.16);
        }

        .client-faq-panel-list {
            position: relative;
            display: grid;
            gap: 10px;
            margin-top: 20px;
        }

        .client-faq-panel-row {
            display: grid;
            grid-template-columns: 38px minmax(0, 1fr);
            gap: 12px;
            align-items: center;
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 14px;
            background: #fff;
            padding: 12px;
        }

        .client-faq-panel-num {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 13px;
            background: #fff7ed;
            color: #c75c0c;
            font-size: 12px;
            font-weight: 900;
        }

        .client-faq-panel-row strong {
            display: block;
            color: #111;
            font-size: 14px;
            line-height: 1.25;
        }

        .client-faq-panel-row span:last-child {
            display: block;
            margin-top: 3px;
            color: rgba(15, 23, 42, 0.5);
            font-size: 12px;
            line-height: 1.45;
        }

        .client-faq-layout {
            display: grid;
            grid-template-columns: minmax(260px, 0.72fr) minmax(0, 1.28fr);
            gap: 44px;
            align-items: start;
        }

        .client-faq-aside {
            position: sticky;
            top: 104px;
        }

        .client-faq-note {
            margin-top: 18px;
            border-radius: 18px;
            border: 1px solid rgba(249, 115, 22, 0.16);
            background: rgba(255, 255, 255, 0.78);
            padding: 18px;
            color: rgba(15, 23, 42, 0.64);
            font-size: 14px;
            line-height: 1.65;
        }

        .client-faq-list {
            display: grid;
            gap: 12px;
        }

        .client-faq-item {
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 20px;
            background: #fff;
            box-shadow: 0 14px 34px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .client-faq-question {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 22px 24px;
            border: 0;
            background: transparent;
            color: #101010;
            cursor: pointer;
            font: inherit;
            font-size: 17px;
            font-weight: 800;
            line-height: 1.35;
            text-align: left;
        }

        .client-faq-question:hover {
            color: #f97316;
        }

        .client-faq-icon {
            position: relative;
            width: 32px;
            height: 32px;
            flex: 0 0 auto;
            border-radius: 50%;
            background: rgba(15, 23, 42, 0.05);
            transition: background 0.2s ease;
        }

        .client-faq-icon::before,
        .client-faq-icon::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 13px;
            height: 2px;
            border-radius: 2px;
            background: currentColor;
            transform: translate(-50%, -50%);
            transition: transform 0.2s ease;
        }

        .client-faq-icon::after {
            transform: translate(-50%, -50%) rotate(90deg);
        }

        .client-faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.28s ease;
        }

        .client-faq-answer-inner {
            padding: 0 24px 22px;
            color: rgba(15, 23, 42, 0.64);
            font-size: 15px;
            line-height: 1.75;
        }

        .client-faq-item.is-open .client-faq-question {
            color: #f97316;
        }

        .client-faq-item.is-open .client-faq-icon {
            background: rgba(249, 115, 22, 0.12);
        }

        .client-faq-item.is-open .client-faq-icon::after {
            transform: translate(-50%, -50%) rotate(0deg);
        }

        @media (max-width: 900px) {
            .client-faq-hero {
                padding: 24px 0 52px;
            }

            .client-faq-hero-grid {
                grid-template-columns: 1fr;
                gap: 30px;
                min-height: 0;
            }

            .client-faq-layout {
                grid-template-columns: 1fr;
                gap: 24px;
            }

            .client-faq-aside {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .client-faq-title {
                font-size: 38px;
            }

            .client-faq-lead {
                font-size: 15px;
            }

            .client-faq-hero-panel {
                border-radius: 22px;
                padding: 20px;
            }

            .client-faq-question {
                padding: 18px;
                font-size: 15px;
            }

            .client-faq-answer-inner {
                padding: 0 18px 18px;
                font-size: 14px;
            }
        }
    </style>

    <section class="client-faq-hero client-faq-page">
        <div class="container-wrap">
            <nav class="client-faq-bc" aria-label="breadcrumbs">
                <a href="{{ route('site.home') }}">Главная</a>
                <span>/</span>
                <b>FAQ</b>
            </nav>
            <div class="client-faq-hero-grid">
                <div>
                    <h1 class="client-faq-title">Частые вопросы о <span>внедрении amoCRM</span></h1>
                    <p class="client-faq-lead">Коротко и по делу: как формируется стоимость, почему нужен разбор перед оценкой, сколько длится проект и как мы работаем с новыми задачами.</p>
                    <div class="client-faq-actions">
                        <a class="client-faq-btn" href="#landing-form">Обсудить проект</a>
                    </div>
                </div>
                <aside class="client-faq-hero-panel" aria-label="Что влияет на оценку проекта">
                    <div class="client-faq-panel-label">Оценка проекта</div>
                    <div class="client-faq-panel-list">
                        <div class="client-faq-panel-row">
                            <span class="client-faq-panel-num">01</span>
                            <div><strong>Процесс продаж</strong><span>воронки, роли, этапы и контроль</span></div>
                        </div>
                        <div class="client-faq-panel-row">
                            <span class="client-faq-panel-num">02</span>
                            <div><strong>Интеграции</strong><span>сайт, телефония, мессенджеры, учетные системы</span></div>
                        </div>
                        <div class="client-faq-panel-row">
                            <span class="client-faq-panel-num">03</span>
                            <div><strong>Запуск команды</strong><span>тестирование, обучение и поддержка старта</span></div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>

    <section class="site-section client-faq-page">
        <div class="container-wrap">
            <div class="client-faq-layout">
                <aside class="client-faq-aside">
                    <p class="site-kicker">Перед стартом</p>
                    <h2 class="site-card-title mt-3 text-2xl md:text-3xl">Главное, что стоит обсудить до сметы</h2>
                    <div class="client-faq-note">
                        Хорошая оценка появляется после понимания процесса продаж, текущего состояния CRM и результата, который нужен руководителю.
                    </div>
                </aside>

                <div>
                    <div class="client-faq-list" data-client-faq>
                        @foreach($faqItems as $index => $item)
                            <article class="client-faq-item {{ $index === 0 ? 'is-open' : '' }}">
                                <button class="client-faq-question" type="button" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                                    <span>{{ $item['question'] }}</span>
                                    <span class="client-faq-icon" aria-hidden="true"></span>
                                </button>
                                <div class="client-faq-answer">
                                    <div class="client-faq-answer-inner">{{ $item['answer'] }}</div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    <div class="container-wrap client-faq-page">
        @include('site.partials.landing-form', [
            'landingTitle' => 'FAQ по внедрению amoCRM',
            'formConfig' => [
                'offer_type' => 'Внедрение amoCRM',
                'title' => 'Обсудим задачу и подскажем следующий шаг',
                'text' => 'Опишите, что нужно сделать с amoCRM: внедрить с нуля, пересобрать текущую систему, настроить интеграции или оценить проект. Вернемся с уточняющими вопросами и понятным форматом старта.',
                'button' => 'Отправить задачу',
            ],
        ])
    </div>

    <script>
        (function () {
            var root = document.querySelector('[data-client-faq]');
            if (!root) return;

            function setAnswer(item, open) {
                var answer = item.querySelector('.client-faq-answer');
                var button = item.querySelector('.client-faq-question');
                item.classList.toggle('is-open', open);
                if (button) button.setAttribute('aria-expanded', open ? 'true' : 'false');
                if (answer) answer.style.maxHeight = open ? answer.scrollHeight + 'px' : '0px';
            }

            root.querySelectorAll('.client-faq-item').forEach(function (item) {
                setAnswer(item, item.classList.contains('is-open'));
            });

            root.addEventListener('click', function (event) {
                var button = event.target.closest('.client-faq-question');
                if (!button) return;

                var item = button.closest('.client-faq-item');
                var shouldOpen = !item.classList.contains('is-open');
                root.querySelectorAll('.client-faq-item').forEach(function (current) {
                    setAnswer(current, current === item ? shouldOpen : false);
                });
            });
        })();
    </script>
@endsection
