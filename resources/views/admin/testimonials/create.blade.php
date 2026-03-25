@extends('admin.layouts.app', ['title' => 'Создать отзыв'])

@section('content')
    <x-card><h1 class="mb-4 text-xl font-semibold">Новый отзыв</h1><form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">@include('admin.testimonials._form')</form></x-card>
@endsection
