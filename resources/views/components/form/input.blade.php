@props([
    'label' => null,
    'name',
    'type' => 'text',
    'value' => '',
])

<div class="space-y-2">
    @if($label)
        <label for="{{ $name }}" class="text-sm font-medium text-slate-700">{{ $label }}</label>
    @endif

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm outline-none ring-0 transition focus:border-slate-500']) }}
    >

    @error($name)
        <p class="text-xs text-red-600">{{ $message }}</p>
    @enderror
</div>
