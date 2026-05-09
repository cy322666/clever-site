@php
    $sectionId = 'case-examples-'.substr(md5(($section['title'] ?? '').serialize($section['items'] ?? [])), 0, 8);
@endphp

<style>
    .ce-section { padding:64px 0; }
    .ce-shell { background:#111; color:#fff; border-radius:28px; padding:44px; position:relative; overflow:hidden; }
    .ce-shell::before { content:''; position:absolute; inset:0; background:linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px); background-size:44px 44px; pointer-events:none; }
    .ce-head { position:relative; z-index:1; max-width:680px; }
    .ce-kicker { font-family:'Manrope',system-ui,sans-serif; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.14em; color:rgba(249,115,22,.85); }
    .ce-title { font-family:'Manrope',system-ui,sans-serif; font-size:clamp(28px,3.5vw,44px); font-weight:800; letter-spacing:-.03em; line-height:1.08; color:#fff; margin-top:10px; }
    .ce-desc { font-family:'Manrope',system-ui,sans-serif; font-size:15px; line-height:1.7; color:rgba(255,255,255,.48); margin-top:12px; max-width:620px; }
    .ce-grid { position:relative; z-index:1; display:grid; grid-template-columns:repeat(3, minmax(0, 1fr)); gap:14px; margin-top:30px; }
    .ce-card { background:rgba(255,255,255,.06); border:1px solid rgba(255,255,255,.1); border-radius:18px; padding:24px; min-height:236px; display:flex; flex-direction:column; text-decoration:none; color:#fff !important; transition:transform .25s, border-color .25s, background .25s; }
    .ce-card:hover { transform:translateY(-3px); border-color:rgba(249,115,22,.55); background:rgba(255,255,255,.08); }
    .ce-label { font-family:'Manrope',system-ui,sans-serif; font-size:11px; font-weight:800; color:#f97316; text-transform:uppercase; letter-spacing:.1em; }
    .ce-card-title { font-family:'Manrope',system-ui,sans-serif; font-size:19px; font-weight:800; letter-spacing:-.02em; line-height:1.18; color:#fff; margin-top:14px; }
    .ce-card-text { font-family:'Manrope',system-ui,sans-serif; font-size:14px; line-height:1.65; color:rgba(255,255,255,.5); margin-top:10px; }
    .ce-result { margin-top:auto; padding-top:18px; font-family:'Manrope',system-ui,sans-serif; font-size:13px; line-height:1.45; color:rgba(255,255,255,.76); }
    .ce-result strong { color:#fff; }
    .ce-link { display:inline-flex; align-items:center; gap:6px; margin-top:24px; font-family:'Manrope',system-ui,sans-serif; font-size:14px; font-weight:700; color:#f97316; text-decoration:none; }
    .ce-link::after { content:'→'; transition:transform .2s; }
    .ce-link:hover::after { transform:translateX(4px); }
    .ce-anim { opacity:0; transform:translateY(26px); transition:opacity .7s cubic-bezier(.23,1,.32,1), transform .7s cubic-bezier(.23,1,.32,1); }
    .ce-section.ce-visible .ce-anim { opacity:1; transform:translateY(0); }

    @media (max-width:1023px) {
        .ce-grid { grid-template-columns:1fr; }
        .ce-card { min-height:auto; }
    }

    @media (max-width:767px) {
        .ce-section { padding:48px 0; }
        .ce-shell { border-radius:22px; padding:30px 20px; }
    }
</style>

<section class="ce-section landing-section" id="{{ $sectionId }}">
    <div class="ce-shell">
        <div class="ce-head">
            @if(!empty($section['kicker']))
                <div class="ce-kicker ce-anim" style="transition-delay:.15s">{{ $section['kicker'] }}</div>
            @endif
            @if(!empty($section['title']))
                <h2 class="ce-title ce-anim" style="transition-delay:.3s">{{ $section['title'] }}</h2>
            @endif
            @if(!empty($section['description']))
                <p class="ce-desc ce-anim" style="transition-delay:.42s">{{ $section['description'] }}</p>
            @endif
        </div>

        @if(!empty($section['items']) && is_array($section['items']))
            <div class="ce-grid">
                @foreach($section['items'] as $index => $item)
                    @php $tag = empty($item['url']) ? 'article' : 'a'; @endphp
                    <{{ $tag }} @if(!empty($item['url'])) href="{{ $item['url'] }}" @endif class="ce-card ce-anim" style="transition-delay:{{ 0.56 + $index * 0.12 }}s">
                        @if(!empty($item['label']))
                            <div class="ce-label">{{ $item['label'] }}</div>
                        @endif
                        <h3 class="ce-card-title">{{ $item['title'] ?? 'Кейс' }}</h3>
                        @if(!empty($item['text']))
                            <p class="ce-card-text">{{ $item['text'] }}</p>
                        @endif
                        @if(!empty($item['result']))
                            <div class="ce-result"><strong>Итог:</strong> {{ $item['result'] }}</div>
                        @endif
                    </{{ $tag }}>
                @endforeach
            </div>
        @endif

        @if(!empty($section['link']['label']) && !empty($section['link']['url']))
            <a href="{{ $section['link']['url'] }}" class="ce-link ce-anim" style="transition-delay:.95s">{{ $section['link']['label'] }}</a>
        @endif
    </div>
</section>

<script>
(function() {
    var section = document.getElementById(@json($sectionId));
    if (!section) return;
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                section.classList.add('ce-visible');
                observer.unobserve(section);
            }
        });
    }, { threshold: 0.16 });
    observer.observe(section);
})();
</script>
