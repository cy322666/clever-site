@extends('admin.layouts.app', ['title' => 'Редактировать услугу'])

@section('content')
    <x-card>
        <h1 class="mb-4 text-xl font-semibold">Редактирование услуги</h1>
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @method('PUT')
            @include('admin.services._form')
        </form>

        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="mt-4">
            @csrf
            @method('DELETE')
            <x-button variant="danger" type="submit" onclick="return confirm('Удалить запись?')">Удалить</x-button>
        </form>
    </x-card>
@endsection
