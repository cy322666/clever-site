@csrf

@php
    $publicUrl = $caseStudy->exists ? route('site.case-studies.show', $caseStudy->slug) : null;
    $isPubliclyVisible = $caseStudy->exists
        && $caseStudy->status === 'published'
        && (is_null($caseStudy->published_at) || $caseStudy->published_at->isPast());

    $inputClass = 'w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm outline-none ring-0 transition focus:border-slate-500';
@endphp

<div class="space-y-4" data-slug-generator>
    <x-card>
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Карточка кейса</h2>
                <p class="mt-1 text-sm text-slate-500">Базовая информация для списка и страницы кейса.</p>
            </div>

            @if($caseStudy->exists)
                <div class="flex flex-wrap gap-2">
                    @if($isPubliclyVisible)
                        <x-button variant="secondary" :href="$publicUrl" target="_blank" rel="noreferrer">Открыть кейс</x-button>
                    @else
                        <span class="rounded-md border border-amber-200 bg-amber-50 px-3 py-2 text-xs text-amber-700">Ссылка появится после публикации</span>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="title">Название кейса</label>
                <input id="title" data-slug-source name="title" type="text" value="{{ old('title', $caseStudy->title) }}" class="{{ $inputClass }}">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="slug">Slug</label>
                <input id="slug" data-slug-target name="slug" type="text" value="{{ old('slug', $caseStudy->slug) }}" class="{{ $inputClass }}">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="status">Статус</label>
                <select id="status" name="status" class="{{ $inputClass }}">
                    <option value="draft" @selected(old('status', $caseStudy->status) === 'draft')>Черновик</option>
                    <option value="published" @selected(old('status', $caseStudy->status) === 'published')>Опубликован</option>
                </select>
            </div>

            <x-form.input name="published_at" label="Дата публикации" type="datetime-local" :value="optional($caseStudy->published_at)->format('Y-m-d\TH:i')" />
            <x-form.input name="sort_order" label="Порядок сортировки" type="number" :value="old('sort_order', $caseStudy->sort_order ?? 0)" />
            <x-form.input name="client_name" label="Клиент" :value="old('client_name', $caseStudy->client_name)" />
            <x-form.input name="niche" label="Отрасль" :value="old('niche', $caseStudy->niche)" />

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="short_description">Краткое описание</label>
                <textarea id="short_description" name="short_description" rows="3" class="{{ $inputClass }}">{{ old('short_description', $caseStudy->short_description) }}</textarea>
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="cover_image">Обложка</label>
                <input id="cover_image" name="cover_image" type="file" class="{{ $inputClass }}">

                @if($caseStudy->cover_image)
                    <img src="{{ asset('storage/'.$caseStudy->cover_image) }}" alt="cover" class="h-24 rounded border border-slate-200 object-cover">
                @endif
            </div>
        </div>
    </x-card>

    <x-card>
        <div>
            <h2 class="text-lg font-semibold text-slate-900">Контент кейса</h2>
            <p class="mt-1 text-sm text-slate-500">Основные блоки публичной страницы.</p>
        </div>

        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="result_summary">Краткий результат</label>
                <textarea id="result_summary" name="result_summary" rows="3" class="{{ $inputClass }}">{{ old('result_summary', $caseStudy->result_summary) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="problem_block">Задача клиента</label>
                <textarea id="problem_block" name="problem_block" rows="6" class="{{ $inputClass }}">{{ old('problem_block', $caseStudy->problem_block) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="solution_block">Что сделали</label>
                <textarea id="solution_block" name="solution_block" rows="6" class="{{ $inputClass }}">{{ old('solution_block', $caseStudy->solution_block) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="result_block">Результат</label>
                <textarea id="result_block" name="result_block" rows="6" class="{{ $inputClass }}">{{ old('result_block', $caseStudy->result_block) }}</textarea>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="metrics_block">Цифры и метрики</label>
                <textarea id="metrics_block" name="metrics_block" rows="6" class="{{ $inputClass }}">{{ old('metrics_block', $caseStudy->metrics_block) }}</textarea>
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="full_content">Дополнительный текст</label>
                <textarea id="full_content" name="full_content" rows="6" class="{{ $inputClass }}">{{ old('full_content', $caseStudy->full_content) }}</textarea>
            </div>
        </div>
    </x-card>

    <x-card>
        <div>
            <h2 class="text-lg font-semibold text-slate-900">SEO</h2>
            <p class="mt-1 text-sm text-slate-500">Meta-поля и canonical URL.</p>
        </div>

        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <x-form.input name="seo_title" label="Meta title" :value="old('seo_title', $caseStudy->seo_title)" />

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="canonical_url">Canonical URL</label>
                <input id="canonical_url" name="canonical_url" type="text" value="{{ old('canonical_url', $caseStudy->canonical_url) }}" class="{{ $inputClass }}" placeholder="/case-studies/example-slug или https://example.com/...">
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="seo_description">Meta description</label>
                <textarea id="seo_description" name="seo_description" rows="3" class="{{ $inputClass }}">{{ old('seo_description', $caseStudy->seo_description) }}</textarea>
            </div>
        </div>
    </x-card>

    <div class="flex flex-wrap gap-3">
        <x-button type="submit">Сохранить изменения</x-button>

        @if($isPubliclyVisible)
            <x-button variant="secondary" :href="$publicUrl" target="_blank" rel="noreferrer">Открыть публичную страницу</x-button>
        @endif
    </div>
</div>

@include('admin.partials.slug-preview-script')
