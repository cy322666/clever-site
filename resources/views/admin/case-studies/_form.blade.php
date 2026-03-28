@csrf
@php
    $publicUrl = $caseStudy->exists ? route('site.case-studies.show', $caseStudy->slug) : null;
    $isPubliclyVisible = $caseStudy->exists
        && $caseStudy->status === 'published'
        && (is_null($caseStudy->published_at) || $caseStudy->published_at->isPast());
@endphp

<div class="space-y-6" data-slug-generator>
    <x-card>
        <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Основное</h2>
                <p class="mt-1 text-sm text-slate-500">Название кейса, slug, статус публикации и краткий контекст проекта</p>
            </div>

            @if($caseStudy->exists)
                <div class="flex flex-wrap gap-2">
                    @if($isPubliclyVisible)
                        <x-button variant="secondary" :href="$publicUrl" target="_blank" rel="noreferrer">Открыть кейс</x-button>
                        <span class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-500">{{ $publicUrl }}</span>
                    @else
                        <span class="rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-xs text-amber-700">Публичная ссылка появится после публикации</span>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-5 grid gap-4 md:grid-cols-2">
            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="title">Название кейса</label>
                <input id="title" data-slug-source name="title" type="text" value="{{ old('title', $caseStudy->title) }}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="slug">Slug</label>
                <input id="slug" data-slug-target name="slug" type="text" value="{{ old('slug', $caseStudy->slug) }}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                <p class="text-xs text-slate-500">Заполняется автоматически, но можно скорректировать вручную</p>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="status">Статус</label>
                <select id="status" name="status" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                    <option value="draft" @selected(old('status', $caseStudy->status) === 'draft')>draft</option>
                    <option value="published" @selected(old('status', $caseStudy->status) === 'published')>published</option>
                </select>
            </div>

            <x-form.input name="published_at" label="Дата публикации" type="datetime-local" :value="optional($caseStudy->published_at)->format('Y-m-d\TH:i')" />
            <x-form.input name="sort_order" label="Порядок сортировки" type="number" :value="old('sort_order', $caseStudy->sort_order ?? 0)" />
            <x-form.input name="client_name" label="Клиент" :value="old('client_name', $caseStudy->client_name)" />
            <x-form.input name="niche" label="Отрасль" :value="old('niche', $caseStudy->niche)" />

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="short_description">Краткое описание / excerpt</label>
                <textarea id="short_description" name="short_description" rows="3" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('short_description', $caseStudy->short_description) }}</textarea>
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="cover_image">Обложка</label>
                <input id="cover_image" name="cover_image" type="file" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                @if($caseStudy->cover_image)
                    <img src="{{ asset('storage/'.$caseStudy->cover_image) }}" alt="cover" class="h-24 rounded border border-slate-200 object-cover">
                @endif
            </div>
        </div>
    </x-card>

    <x-card>
        <div class="space-y-1">
            <h2 class="text-lg font-semibold text-slate-900">Содержание кейса</h2>
            <p class="text-sm text-slate-500">Эти поля формируют публичную страницу и помогают быстро показать бизнес-контекст проекта</p>
        </div>

        <div class="mt-5 grid gap-4 md:grid-cols-2">
            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="result_summary">Краткий результат</label>
                <textarea id="result_summary" name="result_summary" rows="3" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('result_summary', $caseStudy->result_summary) }}</textarea>
                <p class="text-xs text-slate-500">Короткая выжимка для карточек и hero кейса</p>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="problem_block">Задача клиента</label>
                <textarea id="problem_block" name="problem_block" rows="6" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('problem_block', $caseStudy->problem_block) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="solution_block">Что сделали</label>
                <textarea id="solution_block" name="solution_block" rows="6" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('solution_block', $caseStudy->solution_block) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="result_block">Результат</label>
                <textarea id="result_block" name="result_block" rows="6" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('result_block', $caseStudy->result_block) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="metrics_block">Цифры / метрики</label>
                <textarea id="metrics_block" name="metrics_block" rows="6" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('metrics_block', $caseStudy->metrics_block) }}</textarea>
                <p class="text-xs text-slate-500">Например: рост конверсии, срок ответа, количество обработанных лидов, выручка</p>
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="full_content">Дополнительный текст кейса</label>
                <textarea id="full_content" name="full_content" rows="6" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('full_content', $caseStudy->full_content) }}</textarea>
            </div>
        </div>
    </x-card>

    <x-card>
        <div class="space-y-1">
            <h2 class="text-lg font-semibold text-slate-900">SEO</h2>
            <p class="text-sm text-slate-500">SEO-поля и optional canonical для точной настройки индексации</p>
        </div>

        <div class="mt-5 grid gap-4 md:grid-cols-2">
            <x-form.input name="seo_title" label="Meta title" :value="old('seo_title', $caseStudy->seo_title)" />

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="canonical_url">Canonical</label>
                <input id="canonical_url" name="canonical_url" type="text" value="{{ old('canonical_url', $caseStudy->canonical_url) }}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm" placeholder="/case-studies/example-slug или https://example.com/...">
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="seo_description">Meta description</label>
                <textarea id="seo_description" name="seo_description" rows="3" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('seo_description', $caseStudy->seo_description) }}</textarea>
            </div>
        </div>
    </x-card>

    <div class="flex flex-wrap gap-3">
        <x-button type="submit">Сохранить</x-button>
        @if($isPubliclyVisible)
            <x-button variant="secondary" :href="$publicUrl" target="_blank" rel="noreferrer">Открыть публичную страницу</x-button>
        @endif
    </div>
</div>

@include('admin.partials.slug-preview-script')
