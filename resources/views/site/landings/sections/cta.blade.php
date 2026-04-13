<style>
    .ct-wrap { background:#111; border-radius:28px; padding:44px 48px; color:#fff; display:flex; align-items:center; justify-content:space-between; gap:32px; position:relative; overflow:hidden; }
    .ct-wrap::before { content:''; position:absolute; inset:0; pointer-events:none; background:linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px); background-size:44px 44px; }
    .ct-left { position:relative; z-index:1; }
    .ct-title { font-family:'Manrope',system-ui,sans-serif; font-size:clamp(24px,3vw,32px); font-weight:800; letter-spacing:-.03em; color:#fff; }
    .ct-text { font-family:'Manrope',system-ui,sans-serif; font-size:14px; color:rgba(255,255,255,.4); margin-top:8px; }
    .ct-actions { display:flex; gap:12px; flex-shrink:0; position:relative; z-index:1; }
    .ct-btn { display:inline-flex; align-items:center; justify-content:center; padding:16px 32px; border-radius:14px; font-family:'Manrope',system-ui,sans-serif; font-size:15px; font-weight:600; text-decoration:none; background:#f97316; color:#fff !important; border:none; cursor:pointer; transition:all .25s; }
    .ct-btn:hover { background:#ea6c0e; transform:translateY(-1px); }
    .ct-btn-ghost { display:inline-flex; align-items:center; justify-content:center; padding:16px 32px; border-radius:14px; font-family:'Manrope',system-ui,sans-serif; font-size:15px; font-weight:600; text-decoration:none; background:transparent; color:#fff !important; border:1px solid rgba(255,255,255,.15); cursor:pointer; transition:all .25s; }
    .ct-btn-ghost:hover { border-color:#f97316; color:#f97316 !important; }

    /* Animation — slide from sides */
    .ct-left { opacity:0; transform:translateX(-40px); transition:opacity .7s cubic-bezier(.23,1,.32,1), transform .7s cubic-bezier(.23,1,.32,1); transition-delay:.3s; }
    .ct-actions { opacity:0; transform:translateX(40px); transition:opacity .7s cubic-bezier(.23,1,.32,1), transform .7s cubic-bezier(.23,1,.32,1); transition-delay:.5s; }
    .ct-section.ct-visible .ct-left,
    .ct-section.ct-visible .ct-actions { opacity:1; transform:translateX(0); }

    @media (max-width:767px) {
        .ct-wrap { flex-direction:column; text-align:center; padding:36px 24px; border-radius:20px; }
        .ct-actions { justify-content:center; }
    }
</style>

<section class="landing-section ct-section" id="ct-section">
    <div class="ct-wrap">
        <div class="ct-left">
            @if(!empty($section['title']))
                <h2 class="ct-title">{{ $section['title'] }}</h2>
            @endif
            @if(!empty($section['text']))
                <p class="ct-text">{{ $section['text'] }}</p>
            @endif
        </div>
        <div class="ct-actions">
            @if(!empty($section['primary_cta']['label']) && !empty($section['primary_cta']['url']))
                <a href="{{ $section['primary_cta']['url'] }}" class="ct-btn">{{ $section['primary_cta']['label'] }}</a>
            @endif
            @if(!empty($section['secondary_cta']['label']) && !empty($section['secondary_cta']['url']))
                <a href="{{ $section['secondary_cta']['url'] }}" class="ct-btn-ghost">{{ $section['secondary_cta']['label'] }}</a>
            @endif
        </div>
    </div>
</section>

<script>
(function() {
    var section = document.getElementById('ct-section');
    if (!section) return;
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                section.classList.add('ct-visible');
                observer.unobserve(section);
            }
        });
    }, { threshold: 0.3 });
    observer.observe(section);
})();
</script>
