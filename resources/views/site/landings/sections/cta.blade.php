<section class="landing-section">
    <div class="landing-cta">
        @if(!empty($section['title']))
            <h2 class="landing-cta-title">{{ $section['title'] }}</h2>
        @endif

        @if(!empty($section['text']))
            <p class="landing-cta-text">{{ $section['text'] }}</p>
        @endif

        <div class="landing-actions">
            @if(!empty($section['primary_cta']['label']) && !empty($section['primary_cta']['url']))
                <a href="{{ $section['primary_cta']['url'] }}" class="btn bg-white text-slate-950 hover:bg-orange-50">{{ $section['primary_cta']['label'] }}</a>
            @endif

            @if(!empty($section['secondary_cta']['label']) && !empty($section['secondary_cta']['url']))
                <a href="{{ $section['secondary_cta']['url'] }}" class="btn border border-white/20 bg-white/5 text-white hover:bg-white/10">{{ $section['secondary_cta']['label'] }}</a>
            @endif
        </div>
    </div>
</section>
