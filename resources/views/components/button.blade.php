@props([
    'variant' => 'primary',
    'href' => null,
])

@php
    $classes = [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'danger' => 'btn-danger',
        'ghost' => 'btn-ghost',
    ][$variant] ?? 'btn-primary';
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "btn {$classes}"]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => "btn {$classes}"]) }}>
        {{ $slot }}
    </button>
@endif
