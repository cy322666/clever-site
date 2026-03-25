@extends('site.layouts.app', ['title' => 'Контакты'])

@section('content')
    <section class="site-page-hero">
        <div class="container-wrap">
            <div class="site-page-hero-box">
                <p class="site-kicker">Раздел сайта</p>
                <h1 class="site-title">Контакты</h1>
                <p class="site-subtitle">Выберите удобный канал связи, и мы вернемся с предложением по вашему проекту.</p>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap grid gap-4 md:grid-cols-2">
            <article class="site-card">
                <h2 class="site-card-title">Связаться с нами</h2>
                <div class="mt-4 space-y-3 text-sm text-slate-700">
                    <p>Телефон: {{ $siteSettings->phone ?? '+7 (000) 000-00-00' }}</p>
                    <p>Email: {{ $siteSettings->email ?? 'hello@example.com' }}</p>
                    <p>Адрес: {{ $siteSettings->address ?? 'Не указан' }}</p>
                </div>
            </article>

            <article class="site-card">
                <h2 class="site-card-title">Социальные сети</h2>
                <ul class="mt-4 space-y-3 text-sm text-slate-700">
                    <li><a class="hover:underline" href="{{ $siteSettings->telegram_link ?? '#' }}" target="_blank" rel="noreferrer">Telegram</a></li>
                    <li><a class="hover:underline" href="{{ $siteSettings->youtube_link ?? '#' }}" target="_blank" rel="noreferrer">YouTube</a></li>
                    <li><a class="hover:underline" href="{{ $siteSettings->vk_link ?? '#' }}" target="_blank" rel="noreferrer">VK</a></li>
                    <li><a class="hover:underline" href="{{ $siteSettings->max_link ?? '#' }}" target="_blank" rel="noreferrer">Max</a></li>
                    <li><a class="hover:underline" href="{{ $siteSettings->teletype_link ?? '#' }}" target="_blank" rel="noreferrer">Teletype</a></li>
                </ul>
            </article>
        </div>
    </section>
@endsection
