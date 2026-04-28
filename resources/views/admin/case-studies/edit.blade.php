@extends('admin.layouts.app', ['title' => 'Редактировать кейс'])

@section('content')
    <div class="space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <x-section-header title="Редактирование кейса" subtitle="Обновите карточку, контент и SEO без лишних полей." />
            <x-button variant="secondary" :href="route('admin.case-studies.index')">К списку кейсов</x-button>
        </div>

        <form action="{{ route('admin.case-studies.update', $caseStudy) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @method('PUT')
            @include('admin.case-studies._form')
        </form>

        <x-card>
            <h2 class="text-lg font-semibold text-slate-900">Опасная зона</h2>
            <p class="mt-1 text-sm text-slate-500">Удаление кейса необратимо.</p>

            <form action="{{ route('admin.case-studies.destroy', $caseStudy) }}" method="POST" class="mt-4">
                @csrf
                @method('DELETE')
                <x-button variant="danger" type="submit" onclick="return confirm('Удалить запись?')">Удалить кейс</x-button>
            </form>
        </x-card>
    </div>
@endsection
