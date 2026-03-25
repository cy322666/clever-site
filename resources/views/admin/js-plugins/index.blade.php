@extends('admin.layouts.app', ['title' => 'JS плагины'])

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <x-section-header title="JS плагины" subtitle="Скрипты, подключаемые на всех страницах сайта." />
            <x-button :href="route('admin.js-plugins.create')">Добавить</x-button>
        </div>

        <form class="flex gap-2" method="GET">
            <x-form.input name="q" label="" placeholder="Поиск по названию" :value="request('q')" />
            <x-button variant="secondary" type="submit">Найти</x-button>
        </form>

        <x-admin.table>
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3">Название</th>
                    <th class="px-4 py-3">Размещение</th>
                    <th class="px-4 py-3">Статус</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($plugins as $item)
                    <tr class="border-t border-slate-200">
                        <td class="px-4 py-3">{{ $item->title }}</td>
                        <td class="px-4 py-3">{{ $item->placement }}</td>
                        <td class="px-4 py-3"><x-badge :status="$item->status" /></td>
                        <td class="px-4 py-3 text-right"><x-button variant="ghost" :href="route('admin.js-plugins.edit', $item)">Редактировать</x-button></td>
                    </tr>
                @endforeach
            </tbody>
        </x-admin.table>

        {{ $plugins->links() }}
    </div>
@endsection
