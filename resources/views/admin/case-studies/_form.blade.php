@csrf
<div class="space-y-4">
    @include('admin.partials.entity-form-base', ['entity' => $caseStudy])

    <div class="grid gap-4 md:grid-cols-2">
        <x-form.input name="client_name" label="Клиент" :value="$caseStudy->client_name" />
        <x-form.input name="niche" label="Ниша" :value="$caseStudy->niche" />
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div class="space-y-2"><label class="text-sm">Краткий результат</label><textarea name="result_summary" rows="4" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('result_summary', $caseStudy->result_summary) }}</textarea></div>
        <div class="space-y-2"><label class="text-sm">Блок: проблема</label><textarea name="problem_block" rows="4" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('problem_block', $caseStudy->problem_block) }}</textarea></div>
        <div class="space-y-2"><label class="text-sm">Блок: решение</label><textarea name="solution_block" rows="4" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('solution_block', $caseStudy->solution_block) }}</textarea></div>
    </div>

    <div class="space-y-2"><label class="text-sm">Блок: результат</label><textarea name="result_block" rows="4" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('result_block', $caseStudy->result_block) }}</textarea></div>

    <x-button type="submit">Сохранить</x-button>
</div>
