@php($level = (int) ($block['level'] ?? 2))

@if($level === 3)
    <h3 class="text-xl font-semibold tracking-tight text-slate-900 md:text-2xl">{{ $block['text'] }}</h3>
@else
    <h2 class="text-2xl font-semibold tracking-tight text-slate-900 md:text-3xl">{{ $block['text'] }}</h2>
@endif
