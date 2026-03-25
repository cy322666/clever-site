@props([
    'title',
    'subtitle' => null,
])

<header class="space-y-2">
    <h2 class="text-2xl font-semibold text-slate-900 md:text-3xl">{{ $title }}</h2>
    @if($subtitle)
        <p class="max-w-3xl text-sm text-slate-600 md:text-base">{{ $subtitle }}</p>
    @endif
</header>
