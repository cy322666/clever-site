@csrf
<div class="space-y-4">
    @include('admin.partials.entity-form-base', ['entity' => $testimonial])
    <div class="grid gap-4 md:grid-cols-3">
        <x-form.input name="author_name" label="Автор" :value="$testimonial->author_name" />
        <x-form.input name="company_name" label="Компания" :value="$testimonial->company_name" />
        <x-form.input name="role" label="Должность" :value="$testimonial->role" />
    </div>
    <div class="space-y-2"><label class="text-sm">Цитата</label><textarea name="quote" rows="3" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('quote', $testimonial->quote) }}</textarea></div>
    <x-button type="submit">Сохранить</x-button>
</div>
