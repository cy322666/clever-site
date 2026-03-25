@extends('admin.layouts.app', ['title' => 'Создать кейс'])

@section('content')
    <x-card><h1 class="mb-4 text-xl font-semibold">Новый кейс</h1><form action="{{ route('admin.case-studies.store') }}" method="POST" enctype="multipart/form-data">@include('admin.case-studies._form')</form></x-card>
@endsection
