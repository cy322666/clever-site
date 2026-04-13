<style>
    .fq-section { padding:48px 0; text-align:center; }
    .fq-kicker { font-family:'Manrope',system-ui,sans-serif; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.14em; color:#f97316; }
    .fq-title { font-family:'Manrope',system-ui,sans-serif; font-size:clamp(28px,3.5vw,42px); font-weight:800; letter-spacing:-.03em; line-height:1.1; color:#111; margin-top:10px; }
    .fq-items { margin-top:32px; max-width:760px; margin-left:auto; margin-right:auto; }
    .fq-item { border-bottom:1px solid rgba(0,0,0,.06); }
    .fq-head { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:22px 0; cursor:pointer; text-align:left; }
    .fq-q { font-family:'Manrope',system-ui,sans-serif; font-size:17px; font-weight:700; letter-spacing:-.02em; color:#111; }
    .fq-icon { width:32px; height:32px; border-radius:50%; background:rgba(0,0,0,.04); display:flex; align-items:center; justify-content:center; flex-shrink:0; transition:all .3s; }
    .fq-icon svg { width:14px; height:14px; stroke:rgba(0,0,0,.3); stroke-width:2; fill:none; transition:all .3s; }
    .fq-item.fq-open .fq-icon { background:#f97316; }
    .fq-item.fq-open .fq-icon svg { stroke:#fff; transform:rotate(45deg); }
    .fq-body { max-height:0; overflow:hidden; transition:max-height .4s ease; }
    .fq-body-inner { padding:0 0 22px; font-family:'Manrope',system-ui,sans-serif; font-size:15px; line-height:1.7; color:rgba(17,17,17,.45); max-width:640px; text-align:left; }

    /* Animation on scroll */
    .fq-anim { opacity:0; transform:translateY(28px); transition:opacity .7s cubic-bezier(.23,1,.32,1), transform .7s cubic-bezier(.23,1,.32,1); will-change:opacity,transform; }
    .fq-section.fq-visible .fq-anim { will-change:auto; }
    .fq-section.fq-visible .fq-anim { opacity:1; transform:translateY(0); }

    @media (max-width:767px) {
        .fq-q { font-size:15px; }
        .fq-body-inner { font-size:14px; }
    }
</style>

<section class="fq-section landing-section" id="fq-section">
    <div class="fq-kicker fq-anim" style="transition-delay:.2s">FAQ</div>
    @if(!empty($section['title']))
        <h2 class="fq-title fq-anim" style="transition-delay:.4s">{{ $section['title'] }}</h2>
    @endif

    @if(!empty($section['items']) && is_array($section['items']))
        <div class="fq-items">
            @foreach($section['items'] as $index => $item)
                <div class="fq-item fq-anim {{ $index === 0 ? 'fq-open' : '' }}" style="transition-delay:{{ 0.65 + $index * 0.15 }}s">
                    <div class="fq-head">
                        <span class="fq-q">{{ $item['question'] ?? 'Вопрос' }}</span>
                        <span class="fq-icon"><svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="M5 12h14"/></svg></span>
                    </div>
                    <div class="fq-body">
                        <div class="fq-body-inner">
                            @if(!empty($item['answer']))
                                {{ $item['answer'] }}
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>

<script>
(function() {
    // Accordion logic
    document.querySelectorAll('.fq-head').forEach(function(head) {
        head.addEventListener('click', function() {
            var item = head.closest('.fq-item');
            var wasOpen = item.classList.contains('fq-open');
            var items = item.closest('.fq-items').querySelectorAll('.fq-item');
            items.forEach(function(i) {
                i.classList.remove('fq-open');
                var b = i.querySelector('.fq-body');
                if (b) b.style.maxHeight = '0';
            });
            if (!wasOpen) {
                item.classList.add('fq-open');
                var body = item.querySelector('.fq-body');
                if (body) body.style.maxHeight = body.scrollHeight + 'px';
            }
        });
    });

    // Open first item
    var first = document.querySelector('.fq-item.fq-open .fq-body');
    if (first) first.style.maxHeight = first.scrollHeight + 'px';

    // Intersection Observer for scroll animation
    var section = document.getElementById('fq-section');
    if (!section) return;
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                section.classList.add('fq-visible');
                observer.unobserve(section);
            }
        });
    }, { threshold: 0.2 });
    observer.observe(section);
})();
</script>
