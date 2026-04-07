<figure class="space-y-3">
    <img
        src="{{ $block['image_url'] }}"
        alt="{{ $block['alt'] ?? '' }}"
        class="w-full rounded-2xl border border-slate-200 object-cover shadow-sm"
    >
    @if(!empty($block['caption']))
        <figcaption class="text-sm leading-6 text-slate-500">{{ $block['caption'] }}</figcaption>
    @endif
</figure>
