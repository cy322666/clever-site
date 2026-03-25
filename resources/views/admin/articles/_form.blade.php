@csrf
<div class="space-y-4">
    @include('admin.partials.entity-form-base', ['entity' => $article])
    <div class="grid gap-4 md:grid-cols-2">
        <div class="space-y-2"><label class="text-sm">Анонс</label><textarea name="excerpt" rows="3" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('excerpt', $article->excerpt) }}</textarea></div>
        <x-form.input name="published_at" label="Дата публикации" type="datetime-local" :value="optional($article->published_at)->format('Y-m-d\TH:i')" />
    </div>
    <x-button type="submit">Сохранить</x-button>
</div>
