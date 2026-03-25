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
                    <div class="cmd-dropdown small">
                        <div class="cmd-col">
                            <a href="/services/vnedrenie-crm">Внедрение</a>
                            <a href="/services/perevnedrenie-crm">Перевнедрение</a>
                            <a href="/services/soprovozhdenie-crm">Сопровождение</a>
                            <a href="/services/skvoznaya-analitika">Аналитика</a>
                            <a href="/services/razrabotka-crm">Разработка</a>
                            <a href="/services/reanimaciya-amocrm">Реанимация amoCRM</a>
                            <a href="/services/audit-amocrm">Аудит amoCRM</a>
                            <a href="/services/kupit-licenzii">Купить amoCRM с бонусами</a>
                        </div>
                    </div>
                </div>

                <div class="cmd-nav-item has-dropdown">
                    <a href="{{ route('site.widgets.index') }}" class="{{ request()->routeIs('site.widgets.*') ? 'is-active' : '' }}">Виджеты</a>
                    <div class="cmd-dropdown small">
                        <div class="cmd-col">
                            <a href="{{ route('site.widgets.index') }}">Все виджеты</a>
                        </div>
                    </div>
                </div>

                <div class="cmd-nav-item">
                    <a href="{{ route('site.case-studies.index') }}" class="{{ request()->routeIs('site.case-studies.*') ? 'is-active' : '' }}">Кейсы</a>
                </div>
                <div class="cmd-nav-item">
                    <a href="{{ route('site.articles.index') }}" class="{{ request()->routeIs('site.articles.*') ? 'is-active' : '' }}">Статьи</a>
                </div>
                <div class="cmd-nav-item">
                    <a href="{{ route('site.contacts') }}" class="{{ request()->routeIs('site.contacts') ? 'is-active' : '' }}">Контакты</a>
                </div>
            </div>

            <div class="cmd-nav-socials">
                <a href="{{ $siteSettings->telegram_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="Telegram" title="Telegram">TG</a>
                <a href="{{ $siteSettings->vk_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="VK" title="VK">VK</a>
                <a href="{{ $siteSettings->youtube_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="YouTube" title="YouTube">YT</a>
                <a href="{{ $siteSettings->max_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="Max" title="Max">MX</a>
            </div>
        </div>
    </nav>

    <main class="site-main">
        @yield('content')
    </main>

    <x-site-footer />

    {!! $globalJsPlugins['body_end'] ?? '' !!}
</body>
</html>
