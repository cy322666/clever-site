@extends('admin.layouts.app', ['title' => 'Редактировать статью'])

@section('content')
    <x-card>
        <h1 class="mb-4 text-xl font-semibold">Редактирование статьи</h1>
        <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">@method('PUT')@include('admin.articles._form')</form>
        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="mt-4">@csrf @method('DELETE')<x-button variant="danger" type="submit" onclick="return confirm('Удалить запись?')">Удалить</x-button></form>
    </x-card>
@endsection
