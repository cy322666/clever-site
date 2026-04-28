<style id="top-nav-home-shared">
    .cmdf5-inspired-nav {
        position: sticky;
        top: 0;
        z-index: 9998;
        background: #000 !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        backdrop-filter: none !important;
    }

    .cmd-nav-inner {
        max-width: 1240px;
        margin: 0 auto;
        padding: 14px 22px;
        display: grid;
        grid-template-columns: auto 1fr auto;
        align-items: center;
        gap: 20px;
    }

    .cmd-nav-center {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 24px;
    }

    .cmd-nav-item {
        position: relative;
    }

    .cmd-nav-item > a {
        color: #fff !important;
        text-decoration: none;
        font-size: 16px !important;
        line-height: 1.2 !important;
        opacity: .92;
    }

    .cmd-nav-item > a.is-active,
    .cmd-nav-item > a:hover {
        color: #ff9b3d !important;
        opacity: 1;
    }

    .cmd-dropdown {
        position: absolute;
        left: 0;
        top: calc(100% + 14px);
        min-width: 760px;
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
        padding: 14px;
        border-radius: 18px;
        background: #111;
        border: 1px solid rgba(255, 255, 255, 0.08);
        box-shadow: 0 18px 44px rgba(0, 0, 0, 0.28);
        opacity: 0;
        visibility: hidden;
        transform: translateY(6px);
        transition: .2s ease;
        z-index: 20;
    }

    .cmd-nav-item:hover .cmd-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .cmd-solution-link {
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 10px 12px;
        border-radius: 12px;
        border: 1px solid transparent;
        background: rgba(255, 255, 255, 0.01);
        text-decoration: none;
        transition: border-color .2s, background .2s;
    }

    .cmd-dropdown a.cmd-solution-link:hover {
        color: inherit !important;
        border-color: rgba(249, 115, 22, 0.28);
        background: rgba(249, 115, 22, 0.08);
    }

    .cmd-solution-title {
        color: rgba(255, 255, 255, 0.92);
        font-size: 15px;
        line-height: 1.35;
        font-weight: 600;
    }

    .cmd-solution-desc {
        color: rgba(255, 255, 255, 0.58);
        font-size: 13px;
        line-height: 1.45;
    }

    .cmd-nav-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 12px;
    }

    .cmd-nav-socials {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: flex-end;
    }

    .cmd-nav-socials a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: #fff !important;
        border: none;
        background: rgba(255, 255, 255, 0.10);
        transition: all .2s ease;
    }

    .cmd-nav-socials a svg {
        width: 18px;
        height: 18px;
    }

    .cmd-nav-socials a:hover {
        color: #f97316 !important;
        background: rgba(249, 115, 22, 0.12);
    }

    .cmd-nav-cta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 40px;
        padding: 0 16px;
        border-radius: 11px;
        border: 1px solid rgba(255, 255, 255, 0.14);
        background: rgba(255, 255, 255, 0.08);
        color: #fff !important;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        white-space: nowrap;
        transition: background .2s, border-color .2s, color .2s;
    }

    .cmd-nav-cta:hover {
        background: #f97316;
        border-color: #f97316;
    }

    @media (max-width: 767px) {
        .cmd-nav-inner {
            display: flex !important;
            flex-wrap: nowrap !important;
            flex-direction: row !important;
            align-items: center !important;
            justify-content: space-between !important;
            padding: 10px 20px !important;
            grid-template-columns: none !important;
        }

        .cmd-nav-center,
        .cmd-nav-actions {
            display: none !important;
        }
    }
</style>
<nav class="cmdf5-inspired-nav">
    <div class="cmd-nav-inner">
        <a class="cmd-nav-brand" href="{{ route('site.home') }}" aria-label="{{ $siteSettings->site_name ?? 'CleverCRM' }}">
            <x-site-logo />
        </a>

        <div class="cmd-nav-center">
            <div class="cmd-nav-item has-dropdown">
                <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}" class="{{ request()->routeIs('site.landings.*') ? 'is-active' : '' }}">Решения</a>
                <div class="cmd-dropdown services-dropdown">
                    <a href="{{ route('site.landings.show', 'perevnedrenie-amocrm') }}" class="cmd-solution-link">
                        <span class="cmd-solution-title">Пересборка amoCRM</span>
                        <span class="cmd-solution-desc">Когда CRM уже есть, но в ней бардак, нет контроля и теряются заявки</span>
                    </a>
                    <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}" class="cmd-solution-link">
                        <span class="cmd-solution-title">Внедрение amoCRM с нуля</span>
                        <span class="cmd-solution-desc">Когда нужно сразу собрать правильную систему продаж, а не просто настроить воронку</span>
                    </a>
                    <a href="{{ route('site.landings.show', 'analitika-prodazh-v-amocrm') }}" class="cmd-solution-link">
                        <span class="cmd-solution-title">Аналитика продаж</span>
                        <span class="cmd-solution-desc">Когда руководителю нужны цифры по заявкам, менеджерам, каналам и выручке</span>
                    </a>
                    <a href="{{ route('site.landings.show', 'razrabotka-crm') }}" class="cmd-solution-link">
                        <span class="cmd-solution-title">Разработка и интеграции</span>
                        <span class="cmd-solution-desc">Когда стандартной amoCRM не хватает под вашу логику продаж</span>
                    </a>
                    <a href="{{ route('site.landings.show', 'soprovozhdenie-amocrm') }}" class="cmd-solution-link">
                        <span class="cmd-solution-title">Сопровождение и развитие</span>
                        <span class="cmd-solution-desc">Когда CRM нужно не просто поддерживать, а регулярно улучшать</span>
                    </a>
                </div>
            </div>

            <div class="cmd-nav-item">
                <a href="{{ route('site.case-studies.index') }}" class="{{ request()->routeIs('site.case-studies.*') ? 'is-active' : '' }}">Кейсы</a>
            </div>
            <div class="cmd-nav-item">
                <a href="{{ route('site.home') }}#start-flow-block">Подход</a>
            </div>
            <div class="cmd-nav-item">
                <a href="{{ route('site.about') }}" class="{{ request()->routeIs('site.about') ? 'is-active' : '' }}">О компании</a>
            </div>
            <div class="cmd-nav-item">
                <a href="{{ route('site.articles.index') }}" class="{{ request()->routeIs('site.articles.*') ? 'is-active' : '' }}">Статьи</a>
            </div>
        </div>

        <div class="cmd-nav-actions">
            <div class="cmd-nav-socials">
                <a href="{{ $siteSettings->telegram_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="Telegram" title="Telegram">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21.2 4.4 2.4 10.8c-.6.2-.6.6 0 .8l4.8 1.8 1.8 5.8c.1.4.5.5.8.2l2.6-2.2 4.8 3.6c.4.3 1 .1 1.1-.4L22 5.2c.1-.6-.4-1-.8-.8Z"/>
                        <path d="m9 13.6 8.4-6.4"/>
                    </svg>
                </a>
                <a href="{{ $siteSettings->vk_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="VK" title="VK">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.785 16.146s.382-.042.578-.252c.18-.193.174-.556.174-.556s-.025-1.698.764-1.95c.778-.247 1.777 1.645 2.836 2.373.8.55 1.41.43 1.41.43l2.83-.04s1.48-.09.778-1.247c-.058-.095-.41-.858-2.107-2.425-1.777-1.64-1.538-1.373.602-4.208 1.303-1.726 1.824-2.78 1.66-3.23-.155-.432-1.115-.318-1.115-.318l-3.19.02s-.236-.033-.412.073c-.173.103-.284.345-.284.345s-.51 1.357-1.19 2.512c-1.434 2.436-2.008 2.564-2.242 2.413-.545-.352-.408-1.415-.408-2.17 0-2.36.357-3.342-.697-3.598-.35-.085-.607-.14-1.5-.15-1.148-.013-2.12.004-2.67.274-.367.18-.65.58-.477.603.213.028.696.13.952.48.33.453.32 1.472.32 1.472s.188 2.78-.443 3.123c-.434.236-1.03-.245-2.31-2.448-.654-1.127-1.15-2.373-1.15-2.373s-.095-.233-.266-.358C5.17 5.4 4.9 5.36 4.9 5.36l-3.03.02s-.456.013-.623.21c-.149.177-.012.542-.012.542s2.395 5.606 5.107 8.432c2.486 2.594 5.31 2.424 5.31 2.424h1.134Z"/>
                    </svg>
                </a>
                <a href="https://max.ru/u/f9LHodD0cOIcLV9o9-5lH1-cKD7pPYP3ykso-qm9ZHZsNCBzSNSqi4wB4F8" target="_blank" rel="noreferrer" aria-label="Max" title="Max">
                    <svg viewBox="0 0 720 720" fill="currentColor">
                        <path d="M350.4,9.6C141.8,20.5,4.1,184.1,12.8,390.4c3.8,90.3,40.1,168,48.7,253.7,2.2,22.2-4.2,49.6,21.4,59.3,31.5,11.9,79.8-8.1,106.2-26.4,9-6.1,17.6-13.2,24.2-22,27.3,18.1,53.2,35.6,85.7,43.4,143.1,34.3,299.9-44.2,369.6-170.3C799.6,291.2,622.5-4.6,350.4,9.6h0ZM269.4,504c-11.3,8.8-22.2,20.8-34.7,27.7-18.1,9.7-23.7-.4-30.5-16.4-21.4-50.9-24-137.6-11.5-190.9,16.8-72.5,72.9-136.3,150-143.1,78-6.9,150.4,32.7,183.1,104.2,72.4,159.1-112.9,316.2-256.4,218.6h0Z"/>
                    </svg>
                </a>
            </div>
            <a href="#home-form" class="cmd-nav-cta" data-lead-open data-lead-offer="Обсудить проект">Обсудить проект</a>
        </div>

        <input type="checkbox" id="nav-toggle" class="cmd-nav-check" aria-hidden="true">
        <label for="nav-toggle" class="cmd-burger" aria-label="Меню">
            <span></span><span></span><span></span>
        </label>

        <div class="cmd-mob-panel">
            <details class="cmd-mob-accordion" open>
                <summary class="cmd-mob-link">Решения</summary>
                <div class="cmd-mob-accordion-body">
                    <a href="{{ route('site.landings.show', 'perevnedrenie-amocrm') }}" class="cmd-mob-sub cmd-mob-sub-rich">
                        <span class="cmd-mob-sub-title">Пересборка amoCRM</span>
                        <span class="cmd-mob-sub-desc">Когда CRM уже есть, но в ней бардак, нет контроля и теряются заявки</span>
                    </a>
                    <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}" class="cmd-mob-sub cmd-mob-sub-rich">
                        <span class="cmd-mob-sub-title">Внедрение amoCRM с нуля</span>
                        <span class="cmd-mob-sub-desc">Когда нужно сразу собрать правильную систему продаж, а не просто настроить воронку</span>
                    </a>
                    <a href="{{ route('site.landings.show', 'analitika-prodazh-v-amocrm') }}" class="cmd-mob-sub cmd-mob-sub-rich">
                        <span class="cmd-mob-sub-title">Аналитика продаж</span>
                        <span class="cmd-mob-sub-desc">Когда руководителю нужны цифры по заявкам, менеджерам, каналам и выручке</span>
                    </a>
                    <a href="{{ route('site.landings.show', 'razrabotka-crm') }}" class="cmd-mob-sub cmd-mob-sub-rich">
                        <span class="cmd-mob-sub-title">Разработка и интеграции</span>
                        <span class="cmd-mob-sub-desc">Когда стандартной amoCRM не хватает под вашу логику продаж</span>
                    </a>
                    <a href="{{ route('site.landings.show', 'soprovozhdenie-amocrm') }}" class="cmd-mob-sub cmd-mob-sub-rich">
                        <span class="cmd-mob-sub-title">Сопровождение и развитие</span>
                        <span class="cmd-mob-sub-desc">Когда CRM нужно не просто поддерживать, а регулярно улучшать</span>
                    </a>
                </div>
            </details>

            <div class="cmd-mob-divider"></div>
            <a href="{{ route('site.case-studies.index') }}" class="cmd-mob-link">Кейсы</a>
            <a href="{{ route('site.home') }}#start-flow-block" class="cmd-mob-link">Подход</a>
            <a href="{{ route('site.about') }}" class="cmd-mob-link">О компании</a>
            <a href="{{ route('site.articles.index') }}" class="cmd-mob-link">Статьи</a>
            <div class="cmd-mob-bottom">
                <div class="cmd-nav-socials">
                    <a href="{{ $siteSettings->telegram_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="Telegram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.2 4.4 2.4 10.8c-.6.2-.6.6 0 .8l4.8 1.8 1.8 5.8c.1.4.5.5.8.2l2.6-2.2 4.8 3.6c.4.3 1 .1 1.1-.4L22 5.2c.1-.6-.4-1-.8-.8Z"/>
                            <path d="m9 13.6 8.4-6.4"/>
                        </svg>
                    </a>
                    <a href="{{ $siteSettings->vk_link ?? '#' }}" target="_blank" rel="noreferrer" aria-label="VK" title="VK">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12.785 16.146s.382-.042.578-.252c.18-.193.174-.556.174-.556s-.025-1.698.764-1.95c.778-.247 1.777 1.645 2.836 2.373.8.55 1.41.43 1.41.43l2.83-.04s1.48-.09.778-1.247c-.058-.095-.41-.858-2.107-2.425-1.777-1.64-1.538-1.373.602-4.208 1.303-1.726 1.824-2.78 1.66-3.23-.155-.432-1.115-.318-1.115-.318l-3.19.02s-.236-.033-.412.073c-.173.103-.284.345-.284.345s-.51 1.357-1.19 2.512c-1.434 2.436-2.008 2.564-2.242 2.413-.545-.352-.408-1.415-.408-2.17 0-2.36.357-3.342-.697-3.598-.35-.085-.607-.14-1.5-.15-1.148-.013-2.12.004-2.67.274-.367.18-.65.58-.477.603.213.028.696.13.952.48.33.453.32 1.472.32 1.472s.188 2.78-.443 3.123c-.434.236-1.03-.245-2.31-2.448-.654-1.127-1.15-2.373-1.15-2.373s-.095-.233-.266-.358C5.17 5.4 4.9 5.36 4.9 5.36l-3.03.02s-.456.013-.623.21c-.149.177-.012.542-.012.542s2.395 5.606 5.107 8.432c2.486 2.594 5.31 2.424 5.31 2.424h1.134Z"/>
                        </svg>
                    </a>
                    <a href="https://max.ru/u/f9LHodD0cOIcLV9o9-5lH1-cKD7pPYP3ykso-qm9ZHZsNCBzSNSqi4wB4F8" target="_blank" rel="noreferrer" aria-label="Max">
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
