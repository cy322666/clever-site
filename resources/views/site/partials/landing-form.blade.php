@php($errorBag = $errors ?? new \Illuminate\Support\ViewErrorBag)

<style>
    .lf-wrap { padding:48px 0; }
    .lf-grid { display:grid; grid-template-columns:1.05fr .95fr; gap:40px; align-items:start; }
    .lf-kicker { font-family:'Manrope',system-ui,sans-serif; font-size:12px; font-weight:700; text-transform:uppercase; letter-spacing:.14em; color:#f97316; }
    .lf-title { font-family:'Manrope',system-ui,sans-serif; font-size:clamp(26px,3vw,38px); font-weight:800; letter-spacing:-.03em; line-height:1.15; color:#111; margin-top:8px; }
    .lf-text { font-family:'Manrope',system-ui,sans-serif; font-size:15px; line-height:1.7; color:rgba(17,17,17,.45); margin-top:12px; }
    .lf-notes { display:grid; grid-template-columns:repeat(3,1fr); gap:10px; margin-top:24px; }
    .lf-note { padding:14px; border-radius:14px; border:1px solid rgba(0,0,0,.04); background:#fff; box-shadow:0 8px 32px rgba(0,0,0,.06), 0 2px 8px rgba(0,0,0,.03); }
    .lf-note-title { font-family:'Manrope',system-ui,sans-serif; font-size:13px; font-weight:700; color:#111; }
    .lf-note-text { font-family:'Manrope',system-ui,sans-serif; font-size:12px; color:rgba(17,17,17,.4); margin-top:4px; line-height:1.5; }
    .lf-card { background:#fff; border:1px solid rgba(0,0,0,.04); border-radius:22px; padding:28px; box-shadow:0 8px 32px rgba(0,0,0,.06), 0 2px 8px rgba(0,0,0,.03); }
    .lf-field { margin-bottom:14px; }
    .lf-field:last-of-type { margin-bottom:18px; }
    .lf-label { display:block; font-family:'Manrope',system-ui,sans-serif; font-size:13px; font-weight:600; color:#555; margin-bottom:6px; }
    .lf-input { width:100%; padding:14px 18px; border-radius:14px; border:1px solid rgba(0,0,0,.08); font-family:'Manrope',system-ui,sans-serif; font-size:14px; color:#111; outline:none; transition:all .2s; background:#fff; }
    .lf-input:focus { border-color:#ffb15f; box-shadow:0 0 0 4px rgba(255,155,61,.12); }
    .lf-input::placeholder { color:#94a3b8; }
    .lf-textarea { min-height:120px; resize:vertical; }
    .lf-submit { width:100%; padding:16px; border-radius:14px; border:none; font-family:'Manrope',system-ui,sans-serif; font-size:15px; font-weight:600; cursor:pointer; background:#f97316; color:#fff; transition:all .25s; }
    .lf-submit:hover { background:#ea6c0e; transform:translateY(-1px); }
    .lf-disclaimer { font-family:'Manrope',system-ui,sans-serif; font-size:12px; color:#94a3b8; margin-top:10px; text-align:center; }
    .lf-error { font-size:12px; color:#ef4444; margin-top:4px; }

    /* Animation — fade up cascade */
    .lf-anim { opacity:0; transform:translateY(28px); transition:opacity .7s cubic-bezier(.23,1,.32,1), transform .7s cubic-bezier(.23,1,.32,1); }
    .lf-section.lf-visible .lf-anim { opacity:1; transform:translateY(0); }

    @media (max-width:767px) {
        .lf-wrap { padding:28px 20px; }
        .lf-grid { grid-template-columns:1fr; gap:28px; }
        .lf-notes { grid-template-columns:1fr; }
        .lf-card { padding:20px; }
    }
</style>

<section class="landing-section lf-section" id="lf-section">
    <div class="lf-wrap">
        <div class="lf-grid">
            <div>
                <div class="lf-kicker lf-anim" style="transition-delay:.2s">Заявка</div>
                <h2 class="lf-title lf-anim" style="transition-delay:.35s">{{ $formConfig['title'] }}</h2>
                <p class="lf-text lf-anim" style="transition-delay:.5s">{{ $formConfig['text'] }}</p>

                <div class="lf-notes lf-anim" style="transition-delay:.65s">
                    <div class="lf-note">
                        <div class="lf-note-title">Формат</div>
                        <div class="lf-note-text">Короткий разбор без лишней продажи и без общих советов</div>
                    </div>
                    <div class="lf-note">
                        <div class="lf-note-title">Что смотрим</div>
                        <div class="lf-note-text">Где теряются заявки, база клиентов и деньги внутри CRM</div>
                    </div>
                    <div class="lf-note">
                        <div class="lf-note-title">Что получите</div>
                        <div class="lf-note-text">Понятный следующий шаг: аудит, внедрение или интеграция</div>
                    </div>
                </div>
            </div>

            <div class="lf-card lf-anim" style="transition-delay:.45s">
                @if(session('landing_form_success'))
                    <div style="padding:14px;border-radius:12px;background:rgba(16,185,129,.08);border:1px solid rgba(16,185,129,.15);color:#065f46;font-size:14px;margin-bottom:16px;">
                        {{ session('landing_form_success') }}
                    </div>
                @endif

                <form action="{{ route('site.inquiries.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="landing_slug" value="{{ $landing->slug }}">
                    <input type="hidden" name="landing_title" value="{{ $landing->displayTitle() }}">
                    <input type="hidden" name="offer_type" value="{{ $formConfig['offer_type'] }}">
                    <input type="hidden" name="page_url" value="{{ request()->fullUrl() }}">
                    <input type="hidden" name="form_anchor" value="landing-form">

                    <div class="lf-field">
                        <label class="lf-label" for="lf_name">Имя</label>
                        <input id="lf_name" name="name" type="text" value="{{ old('name') }}" class="lf-input" placeholder="Как к вам обращаться">
                        @if($errorBag->has('name'))
                            <p class="lf-error">{{ $errorBag->first('name') }}</p>
                        @endif
                    </div>

                    <div class="lf-field">
                        <label class="lf-label" for="lf_contact">Контакт</label>
                        <input id="lf_contact" name="contact" type="text" value="{{ old('contact') }}" class="lf-input" placeholder="Телефон, Telegram или email">
                        @if($errorBag->has('contact'))
                            <p class="lf-error">{{ $errorBag->first('contact') }}</p>
                        @endif
                    </div>

                    <div class="lf-field">
                        <label class="lf-label" for="lf_message">Коротко о задаче</label>
                        <textarea id="lf_message" name="message" class="lf-input lf-textarea" placeholder="Например: теряются заявки, нужна интеграция, CRM уже стоит но не даёт результата">{{ old('message') }}</textarea>
                        @if($errorBag->has('message'))
                            <p class="lf-error">{{ $errorBag->first('message') }}</p>
                        @endif
                    </div>

                    <button type="submit" class="lf-submit">{{ $formConfig['button'] }}</button>
                    <p class="lf-disclaimer">Отправляя форму, вы оставляете контакт для обратной связи по вашей задаче</p>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
(function() {
    var section = document.getElementById('lf-section');
    if (!section) return;
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                section.classList.add('lf-visible');
                observer.unobserve(section);
            }
        });
    }, { threshold: 0.2 });
    observer.observe(section);
})();
</script>
