@extends('site.layouts.app', [
    'title' => 'Продление лицензий amoCRM с бонусами | Clever',
    'metaDescription' => 'Продлите лицензию amoCRM через Clever: бонусные месяцы amoCRM, 40+ виджетов и кешбек работами по amoCRM до 10% от суммы оплаты лицензий.',
    'canonical' => route('site.license-renewal'),
])

@php
    $bonusRows = [
        ['term' => '6', 'gift' => '1', 'total' => '7', 'payment' => 'Оплачиваете 6, пользуетесь 7', 'saving' => '1 199'],
        ['term' => '9', 'gift' => '2', 'total' => '10', 'payment' => 'Оплачиваете 8, пользуетесь 11', 'saving' => '2 398'],
        ['term' => '12', 'gift' => '3', 'total' => '13', 'payment' => 'Оплачиваете 10, пользуетесь 13', 'saving' => '3 597'],
        ['term' => '24', 'gift' => '4', 'total' => '25', 'payment' => 'Оплачиваете 18, пользуетесь 25', 'saving' => '7 194'],
    ];

    $bonusCards = [
        ['value' => '40+', 'title' => 'виджетов бонусом', 'text' => 'Полезные виджеты от Clever и партнеров для продаж, контроля, коммуникаций и автоматизации.'],
        ['value' => 'до 10%', 'title' => 'кешбек работами', 'text' => 'Дарим часы работ по amoCRM от суммы оплаты лицензий. Расчет: 3 000 ₽ за час.'],
        ['value' => '+1-4', 'title' => 'месяца amoCRM', 'text' => 'Продлеваете через нас и получаете дополнительные месяцы использования amoCRM.'],
    ];

    $licenseSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => 'Продление лицензий amoCRM с бонусами',
        'description' => 'Продление лицензии amoCRM через Clever: бонусные месяцы, виджеты и кешбек работами по amoCRM.',
        'url' => route('site.license-renewal'),
        'provider' => [
            '@type' => 'Organization',
            'name' => $siteSettings->site_name ?? 'CleverCRM',
            'url' => route('site.home'),
        ],
    ];
@endphp

@push('meta')
    <meta property="og:type" content="website">
    <meta property="og:title" content="Продление лицензий amoCRM с бонусами | Clever">
    <meta property="og:description" content="Продлите лицензию amoCRM через Clever: бонусные месяцы amoCRM, 40+ виджетов и кешбек работами по amoCRM до 10% от суммы оплаты лицензий.">
    <meta property="og:url" content="{{ route('site.license-renewal') }}">
    <meta name="twitter:card" content="summary">
@endpush

@push('schema')
    <script type="application/ld+json">{!! json_encode($licenseSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush

@section('content')
    <section class="relative overflow-hidden bg-[#111113] text-white">
        <div class="container-wrap grid gap-10 py-14 md:py-20 lg:grid-cols-[minmax(0,1.05fr)_minmax(360px,.95fr)] lg:items-center">
            <div>
                <h1 class="max-w-4xl text-4xl font-black leading-[1.02] tracking-tight md:text-6xl">
                    Продлите лицензию amoCRM с бонусными месяцами и виджетами
                </h1>
                <p class="mt-6 max-w-2xl text-base leading-8 text-white/68 md:text-lg">
                    Поможем продлить amoCRM через нас: лицензия становится выгоднее за счет бесплатных месяцев,
                    а сверху вы получаете 40+ виджетов и кешбек часами работ по amoCRM.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#license-renewal-form" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-orange-500 px-5 text-sm font-extrabold text-white shadow-lg shadow-orange-500/20 transition hover:bg-orange-600">
                        Рассчитать продление
                    </a>
                    <a href="#license-bonuses" class="inline-flex min-h-12 items-center justify-center rounded-xl border border-white/15 bg-white/8 px-5 text-sm font-bold text-white transition hover:bg-white/12">
                        Смотреть бонусы
                    </a>
                </div>
            </div>

            <div class="rounded-[28px] border border-white/10 bg-white/[0.06] p-4 shadow-2xl shadow-black/30 backdrop-blur">
                <div class="rounded-3xl bg-white p-5 text-slate-950">
                    <div class="flex items-center justify-between gap-4 border-b border-slate-100 pb-4">
                        <div>
                            <p class="text-xs font-extrabold uppercase tracking-[0.12em] text-slate-400">Экономия на лицензии</p>
                            <p class="mt-1 text-2xl font-black tracking-tight">amoCRM + Clever</p>
                        </div>
                        <div class="rounded-2xl bg-orange-50 px-4 py-3 text-right">
                            <p class="text-xs font-bold text-orange-700">бонусом</p>
                            <p class="text-xl font-black text-orange-600">40+</p>
                        </div>
                    </div>

                    <div class="mt-5 grid gap-3">
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm font-bold text-slate-600">Оплачиваете</span>
                                <span class="text-lg font-black">10 месяцев</span>
                            </div>
                            <div class="mt-3 h-2 overflow-hidden rounded-full bg-slate-200">
                                <div class="h-full w-[78%] rounded-full bg-orange-500"></div>
                            </div>
                        </div>
                        <div class="rounded-2xl border border-orange-100 bg-orange-50 p-4">
                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm font-bold text-orange-800">Пользуетесь</span>
                                <span class="text-lg font-black text-orange-700">13 месяцев</span>
                            </div>
                            <div class="mt-3 h-2 overflow-hidden rounded-full bg-orange-200">
                                <div class="h-full w-full rounded-full bg-orange-500"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 grid grid-cols-3 gap-3">
                        <div class="rounded-2xl bg-slate-950 p-4 text-white">
                            <p class="text-2xl font-black">3</p>
                            <p class="mt-1 text-xs leading-5 text-white/62">месяца в подарок</p>
                        </div>
                        <div class="rounded-2xl bg-slate-100 p-4">
                            <p class="text-2xl font-black">10%</p>
                            <p class="mt-1 text-xs leading-5 text-slate-500">кешбек работами</p>
                        </div>
                        <div class="rounded-2xl bg-slate-100 p-4">
                            <p class="text-2xl font-black">3 000</p>
                            <p class="mt-1 text-xs leading-5 text-slate-500">₽ за час работ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="license-bonuses" class="site-section">
        <div class="container-wrap">
            <div class="max-w-3xl">
                <p class="site-kicker">Что входит</p>
                <h2 class="site-title">Бонусы при продлении через Clever</h2>
                <p class="site-subtitle">
                    Условия взяты из бонусного предложения Clever: бесплатные месяцы amoCRM, набор виджетов и кешбек на работы по CRM.
                </p>
            </div>

            <div class="mt-8 grid gap-4 md:grid-cols-3">
                @foreach($bonusCards as $card)
                    <article class="site-card">
                        <p class="text-4xl font-black tracking-tight text-orange-500">{{ $card['value'] }}</p>
                        <h3 class="mt-4 text-lg font-extrabold text-slate-950">{{ $card['title'] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $card['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="site-section pt-0">
        <div class="container-wrap">
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="grid gap-4 border-b border-slate-200 bg-slate-950 p-6 text-white md:grid-cols-[minmax(0,1fr)_auto] md:items-end md:p-8">
                    <div>
                        <p class="text-xs font-extrabold uppercase tracking-[0.12em] text-orange-300">Бонусные месяцы</p>
                        <h2 class="mt-3 text-3xl font-black tracking-tight md:text-4xl">Сколько можно получить</h2>
                    </div>
                    <p class="max-w-md text-sm leading-7 text-white/62">
                        Вы платите меньше, чем напрямую, а пользуетесь amoCRM дольше. Выгода указана за одного пользователя.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-[820px] w-full text-left">
                        <thead class="bg-slate-50 text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">
                            <tr>
                                <th class="px-5 py-4">Месяцы продления</th>
                                <th class="px-5 py-4">Месяцы в подарок</th>
                                <th class="px-5 py-4">Общий срок</th>
                                <th class="px-5 py-4">Как это выглядит</th>
                                <th class="px-5 py-4">Выгода</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @foreach($bonusRows as $row)
                                <tr class="transition hover:bg-orange-50/40">
                                    <td class="px-5 py-5 text-lg font-black text-slate-950">{{ $row['term'] }}</td>
                                    <td class="px-5 py-5"><span class="rounded-full bg-orange-100 px-3 py-1.5 font-extrabold text-orange-700">+{{ $row['gift'] }}</span></td>
                                    <td class="px-5 py-5 font-bold text-slate-700">{{ $row['total'] }} мес.</td>
                                    <td class="px-5 py-5 text-slate-600">{{ $row['payment'] }}</td>
                                    <td class="px-5 py-5 font-black text-slate-950">{{ $row['saving'] }} ₽</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="site-section pt-0">
        <div class="container-wrap grid gap-4 lg:grid-cols-3">
            <article class="site-card lg:col-span-2">
                <p class="site-kicker">Кешбек работами</p>
                <h2 class="mt-3 text-3xl font-black tracking-tight text-slate-950">Часы на доработки amoCRM вместо абстрактной скидки</h2>
                <p class="mt-4 max-w-3xl text-base leading-8 text-slate-600">
                    До 10% от суммы оплаты лицензий возвращаем работами с нами. Эти часы можно направить на настройку воронок,
                    автоматизацию, интеграции, разбор ошибок или развитие CRM. Расчет стоимости часа: 3 000 ₽.
                </p>
            </article>
            <article class="site-card bg-slate-950 text-white">
                <p class="text-5xl font-black">10%</p>
                <p class="mt-4 text-sm leading-7 text-white/68">
                    Максимальный кешбек работами от суммы оплаты лицензий. Финальный объем считаем перед счетом.
                </p>
            </article>
        </div>
    </section>

    <section id="license-renewal-form" class="site-section pt-0">
        <div class="container-wrap">
            <div class="grid overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-sm lg:grid-cols-[minmax(0,.9fr)_minmax(360px,1fr)]">
                <div class="bg-slate-950 p-6 text-white md:p-8">
                    <p class="text-xs font-extrabold uppercase tracking-[0.12em] text-orange-300">Проверим вашу лицензию</p>
                    <h2 class="mt-4 text-3xl font-black tracking-tight md:text-5xl">Рассчитать продление amoCRM</h2>
                    <p class="mt-5 text-base leading-8 text-white/64">
                        Оставьте контакт, количество пользователей и текущий срок лицензии. Вернемся с вариантом продления,
                        бонусными месяцами, виджетами и расчетом кешбека работами.
                    </p>
                    <div class="mt-8 grid gap-3 text-sm text-white/72">
                        <a href="tel:+79996373955" class="rounded-2xl border border-white/10 bg-white/[0.04] p-4 transition hover:border-orange-300/40 hover:bg-white/[0.08] hover:text-white">
                            Контакты: +7 999 637-39-55
                        </a>
                        <a href="mailto:admin@blackclever.ru" class="rounded-2xl border border-white/10 bg-white/[0.04] p-4 transition hover:border-orange-300/40 hover:bg-white/[0.08] hover:text-white">
                            Email: admin@blackclever.ru
                        </a>
                        <a href="https://t.me/integrator" target="_blank" rel="noreferrer" class="rounded-2xl border border-white/10 bg-white/[0.04] p-4 transition hover:border-orange-300/40 hover:bg-white/[0.08] hover:text-white">
                            Telegram: @integrator
                        </a>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    @if(session('landing_form_success'))
                        <div class="mb-5 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm font-semibold text-green-700">
                            {{ session('landing_form_success') }}
                        </div>
                    @endif

                    <form action="{{ route('site.inquiries.store') }}" method="POST" class="grid gap-4">
                        @csrf
                        <input type="hidden" name="landing_title" value="Продление лицензий amoCRM">
                        <input type="hidden" name="offer_type" value="Продление лицензий amoCRM с бонусами">
                        <input type="hidden" name="page_url" value="{{ request()->fullUrl() }}">
                        <input type="hidden" name="form_anchor" value="license-renewal-form">

                        <label class="grid gap-2">
                            <span class="text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">Имя</span>
                            <input name="name" type="text" value="{{ old('name') }}" required class="min-h-13 rounded-2xl border border-slate-200 bg-white px-4 text-sm text-slate-950 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100" placeholder="Как к вам обращаться">
                            @error('name')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="grid gap-2">
                            <span class="text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">Контакт</span>
                            <input name="contact" type="text" value="{{ old('contact') }}" required class="min-h-13 rounded-2xl border border-slate-200 bg-white px-4 text-sm text-slate-950 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100" placeholder="Телефон, Telegram или email">
                            @error('contact')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </label>

                        <label class="grid gap-2">
                            <span class="text-xs font-extrabold uppercase tracking-[0.08em] text-slate-500">Что продлеваем</span>
                            <textarea name="message" rows="5" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm leading-6 text-slate-950 outline-none transition focus:border-orange-400 focus:ring-4 focus:ring-orange-100" placeholder="Например: 8 пользователей, лицензия заканчивается в июне, хотим продлить на год">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-xs text-red-600">{{ $message }}</span>
                            @enderror
                        </label>

                        <button type="submit" class="mt-2 inline-flex min-h-13 items-center justify-center rounded-2xl bg-orange-500 px-5 text-sm font-extrabold text-white shadow-lg shadow-orange-500/20 transition hover:bg-orange-600">
                            Получить расчет
                        </button>
                        <p class="text-center text-xs leading-5 text-slate-400">
                            Отправляя форму, вы оставляете контакт для обратной связи по продлению лицензии.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
