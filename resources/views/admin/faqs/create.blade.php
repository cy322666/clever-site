@extends('admin.layouts.app', ['title' => 'Создать FAQ'])

@section('content')
    <x-card><h1 class="mb-4 text-xl font-semibold">Новый FAQ</h1><form action="{{ route('admin.faqs.store') }}" method="POST" enctype="multipart/form-data">@include('admin.faqs._form')</form></x-card>
@endsection
