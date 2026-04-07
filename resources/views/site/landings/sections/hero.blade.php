<section class="landing-section">
    <div class="landing-hero">
        <div class="landing-hero-grid">
            <div>
                @if(!empty($section['kicker']))
                    <p class="landing-kicker">{{ $section['kicker'] }}</p>
                @endif

                <h1 class="site-title mt-4">{{ $landing->h1 ?: $landing->title }}</h1>

                @if(!empty($section['lead']))
                    <p class="landing-lead">{{ $section['lead'] }}</p>
                @endif

                @if(!empty($section['highlights']) && is_array($section['highlights']))
                    <ul class="landing-highlight-list">
                        @foreach($section['highlights'] as $highlight)
                            <li class="landing-highlight-item">{{ $highlight }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="landing-actions">
                    @if(!empty($section['primary_cta']['label']) && !empty($section['primary_cta']['url']))
                        <a href="{{ $section['primary_cta']['url'] }}" class="btn btn-primary">{{ $section['primary_cta']['label'] }}</a>
                    @endif

                    @if(!empty($section['secondary_cta']['label']) && !empty($section['secondary_cta']['url']))
                        <a href="{{ $section['secondary_cta']['url'] }}" class="btn btn-secondary">{{ $section['secondary_cta']['label'] }}</a>
                    @endif
                </div>
            </div>

            @if(!empty($section['panel_title']) || !empty($section['panel_items']))
                <aside class="landing-hero-panel">
                    @if(!empty($section['panel_title']))
                        <h2 class="landing-hero-panel-title">{{ $section['panel_title'] }}</h2>
                    @endif

                    @if(!empty($section['panel_items']) && is_array($section['panel_items']))
                        <ul class="landing-hero-panel-list">
                            @foreach($section['panel_items'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                </aside>
            @endif
        </div>
    </div>
</section>
