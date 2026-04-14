<style>
    .sp-wrap { background:#0f0f11; padding:100px 0; position:relative; min-height:100vh; display:flex; align-items:center; }
    .sp-inner { position:relative; z-index:1; max-width:1100px; margin:0 auto; padding:0 24px; width:100%; }

    .sp-kicker { font-family:'Manrope',system-ui,sans-serif; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.14em; color:rgba(249,115,22,.7); }
    .sp-title { font-family:'Manrope',system-ui,sans-serif; font-size:clamp(32px,4vw,52px); font-weight:800; letter-spacing:-.03em; line-height:1.1; color:#fff; margin-top:12px; }

    /* Fade-up animation */
    .sp-anim { opacity:0; transform:translateY(30px); transition:opacity .8s cubic-bezier(.23,1,.32,1), transform .8s cubic-bezier(.23,1,.32,1); will-change:opacity, transform; }
    .sp-wrap.sp-visible .sp-anim { will-change:auto; }
    .sp-wrap.sp-visible .sp-anim { opacity:1; transform:translateY(0); }

    .sp-bar { display:flex; gap:6px; margin-top:48px; }
    .sp-bar-item { flex:1; height:5px; border-radius:3px; background:rgba(255,255,255,.08); cursor:pointer; transition:all .3s; position:relative; overflow:hidden; }
    .sp-bar-item::after { content:''; position:absolute; top:0; left:0; height:100%; width:0; background:#f97316; border-radius:2px; transition:width .3s; }
    .sp-bar-item.done::after { width:100%; }
    .sp-bar-item.active::after { width:0; animation:spFill var(--sp-duration) linear forwards; }
    @keyframes spFill { from { width:0; } to { width:100%; } }

    .sp-labels { display:flex; margin-top:10px; }
    .sp-label { flex:1; font-family:'Manrope',system-ui,sans-serif; font-size:13px; color:rgba(255,255,255,.2); cursor:pointer; transition:color .2s; padding-right:8px; }
    .sp-label.active { color:rgba(255,255,255,.6); }

    .sp-stage { margin-top:56px; min-height:220px; position:relative; }
    .sp-step { display:none; animation:spFade .4s ease; }
    .sp-step.active { display:grid; grid-template-columns:auto 1fr; gap:28px; align-items:start; }
    @keyframes spFade { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }

    .sp-num { font-family:'Manrope',system-ui,sans-serif; font-size:96px; font-weight:900; color:rgba(249,115,22,.12); line-height:1; }
    .sp-step-title { font-family:'Manrope',system-ui,sans-serif; font-size:32px; font-weight:800; letter-spacing:-.03em; color:#fff; }
    .sp-step-text { font-family:'Manrope',system-ui,sans-serif; font-size:17px; line-height:1.7; color:rgba(255,255,255,.4); margin-top:14px; max-width:540px; }

    .sp-nav { display:flex; gap:14px; margin-top:36px; }
    .sp-nav-btn { width:48px; height:48px; border-radius:50%; border:1px solid rgba(255,255,255,.1); background:transparent; display:flex; align-items:center; justify-content:center; cursor:pointer; color:rgba(255,255,255,.5); font-size:18px; transition:all .2s; }
    .sp-nav-btn:hover { border-color:#f97316; color:#f97316; }

    .sp-counter { font-family:'Manrope',system-ui,sans-serif; font-size:13px; color:rgba(255,255,255,.2); margin-top:32px; display:flex; align-items:center; gap:8px; }
    .sp-counter-current { color:rgba(255,255,255,.6); font-weight:700; }

    @media (max-width:767px) {
        .sp-wrap { padding:64px 0; }
        .sp-step.active { grid-template-columns:1fr; }
        .sp-num { font-size:48px; }
        .sp-step-title { font-size:20px; }
        .sp-labels { display:none; }
    }
</style>

<section class="landing-section">
    @if(!empty($section['items']) && is_array($section['items']))
        @php $items = $section['items']; $count = count($items); @endphp

        <div class="sp-wrap" id="steps-process">
            <div class="sp-inner">
                <div class="sp-kicker sp-anim" style="transition-delay:.2s">внедрение</div>
                @if(!empty($section['title']))
                    <h2 class="sp-title sp-anim" style="transition-delay:.4s">{{ $section['title'] }}</h2>
                @endif

                <div class="sp-bar sp-anim" style="transition-delay:.65s">
                    @foreach($items as $i => $item)
                        <div class="sp-bar-item" data-sp-step="{{ $i }}"></div>
                    @endforeach
                </div>

                <div class="sp-labels sp-anim" style="transition-delay:.8s">
                    @foreach($items as $i => $item)
                        <div class="sp-label {{ $i === 0 ? 'active' : '' }}" data-sp-step="{{ $i }}">{{ $item['title'] ?? 'Этап' }}</div>
                    @endforeach
                </div>

                <div class="sp-stage sp-anim" style="transition-delay:.95s">
                    @foreach($items as $i => $item)
                        <div class="sp-step {{ $i === 0 ? 'active' : '' }}" data-sp-step="{{ $i }}">
                            <div class="sp-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <div>
                                <h3 class="sp-step-title">{{ $item['title'] ?? 'Этап' }}</h3>
                                @if(!empty($item['text']))
                                    <p class="sp-step-text">{{ $item['text'] }}</p>
                                @endif
                                <div class="sp-nav">
                                    <button class="sp-nav-btn" data-sp-dir="-1"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg></button>
                                    <button class="sp-nav-btn" data-sp-dir="1"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="sp-counter sp-anim" style="transition-delay:1.1s">
                    <span class="sp-counter-current" id="sp-current">01</span> / <span>{{ str_pad($count, 2, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>
        </div>

        <script>
        (function(){
            var wrap = document.getElementById('steps-process');
            if (!wrap) return;
            var bars = wrap.querySelectorAll('.sp-bar-item');
            var labels = wrap.querySelectorAll('.sp-label');
            var steps = wrap.querySelectorAll('.sp-step');
            var counter = document.getElementById('sp-current');
            var total = steps.length;
            var current = 0;
            var duration = 5000;
            var timer = null;

            wrap.style.setProperty('--sp-duration', duration + 'ms');

            function show(i) {
                if (i < 0) i = total - 1;
                if (i >= total) i = 0;
                current = i;
                bars.forEach(function(b, idx) {
                    b.classList.remove('active', 'done');
                    if (idx < i) b.classList.add('done');
                    if (idx === i) b.classList.add('active');
                });
                labels.forEach(function(l, idx) { l.classList.toggle('active', idx === i); });
                steps.forEach(function(s, idx) { s.classList.toggle('active', idx === i); });
                if (counter) counter.textContent = String(i + 1).padStart(2, '0');
                resetTimer();
            }

            function next() { show(current + 1); }

            function resetTimer() {
                if (timer) clearInterval(timer);
                timer = setInterval(next, duration);
            }

            bars.forEach(function(b) { b.addEventListener('click', function() { show(+b.dataset.spStep); }); });
            labels.forEach(function(l) { l.addEventListener('click', function() { show(+l.dataset.spStep); }); });
            wrap.querySelectorAll('.sp-nav-btn').forEach(function(btn) {
                btn.addEventListener('click', function() { show(current + (+btn.dataset.spDir)); });
            });

            // Intersection Observer — trigger animations when visible
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        wrap.classList.add('sp-visible');
                        // Wait for bar fade-up animation to finish before starting autoscroll
                        setTimeout(function() {
                            show(0);
                        }, 1500);
                        observer.unobserve(wrap);
                    }
                });
            }, { threshold: 0.35 });
            observer.observe(wrap);
        })();
        </script>
    @endif
</section>
