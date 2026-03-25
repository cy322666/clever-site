@csrf
<div class="space-y-4">
    @include('admin.partials.entity-form-base', ['entity' => $widget])
    <div class="grid gap-4 md:grid-cols-3">
        <x-form.input name="price_text" label="Текст цены" :value="$widget->price_text" />
        <x-form.input name="platform_compatibility" label="Совместимость с платформами" :value="$widget->platform_compatibility" />
        <x-form.input name="external_link" label="Внешняя ссылка" :value="$widget->external_link" />
    </div>
    <x-button type="submit">Сохранить</x-button>
</div>
