@extends('admin.layouts.app', ['title' => 'Редактировать JS плагин'])

@section('content')
    <x-card>
        <h1 class="mb-4 text-xl font-semibold">Редактирование JS плагина</h1>
        <form action="{{ route('admin.js-plugins.update', $plugin) }}" method="POST">@method('PUT')@include('admin.js-plugins._form')</form>
        <form action="{{ route('admin.js-plugins.destroy', $plugin) }}" method="POST" class="mt-4">@csrf @method('DELETE')<x-button variant="danger" type="submit" onclick="return confirm('Удалить запись?')">Удалить</x-button></form>
    </x-card>
@endsection
