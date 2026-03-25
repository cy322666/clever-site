@extends('admin.layouts.app', ['title' => 'Создать услугу'])

@section('content')
    <x-card>
        <h1 class="mb-4 text-xl font-semibold">Новая услуга</h1>
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.services._form')
        </form>
    </x-card>
@endsection
