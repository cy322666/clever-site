@extends('admin.layouts.app', ['title' => 'Панель управления'])

@section('content')
    <div class="space-y-6">
        <x-section-header title="Панель управления" subtitle="Сводка по контентным разделам." />

        <div class="grid gap-4 md:grid-cols-3">
            <x-card><p class="text-sm text-slate-500">Услуги</p><p class="mt-2 text-2xl font-semibold">{{ $stats['services'] }}</p></x-card>
            <x-card><p class="text-sm text-slate-500">Кейсы</p><p class="mt-2 text-2xl font-semibold">{{ $stats['caseStudies'] }}</p></x-card>
            <x-card><p class="text-sm text-slate-500">Статьи</p><p class="mt-2 text-2xl font-semibold">{{ $stats['articles'] }}</p></x-card>
            <x-card><p class="text-sm text-slate-500">Виджеты</p><p class="mt-2 text-2xl font-semibold">{{ $stats['widgets'] }}</p></x-card>
            <x-card><p class="text-sm text-slate-500">Отзывы</p><p class="mt-2 text-2xl font-semibold">{{ $stats['testimonials'] }}</p></x-card>
            <x-card><p class="text-sm text-slate-500">FAQ</p><p class="mt-2 text-2xl font-semibold">{{ $stats['faqs'] }}</p></x-card>
        </div>
    </div>
@endsection
