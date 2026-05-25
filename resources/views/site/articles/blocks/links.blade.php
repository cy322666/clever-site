<div class="article-related-links">
    @if(!empty($block['title']))
        <h3 class="article-related-links-title">{{ $block['title'] }}</h3>
    @endif

    <div class="article-related-links-grid">
        @foreach($block['items'] as $item)
            <a
                href="{{ $item['url'] }}"
                class="article-related-card"
                @if(str_starts_with($item['url'], 'http')) target="_blank" rel="noreferrer noopener" @endif
            >
                <div class="article-related-meta">
                    @if(!empty($item['badge']))
                        <span>{{ $item['badge'] }}</span>
                    @endif
                    <span>CRM</span>
                </div>
                <h3 class="article-related-card-title">{{ $item['title'] }}</h3>
                @if(!empty($item['description']))
                    <p class="article-related-card-text">{{ $item['description'] }}</p>
                @endif
                <div class="article-related-card-foot">
                    <span class="article-related-card-url">{{ $item['url'] }}</span>
                    <span class="article-related-card-arrow">→</span>
                </div>
            </a>
        @endforeach
    </div>
</div>
