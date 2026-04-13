<style>
    .lh-open { padding: 0; position: relative; }
    .lh-open::after { content:''; position:absolute; top:-50px; right:-100px; width:500px; height:500px; background:radial-gradient(circle, rgba(255,138,42,.10), transparent 70%); pointer-events:none; }

    .lh-bc { display:flex; align-items:center; gap:6px; font-family:'Manrope',system-ui,sans-serif; font-size:13px; color:rgba(15,23,42,.35); position:relative; z-index:1; }
    .lh-bc a { color:rgba(15,23,42,.35); text-decoration:none; transition:color .2s; }
    .lh-bc a:hover { color:#f97316; }
    .lh-bc-sep { color:rgba(15,23,42,.2); }

    .lh-grid { display:grid; grid-template-columns:1fr .55fr; gap:56px; align-items:center; margin-top:28px; margin-bottom:64px; position:relative; z-index:1; min-height:420px; }

    .lh-kicker { font-family:'Manrope',system-ui,sans-serif; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.14em; color:#f97316; margin-top:0; }

    .lh-title { font-family:'Manrope',system-ui,sans-serif; font-size:clamp(44px,5.5vw,72px); font-weight:900; line-height:.96; letter-spacing:-.045em; color:#111; margin-top:12px; min-height:1.92em; }
    .lh-title span { color:#ff6a00; text-shadow: 0 0 10px rgba(255,106,0,.16), 0 0 24px rgba(255,106,0,.14); }

    /* Typewriter cursor */
    .lh-title .lh-cursor { display:inline-block; width:3px; height:.75em; background:#f97316; margin-left:2px; vertical-align:middle; animation:lhBlink .6s step-end infinite; }
    @keyframes lhBlink { 50% { opacity:0; } }

    .lh-lead { font-family:'Manrope',system-ui,sans-serif; font-size:17px; line-height:1.7; color:rgba(15,23,42,.45); margin-top:24px; max-width:560px; }

    .lh-actions { display:flex; gap:12px; margin-top:32px; flex-wrap:wrap; }
    .lh-btn-primary { display:inline-flex; align-items:center; justify-content:center; padding:15px 30px; border-radius:14px; font-family:'Manrope',system-ui,sans-serif; font-size:15px; font-weight:600; text-decoration:none; background:#f97316; color:#fff !important; border:none; cursor:pointer; transition:all .25s; }
    .lh-btn-primary:hover { background:#ea6c0e; transform:translateY(-1px); }
    .lh-btn-outline { display:inline-flex; align-items:center; justify-content:center; padding:15px 30px; border-radius:14px; font-family:'Manrope',system-ui,sans-serif; font-size:15px; font-weight:600; text-decoration:none; background:transparent; color:#111 !important; border:1px solid rgba(15,23,42,.1); cursor:pointer; transition:all .25s; }
    .lh-btn-outline:hover { border-color:#f97316; color:#f97316 !important; }

    .lh-info { display:flex; flex-direction:column; }
    .lh-info-row { padding:20px 0; border-bottom:1px solid rgba(15,23,42,.06); }
    .lh-info-row:last-child { border-bottom:none; }
    .lh-info-label { font-family:'Manrope',system-ui,sans-serif; font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.1em; color:rgba(15,23,42,.3); }
    .lh-info-value { font-family:'Manrope',system-ui,sans-serif; font-size:15px; font-weight:600; color:#111; margin-top:4px; }

    .lh-divider { margin-top:56px; height:1px; background:rgba(15,23,42,.06); position:relative; z-index:1; }

    /* Animation: fade up for non-title elements */
    .lh-anim { opacity:0; transform:translateY(20px); transition:opacity .6s ease, transform .6s ease; }
    .lh-anim.lh-visible { opacity:1; transform:translateY(0); }

    @media (max-width:767px) {
        .lh-grid { grid-template-columns:1fr; gap:32px; min-height:auto; }
        .lh-title { font-size:clamp(32px,10vw,48px); }
        .lh-open { padding:24px 0 0; }
    }
</style>

<section class="landing-section">
    <div class="lh-open">
        <nav class="lh-bc lh-anim">
            <a href="/">Главная</a>
            <span class="lh-bc-sep">/</span>
            <a href="/services">Услуги</a>
            <span class="lh-bc-sep">/</span>
            <span>{{ strip_tags($landing->h1 ?: $landing->title) }}</span>
        </nav>

        <div class="lh-grid">
            <div>
                @if(!empty($section['kicker']))
                    <p class="lh-kicker lh-anim">{{ $section['kicker'] }}</p>
                @endif

                <h1 class="lh-title" id="lh-typewriter" data-text="{{ strip_tags($landing->h1 ?: $landing->title) }}" data-accent="{{ $landing->h1 && str_contains($landing->h1, '<span>') ? strip_tags(preg_match('/<span>(.*?)<\/span>/', $landing->h1, $m) ? $m[1] : '') : '' }}"></h1>

                @if(!empty($section['lead']))
                    <p class="lh-lead lh-anim">{{ $section['lead'] }}</p>
                @endif

                <div class="lh-actions lh-anim">
                    @if(!empty($section['primary_cta']['label']) && !empty($section['primary_cta']['url']))
                        <a href="{{ $section['primary_cta']['url'] }}" class="lh-btn-primary">{{ $section['primary_cta']['label'] }}</a>
                    @endif

                    @if(!empty($section['secondary_cta']['label']) && !empty($section['secondary_cta']['url']))
                        <a href="{{ $section['secondary_cta']['url'] }}" class="lh-btn-outline">{{ $section['secondary_cta']['label'] }}</a>
                    @endif
                </div>
            </div>

            <aside class="lh-info lh-anim">
                @php
                    $hasLabels = false;
                    if (!empty($section['panel_items']) && is_array($section['panel_items'])) {
                        foreach ($section['panel_items'] as $item) {
                            if (is_string($item) && str_contains($item, ':')) {
                                $hasLabels = true;
                                break;
                            }
                        }
                    }
                @endphp

                @if($hasLabels)
                    @foreach($section['panel_items'] as $item)
                        @php $parts = explode(':', $item, 2); @endphp
                        <div class="lh-info-row">
                            <div class="lh-info-label">{{ trim($parts[0]) }}</div>
                            <div class="lh-info-value">{{ trim($parts[1]) }}</div>
                        </div>
                    @endforeach
                @else
                    <div class="lh-info-row">
                        <div class="lh-info-label">Срок</div>
                        <div class="lh-info-value">2 — 6 недель</div>
                    </div>
                    <div class="lh-info-row">
                        <div class="lh-info-label">Формат</div>
                        <div class="lh-info-value">Под ключ с обучением</div>
                    </div>
                    <div class="lh-info-row">
                        <div class="lh-info-label">Опыт</div>
                        <div class="lh-info-value">150+ проектов, 8 лет</div>
                    </div>
                    <div class="lh-info-row">
                        <div class="lh-info-label">Платформа</div>
                        <div class="lh-info-value">amoCRM</div>
                    </div>
                @endif
            </aside>
        </div>

    </div>
</section>

<script>
(function() {
    var el = document.getElementById('lh-typewriter');
    if (!el) return;

    var fullText = el.dataset.text;
    var accentText = el.dataset.accent;
    var speed = 45;
    var cursor = document.createElement('span');
    cursor.className = 'lh-cursor';

    // Find where accent starts in full text
    var accentStart = accentText ? fullText.indexOf(accentText) : -1;
    var beforeAccent = accentStart > -1 ? fullText.substring(0, accentStart) : fullText;
    var afterAccent = accentStart > -1 ? accentText : '';

    var i = 0;
    var phase = 'before'; // 'before', 'accent', 'done'

    // Show breadcrumb and kicker first
    setTimeout(function() {
        document.querySelectorAll('.lh-bc, .lh-kicker').forEach(function(e) { e.classList.add('lh-visible'); });
    }, 100);

    // Start typing after brief delay
    setTimeout(function() {
        el.appendChild(cursor);
        type();
    }, 500);

    function type() {
        if (phase === 'before') {
            if (i < beforeAccent.length) {
                el.insertBefore(document.createTextNode(beforeAccent[i]), cursor);
                i++;
                setTimeout(type, speed);
            } else {
                if (afterAccent) {
                    phase = 'accent';
                    i = 0;
                    var span = document.createElement('span');
                    span.id = 'lh-accent-span';
                    el.insertBefore(span, cursor);
                    setTimeout(type, speed);
                } else {
                    finish();
                }
            }
        } else if (phase === 'accent') {
            var span = document.getElementById('lh-accent-span');
            if (i < afterAccent.length) {
                span.textContent += afterAccent[i];
                i++;
                setTimeout(type, speed);
            } else {
                finish();
            }
        }
    }

    function finish() {
        // Remove cursor after a pause
        setTimeout(function() {
            cursor.style.animation = 'none';
            cursor.style.opacity = '0';
            cursor.style.transition = 'opacity .3s';
        }, 800);

        // Fade in remaining elements
        var delay = 200;
        document.querySelectorAll('.lh-lead, .lh-actions, .lh-info, .lh-divider').forEach(function(e) {
            setTimeout(function() { e.classList.add('lh-visible'); }, delay);
            delay += 150;
        });
    }
})();
</script>
