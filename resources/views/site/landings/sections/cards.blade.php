@php
    $sectionId = 'cards-'.substr(md5(($section['title'] ?? '').serialize($section['items'] ?? [])), 0, 8);
    $columns = max(2, min(4, (int) ($section['columns'] ?? 3)));
@endphp

<style>
    .lc-section { padding: 56px 0; }
    .lc-head { max-width: 680px; }
    .lc-kicker { font-family:'Manrope',system-ui,sans-serif; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.14em; color:#f97316; }
    .lc-title { font-family:'Manrope',system-ui,sans-serif; font-size:clamp(28px,3.5vw,44px); font-weight:800; letter-spacing:-.03em; line-height:1.08; color:#111; margin-top:10px; }
    .lc-desc { font-family:'Manrope',system-ui,sans-serif; font-size:15px; line-height:1.7; color:rgba(17,17,17,.5); margin-top:12px; max-width:620px; }
    .lc-grid { display:grid; grid-template-columns:repeat(var(--lc-columns), minmax(0, 1fr)); gap:14px; margin-top:28px; }
    .lc-card { background:#fff; border:1px solid rgba(15,23,42,.08); border-radius:18px; padding:24px; box-shadow:0 14px 34px rgba(15,23,42,.06); min-height:168px; display:flex; flex-direction:column; }
    .lc-num { font-family:'Manrope',system-ui,sans-serif; font-size:12px; font-weight:800; color:#f97316; }
    .lc-card-title { font-family:'Manrope',system-ui,sans-serif; font-size:18px; font-weight:800; letter-spacing:-.02em; color:#111; margin-top:16px; line-height:1.2; }
    .lc-card-text { font-family:'Manrope',system-ui,sans-serif; font-size:14px; line-height:1.65; color:rgba(17,17,17,.52); margin-top:8px; }
    .lc-card-note { margin-top:auto; padding-top:18px; font-family:'Manrope',system-ui,sans-serif; font-size:12px; font-weight:700; color:rgba(17,17,17,.35); text-transform:uppercase; letter-spacing:.08em; }
    .lc-anim { opacity:0; transform:translateY(26px); transition:opacity .7s cubic-bezier(.23,1,.32,1), transform .7s cubic-bezier(.23,1,.32,1); }
    .lc-section.lc-visible .lc-anim { opacity:1; transform:translateY(0); }
    .lc-section-featured { padding:72px 0; }
    .lc-section-featured .lc-head { max-width:760px; }
    .lc-section-featured .lc-grid { gap:18px; margin-top:34px; }
    .lc-section-featured .lc-card { position:relative; min-height:252px; padding:34px; border-color:rgba(249,115,22,.22); box-shadow:0 24px 56px rgba(15,23,42,.1); overflow:hidden; }
    .lc-section-featured .lc-card::before { content:''; position:absolute; left:0; right:0; top:0; height:5px; background:#f97316; }
    .lc-section-featured .lc-num { font-size:13px; }
    .lc-section-featured .lc-card-title { font-size:24px; margin-top:20px; }
    .lc-section-featured .lc-card-text { font-size:16px; line-height:1.7; color:rgba(17,17,17,.58); }

    @media (max-width:1023px) {
        .lc-grid { grid-template-columns:repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width:767px) {
        .lc-section { padding:44px 0; }
        .lc-section-featured { padding:52px 0; }
        .lc-grid { grid-template-columns:1fr; }
        .lc-card { min-height:auto; }
        .lc-section-featured .lc-card { min-height:auto; padding:28px; }
        .lc-section-featured .lc-card-title { font-size:21px; }
        .lc-section-featured .lc-card-text { font-size:15px; }
    }
</style>

<section class="lc-section landing-section {{ ($section['variant'] ?? '') === 'featured' ? 'lc-section-featured' : '' }}" id="{{ $sectionId }}" style="--lc-columns: {{ $columns }}">
    <div class="lc-head">
        @if(!empty($section['kicker']))
            <div class="lc-kicker lc-anim" style="transition-delay:.15s">{{ $section['kicker'] }}</div>
        @endif
        @if(!empty($section['title']))
            <h2 class="lc-title lc-anim" style="transition-delay:.3s">{{ $section['title'] }}</h2>
        @endif
        @if(!empty($section['description']))
            <p class="lc-desc lc-anim" style="transition-delay:.42s">{{ $section['description'] }}</p>
        @endif
    </div>

    @if(!empty($section['items']) && is_array($section['items']))
        <div class="lc-grid">
            @foreach($section['items'] as $index => $item)
                <article class="lc-card lc-anim" style="transition-delay:{{ 0.52 + $index * 0.1 }}s">
                    <div class="lc-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <h3 class="lc-card-title">{{ $item['title'] ?? 'Пункт' }}</h3>
                    @if(!empty($item['text']))
                        <p class="lc-card-text">{{ $item['text'] }}</p>
                    @endif
                    @if(!empty($item['note']))
                        <div class="lc-card-note">{{ $item['note'] }}</div>
                    @endif
                </article>
            @endforeach
        </div>
    @endif
</section>

<script>
(function() {
    var section = document.getElementById(@json($sectionId));
    if (!section) return;
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                section.classList.add('lc-visible');
                observer.unobserve(section);
            }
        });
    }, { threshold: 0.18 });
    observer.observe(section);
})();
</script>
