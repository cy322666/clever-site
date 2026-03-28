<div class="rounded-[28px] bg-slate-950 px-6 py-6 text-white md:px-8">
    <h3 class="text-2xl font-semibold tracking-tight">{{ $block['title'] }}</h3>
    @if(!empty($block['text']))
        <p class="mt-3 max-w-3xl text-sm leading-7 text-white/74 md:text-base">{{ $block['text'] }}</p>
    @endif
    <a
        href="{{ $block['button_url'] }}"
        class="btn mt-5 bg-[#ff9b3d] text-slate-950 hover:bg-[#ffb15f]"
        @if(str_starts_with($block['button_url'], 'http')) target="_blank" rel="noreferrer noopener" @endif
    >
        {{ $block['button_label'] }}
    </a>
</div>
