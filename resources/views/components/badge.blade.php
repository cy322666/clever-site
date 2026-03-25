@props(['status'])

@php
    $classes = $status === 'published'
        ? 'bg-emerald-100 text-emerald-700'
        : 'bg-slate-200 text-slate-700';
@endphp

<span class="inline-flex rounded-full px-2 py-1 text-xs font-medium {{ $classes }}">
    {{ $status }}
</span>
