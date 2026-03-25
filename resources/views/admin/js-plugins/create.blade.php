@extends('admin.layouts.app', ['title' => 'Создать JS плагин'])

@section('content')
    <x-card>
        <h1 class="mb-4 text-xl font-semibold">Новый JS плагин</h1>
        <form action="{{ route('admin.js-plugins.store') }}" method="POST">
            @include('admin.js-plugins._form')
        </form>
    </x-card>
@endsection
