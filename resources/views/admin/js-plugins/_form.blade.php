@csrf
<div class="space-y-4">
    <div class="grid gap-4 md:grid-cols-2">
        <x-form.input name="title" label="Название" :value="$plugin->title" />
        <x-form.input name="slug" label="Слаг" :value="$plugin->slug" />
        <x-form.input name="sort_order" label="Порядок сортировки" type="number" :value="$plugin->sort_order" />

        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-700" for="placement">Где подключать</label>
            <select id="placement" name="placement" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                <option value="head" @selected(old('placement', $plugin->placement) === 'head')>&lt;head&gt;</option>
                <option value="body_end" @selected(old('placement', $plugin->placement) === 'body_end')>Перед &lt;/body&gt;</option>
            </select>
        </div>

        <div class="space-y-2">
            <label class="text-sm font-medium text-slate-700" for="status">Статус</label>
            <select id="status" name="status" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                <option value="draft" @selected(old('status', $plugin->status) === 'draft')>draft</option>
                <option value="published" @selected(old('status', $plugin->status) === 'published')>published</option>
            </select>
        </div>
    </div>

    <div class="space-y-2">
        <label class="text-sm font-medium text-slate-700" for="script_snippet">JS код или скрипт-вставка</label>
        <textarea id="script_snippet" name="script_snippet" rows="14" class="w-full rounded-md border border-slate-300 px-3 py-2 font-mono text-xs">{{ old('script_snippet', $plugin->script_snippet) }}</textarea>
        <p class="text-xs text-slate-500">Можно вставлять как полный <code>&lt;script&gt;...&lt;/script&gt;</code>, так и чистый JS-код.</p>
    </div>

    <x-button type="submit">Сохранить</x-button>
</div>
