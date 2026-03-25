@extends('admin.layouts.app', ['title' => 'Редактировать виджет'])

@section('content')
    <x-card>
        <h1 class="mb-4 text-xl font-semibold">Редактирование виджета</h1>
        <form action="{{ route('admin.widgets.update', $widget) }}" method="POST" enctype="multipart/form-data">@method('PUT')@include('admin.widgets._form')</form>
        <form action="{{ route('admin.widgets.destroy', $widget) }}" method="POST" class="mt-4">@csrf @method('DELETE')<x-button variant="danger" type="submit" onclick="return confirm('Удалить запись?')">Удалить</x-button></form>
    </x-card>
@endsection
