<nav class="cmdf5-inspired-nav">
    <div class="cmd-nav-inner">
        <a class="cmd-nav-brand" href="{{ route('site.home') }}" aria-label="{{ $siteSettings->site_name ?? 'CleverCRM' }}">
            <x-site-logo />
        </a>

        <div class="cmd-nav-center">
            <div class="cmd-nav-item has-dropdown">
                <a href="{{ route('site.services.index') }}" class="{{ request()->routeIs('site.services.*') || request()->routeIs('site.landings.*') ? 'is-active' : '' }}">Услуги</a>
                <div class="cmd-dropdown services-dropdown">
                    <div class="cmd-col">
                        <div class="cmd-col-title">Запуск и база</div>
                        <a href="/services/vnedrenie-crm">Внедрение</a>
                        <a href="/services/razrabotka-crm">Разработка</a>
                        <a href="/services/kupit-licenzii">Купить amoCRM с бонусами</a>
                    </div>
                    <div class="cmd-col">
                        <div class="cmd-col-title">Оптимизация и рост</div>
                        <a href="/services/perevnedrenie-crm">Перевнедрение</a>
                        <a href="/services/reanimaciya-amocrm">Реанимация amoCRM</a>
                        <a href="/services/soprovozhdenie-crm">Сопровождение</a>
                    </div>
                    <div class="cmd-col">
                        <div class="cmd-col-title">Контроль и спецзадачи</div>
                        <a href="/services/skvoznaya-analitika">Аналитика</a>
                        <a href="/services/audit-amocrm">Аудит amoCRM</a>
                    </div>
                </div>
            </div>

            <div class="cmd-nav-item">
                <a href="{{ route('site.case-studies.index') }}" class="{{ request()->routeIs('site.case-studies.*') ? 'is-active' : '' }}">Кейсы</a>
            </div>
            <div class="cmd-nav-item">
                <a href="{{ route('site.widgets.index') }}" class="{{ request()->routeIs('site.widgets.*') ? 'is-active' : '' }}">Виджеты</a>
            </div>
            <div class="cmd-nav-item">
                <a href="{{ route('site.articles.index') }}" class="{{ request()->routeIs('site.articles.*') ? 'is-active' : '' }}">Статьи</a>
            </div>
        </div>

        <div class="cmd-nav-socials">
            <a href="{{ $siteSettings->telegram_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="Telegram" title="Telegram">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21.2 4.4 2.4 10.8c-.6.2-.6.6 0 .8l4.8 1.8 1.8 5.8c.1.4.5.5.8.2l2.6-2.2 4.8 3.6c.4.3 1 .1 1.1-.4L22 5.2c.1-.6-.4-1-.8-.8Z"/>
                    <path d="m9 13.6 8.4-6.4"/>
                </svg>
            </a>
            <a href="{{ $siteSettings->max_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="Max" title="Max">
                <svg viewBox="0 0 720 720" fill="currentColor">
                    <path d="M350.4,9.6C141.8,20.5,4.1,184.1,12.8,390.4c3.8,90.3,40.1,168,48.7,253.7,2.2,22.2-4.2,49.6,21.4,59.3,31.5,11.9,79.8-8.1,106.2-26.4,9-6.1,17.6-13.2,24.2-22,27.3,18.1,53.2,35.6,85.7,43.4,143.1,34.3,299.9-44.2,369.6-170.3C799.6,291.2,622.5-4.6,350.4,9.6h0ZM269.4,504c-11.3,8.8-22.2,20.8-34.7,27.7-18.1,9.7-23.7-.4-30.5-16.4-21.4-50.9-24-137.6-11.5-190.9,16.8-72.5,72.9-136.3,150-143.1,78-6.9,150.4,32.7,183.1,104.2,72.4,159.1-112.9,316.2-256.4,218.6h0Z"/>
                </svg>
            </a>
        </div>

        <input type="checkbox" id="nav-toggle" class="cmd-nav-check" aria-hidden="true">
        <label for="nav-toggle" class="cmd-burger" aria-label="Меню">
            <span></span><span></span><span></span>
        </label>

        <div class="cmd-mob-panel">
            <div class="cmd-mob-cat">Услуги</div>
            <a href="/services/vnedrenie-crm" class="cmd-mob-sub">Внедрение</a>
            <a href="/services/perevnedrenie-crm" class="cmd-mob-sub">Перевнедрение</a>
            <a href="/services/razrabotka-crm" class="cmd-mob-sub">Разработка</a>
            <a href="/services/skvoznaya-analitika" class="cmd-mob-sub">Аналитика</a>
            <a href="/services/reanimaciya-amocrm" class="cmd-mob-sub">Реанимация amoCRM</a>
            <a href="/services/audit-amocrm" class="cmd-mob-sub">Аудит amoCRM</a>
            <div class="cmd-mob-divider"></div>
            <a href="{{ route('site.case-studies.index') }}" class="cmd-mob-link">Кейсы</a>
            <a href="{{ route('site.widgets.index') }}" class="cmd-mob-link">Виджеты</a>
            <a href="{{ route('site.articles.index') }}" class="cmd-mob-link">Статьи</a>
            <div class="cmd-mob-bottom">
                <div class="cmd-nav-socials">
                    <a href="{{ $siteSettings->telegram_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="Telegram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.2 4.4 2.4 10.8c-.6.2-.6.6 0 .8l4.8 1.8 1.8 5.8c.1.4.5.5.8.2l2.6-2.2 4.8 3.6c.4.3 1 .1 1.1-.4L22 5.2c.1-.6-.4-1-.8-.8Z"/>
                            <path d="m9 13.6 8.4-6.4"/>
                        </svg>
                    </a>
                    <a href="{{ $siteSettings->max_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="Max">
                        <svg viewBox="0 0 720 720" fill="currentColor">
                            <path d="M350.4,9.6C141.8,20.5,4.1,184.1,12.8,390.4c3.8,90.3,40.1,168,48.7,253.7,2.2,22.2-4.2,49.6,21.4,59.3,31.5,11.9,79.8-8.1,106.2-26.4,9-6.1,17.6-13.2,24.2-22,27.3,18.1,53.2,35.6,85.7,43.4,143.1,34.3,299.9-44.2,369.6-170.3C799.6,291.2,622.5-4.6,350.4,9.6h0ZM269.4,504c-11.3,8.8-22.2,20.8-34.7,27.7-18.1,9.7-23.7-.4-30.5-16.4-21.4-50.9-24-137.6-11.5-190.9,16.8-72.5,72.9-136.3,150-143.1,78-6.9,150.4,32.7,183.1,104.2,72.4,159.1-112.9,316.2-256.4,218.6h0Z"/>
                        </svg>
                    </a>
                </div>
                <a href="#home-form" class="cmd-mob-cta" data-lead-open data-lead-offer="Обсудить проект">Обсудить проект</a>
            </div>
        </div>
    </div>
</nav>
<div class="nav-spacer"></div>
