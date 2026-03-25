@extends('admin.layouts.app', ['title' => 'Создать статью'])

@section('content')
    <x-card><h1 class="mb-4 text-xl font-semibold">Новая статья</h1><form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">@include('admin.articles._form')</form></x-card>
@endsection
