<div class="article-split-cta">
    <div class="article-split-cta-copy">
        <h3 class="article-split-cta-title">{{ $block['title'] }}</h3>
        @if(!empty($block['text']))
            <p class="article-split-cta-text">{{ $block['text'] }}</p>
        @endif
    </div>
    <a
        href="{{ $block['button_url'] }}"
        class="article-split-cta-btn"
        @if(str_starts_with($block['button_url'], 'http')) target="_blank" rel="noreferrer noopener" @endif
    >
        {{ $block['button_label'] }}
    </a>
</div>
