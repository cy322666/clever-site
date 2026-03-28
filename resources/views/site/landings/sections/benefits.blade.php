<section class="landing-section">
    <div class="site-page-hero-box">
        @if(!empty($section['title']))
            <h2 class="landing-section-heading">{{ $section['title'] }}</h2>
        @endif

        @if(!empty($section['description']))
            <p class="landing-section-copy">{{ $section['description'] }}</p>
        @endif

        @if(!empty($section['items']) && is_array($section['items']))
            <div class="landing-grid mt-6">
                @foreach($section['items'] as $item)
                    <article class="landing-card">
                        <h3 class="landing-card-title">{{ $item['title'] ?? 'Преимущество' }}</h3>
                        @if(!empty($item['text']))
                            <p class="landing-card-text">{{ $item['text'] }}</p>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
