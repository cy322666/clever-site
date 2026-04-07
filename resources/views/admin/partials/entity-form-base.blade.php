@props([
    'entity',
    'showFullContent' => true,
    'showCoverImage' => true,
])

<div class="grid gap-4 md:grid-cols-2">
    <x-form.input name="title" label="Название" :value="$entity->title" />
    <x-form.input name="slug" label="Слаг" :value="$entity->slug" />
    <x-form.input name="sort_order" label="Порядок сортировки" type="number" :value="$entity->sort_order" />

    <div class="space-y-2">
        <label class="text-sm font-medium text-slate-700" for="status">Статус</label>
        <select id="status" name="status" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
            <option value="draft" @selected(old('status', $entity->status) === 'draft')>draft</option>
            <option value="published" @selected(old('status', $entity->status) === 'published')>published</option>
        </select>
    </div>

    <x-form.input name="seo_title" label="SEO заголовок" :value="$entity->seo_title" />
    <div class="space-y-2 md:col-span-2">
        <label class="text-sm font-medium text-slate-700" for="seo_description">SEO описание</label>
        <textarea id="seo_description" name="seo_description" rows="2" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('seo_description', $entity->seo_description) }}</textarea>
    </div>

    <div class="space-y-2 md:col-span-2">
        <label class="text-sm font-medium text-slate-700" for="short_description">Краткое описание</label>
        <textarea id="short_description" name="short_description" rows="3" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('short_description', $entity->short_description) }}</textarea>
    </div>

    @if($showFullContent)
        <div class="space-y-2 md:col-span-2">
            <label class="text-sm font-medium text-slate-700" for="full_content">Полное содержание</label>
            <textarea id="full_content" name="full_content" rows="6" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('full_content', $entity->full_content) }}</textarea>
        </div>
    @endif

    @if($showCoverImage)
        <div class="space-y-2 md:col-span-2">
            <label class="text-sm font-medium text-slate-700" for="cover_image">Обложка</label>
            <input id="cover_image" name="cover_image" type="file" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
            @if($entity->cover_image)
                <img src="{{ asset('storage/'.$entity->cover_image) }}" alt="cover" class="h-24 rounded border border-slate-200 object-cover">
            @endif
        </div>
    @endif
</div>
