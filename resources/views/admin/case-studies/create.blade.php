@extends('admin.layouts.app', ['title' => 'Создать кейс'])

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <x-section-header title="Новый кейс" subtitle="Заполните базовые поля, затем контент и SEO." />
            <x-button variant="secondary" :href="route('admin.case-studies.index')">К списку кейсов</x-button>
        </div>

        <form action="{{ route('admin.case-studies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @include('admin.case-studies._form')
        </form>
    </div>
@endsection
