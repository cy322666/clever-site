<style>
    .lh-open { padding: 0; position: relative; }
    .lh-open::after { content:''; position:absolute; top:-50px; right:-100px; width:500px; height:500px; background:radial-gradient(circle, rgba(255,138,42,.10), transparent 70%); pointer-events:none; }

    .lh-bc { display:flex; align-items:center; gap:6px; font-family:'Manrope',system-ui,sans-serif; font-size:13px; color:rgba(15,23,42,.35); position:relative; z-index:1; }
    .lh-bc a { color:rgba(15,23,42,.35); text-decoration:none; transition:color .2s; }
    .lh-bc a:hover { color:#f97316; }
    .lh-bc-sep { color:rgba(15,23,42,.2); }

    .lh-grid { display:grid; grid-template-columns:1fr .55fr; gap:56px; align-items:center; margin-top:28px; margin-bottom:64px; position:relative; z-index:1; min-height:420px; }
    .lh-grid-launch { grid-template-columns:1fr .82fr; align-items:stretch; min-height:460px; }

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

    .lh-launch-card {
        position:relative;
        background:linear-gradient(180deg, #fff 0%, #fefefe 100%);
        border:1px solid rgba(15,23,42,.08);
        border-radius:28px;
        padding:30px;
        box-shadow:0 24px 56px rgba(15,23,42,.08), 0 4px 14px rgba(15,23,42,.04);
        overflow:hidden;
        display:flex;
        flex-direction:column;
        gap:16px;
    }
    .lh-launch-card::before {
        content:'';
        position:absolute;
        width:280px;
        height:280px;
        right:-120px;
        top:-120px;
        background:radial-gradient(circle, rgba(249,115,22,.16) 0%, rgba(249,115,22,0) 72%);
        pointer-events:none;
    }
    .lh-launch-head {
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
    }
    .lh-launch-badge {
        display:inline-flex;
        align-items:center;
        gap:8px;
        background:rgba(249,115,22,.12);
        color:#c75c0c;
        border:1px solid rgba(249,115,22,.22);
        border-radius:999px;
        padding:7px 12px;
        font-family:'Manrope',system-ui,sans-serif;
        font-size:11px;
        font-weight:700;
        text-transform:uppercase;
        letter-spacing:.08em;
    }
    .lh-launch-badge::before {
        content:'';
        width:6px;
        height:6px;
        border-radius:50%;
        background:#f97316;
        box-shadow:0 0 0 6px rgba(249,115,22,.16);
    }
    .lh-launch-state {
        display:inline-flex;
        align-items:center;
        gap:6px;
        background:#fff;
        border:1px solid rgba(15,23,42,.1);
        border-radius:999px;
        padding:6px 10px;
        font-family:'Manrope',system-ui,sans-serif;
        font-size:10px;
        font-weight:700;
        letter-spacing:.06em;
        text-transform:uppercase;
        color:rgba(15,23,42,.55);
    }
    .lh-launch-state::before {
        content:'';
        width:6px;
        height:6px;
        border-radius:50%;
        background:#f97316;
        box-shadow:0 0 0 5px rgba(249,115,22,.14);
    }
    .lh-launch-canvas {
        background:#f8fafc;
        border:1px solid rgba(15,23,42,.08);
        border-radius:20px;
        padding:14px;
        display:flex;
        flex-direction:column;
        gap:10px;
    }
    .lh-launch-zone {
        background:#fff;
        border:1px solid rgba(15,23,42,.08);
        border-radius:14px;
        padding:10px;
    }
    .lh-launch-zone-label {
        font-family:'Manrope',system-ui,sans-serif;
        font-size:10px;
        font-weight:700;
        text-transform:uppercase;
        letter-spacing:.08em;
        color:rgba(15,23,42,.42);
        margin-bottom:8px;
    }
    .lh-launch-map-row {
        display:flex;
        gap:6px;
        flex-wrap:wrap;
    }
    .lh-launch-node {
        padding:6px 9px;
        border-radius:999px;
        border:1px solid rgba(15,23,42,.1);
        background:#fff;
        font-family:'Manrope',system-ui,sans-serif;
        font-size:11px;
        font-weight:600;
        color:rgba(15,23,42,.72);
    }
    .lh-launch-map-arrow {
        width:2px;
        height:12px;
        background:rgba(249,115,22,.4);
        border-radius:999px;
        margin:8px auto 6px;
        position:relative;
    }
    .lh-launch-map-arrow::after {
        content:'';
        position:absolute;
        left:-3px;
        bottom:-1px;
        width:8px;
        height:8px;
        border-right:2px solid rgba(249,115,22,.6);
        border-bottom:2px solid rgba(249,115,22,.6);
        transform:rotate(45deg);
    }
    .lh-launch-core {
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius:11px;
        background:linear-gradient(180deg, #fff7ed, #fff);
        border:1px solid rgba(249,115,22,.24);
        padding:9px;
        font-family:'Manrope',system-ui,sans-serif;
        font-size:12px;
        font-weight:800;
        color:#c75c0c;
    }
    .lh-launch-process {
        display:flex;
        flex-direction:column;
        gap:8px;
    }
    .lh-launch-stages {
        display:grid;
        grid-template-columns:repeat(3, minmax(0, 1fr));
        gap:6px;
    }
    .lh-launch-stage {
        min-height:44px;
        padding:6px 8px;
        border-radius:9px;
        border:1px solid rgba(15,23,42,.1);
        background:#fff;
        display:flex;
        align-items:center;
        justify-content:center;
        text-align:center;
        font-family:'Manrope',system-ui,sans-serif;
        font-size:10px;
        font-weight:700;
        line-height:1.25;
        color:rgba(15,23,42,.58);
    }
    .lh-launch-stage.is-accent {
        border-color:rgba(249,115,22,.28);
        background:#fff7ed;
        color:#c75c0c;
    }
    .lh-launch-team {
        display:flex;
        flex-direction:column;
        gap:8px;
    }
    .lh-launch-team-row {
        display:grid;
        grid-template-columns:20px 1fr 44px;
        align-items:center;
        gap:8px;
    }
    .lh-launch-avatar {
        width:20px;
        height:20px;
        border-radius:50%;
        background:linear-gradient(145deg, #cbd5e1, #94a3b8);
    }
    .lh-launch-avatar.is-accent { background:linear-gradient(145deg, #fdba74, #f97316); }
    .lh-launch-line {
        height:9px;
        border-radius:999px;
        background:rgba(15,23,42,.14);
        position:relative;
        overflow:hidden;
    }
    .lh-launch-line::after {
        content:'';
        display:block;
        height:100%;
        width:68%;
        background:linear-gradient(90deg, rgba(249,115,22,.52), rgba(249,115,22,.2));
    }
    .lh-launch-status {
        height:9px;
        border-radius:999px;
        background:rgba(15,23,42,.12);
    }
    .lh-launch-status.is-accent { background:rgba(249,115,22,.45); }
    .lh-launch-footer {
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:8px;
    }
    .lh-launch-mini {
        background:#fff;
        border:1px solid rgba(15,23,42,.08);
        border-radius:12px;
        padding:10px;
    }
    .lh-launch-mini-line {
        height:7px;
        border-radius:999px;
        background:rgba(15,23,42,.18);
    }
    .lh-launch-mini-line + .lh-launch-mini-line { margin-top:8px; }
    .lh-launch-mini-line.is-short { width:68%; }
    .lh-launch-avatars {
        display:flex;
        align-items:center;
        margin-bottom:8px;
    }
    .lh-launch-avatars span {
        width:20px;
        height:20px;
        border-radius:50%;
        border:2px solid #fff;
        margin-right:-5px;
        background:linear-gradient(145deg, #cbd5e1, #94a3b8);
    }
    .lh-launch-avatars span:nth-child(2) { background:linear-gradient(145deg, #fcd34d, #f59e0b); }
    .lh-launch-avatars span:nth-child(3) { background:linear-gradient(145deg, #fdba74, #f97316); }
    .lh-launch-avatars span:nth-child(4) {
        width:auto;
        height:auto;
        border:none;
        margin-right:0;
        margin-left:8px;
        background:none;
        font-family:'Manrope',system-ui,sans-serif;
        font-size:11px;
        font-weight:700;
        color:rgba(15,23,42,.45);
    }

    .lh-divider { margin-top:56px; height:1px; background:rgba(15,23,42,.06); position:relative; z-index:1; }

    /* Animation: fade up for non-title elements */
    .lh-anim { opacity:0; transform:translateY(20px); transition:opacity .6s ease, transform .6s ease; }
    .lh-anim.lh-visible { opacity:1; transform:translateY(0); }

    @media (max-width:767px) {
        .lh-grid { grid-template-columns:1fr; gap:32px; min-height:auto; }
        .lh-title { font-size:clamp(32px,10vw,48px); }
        .lh-open { padding:24px 0 0; }
        .lh-launch-card { padding:20px; border-radius:22px; }
        .lh-launch-stages { grid-template-columns:repeat(2, minmax(0, 1fr)); }
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

        <div class="lh-grid {{ $landing->slug === 'vnedrenie-amocrm' ? 'lh-grid-launch' : '' }}">
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

            @if($landing->slug === 'vnedrenie-amocrm')
                <aside class="lh-launch-card lh-anim" aria-label="Визуальная схема внедрения amoCRM">
                    <div class="lh-launch-canvas" aria-hidden="true">
                        <div class="lh-launch-zone">
                            <div class="lh-launch-zone-label">Сборка CRM</div>
                            <div class="lh-launch-map-row">
                                <div class="lh-launch-node">Сайт</div>
                                <div class="lh-launch-node">Звонки</div>
                                <div class="lh-launch-node">WhatsApp</div>
                                <div class="lh-launch-node">Реклама</div>
                            </div>
                            <div class="lh-launch-map-arrow"></div>
                            <div class="lh-launch-core">amoCRM под ваши продажи</div>
                        </div>

                        <div class="lh-launch-zone">
                            <div class="lh-launch-zone-label">Что делаем в проекте</div>
                            <div class="lh-launch-process">
                                <div class="lh-launch-stages">
                                    <div class="lh-launch-stage is-accent">Аудит продаж и описание процессов</div>
                                    <div class="lh-launch-stage">Интеграция amoCRM</div>
                                    <div class="lh-launch-stage">Обучение и сопровождение</div>
                                </div>
                            </div>
                        </div>

                        <div class="lh-launch-footer">
                            <div class="lh-launch-mini">
                                <div class="lh-launch-mini-line"></div>
                                <div class="lh-launch-mini-line is-short"></div>
                            </div>
                            <div class="lh-launch-mini">
                                <div class="lh-launch-avatars">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                                <div class="lh-launch-mini-line"></div>
                            </div>
                        </div>
                    </div>
                </aside>
            @else
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
            @endif
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
        document.querySelectorAll('.lh-lead, .lh-actions, .lh-info, .lh-launch-card, .lh-divider').forEach(function(e) {
            setTimeout(function() { e.classList.add('lh-visible'); }, delay);
            delay += 150;
        });
    }
})();
</script>
