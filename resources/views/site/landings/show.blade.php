@extends('site.layouts.app', [
    'title' => $landing->seoTitle(),
    'metaDescription' => $landing->seoDescription(),
    'canonical' => $landing->canonicalUrl(),
    'robots' => 'index,follow',
])

@section('content')
    @foreach($sections as $section)
        @if(($section['data']['type'] ?? '') === 'steps')
            @include($section['view'], [
                'landing' => $landing,
                'section' => $section['data'],
            ])
        @else
            <div class="container-wrap landing-shell">
                @include($section['view'], [
                    'landing' => $landing,
                    'section' => $section['data'],
                ])
            </div>
        @endif
    @endforeach

    <div class="container-wrap landing-shell">
        @include('site.partials.landing-form', [
            'landing' => $landing,
            'formConfig' => $formConfig,
        ])

        @if($relatedLandings->isNotEmpty())
            <style>
                .rl-section { padding:48px 0; }
                .rl-kicker { font-family:'Manrope',system-ui,sans-serif; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.14em; color:#f97316; }
                .rl-title { font-family:'Manrope',system-ui,sans-serif; font-size:clamp(28px,3.5vw,42px); font-weight:800; letter-spacing:-.03em; line-height:1.1; color:#111; margin-top:10px; }
                .rl-desc { font-family:'Manrope',system-ui,sans-serif; font-size:15px; line-height:1.7; color:rgba(17,17,17,.45); margin-top:8px; }
                .rl-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-top:28px; }
                .rl-card { background:#fff; border:1px solid rgba(0,0,0,.04); border-radius:22px; padding:28px; box-shadow:0 8px 32px rgba(0,0,0,.06), 0 2px 8px rgba(0,0,0,.03); transition:all .3s; text-decoration:none; display:flex; flex-direction:column; }
                .rl-card:hover { transform:translateY(-4px); box-shadow:0 16px 48px rgba(0,0,0,.1); border-color:rgba(249,115,22,.12); }
                .rl-card-kicker { font-family:'Manrope',system-ui,sans-serif; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.1em; color:#f97316; }
                .rl-card-title { font-family:'Manrope',system-ui,sans-serif; font-size:18px; font-weight:700; letter-spacing:-.02em; color:#111; margin-top:12px; }
                .rl-card-text { font-family:'Manrope',system-ui,sans-serif; font-size:14px; line-height:1.6; color:rgba(17,17,17,.45); margin-top:8px; flex:1; }
                .rl-card-link { font-family:'Manrope',system-ui,sans-serif; font-size:14px; font-weight:600; color:#f97316; text-decoration:none; display:inline-flex; align-items:center; gap:4px; margin-top:16px; transition:gap .2s; }
                .rl-card-link:hover { gap:8px; }
                .rl-card-link::after { content:'→'; }

                .rl-anim { opacity:0; transform:translateY(28px); transition:opacity .7s cubic-bezier(.23,1,.32,1), transform .7s cubic-bezier(.23,1,.32,1); }
                .rl-section.rl-visible .rl-anim { opacity:1; transform:translateY(0); }

                @media (max-width:767px) {
                    .rl-grid { grid-template-columns:1fr; }
                }
            </style>

            <section class="rl-section" id="rl-section">
                <div class="rl-kicker rl-anim" style="transition-delay:.2s">Ещё</div>
                <h2 class="rl-title rl-anim" style="transition-delay:.35s">Другие услуги и решения</h2>
                <p class="rl-desc rl-anim" style="transition-delay:.45s">Соседние решения по внедрению, автоматизации и типовым проблемам в продажах.</p>

                <div class="rl-grid">
                    @foreach($relatedLandings as $index => $relatedLanding)
                        <div class="rl-card rl-anim" style="transition-delay:{{ 0.6 + $index * 0.15 }}s">
                            <div class="rl-card-kicker">{{ $relatedLanding['page_type_label'] }}</div>
                            <h3 class="rl-card-title">{{ strip_tags($relatedLanding['title']) }}</h3>
                            <p class="rl-card-text">{{ $relatedLanding['excerpt'] }}</p>
                            <a href="{{ $relatedLanding['url'] }}" class="rl-card-link">{{ $relatedLanding['anchor_text'] }}</a>
                        </div>
                    @endforeach
                </div>
            </section>

            <script>
            (function() {
                var section = document.getElementById('rl-section');
                if (!section) return;
                var observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            section.classList.add('rl-visible');
                            observer.unobserve(section);
                        }
                    });
                }, { threshold: 0.2 });
                observer.observe(section);
            })();
            </script>
        @endif
    </div>
@endsection
