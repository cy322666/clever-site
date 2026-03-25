@extends('site.layouts.app', [
    'title' => $service?->seo_title ?: 'Разработка для amoCRM',
    'metaDescription' => $service?->seo_description ?: 'Разработка и доработка решений для amoCRM: виджеты, интеграции, автоматизация и нестандартная бизнес-логика.',
])

@section('content')
    <section class="site-page-hero service-offer-hero">
        <div class="container-wrap">
            <div class="service-offer-hero-grid">
                <div class="site-page-hero-box">
                    <p class="site-kicker">Услуга CRM Architect</p>
                    <h1 class="site-title">Разработка для amoCRM под задачи бизнеса</h1>
                    <p class="site-subtitle">
                        Создаем и дорабатываем решения, когда стандартных настроек уже недостаточно:
                        кастомная логика, интеграции, сценарии автоматизации и удобные интерфейсы для команды.
                    </p>

                    <ul class="service-offer-bullets">
                        <li>Кастомные доработки под процесс продаж</li>
                        <li>Интеграции с внешними сервисами и API</li>
                        <li>Разработка виджетов и автоматизаций</li>
                        <li>Стабильная работа и поддержка после запуска</li>
                    </ul>

                    <div class="service-offer-actions">
                        <x-button variant="secondary" :href="route('site.contacts')">Обсудить разработку</x-button>
                    </div>
                </div>

                <aside class="site-card service-offer-visual">
                    <p class="service-offer-visual-title">Что получаете на выходе</p>
                    <ul class="service-offer-visual-list">
                        <li>Логику, адаптированную под ваш процесс</li>
                        <li>Снижение ручной работы в CRM</li>
                        <li>Точные интеграции без «костылей»</li>
                        <li>Контроль и прогнозируемость изменений</li>
                    </ul>
                    <p class="service-offer-visual-note">
                        Разработка идет от бизнес-задач, а не от набора технических функций.
                    </p>
                </aside>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <div class="service-section-head">
                <h2 class="site-title service-section-title">Что входит в разработку</h2>
                <p class="service-section-subtitle">
                    Закрываем полный цикл: от постановки задачи до запуска и сопровождения.
                </p>
            </div>

            @php
                $developmentScope = [
                    [
                        'title' => 'Анализ задачи',
                        'text' => 'Фиксируем бизнес-цель, ограничения и ожидаемый результат.',
                    ],
                    [
                        'title' => 'Проектирование решения',
                        'text' => 'Определяем архитектуру, точки интеграции и пользовательский сценарий.',
                    ],
                    [
                        'title' => 'Разработка',
                        'text' => 'Реализуем логику, виджеты, обработчики и нужные интерфейсные элементы.',
                    ],
                    [
                        'title' => 'Интеграции',
                        'text' => 'Подключаем телефонию, сайт, мессенджеры, платежки и внутренние сервисы.',
                    ],
                    [
                        'title' => 'Тестирование',
                        'text' => 'Проверяем корректность сценариев на реальных кейсах команды.',
                    ],
                    [
                        'title' => 'Запуск и поддержка',
                        'text' => 'Внедряем в работу и сопровождаем после релиза.',
                    ],
                ];
            @endphp

            <div class="service-cards-grid service-cards-grid--3">
                @foreach($developmentScope as $index => $item)
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
                <h2 class="site-title service-section-title">Когда нужна именно разработка</h2>
            </div>

            @php
                $whenNeedDev = [
                    [
                        'title' => 'Не хватает стандартных функций',
                        'text' => 'Текущие возможности amoCRM не покрывают реальные процессы команды.',
                    ],
                    [
                        'title' => 'Нужны сложные интеграции',
                        'text' => 'Требуется обмен данными с внешними системами по вашей логике.',
                    ],
                    [
                        'title' => 'Много ручных действий',
                        'text' => 'Менеджеры тратят время на рутину, которую можно автоматизировать.',
                    ],
                    [
                        'title' => 'Нужен контроль качества данных',
                        'text' => 'Важно, чтобы CRM собирала корректные данные для аналитики и управления.',
                    ],
                ];
            @endphp

            <div class="service-cards-grid service-cards-grid--4">
                @foreach($whenNeedDev as $item)
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
                <h2 class="site-title service-section-title">Примеры проектов</h2>
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
                            Откройте общий раздел кейсов и посмотрите доступные материалы.
                        </p>
                        <a href="{{ route('site.case-studies.index') }}" class="site-link">Открыть кейсы</a>
                    </article>
                @endforelse
            </div>
        </div>
    </section>

    <section class="site-section service-cta">
        <div class="container-wrap">
            <div class="site-page-hero-box service-cta-box">
                <h2 class="site-title service-section-title">Обсудим задачу по разработке</h2>
                <p class="service-section-subtitle">
                    Расскажите, что именно нужно доработать в amoCRM, и мы предложим понятный план реализации.
                </p>
                <div class="service-offer-actions">
                    <x-button variant="secondary" :href="route('site.contacts')">Получить разбор проекта</x-button>
                    <x-button variant="secondary" :href="$siteSettings->telegram_link ?: '#'" target="_blank" rel="noreferrer">Написать в Telegram</x-button>
                </div>
            </div>
        </div>
    </section>
@endsection
