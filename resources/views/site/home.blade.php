@extends('site.layouts.app', ['title' => 'Главная'])

@section('content')
    <section class="site-section bg-gradient-to-b from-slate-100 to-slate-50">
        <div class="container-wrap">
            <x-section-header :title="$siteSettings->hero_title ?? 'Интегрируем CRM в маркетинг и продажи'" :subtitle="$siteSettings->hero_subtitle ?? 'Делаем прозрачную воронку, автоматизируем рутину и растим выручку через системную аналитику.'" />
            <div class="mt-6 flex flex-wrap gap-3">
                <x-button type="button" data-lead-open data-lead-offer="Обсудить проект">Обсудить проект</x-button>
                <x-button variant="secondary" :href="route('site.services.index')">Смотреть услуги</x-button>
            </div>
        </div>
    </section>

    <section class="site-section">
        <div class="container-wrap space-y-10">
            <x-section-header title="Услуги" subtitle="Базовый блок услуг на главной." />
            <div class="grid gap-4 md:grid-cols-3">
                @forelse($services as $service)
                    <x-card class="anim-bounce">
                        <h3 class="text-lg font-semibold">{{ $service->title }}</h3>
                        <p class="mt-2 text-sm text-slate-600">{{ $service->short_description }}</p>
                        <a href="{{ route('site.services.show', $service->slug) }}" class="mt-4 inline-block text-sm font-medium text-slate-900">Подробнее</a>
                    </x-card>
                @empty
                    <x-card>Нет опубликованных услуг.</x-card>
                @endforelse
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="anim-bounce stagger-1"><x-card><x-section-header title="Когда к нам обращаются" /><p class="mt-3 text-sm">Когда лиды теряются, CRM не связана с рекламой и менеджеры работают вручную.</p></x-card></div>
                <div class="anim-bounce stagger-2"><x-card><x-section-header title="Почему нас выбирают" /><p class="mt-3 text-sm">Фокус на бизнес-результат, прозрачные этапы, понятная документация.</p></x-card></div>
                <div class="anim-bounce stagger-3"><x-card><x-section-header title="Про основателя" /><p class="mt-3 text-sm">Секция с биографией, опытом и подходом к проектам.</p></x-card></div>
                <div class="anim-bounce stagger-4"><x-card><x-section-header title="Интервью" /><p class="mt-3 text-sm">Место под видеоматериалы, подкасты и внешние публикации.</p></x-card></div>
                <div class="anim-bounce stagger-5"><x-card><x-section-header title="Экспертность" /><p class="mt-3 text-sm">Портфолио технологий, сертификации и методологии внедрения.</p></x-card></div>
                <div class="anim-bounce stagger-6"><x-card><x-section-header title="CTA" /><p class="mt-3 text-sm">Закрывающий блок с призывом оставить заявку.</p></x-card></div>
            </div>

            <x-section-header title="Кейсы" subtitle="Последние реализованные проекты." />
            <div class="grid gap-4 md:grid-cols-3">
                @forelse($caseStudies as $case)
                    <x-card>
                        <h3 class="text-lg font-semibold">{{ $case->title }}</h3>
                        <p class="mt-2 text-sm text-slate-600">{{ $case->result_summary }}</p>
                        <a href="{{ route('site.case-studies.show', $case->slug) }}" class="mt-4 inline-block text-sm font-medium text-slate-900">Кейс</a>
                    </x-card>
                @empty
                    <x-card>Нет опубликованных кейсов.</x-card>
                @endforelse
            </div>

            <x-section-header title="Отзывы" />
            <div class="grid gap-4 md:grid-cols-2">
                @forelse($testimonials as $testimonial)
                    <x-card>
                        <p class="text-sm">{{ $testimonial->quote }}</p>
                        <p class="mt-3 text-xs text-slate-500">{{ $testimonial->author_name }} · {{ $testimonial->company_name }}</p>
                    </x-card>
                @empty
                    <x-card>Нет опубликованных отзывов.</x-card>
                @endforelse
            </div>

            <x-section-header title="FAQ" />
            <div class="space-y-2" x-data="{open: null}">
                @foreach($faqs as $item)
                    <div class="card p-0">
                        <button class="flex w-full items-center justify-between px-4 py-3 text-left" @click="open = open === {{ $item->id }} ? null : {{ $item->id }}">
                            <span class="font-medium">{{ $item->question }}</span>
                            <span x-text="open === {{ $item->id }} ? '-' : '+'"></span>
                        </button>
                        <div x-show="open === {{ $item->id }}" class="px-4 pb-4 text-sm text-slate-600" x-cloak>
                            {{ $item->answer }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
