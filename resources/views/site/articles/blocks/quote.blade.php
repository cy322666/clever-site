<figure class="rounded-2xl border-l-4 border-slate-900 bg-slate-50 px-6 py-5">
    <blockquote class="text-lg leading-8 text-slate-800">
        “{{ $block['text'] }}”
    </blockquote>
    @if(!empty($block['author']))
        <figcaption class="mt-3 text-sm font-medium text-slate-500">{{ $block['author'] }}</figcaption>
    @endif
</figure>
