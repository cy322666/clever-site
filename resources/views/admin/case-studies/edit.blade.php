@extends('admin.layouts.app', ['title' => 'Редактировать кейс'])

@section('content')
    <x-card>
        <h1 class="mb-4 text-xl font-semibold">Редактирование кейса</h1>
        <form action="{{ route('admin.case-studies.update', $caseStudy) }}" method="POST" enctype="multipart/form-data">@method('PUT')@include('admin.case-studies._form')</form>
        <form action="{{ route('admin.case-studies.destroy', $caseStudy) }}" method="POST" class="mt-4">@csrf @method('DELETE')<x-button variant="danger" type="submit" onclick="return confirm('Удалить запись?')">Удалить</x-button></form>
    </x-card>
@endsection
