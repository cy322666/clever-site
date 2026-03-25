@extends('admin.layouts.app', ['title' => 'Редактировать отзыв'])

@section('content')
    <x-card>
        <h1 class="mb-4 text-xl font-semibold">Редактирование отзыва</h1>
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">@method('PUT')@include('admin.testimonials._form')</form>
        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="mt-4">@csrf @method('DELETE')<x-button variant="danger" type="submit" onclick="return confirm('Удалить запись?')">Удалить</x-button></form>
    </x-card>
@endsection
