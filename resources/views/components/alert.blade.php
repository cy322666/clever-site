@props(['type' => 'success'])

@php
    $classes = $type === 'error'
        ? 'border-red-200 bg-red-50 text-red-700'
        : 'border-emerald-200 bg-emerald-50 text-emerald-700';
@endphp

<div {{ $attributes->merge(['class' => "rounded-md border px-4 py-3 text-sm {$classes}"]) }}>
    {{ $slot }}
</div>
