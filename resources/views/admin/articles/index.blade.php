@extends('admin.layouts.app', ['title' => 'Статьи'])

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3"><x-section-header title="Статьи" /><x-button :href="route('admin.articles.create')">Добавить</x-button></div>
        <form class="flex gap-2" method="GET"><x-form.input name="q" label="" placeholder="Поиск по названию" :value="request('q')" /><x-button variant="secondary" type="submit">Найти</x-button></form>
        <x-admin.table>
            <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                <tr>
                    <th class="px-4 py-3 text-left">Статья</th>
                    <th class="px-4 py-3 text-left">Публикация</th>
                    <th class="px-4 py-3 text-left">Slug</th>
                    <th class="px-4 py-3 text-right"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $item)
                    @php
                        $publiclyVisible = $item->status === 'published' && (is_null($item->published_at) || $item->published_at->isPast());
                    @endphp
                    <tr class="border-t align-top">
                        <td class="px-4 py-3">
                            <p class="font-medium text-slate-900">{{ $item->title }}</p>
                            @if($item->excerptText())
                                <p class="mt-1 max-w-xl text-sm text-slate-500">{{ $item->excerptText() }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <x-badge :status="$item->status" />
                            <p class="mt-2 text-xs text-slate-500">{{ optional($item->published_at)->format('d.m.Y H:i') ?: 'Без даты' }}</p>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-500">{{ $item->slug }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                @if($publiclyVisible)
                                    <x-button variant="secondary" :href="route('site.articles.show', $item->slug)" target="_blank" rel="noreferrer">Публичная</x-button>
                                @endif
                                <x-button variant="ghost" :href="route('admin.articles.edit', $item)">Редактировать</x-button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-admin.table>
        {{ $articles->links() }}
    </div>
@endsection
