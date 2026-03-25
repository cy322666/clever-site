@csrf
<div class="space-y-4">
    @include('admin.partials.entity-form-base', ['entity' => $service])

    <div class="grid gap-4 md:grid-cols-2">
        <x-form.input name="icon_name" label="Имя иконки" :value="$service->icon_name" />
        <x-form.input name="short_label" label="Короткая метка" :value="$service->short_label" />
    </div>

    <x-button type="submit">Сохранить</x-button>
</div>
