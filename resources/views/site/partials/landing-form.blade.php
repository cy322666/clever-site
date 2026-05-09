@php($errorBag = $errors ?? new \Illuminate\Support\ViewErrorBag)

<style>
    .lf-wrap {
        padding: 56px 0;
        font-family: 'Manrope', system-ui, sans-serif;
    }
    .lf-shell {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        background:
            radial-gradient(circle at 12% 0%, rgba(249, 115, 22, .26), transparent 34%),
            radial-gradient(circle at 88% 14%, rgba(59, 130, 246, .12), transparent 30%),
            linear-gradient(135deg, #111113 0%, #171717 62%, #111113 100%);
        border: 1px solid rgba(255, 255, 255, .08);
        box-shadow: 0 28px 72px rgba(15, 23, 42, .18);
        color: #fff;
    }
    .lf-shell::before {
        content: '';
        position: absolute;
        inset: 0;
        pointer-events: none;
        background:
            linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
        background-size: 44px 44px;
    }
    .lf-grid {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(360px, .82fr);
        gap: 36px;
        align-items: stretch;
        padding: 38px;
    }
    .lf-content {
        display: flex;
        flex-direction: column;
        min-height: 100%;
    }
    .lf-kicker {
        display: inline-flex;
        width: max-content;
        align-items: center;
        gap: 9px;
        border: 1px solid rgba(249, 115, 22, .28);
        border-radius: 999px;
        background: rgba(249, 115, 22, .1);
        padding: 7px 12px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: #ffb15f;
    }
    .lf-kicker::before {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #f97316;
        box-shadow: 0 0 0 6px rgba(249, 115, 22, .18);
    }
    .lf-title {
        max-width: 720px;
        margin-top: 18px;
        font-size: clamp(30px, 4vw, 52px);
        font-weight: 900;
        line-height: 1.02;
        letter-spacing: 0;
        color: #fff;
    }
    .lf-text {
        max-width: 610px;
        margin-top: 16px;
        font-size: 16px;
        line-height: 1.7;
        color: rgba(255, 255, 255, .58);
    }
    .lf-audit-panel {
        margin-top: 32px;
        max-width: 640px;
        border-radius: 22px;
        border: 1px solid rgba(255, 255, 255, .1);
        background: rgba(255, 255, 255, .055);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .08);
        backdrop-filter: blur(14px);
    }
    .lf-audit-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 18px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, .08);
    }
    .lf-audit-title {
        font-size: 14px;
        font-weight: 800;
        color: #fff;
    }
    .lf-audit-status {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        white-space: nowrap;
        border-radius: 999px;
        background: rgba(34, 197, 94, .12);
        padding: 7px 10px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #86efac;
    }
    .lf-audit-status::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #22c55e;
    }
    .lf-audit-steps {
        display: grid;
        gap: 1px;
    }
    .lf-audit-step {
        display: grid;
        grid-template-columns: auto 1fr auto;
        gap: 14px;
        align-items: center;
        padding: 16px 20px;
        background: rgba(255, 255, 255, .035);
    }
    .lf-audit-step:first-child {
        background: rgba(249, 115, 22, .11);
    }
    .lf-audit-num {
        font-size: 12px;
        font-weight: 900;
        color: rgba(255, 177, 95, .9);
    }
    .lf-audit-name {
        font-size: 14px;
        font-weight: 700;
        color: rgba(255, 255, 255, .9);
    }
    .lf-audit-mark {
        width: 36px;
        height: 8px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .12);
        overflow: hidden;
    }
    .lf-audit-mark::before {
        content: '';
        display: block;
        height: 100%;
        width: 70%;
        border-radius: inherit;
        background: #f97316;
    }
    .lf-audit-step:nth-child(2) .lf-audit-mark::before { width: 48%; }
    .lf-audit-step:nth-child(3) .lf-audit-mark::before { width: 28%; }
    .lf-notes {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 12px;
        margin-top: auto;
        padding-top: 28px;
    }
    .lf-note {
        min-height: 118px;
        border-radius: 18px;
        border: 1px solid rgba(255, 255, 255, .09);
        background: rgba(255, 255, 255, .045);
        padding: 18px;
    }
    .lf-note-title {
        font-size: 13px;
        font-weight: 800;
        color: #fff;
    }
    .lf-note-text {
        margin-top: 8px;
        font-size: 12px;
        line-height: 1.55;
        color: rgba(255, 255, 255, .46);
    }
    .lf-card {
        align-self: stretch;
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, .76);
        background: rgba(255, 255, 255, .97);
        padding: 28px;
        box-shadow: 0 24px 64px rgba(0, 0, 0, .22);
        color: #111;
    }
    .lf-card-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 22px;
    }
    .lf-card-title {
        font-size: 22px;
        line-height: 1.15;
        font-weight: 900;
        letter-spacing: 0;
        color: #111;
    }
    .lf-card-subtitle {
        margin-top: 6px;
        font-size: 13px;
        line-height: 1.5;
        color: rgba(17, 17, 17, .48);
    }
    .lf-card-badge {
        flex-shrink: 0;
        border-radius: 999px;
        background: rgba(249, 115, 22, .1);
        padding: 8px 11px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #c75c0c;
    }
    .lf-success {
        margin-bottom: 18px;
        border-radius: 16px;
        border: 1px solid rgba(16, 185, 129, .18);
        background: rgba(16, 185, 129, .08);
        padding: 14px 16px;
        font-size: 14px;
        line-height: 1.5;
        color: #065f46;
    }
    .lf-form {
        display: grid;
        gap: 14px;
    }
    .lf-field {
        display: grid;
        gap: 7px;
    }
    .lf-label {
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        color: rgba(17, 17, 17, .48);
    }
    .lf-input {
        width: 100%;
        min-height: 52px;
        border-radius: 16px;
        border: 1px solid rgba(15, 23, 42, .1);
        background:
            linear-gradient(180deg, #fff 0%, #fbfdff 100%);
        padding: 15px 16px;
        font-family: 'Manrope', system-ui, sans-serif;
        font-size: 15px;
        line-height: 1.4;
        color: #111;
        outline: none;
        transition: border-color .2s, box-shadow .2s, background .2s;
    }
    .lf-input:focus {
        border-color: #f97316;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(249, 115, 22, .12);
    }
    .lf-input::placeholder {
        color: #94a3b8;
    }
    .lf-input[aria-invalid="true"] {
        border-color: rgba(239, 68, 68, .78);
        box-shadow: 0 0 0 4px rgba(239, 68, 68, .08);
    }
    .lf-textarea {
        min-height: 122px;
        resize: vertical;
    }
    .lf-submit {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        min-height: 54px;
        margin-top: 4px;
        border: none;
        border-radius: 16px;
        background: #f97316;
        color: #fff;
        cursor: pointer;
        font-family: 'Manrope', system-ui, sans-serif;
        font-size: 15px;
        font-weight: 800;
        line-height: 1.2;
        transition: transform .22s, background .22s, box-shadow .22s;
        box-shadow: 0 16px 30px rgba(249, 115, 22, .24);
    }
    .lf-submit::after {
        content: '→';
        font-size: 18px;
        line-height: 1;
        transition: transform .22s;
    }
    .lf-submit:hover {
        background: #ea6c0e;
        transform: translateY(-1px);
        box-shadow: 0 20px 36px rgba(249, 115, 22, .3);
    }
    .lf-submit:hover::after {
        transform: translateX(3px);
    }
    .lf-disclaimer {
        margin-top: 12px;
        text-align: center;
        font-size: 12px;
        line-height: 1.5;
        color: rgba(17, 17, 17, .42);
    }
    .lf-error {
        margin-top: 1px;
        font-size: 12px;
        line-height: 1.4;
        color: #dc2626;
    }

    .lf-anim {
        opacity: 0;
        transform: translateY(28px);
        transition: opacity .7s cubic-bezier(.23,1,.32,1), transform .7s cubic-bezier(.23,1,.32,1);
    }
    .lf-section.lf-visible .lf-anim {
        opacity: 1;
        transform: translateY(0);
    }

    @media (max-width: 1023px) {
        .lf-grid {
            grid-template-columns: 1fr;
        }
        .lf-notes {
            margin-top: 0;
        }
    }

    @media (max-width: 767px) {
        .lf-wrap {
            padding: 36px 0;
        }
        .lf-shell {
            border-radius: 22px;
        }
        .lf-grid {
            gap: 26px;
            padding: 24px 18px;
        }
        .lf-title {
            font-size: clamp(28px, 9vw, 40px);
        }
        .lf-text {
            font-size: 15px;
        }
        .lf-audit-top {
            align-items: flex-start;
            flex-direction: column;
        }
        .lf-audit-step {
            grid-template-columns: auto 1fr;
        }
        .lf-audit-mark {
            grid-column: 2;
            width: 100%;
        }
        .lf-notes {
            grid-template-columns: 1fr;
            padding-top: 18px;
        }
        .lf-note {
            min-height: auto;
        }
        .lf-card {
            border-radius: 20px;
            padding: 22px 18px;
        }
        .lf-card-head {
            flex-direction: column;
            gap: 10px;
        }
        .lf-card-badge {
            width: max-content;
        }
    }
</style>

<section class="landing-section lf-section" id="landing-form">
    <div class="lf-wrap">
        <div class="lf-shell">
            <div class="lf-grid">
                <div class="lf-content">
                    <div class="lf-kicker lf-anim" style="transition-delay:.15s">{{ $formConfig['offer_type'] }}</div>
                    <h2 class="lf-title lf-anim" style="transition-delay:.3s">{{ $formConfig['title'] }}</h2>
                    <p class="lf-text lf-anim" style="transition-delay:.42s">{{ $formConfig['text'] }}</p>

                    <div class="lf-audit-panel lf-anim" style="transition-delay:.56s">
                        <div class="lf-audit-top">
                            <div class="lf-audit-title">Карта первичного разбора</div>
                            <div class="lf-audit-status">Смотрим первым</div>
                        </div>
                        <div class="lf-audit-steps">
                            <div class="lf-audit-step">
                                <div class="lf-audit-num">01</div>
                                <div class="lf-audit-name">Потери в заявках и воронке</div>
                                <div class="lf-audit-mark"></div>
                            </div>
                            <div class="lf-audit-step">
                                <div class="lf-audit-num">02</div>
                                <div class="lf-audit-name">Что можно сохранить в CRM</div>
                                <div class="lf-audit-mark"></div>
                            </div>
                            <div class="lf-audit-step">
                                <div class="lf-audit-num">03</div>
                                <div class="lf-audit-name">Следующий шаг без лишней перестройки</div>
                                <div class="lf-audit-mark"></div>
                            </div>
                        </div>
                    </div>

                    <div class="lf-notes lf-anim" style="transition-delay:.72s">
                        <div class="lf-note">
                            <div class="lf-note-title">Формат</div>
                            <div class="lf-note-text">Короткий разбор без давления и общих советов</div>
                        </div>
                        <div class="lf-note">
                            <div class="lf-note-title">Фокус</div>
                            <div class="lf-note-text">Заявки, база клиентов, контроль менеджеров и деньги в CRM</div>
                        </div>
                        <div class="lf-note">
                            <div class="lf-note-title">Итог</div>
                            <div class="lf-note-text">Понятно, нужен аудит, внедрение, интеграция или точечная доработка</div>
                        </div>
                    </div>
                </div>

                <div class="lf-card lf-anim" style="transition-delay:.44s">
                    <div class="lf-card-head">
                        <div>
                            <h3 class="lf-card-title">Опишите задачу</h3>
                            <p class="lf-card-subtitle">Вернемся с уточняющими вопросами и конкретным следующим шагом.</p>
                        </div>
                        <div class="lf-card-badge">CRM</div>
                    </div>

                    @if(session('landing_form_success'))
                        <div class="lf-success">
                            {{ session('landing_form_success') }}
                        </div>
                    @endif

                    <form action="{{ route('site.inquiries.store') }}" method="POST" class="lf-form">
                        @csrf
                        @isset($landing)
                            <input type="hidden" name="landing_slug" value="{{ $landing->slug }}">
                        @endisset
                        <input type="hidden" name="landing_title" value="{{ isset($landing) ? $landing->displayTitle() : ($landingTitle ?? ($title ?? 'Сайт')) }}">
                        <input type="hidden" name="offer_type" value="{{ $formConfig['offer_type'] }}">
                        <input type="hidden" name="page_url" value="{{ request()->fullUrl() }}">
                        <input type="hidden" name="form_anchor" value="landing-form">

                        <div class="lf-field">
                            <label class="lf-label" for="lf_name">Имя</label>
                            <input id="lf_name" name="name" type="text" value="{{ old('name') }}" class="lf-input" placeholder="Как к вам обращаться" autocomplete="name" required aria-invalid="{{ $errorBag->has('name') ? 'true' : 'false' }}">
                            @if($errorBag->has('name'))
                                <p class="lf-error">{{ $errorBag->first('name') }}</p>
                            @endif
                        </div>

                        <div class="lf-field">
                            <label class="lf-label" for="lf_contact">Контакт</label>
                            <input id="lf_contact" name="contact" type="text" value="{{ old('contact') }}" class="lf-input" placeholder="Телефон, Telegram или email" autocomplete="email" required aria-invalid="{{ $errorBag->has('contact') ? 'true' : 'false' }}">
                            @if($errorBag->has('contact'))
                                <p class="lf-error">{{ $errorBag->first('contact') }}</p>
                            @endif
                        </div>

                        <div class="lf-field">
                            <label class="lf-label" for="lf_message">Коротко о задаче</label>
                            <textarea id="lf_message" name="message" class="lf-input lf-textarea" placeholder="Например: теряются заявки, CRM уже стоит, но не дает контроля" aria-invalid="{{ $errorBag->has('message') ? 'true' : 'false' }}">{{ old('message') }}</textarea>
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
    </div>
</section>

<script>
(function() {
    var section = document.getElementById('landing-form');
    if (!section) return;
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                section.classList.add('lf-visible');
                observer.unobserve(section);
            }
        });
    }, { threshold: 0.18 });
    observer.observe(section);
})();
</script>
