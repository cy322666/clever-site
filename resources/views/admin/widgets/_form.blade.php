@csrf
<div class="space-y-4">
    @include('admin.partials.entity-form-base', ['entity' => $widget, 'showCoverImage' => false])
    <div class="grid gap-4 md:grid-cols-3">
        <x-form.input name="price_text" label="Текст цены" :value="$widget->price_text" />
        <x-form.input name="platform_compatibility" label="Совместимость с платформами" :value="$widget->platform_compatibility" />
        <x-form.input name="external_link" label="Внешняя ссылка" :value="$widget->external_link" />
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-700" for="cover_image">Изображение 1</label>
            <input id="cover_image" name="cover_image" type="file" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
            @if($widget->cover_image)
                <img src="{{ asset('storage/'.$widget->cover_image) }}" alt="image 1" class="h-24 w-full rounded border border-slate-200 object-cover">
            @endif
        </div>

        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-700" for="gallery_image_2">Изображение 2</label>
            <input id="gallery_image_2" name="gallery_image_2" type="file" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
            @if($widget->gallery_image_2)
                <img src="{{ asset('storage/'.$widget->gallery_image_2) }}" alt="image 2" class="h-24 w-full rounded border border-slate-200 object-cover">
            @endif
        </div>

        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-700" for="gallery_image_3">Изображение 3</label>
            <input id="gallery_image_3" name="gallery_image_3" type="file" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
            @if($widget->gallery_image_3)
                <img src="{{ asset('storage/'.$widget->gallery_image_3) }}" alt="image 3" class="h-24 w-full rounded border border-slate-200 object-cover">
            @endif
        </div>
    </div>

    <x-button type="submit">Сохранить</x-button>
</div>
