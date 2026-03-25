@extends('admin.layouts.app', ['title' => 'Создать виджет'])

@section('content')
    <x-card><h1 class="mb-4 text-xl font-semibold">Новый виджет</h1><form action="{{ route('admin.widgets.store') }}" method="POST" enctype="multipart/form-data">@include('admin.widgets._form')</form></x-card>
@endsection
