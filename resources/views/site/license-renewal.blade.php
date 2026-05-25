@extends('site.layouts.app', [
    'title' => 'Продление лицензий amoCRM с бонусами | Clever',
    'metaDescription' => 'Продлите лицензию amoCRM через Clever: бонусные месяцы amoCRM, 40+ виджетов от нас и партнеров и кешбек работами по amoCRM до 10% от суммы оплаты лицензий.',
    'canonical' => route('site.license-renewal'),
])

@php
    $companyWidgets = [
        ['title' => 'Антидублирование', 'description' => 'Поиск и объединение дублей контактов и компаний.'],
        ['title' => 'Написать в WhatsApp', 'description' => 'Быстрый переход в чат WhatsApp из карточки CRM.'],
        ['title' => 'Табель', 'description' => 'Отображение статусов сотрудников: работает, отпуск и другие состояния.'],
        ['title' => 'Управление полями', 'description' => 'Скрытие и показ полей для пользователей.'],
        ['title' => 'Яндекс.Диск', 'description' => 'Хранение файлов вне CRM.'],
        ['title' => 'Google Drive', 'description' => 'Интеграция с Google Диском.'],
        ['title' => 'Чек-листы', 'description' => 'Чек-листы действий по сделкам.'],
        ['title' => 'Уведомления в Telegram', 'description' => 'Оповещения о событиях CRM.'],
        ['title' => 'Мультикомпании', 'description' => 'Связь нескольких юрлиц.'],
        ['title' => 'Регион по номеру', 'description' => 'Определение региона и времени клиента.'],
        ['title' => 'Информер', 'description' => 'Быстрый просмотр связанных данных.'],
        ['title' => 'Подсказки полей', 'description' => 'Инструкции по заполнению полей.'],
        ['title' => 'Автоудаление файлов', 'description' => 'Очистка устаревших файлов.'],
        ['title' => 'Копирование сделок', 'description' => 'Клонирование сделок в 1 клик.'],
        ['title' => 'Итоги таблиц', 'description' => 'Суммы и итоги в списках CRM.'],
        ['title' => 'Ускорение голосовых', 'description' => 'Изменение скорости аудио.'],
        ['title' => 'Гугл таблицы', 'description' => 'Выгрузка данных в Google Sheets.'],
        ['title' => 'Трекер активности', 'description' => 'Учет времени работы со сделками.'],
        ['title' => 'Файндер', 'description' => 'Быстрый поиск по CRM и контроль времени ответа.'],
        ['title' => 'Пушер', 'description' => 'Push-уведомления о событиях.'],
        ['title' => 'Калькулятор полей', 'description' => 'Расчет значений полей по формулам.'],
        ['title' => 'Email-модули', 'description' => 'Массовые email-рассылки и трекинг.'],
    ];

    $bonusRows = [
        ['term' => '6', 'gift' => '1', 'total' => '7', 'payment' => 'Оплачиваете 6, пользуетесь 7', 'saving' => '1 199'],
        ['term' => '9', 'gift' => '2', 'total' => '10', 'payment' => 'Оплачиваете 8, пользуетесь 11', 'saving' => '2 398'],
        ['term' => '12', 'gift' => '3', 'total' => '13', 'payment' => 'Оплачиваете 10, пользуетесь 13', 'saving' => '3 597'],
        ['term' => '24', 'gift' => '4', 'total' => '25', 'payment' => 'Оплачиваете 18, пользуетесь 25', 'saving' => '7 194'],
    ];

    $bonusCards = [
        ['value' => '40+', 'title' => 'виджетов от нас и партнеров', 'text' => 'Набор amoCRM-виджетов для продаж, контроля, коммуникаций и автоматизации.'],
        ['value' => 'до 10%', 'title' => 'кешбек работами', 'text' => 'Дарим часы работ по amoCRM от суммы оплаты лицензий. Расчет: 3 000 ₽ за час.'],
        ['value' => '+1-4', 'title' => 'месяца amoCRM', 'text' => 'Продлеваете через нас и получаете дополнительные месяцы использования amoCRM.'],
    ];

    $relatedLinks = [
        [
            'kicker' => 'Решение',
            'title' => 'Внедрение amoCRM',
            'text' => 'Соберем CRM с нуля: воронки, этапы, роли, автоматизацию и контроль заявок.',
            'url' => route('site.landings.show', 'vnedrenie-amocrm'),
            'label' => 'Смотреть внедрение',
        ],
        [
            'kicker' => 'Решение',
            'title' => 'Пересборка amoCRM',
            'text' => 'Наводим порядок в действующей CRM, если накопились дубли, хаос в воронках и потерян контроль.',
            'url' => route('site.landings.show', 'perevnedrenie-amocrm'),
            'label' => 'Смотреть пересборку',
        ],
        [
            'kicker' => 'Решение',
            'title' => 'Разработка и интеграции',
            'text' => 'Дорабатываем amoCRM под вашу логику продаж, интеграции, отчеты и нестандартные процессы.',
            'url' => route('site.landings.show', 'razrabotka-crm'),
            'label' => 'Смотреть разработку',
        ],
        [
            'kicker' => 'Раздел',
            'title' => 'Кейсы Clever',
            'text' => 'Посмотрите, как мы решаем задачи по CRM, аналитике, автоматизации и контролю продаж.',
            'url' => route('site.case-studies.index'),
            'label' => 'Перейти в кейсы',
        ],
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
    <meta property="og:description" content="Продлите лицензию amoCRM через Clever: бонусные месяцы amoCRM, 40+ виджетов от нас и партнеров и кешбек работами по amoCRM до 10% от суммы оплаты лицензий.">
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
                    Продлите лицензии amoCRM с бонусными месяцами и виджетами
                </h1>

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
                            <p class="text-2xl font-black">40+</p>
                            <p class="mt-1 text-xs leading-5 text-slate-500">виджетов бесплатно</p>
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
            <div class="grid gap-8 lg:grid-cols-[minmax(280px,.78fr)_minmax(0,1.22fr)] lg:items-start">
                <div class="lg:sticky lg:top-28">
                    <p class="site-kicker">Бонусные виджеты Clever</p>
                    <h2 class="site-title">Набор из 40+ виджетов для amoCRM</h2>
                </div>

                <div class="divide-y divide-slate-200 border-y border-slate-200">
                    @foreach($companyWidgets as $widget)
                        <article class="grid gap-2 py-4 sm:grid-cols-[minmax(180px,.42fr)_minmax(0,1fr)] sm:items-start">
                            <h3 class="text-base font-extrabold text-slate-950">
                                {{ $widget['title'] }}
                            </h3>
                            <p class="text-sm leading-6 text-slate-600">
                                {{ $widget['description'] }}
                            </p>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <section class="site-section pt-0">
        <div class="container-wrap">
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <div class="grid gap-4 border-b border-slate-200 bg-slate-950 p-6 text-white md:grid-cols-[minmax(0,1fr)_auto] md:items-end md:p-8">
                    <div>
                        <p class="text-xs font-extrabold uppercase tracking-[0.12em] text-orange-300">Бонусные месяцы</p>
                        <h2 class="mt-3 text-3xl font-black tracking-tight md:text-4xl">БОНУСНЫЕ МЕСЯЦЫ</h2>
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
                                    <td class="px-5 py-5 font-black text-slate-950">От {{ $row['saving'] }} ₽</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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

    <section class="rl-section pt-0" id="license-related">
        <div class="container-wrap">
            <div class="rl-kicker">Ещё</div>
            <h2 class="rl-title">Другие услуги и решения</h2>
            <p class="rl-desc">Соседние страницы по внедрению, развитию и настройке amoCRM.</p>

            <div class="rl-grid">
                @foreach($relatedLinks as $item)
                    <div class="rl-card">
                        <div class="rl-card-kicker">{{ $item['kicker'] }}</div>
                        <h3 class="rl-card-title">{{ $item['title'] }}</h3>
                        <p class="rl-card-text">{{ $item['text'] }}</p>
                        <a href="{{ $item['url'] }}" class="rl-card-link">{{ $item['label'] }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
