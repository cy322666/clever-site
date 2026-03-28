<div class="space-y-4">
    @if(!empty($block['title']))
        <h3 class="text-xl font-semibold tracking-tight text-slate-900">{{ $block['title'] }}</h3>
    @endif

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @foreach($block['items'] as $item)
            <a
                href="{{ $item['url'] }}"
                class="site-card no-underline"
                @if(str_starts_with($item['url'], 'http')) target="_blank" rel="noreferrer noopener" @endif
            >
                @if(!empty($item['badge']))
                    <p class="site-kicker">{{ $item['badge'] }}</p>
                @endif
                <h3 class="site-card-title mt-3">{{ $item['title'] }}</h3>
                @if(!empty($item['description']))
                    <p class="site-card-text">{{ $item['description'] }}</p>
                @endif
                <span class="site-link">Открыть</span>
            </a>
        @endforeach
    </div>
</div>
