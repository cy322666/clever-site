@extends('admin.layouts.app', ['title' => 'Настройки сайта'])

@section('content')
    <x-card>
        <h1 class="mb-4 text-xl font-semibold">Настройки сайта</h1>
        <form action="{{ route('admin.site-settings.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="grid gap-4 md:grid-cols-2">
                <x-form.input name="site_name" label="Название сайта" :value="$siteSetting->site_name" />
                <x-form.input name="phone" label="Телефон" :value="$siteSetting->phone" />
                <x-form.input name="email" label="Эл. почта" type="email" :value="$siteSetting->email" />
                <x-form.input name="address" label="Адрес" :value="$siteSetting->address" />
                <x-form.input name="telegram_link" label="Ссылка Telegram" :value="$siteSetting->telegram_link" />
                <x-form.input name="youtube_link" label="Ссылка YouTube" :value="$siteSetting->youtube_link" />
                <x-form.input name="vk_link" label="Ссылка VK" :value="$siteSetting->vk_link" />
                <x-form.input name="max_link" label="Ссылка Max" :value="$siteSetting->max_link" />
                <x-form.input name="teletype_link" label="Ссылка Teletype" :value="$siteSetting->teletype_link" />
                <x-form.input name="hero_title" label="Заголовок Hero" :value="$siteSetting->hero_title" />
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="hero_subtitle">Подзаголовок Hero</label>
                <textarea id="hero_subtitle" name="hero_subtitle" rows="3" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('hero_subtitle', $siteSetting->hero_subtitle) }}</textarea>
            </div>

            <x-button type="submit">Сохранить настройки</x-button>
        </form>
    </x-card>
@endsection
