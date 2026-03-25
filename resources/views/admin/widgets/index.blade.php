@extends('admin.layouts.app', ['title' => 'Виджеты'])

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3"><x-section-header title="Виджеты" /><x-button :href="route('admin.widgets.create')">Добавить</x-button></div>
        <form class="flex gap-2" method="GET"><x-form.input name="q" label="" placeholder="Поиск по названию" :value="request('q')" /><x-button variant="secondary" type="submit">Найти</x-button></form>
        <x-admin.table><thead class="bg-slate-50 text-xs uppercase text-slate-500"><tr><th class="px-4 py-3">Название</th><th class="px-4 py-3">Статус</th><th class="px-4 py-3"></th></tr></thead><tbody>@foreach($widgets as $item)<tr class="border-t"><td class="px-4 py-3">{{ $item->title }}</td><td class="px-4 py-3"><x-badge :status="$item->status" /></td><td class="px-4 py-3 text-right"><x-button variant="ghost" :href="route('admin.widgets.edit', $item)">Редактировать</x-button></td></tr>@endforeach</tbody></x-admin.table>
        {{ $widgets->links() }}
    </div>
@endsection
