@csrf

@php
    $publicUrl = $article->exists ? route('site.articles.show', $article->slug) : null;
    $isPubliclyVisible = $article->exists
        && $article->status === 'published'
        && (is_null($article->published_at) || $article->published_at->isPast());
@endphp

<div class="space-y-6" data-slug-generator>
    <x-card>
        <div class="flex flex-col gap-3 md:flex-row md:items-start md:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Основное</h2>
                <p class="mt-1 text-sm text-slate-500">Заголовок, slug, статус публикации и короткое описание статьи</p>
            </div>

            @if($article->exists)
                <div class="flex flex-wrap gap-2">
                    @if($isPubliclyVisible)
                        <x-button variant="secondary" :href="$publicUrl" target="_blank" rel="noreferrer">Открыть статью</x-button>
                        <span class="rounded-xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-500">{{ $publicUrl }}</span>
                    @else
                        <span class="rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-xs text-amber-700">Публичная ссылка появится после публикации</span>
                    @endif
                </div>
            @endif
        </div>

        <div class="mt-5 grid gap-4 md:grid-cols-2">
            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="title">Заголовок статьи</label>
                <input id="title" data-slug-source name="title" type="text" value="{{ old('title', $article->title) }}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="slug">Slug</label>
                <input id="slug" data-slug-target name="slug" type="text" value="{{ old('slug', $article->slug) }}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                <p class="text-xs text-slate-500">Заполняется автоматически из заголовка, но можно отредактировать вручную</p>
            </div>

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="status">Статус</label>
                <select id="status" name="status" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                    <option value="draft" @selected(old('status', $article->status) === 'draft')>draft</option>
                    <option value="published" @selected(old('status', $article->status) === 'published')>published</option>
                </select>
            </div>

            <x-form.input name="published_at" label="Дата публикации" type="datetime-local" :value="optional($article->published_at)->format('Y-m-d\TH:i')" />
            <x-form.input name="sort_order" label="Порядок сортировки" type="number" :value="old('sort_order', $article->sort_order ?? 0)" />

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="excerpt">Короткое описание / excerpt</label>
                <textarea id="excerpt" name="excerpt" rows="3" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('excerpt', $article->excerpt) }}</textarea>
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="short_description">Дополнительное краткое описание</label>
                <textarea id="short_description" name="short_description" rows="3" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('short_description', $article->short_description) }}</textarea>
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="cover_image">Обложка</label>
                <input id="cover_image" name="cover_image" type="file" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                @if($article->cover_image)
                    <img src="{{ asset('storage/'.$article->cover_image) }}" alt="cover" class="h-24 rounded border border-slate-200 object-cover">
                @endif
            </div>
        </div>
    </x-card>

    <x-card>
        <div class="space-y-1">
            <h2 class="text-lg font-semibold text-slate-900">Контент статьи</h2>
            <p class="text-sm text-slate-500">Основной публичный рендер работает из блоков ниже</p>
        </div>

        <div class="mt-5">
            @include('admin.articles._blocks-editor')
        </div>

        <div class="mt-5 space-y-2">
            <label class="text-sm font-medium text-slate-700" for="full_content">Legacy текст статьи</label>
            <textarea id="full_content" name="full_content" rows="6" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('full_content', $article->full_content) }}</textarea>
            <p class="text-xs text-slate-500">Оставлено для совместимости со старыми материалами и миграции контента</p>
        </div>
    </x-card>

    <x-card>
        <div class="space-y-1">
            <h2 class="text-lg font-semibold text-slate-900">SEO</h2>
            <p class="text-sm text-slate-500">SEO-метаданные и optional canonical для управления выдачей</p>
        </div>

        <div class="mt-5 grid gap-4 md:grid-cols-2">
            <x-form.input name="seo_title" label="Meta title" :value="old('seo_title', $article->seo_title)" />

            <div class="space-y-2">
                <label class="text-sm font-medium text-slate-700" for="canonical_url">Canonical</label>
                <input id="canonical_url" name="canonical_url" type="text" value="{{ old('canonical_url', $article->canonical_url) }}" class="w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm" placeholder="/articles/example-slug или https://example.com/...">
            </div>

            <div class="space-y-2 md:col-span-2">
                <label class="text-sm font-medium text-slate-700" for="seo_description">Meta description</label>
                <textarea id="seo_description" name="seo_description" rows="3" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('seo_description', $article->seo_description) }}</textarea>
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
