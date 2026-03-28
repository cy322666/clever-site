<section class="landing-section">
    <div class="site-page-hero-box">
        @if(!empty($section['title']))
            <h2 class="landing-section-heading">{{ $section['title'] }}</h2>
        @endif

        @if(!empty($section['items']) && is_array($section['items']))
            <div class="landing-steps mt-6">
                @foreach($section['items'] as $index => $item)
                    <article class="landing-step">
                        <div class="landing-step-index">{{ $index + 1 }}</div>
                        <h3 class="landing-card-title mt-4">{{ $item['title'] ?? 'Этап' }}</h3>
                        @if(!empty($item['text']))
                            <p class="landing-card-text">{{ $item['text'] }}</p>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
