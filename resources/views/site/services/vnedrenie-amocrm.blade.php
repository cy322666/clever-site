@extends('site.layouts.app', [
    'title' => $service?->seo_title ?: 'Внедрение amoCRM',
    'metaDescription' => $service?->seo_description ?: 'Внедрение amoCRM под реальные процессы продаж: воронки, автоматизация, интеграции и контроль для руководителя.',
])

@section('content')
    <section class="site-page-hero service-offer-hero">
        <div class="container-wrap">
            <div class="service-offer-hero-grid">
                <div class="site-page-hero-box">
                    <p class="site-kicker">Услуга CRM Architect</p>
                    <h1 class="site-title">Внедрение amoCRM под реальные процессы продаж</h1>
                    <p class="site-subtitle">
                        Собираем CRM не как набор полей и этапов, а как рабочую систему под вашу модель продаж, роли в команде,
                        управленческие задачи и точки контроля.
                    </p>

                    <ul class="service-offer-bullets">
                        <li>Воронки под реальный процесс продаж</li>
                        <li>Автоматизация ключевых этапов</li>
                        <li>Интеграции с нужными сервисами</li>
                        <li>Контроль для руководителя без ручного хаоса</li>
                    </ul>

                    <div class="service-offer-actions">
                        <x-button variant="secondary" :href="route('site.contacts')">Получить разбор проекта</x-button>
                    </div>
                </div>

                <aside class="site-card service-offer-visual">
                    <p class="service-offer-visual-title">Что получает команда после внедрения</p>
                    <ul class="service-offer-visual-list">
                        <li>Понятная логика движения сделки по этапам</li>
                        <li>Фиксация входящих и задач в единой системе</li>
                        <li>Автоматизация рутинных действий менеджеров</li>
                        <li>Прозрачные точки контроля для руководителя</li>
                    </ul>
                    <p class="service-offer-visual-note">
                        На старте закладываем архитектуру, которую не придется переделывать через несколько месяцев.
                    </p>
                </aside>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <div class="service-section-head">
                <h2 class="site-title service-section-title">Что входит во внедрение</h2>
                <p class="service-section-subtitle">
                    Собираем CRM как рабочую систему продаж: от логики воронок до автоматизации, интеграций и запуска команды.
                </p>
            </div>

            @php
                $implementationScope = [
                    [
                        'title' => 'Разбор процессов',
                        'text' => 'Изучаем текущую логику продаж, роли в команде и точки потерь.',
                    ],
                    [
                        'title' => 'Проектирование воронок',
                        'text' => 'Собираем этапы и логику CRM под реальный процесс работы.',
                    ],
                    [
                        'title' => 'Поля и карточки',
                        'text' => 'Настраиваем структуру CRM под задачи менеджеров и руководителя.',
                    ],
                    [
                        'title' => 'Автоматизация',
                        'text' => 'Убираем ручную рутину через задачи, уведомления и сценарии.',
                    ],
                    [
                        'title' => 'Интеграции',
                        'text' => 'Связываем CRM с сайтом, телефонией, мессенджерами и другими сервисами.',
                    ],
                    [
                        'title' => 'Запуск команды',
                        'text' => 'Тестируем систему, обучаем сотрудников и доводим до рабочей логики.',
                    ],
                ];
            @endphp

            <div class="service-cards-grid service-cards-grid--3">
                @foreach($implementationScope as $index => $item)
                    <article class="site-card service-clean-card service-scope-card">
                        <div class="service-scope-head">
                            <span class="service-scope-icon">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <p class="service-clean-card-title">{{ $item['title'] }}</p>
                        </div>
                        <p class="service-clean-card-text">{{ $item['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <div class="service-section-head">
                <h2 class="site-title service-section-title">Когда нужно внедрение, а не просто настройка CRM</h2>
            </div>

            @php
                $whenNeedItems = [
                    [
                        'title' => 'CRM еще нет',
                        'text' => 'Нужно сразу собрать систему под реальные процессы продаж, а не переделывать ее через полгода.',
                    ],
                    [
                        'title' => 'Продажи уже идут, но без системы',
                        'text' => 'Заявки, задачи и договоренности держатся на людях, а не на понятной логике работы.',
                    ],
                    [
                        'title' => 'Нужен порядок и контроль',
                        'text' => 'Руководителю важно видеть, что происходит по входящим, сделкам, менеджерам и этапам.',
                    ],
                    [
                        'title' => 'Нужна база для роста',
                        'text' => 'CRM должна выдерживать увеличение заявок, команды, каналов и автоматизаций.',
                    ],
                ];
            @endphp

            <div class="service-cards-grid service-cards-grid--4">
                @foreach($whenNeedItems as $item)
                    <article class="site-card service-clean-card">
                        <p class="service-clean-card-title">{{ $item['title'] }}</p>
                        <p class="service-clean-card-text">{{ $item['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <div class="service-section-head">
                <h2 class="site-title service-section-title">Как строится работа по проекту</h2>
            </div>

            @php
                $steps = [
                    [
                        'title' => 'Погружение',
                        'text' => 'Разбираем процессы, роли, точки потерь и текущую логику работы с клиентом.',
                    ],
                    [
                        'title' => 'Архитектура',
                        'text' => 'Собираем структуру CRM под реальный процесс продаж и требования руководителя.',
                    ],
                    [
                        'title' => 'Настройка и интеграции',
                        'text' => 'Внедряем воронки, поля, автоматизацию, связи с сервисами и ключевые сценарии.',
                    ],
                    [
                        'title' => 'Запуск и адаптация',
                        'text' => 'Проверяем логику на практике, обучаем команду и доводим систему до рабочего состояния.',
                    ],
                ];
            @endphp

            <div class="service-cards-grid service-cards-grid--4">
                @foreach($steps as $index => $step)
                    <article class="site-card service-step-card">
                        <span class="service-step-number">{{ $index + 1 }}</span>
                        <p class="service-clean-card-title">{{ $step['title'] }}</p>
                        <p class="service-clean-card-text">{{ $step['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <div class="service-section-head">
                <h2 class="site-title service-section-title">Почему не делаем шаблонное внедрение</h2>
            </div>

            @php
                $advantages = [
                    [
                        'title' => 'Под бизнес, а не по шаблону',
                        'text' => 'Собираем CRM под реальные процессы, а не под типовой набор этапов.',
                    ],
                    [
                        'title' => 'С учетом роста',
                        'text' => 'Система должна работать не только сейчас, но и выдерживать развитие компании.',
                    ],
                    [
                        'title' => 'С нормальной логикой для команды',
                        'text' => 'Менеджерам должно быть удобно работать, а не обходить CRM стороной.',
                    ],
                    [
                        'title' => 'С контролем для руководителя',
                        'text' => 'В CRM должны быть видны не только сделки, но и точки потерь, нагрузка и динамика.',
                    ],
                ];
            @endphp

            <div class="service-cards-grid service-cards-grid--4">
                @foreach($advantages as $item)
                    <article class="site-card service-clean-card">
                        <p class="service-clean-card-title">{{ $item['title'] }}</p>
                        <p class="service-clean-card-text">{{ $item['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <div class="service-section-head">
                <h2 class="site-title service-section-title">Как это выглядит на реальных проектах</h2>
                <p class="service-section-subtitle">
                    Показываем не абстрактные обещания, а реальные решения: как собираем воронки, автоматизацию,
                    интеграции и контроль под задачи бизнеса.
                </p>
            </div>

            <div class="service-cases-grid">
                @forelse($caseStudies as $caseStudy)
                    <article class="site-card service-clean-card">
                        <p class="site-kicker">Кейс</p>
                        <p class="service-clean-card-title">{{ $caseStudy->title }}</p>
                        <p class="service-clean-card-text">{{ $caseStudy->result_summary ?: $caseStudy->short_description }}</p>
                        <a href="{{ route('site.case-studies.show', $caseStudy->slug) }}" class="site-link">Смотреть кейс</a>
                    </article>
                @empty
                    <article class="site-card service-clean-card">
                        <p class="service-clean-card-title">Кейсы готовятся к публикации</p>
                        <p class="service-clean-card-text">
                            Можно перейти в общий раздел и посмотреть доступные материалы по проектам и автоматизации.
                        </p>
                        <a href="{{ route('site.case-studies.index') }}" class="site-link">Открыть раздел кейсов</a>
                    </article>
                @endforelse
            </div>
        </div>
    </section>

    <section class="site-section service-cta">
        <div class="container-wrap">
            <div class="site-page-hero-box service-cta-box">
                <h2 class="site-title service-section-title">Обсудим внедрение под ваш процесс продаж</h2>
                <p class="service-section-subtitle">
                    Если нужна не просто настройка amoCRM, а рабочая система под ваш бизнес, разберем текущую ситуацию и
                    предложим понятную логику внедрения.
                </p>
                <div class="service-offer-actions">
                    <x-button variant="secondary" :href="route('site.contacts')">Получить разбор проекта</x-button>
                    <x-button variant="secondary" :href="$siteSettings->telegram_link ?: '#'" target="_blank" rel="noreferrer">Написать в Telegram</x-button>
                </div>
            </div>
        </div>
    </section>
@endsection
