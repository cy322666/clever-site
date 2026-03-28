@php($tag = ($block['style'] ?? 'unordered') === 'ordered' ? 'ol' : 'ul')

<{{ $tag }} class="space-y-3 pl-5 text-base leading-8 text-slate-700 {{ $tag === 'ol' ? 'list-decimal' : 'list-disc' }}">
    @foreach($block['items'] as $item)
        <li>{{ $item }}</li>
    @endforeach
</{{ $tag }}>
