<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? ($siteSettings->site_name ?? 'CRM Integrator') }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Маркетинговый сайт CRM-интегратора' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {!! $globalJsPlugins['head'] ?? '' !!}
</head>
<body class="min-h-screen">
    <nav class="cmdf5-inspired-nav">
        <div class="cmd-nav-inner">
            <a class="cmd-nav-brand" href="{{ route('site.home') }}" aria-label="{{ $siteSettings->site_name ?? 'CleverCRM' }}">
                <x-site-logo />
            </a>

            <div class="cmd-nav-center">
                <div class="cmd-nav-item has-dropdown">
                    <a href="{{ route('site.services.index') }}" class="{{ request()->routeIs('site.services.*') ? 'is-active' : '' }}">Услуги</a>
                    <div class="cmd-dropdown services-dropdown">
                        <div class="cmd-col">
                            <div class="cmd-col-title">Запуск и база</div>
                            <a href="/services/vnedrenie-crm">Внедрение</a>
                            <a href="/services/razrabotka-crm">Разработка</a>
                        </div>
                        <div class="cmd-col">
                            <div class="cmd-col-title">Оптимизация и рост</div>
                            <a href="/services/reanimaciya-amocrm">Реанимация amoCRM</a>
                        </div>
                        <div class="cmd-col">
                            <div class="cmd-col-title">Контроль и спецзадачи</div>
                            <a href="{{ route('site.services.index') }}">Аудит amoCRM</a>
                            <a href="{{ route('site.services.index') }}">Аналитика</a>
                        </div>
                    </div>
                </div>

                <div class="cmd-nav-item">
                    <a href="{{ route('site.case-studies.index') }}" class="{{ request()->routeIs('site.case-studies.*') ? 'is-active' : '' }}">Кейсы</a>
                </div>
                <div class="cmd-nav-item">
                    <a href="{{ route('site.articles.index') }}" class="{{ request()->routeIs('site.articles.*') ? 'is-active' : '' }}">Статьи</a>
                </div>
            </div>

            <div class="cmd-nav-socials">
                <a href="{{ $siteSettings->telegram_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="Telegram" title="Telegram">TG</a>
                <a href="{{ $siteSettings->max_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="Max" title="Max">MX</a>
            </div>
        </div>
    </nav>

    <main class="site-main">
        @yield('content')
    </main>

    <x-site-footer />
    @include('site.partials.lead-popup')

    {!! $globalJsPlugins['body_end'] ?? '' !!}
</body>
</html>
