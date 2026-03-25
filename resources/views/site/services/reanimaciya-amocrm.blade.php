@extends('site.layouts.app', [
    'title' => $service?->seo_title ?: 'Реанимация amoCRM',
    'metaDescription' => $service?->seo_description ?: 'Реанимация amoCRM: восстанавливаем логику, порядок в сделках, автоматизацию и контроль для руководителя.',
])

@section('content')
    <section class="site-page-hero service-offer-hero">
        <div class="container-wrap">
            <div class="service-offer-hero-grid">
                <div class="site-page-hero-box">
                    <p class="site-kicker">Услуга CRM Architect</p>
                    <h1 class="site-title">Реанимация amoCRM после неудачного внедрения</h1>
                    <p class="site-subtitle">
                        Пересобираем CRM, когда система есть, но не помогает продажам:
                        возвращаем рабочую логику, убираем хаос и делаем CRM удобной для команды.
                    </p>

                    <ul class="service-offer-bullets">
                        <li>Диагностика текущих проблем и точек потерь</li>
                        <li>Пересборка воронок, полей и этапов</li>
                        <li>Восстановление автоматизаций и интеграций</li>
                        <li>Понятный контроль для руководителя</li>
                    </ul>

                    <div class="service-offer-actions">
                        <x-button variant="secondary" :href="route('site.contacts')">Получить разбор CRM</x-button>
                    </div>
                </div>

                <aside class="site-card service-offer-visual">
                    <p class="service-offer-visual-title">Что меняется после реанимации</p>
                    <ul class="service-offer-visual-list">
                        <li>Сделки перестают «зависать» между этапами</li>
                        <li>Менеджеры работают в CRM, а не в чатах и таблицах</li>
                        <li>Автоматизация снова экономит время команды</li>
                        <li>Руководитель видит реальную картину по продажам</li>
                    </ul>
                    <p class="service-offer-visual-note">
                        Сначала лечим критичные узкие места, затем усиливаем систему под рост.
                    </p>
                </aside>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap">
            <div class="service-section-head">
                <h2 class="site-title service-section-title">Что входит в реанимацию</h2>
                <p class="service-section-subtitle">
                    Пошагово приводим CRM в рабочее состояние без полной переделки «с нуля», если это не нужно.
                </p>
            </div>

            @php
                $recoveryScope = [
                    [
                        'title' => 'Экспресс-аудит',
                        'text' => 'Проверяем воронки, поля, задачи, автоматизации и дисциплину ведения сделок.',
                    ],
                    [
                        'title' => 'Карта проблем',
                        'text' => 'Фиксируем, где теряются лиды, тормозятся этапы и ломается логика процесса.',
                    ],
                    [
                        'title' => 'Пересборка структуры',
                        'text' => 'Обновляем этапы, карточки и правила работы под реальный процесс продаж.',
                    ],
                    [
                        'title' => 'Автоматизации',
                        'text' => 'Восстанавливаем или перенастраиваем сценарии, уведомления и задачи.',
                    ],
                    [
                        'title' => 'Интеграции',
                        'text' => 'Чиним связи с сайтом, телефонией, мессенджерами и внешними сервисами.',
                    ],
                    [
                        'title' => 'Финальный запуск',
                        'text' => 'Проверяем на реальных кейсах и даем команде понятный регламент работы.',
                    ],
                ];
            @endphp

            <div class="service-cards-grid service-cards-grid--3">
                @foreach($recoveryScope as $index => $item)
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
                <h2 class="site-title service-section-title">Когда нужна реанимация, а не обычное сопровождение</h2>
            </div>

            @php
                $whenNeedRecovery = [
                    [
                        'title' => 'CRM есть, но команда ее обходит',
                        'text' => 'Менеджерам неудобно работать, данные теряются, этапы не отражают реальность.',
                    ],
                    [
                        'title' => 'Сделки застревают и теряются',
                        'text' => 'Нет прозрачной логики движения клиента и причин потерь на этапах.',
                    ],
                    [
                        'title' => 'Автоматизация сломана',
                        'text' => 'Триггеры не работают, задачи дублируются или не ставятся вовсе.',
                    ],
                    [
                        'title' => 'Руководитель не видит контроль',
                        'text' => 'По CRM нельзя быстро понять нагрузку, качество работы и реальные цифры.',
                    ],
                ];
            @endphp

            <div class="service-cards-grid service-cards-grid--4">
                @foreach($whenNeedRecovery as $item)
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
                <h2 class="site-title service-section-title">Реальные проекты</h2>
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
                            Можно перейти в общий раздел и посмотреть доступные материалы по проектам.
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
                <h2 class="site-title service-section-title">Обсудим, как восстановить вашу amoCRM</h2>
                <p class="service-section-subtitle">
                    Разберем текущую систему, покажем узкие места и предложим понятный план реанимации под ваш процесс продаж.
                </p>
                <div class="service-offer-actions">
                    <x-button variant="secondary" :href="route('site.contacts')">Получить разбор проекта</x-button>
                    <x-button variant="secondary" :href="$siteSettings->telegram_link ?: '#'" target="_blank" rel="noreferrer">Написать в Telegram</x-button>
                </div>
            </div>
        </div>
    </section>
@endsection
