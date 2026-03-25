@csrf
<div class="space-y-4">
    @include('admin.partials.entity-form-base', ['entity' => $faq])
    <x-form.input name="question" label="Вопрос" :value="$faq->question" />
    <div class="space-y-2"><label class="text-sm">Ответ</label><textarea name="answer" rows="5" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('answer', $faq->answer) }}</textarea></div>
    <x-button type="submit">Сохранить</x-button>
</div>
