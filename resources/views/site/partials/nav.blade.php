<nav class="cmdf5-inspired-nav">
    <div class="cmd-nav-inner">
        <a class="cmd-nav-brand crm-brand" href="{{ route('site.home') }}" aria-label="{{ $siteSettings->site_name ?? 'CleverCRM' }}">
            <x-site-logo />
        </a>

        <div class="cmd-nav-center">
            <div class="cmd-nav-item has-dropdown">
                <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}" class="{{ request()->routeIs('site.landings.*') ? 'is-active' : '' }}">Услуги</a>
                <div class="cmd-dropdown services-dropdown">
                    <div class="cmd-col">
                        <div class="cmd-col-title">Запуск и база</div>
                        <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}">Внедрение</a>
                        <a href="{{ route('site.landings.show', 'razrabotka-crm') }}">Разработка</a>
                        <a href="{{ route('site.landings.show', 'skolko-stoit-amocrm') }}">Купить amoCRM с бонусами</a>
                    </div>
                    <div class="cmd-col">
                        <div class="cmd-col-title">Оптимизация и рост</div>
                        <a href="{{ route('site.landings.show', 'perevnedrenie-amocrm') }}">Перевнедрение</a>
                        <a href="{{ route('site.landings.show', 'reanimaciya-amocrm') }}">Реанимация amoCRM</a>
                        <a href="{{ route('site.landings.show', 'soprovozhdenie-amocrm') }}">Сопровождение</a>
                    </div>
                    <div class="cmd-col">
                        <div class="cmd-col-title">Контроль и спецзадачи</div>
                        <a href="{{ route('site.landings.show', 'analitika-prodazh-v-amocrm') }}">Аналитика</a>
                        <a href="{{ route('site.landings.show', 'audit-amocrm') }}">Аудит amoCRM</a>
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
            <a href="{{ $siteSettings->max_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="Max" title="Max">MX</a>
        </div>
    </div>
</nav>
