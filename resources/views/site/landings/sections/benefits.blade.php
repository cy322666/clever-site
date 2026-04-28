<style>
    .zz-section { padding: 48px 0; position:relative; }
    .zz-head { text-align: center; max-width: 560px; margin: 0 auto; opacity:0; transform:translateY(30px); transition:opacity .8s cubic-bezier(.23,1,.32,1), transform .8s cubic-bezier(.23,1,.32,1); transition-delay:.2s; }
    .zz-section.zz-visible .zz-head { opacity:1; transform:translateY(0); }
    .zz-kicker { font-family:'Manrope',system-ui,sans-serif; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.14em; color:#f97316; }
    .zz-title { font-family:'Manrope',system-ui,sans-serif; font-size:clamp(28px,3.5vw,42px); font-weight:800; letter-spacing:-.03em; line-height:1.1; color:#111; margin-top:10px; }
    .zz-desc { font-family:'Manrope',system-ui,sans-serif; font-size:15px; line-height:1.7; color:rgba(17,17,17,.45); margin-top:12px; }

    .zz-timeline { margin-top:48px; position:relative; }
    .zz-timeline::before { content:''; position:absolute; left:50%; top:0; width:2px; background:linear-gradient(to bottom, #f97316, rgba(249,115,22,.08)); transform:translateX(-50%); border-radius:2px; height:0; transition:height 2.2s cubic-bezier(.23,1,.32,1) .5s; }
    .zz-section.zz-visible .zz-timeline::before { height:100%; }

    .zz-item { display:grid; grid-template-columns:1fr 1fr; gap:40px; position:relative; padding-bottom:48px; }
    .zz-item:last-child { padding-bottom:0; }

    .zz-dot { position:absolute; left:50%; top:8px; transform:translateX(-50%) scale(0); width:16px; height:16px; border-radius:50%; background:#f97316; border:4px solid #f7f9fc; z-index:2; box-shadow:0 0 0 4px rgba(249,115,22,.12); transition:transform .6s cubic-bezier(.34,1.56,.64,1); }
    .zz-section.zz-visible .zz-item .zz-dot { transform:translateX(-50%) scale(1); }

    .zz-content { padding:0 20px; opacity:0; transform:translateY(30px); transition:opacity .8s cubic-bezier(.23,1,.32,1), transform .8s cubic-bezier(.23,1,.32,1); will-change:opacity, transform; }
    .zz-section.zz-visible .zz-content { will-change:auto; }
    .zz-section.zz-visible .zz-item .zz-content { opacity:1; transform:translateY(0); }

    .zz-item:nth-child(odd) .zz-content { grid-column:1; text-align:right; }
    .zz-item:nth-child(odd) .zz-spacer { grid-column:2; }
    .zz-item:nth-child(even) .zz-spacer { grid-column:1; }
    .zz-item:nth-child(even) .zz-content { grid-column:2; }

    .zz-num { font-family:'Manrope',system-ui,sans-serif; font-size:32px; font-weight:900; color:rgba(249,115,22,.15); line-height:1; }
    .zz-item-title { font-family:'Manrope',system-ui,sans-serif; font-size:18px; font-weight:700; letter-spacing:-.02em; color:#111; margin-top:8px; }
    .zz-item-text { font-family:'Manrope',system-ui,sans-serif; font-size:14px; line-height:1.65; color:rgba(17,17,17,.45); margin-top:6px; }

    @media (max-width:767px) {
        .zz-timeline::before { left:20px; }
        .zz-item { grid-template-columns:1fr; padding-left:52px; }
        .zz-dot { left:20px; }
        .zz-item:nth-child(odd) .zz-content,
        .zz-item:nth-child(even) .zz-content { grid-column:1; text-align:left; }
        .zz-spacer { display:none; }
    }
</style>

<section class="zz-section" id="zz-benefits">
    <div class="zz-head">
        @if(!empty($section['title']))
            <div class="zz-kicker">Старт проекта</div>
            <h2 class="zz-title">{{ $section['title'] }}</h2>
        @endif

        @if(!empty($section['description']))
            <p class="zz-desc">{{ $section['description'] }}</p>
        @endif
    </div>

    @if(!empty($section['items']) && is_array($section['items']))
        <div class="zz-timeline">
            @foreach($section['items'] as $index => $item)
                <div class="zz-item">
                    <div class="zz-dot" style="transition-delay:{{ 0.6 + $index * 0.45 }}s"></div>
                    @if($index % 2 === 0)
                        <div class="zz-content" style="transition-delay:{{ 0.75 + $index * 0.45 }}s">
                            <div class="zz-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <h3 class="zz-item-title">{{ $item['title'] ?? 'Преимущество' }}</h3>
                            @if(!empty($item['text']))
                                <p class="zz-item-text">{{ $item['text'] }}</p>
                            @endif
                        </div>
                        <div class="zz-spacer"></div>
                    @else
                        <div class="zz-spacer"></div>
                        <div class="zz-content" style="transition-delay:{{ 0.75 + $index * 0.45 }}s">
                            <div class="zz-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <h3 class="zz-item-title">{{ $item['title'] ?? 'Преимущество' }}</h3>
                            @if(!empty($item['text']))
                                <p class="zz-item-text">{{ $item['text'] }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</section>

<script>
(function() {
    var section = document.getElementById('zz-benefits');
    if (!section) return;
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                section.classList.add('zz-visible');
                observer.unobserve(section);
            }
        });
    }, { threshold: 0.25 });
    observer.observe(section);
})();
</script>
