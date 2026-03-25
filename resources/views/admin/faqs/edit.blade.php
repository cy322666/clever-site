@extends('admin.layouts.app', ['title' => 'Редактировать FAQ'])

@section('content')
    <x-card>
        <h1 class="mb-4 text-xl font-semibold">Редактирование FAQ</h1>
        <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" enctype="multipart/form-data">@method('PUT')@include('admin.faqs._form')</form>
        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="mt-4">@csrf @method('DELETE')<x-button variant="danger" type="submit" onclick="return confirm('Удалить запись?')">Удалить</x-button></form>
    </x-card>
@endsection
