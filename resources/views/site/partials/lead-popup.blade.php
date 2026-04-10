@php($errorBag = $errors ?? new \Illuminate\Support\ViewErrorBag)

<style>
  .lead-popup {
    position: fixed;
    inset: 0;
    z-index: 120;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 24px;
    background: rgba(15, 23, 42, .56);
    backdrop-filter: blur(10px);
  }

  .lead-popup.is-open {
    display: flex;
  }

  .lead-popup-panel {
    width: min(100%, 560px);
    border-radius: 28px;
    background: #fff;
    border: 1px solid rgba(148, 163, 184, .18);
    box-shadow: 0 30px 90px rgba(15, 23, 42, .24);
    overflow: hidden;
  }

  .lead-popup-head {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    padding: 26px 26px 0;
  }

  .lead-popup-kicker {
    margin: 0 0 8px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: #ff8a2a;
  }

  .lead-popup-title {
    margin: 0;
    font-size: 28px;
    line-height: 1.1;
    font-weight: 700;
    color: #0f172a;
  }

  .lead-popup-text {
    margin: 10px 0 0;
    font-size: 15px;
    line-height: 1.6;
    color: rgba(15, 23, 42, .62);
  }

  .lead-popup-close {
    width: 40px;
    height: 40px;
    border: 0;
    border-radius: 999px;
    background: #f8fafc;
    color: #0f172a;
    font-size: 24px;
    line-height: 1;
    cursor: pointer;
    transition: background .2s ease, transform .2s ease;
  }

  .lead-popup-close:hover {
    background: #eef2f7;
    transform: scale(1.04);
  }

  .lead-popup-body {
    padding: 22px 26px 26px;
  }

  .lead-popup-success {
    margin-bottom: 16px;
    border-radius: 18px;
    border: 1px solid #bbf7d0;
    background: #f0fdf4;
    padding: 12px 14px;
    font-size: 14px;
    font-weight: 600;
    color: #15803d;
  }

  .lead-popup-form {
    display: grid;
    gap: 14px;
  }

  .lead-popup-field {
    display: grid;
    gap: 8px;
  }

  .lead-popup-field span {
    font-size: 13px;
    font-weight: 600;
    color: #334155;
  }

  .lead-popup-input,
  .lead-popup-textarea {
    width: 100%;
    border-radius: 18px;
    border: 1px solid rgba(148, 163, 184, .32);
    background: #fff;
    padding: 14px 16px;
    font-size: 15px;
    color: #0f172a;
    transition: border-color .2s ease, box-shadow .2s ease;
  }

  .lead-popup-textarea {
    min-height: 132px;
    resize: vertical;
  }

  .lead-popup-input:focus,
  .lead-popup-textarea:focus {
    outline: none;
    border-color: rgba(255, 138, 42, .68);
    box-shadow: 0 0 0 4px rgba(255, 138, 42, .12);
  }

  .lead-popup-error {
    font-size: 12px;
    color: #dc2626;
  }

  .lead-popup-submit {
    margin-top: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    min-height: 54px;
    border: 0;
    border-radius: 18px;
    background: #0f172a;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s ease, transform .2s ease;
  }

  .lead-popup-submit:hover {
    background: #1e293b;
    transform: translateY(-1px);
  }

  .lead-popup-note {
    margin: 12px 0 0;
    font-size: 12px;
    line-height: 1.6;
    color: rgba(15, 23, 42, .54);
  }

  @media (max-width: 640px) {
    .lead-popup {
      padding: 14px;
    }

    .lead-popup-head,
    .lead-popup-body {
      padding-left: 18px;
      padding-right: 18px;
    }

    .lead-popup-title {
      font-size: 24px;
    }
  }
</style>

<div
  class="lead-popup{{ $errorBag->has('contact') ? ' is-open' : '' }}"
  id="lead-popup"
  aria-hidden="{{ $errorBag->has('contact') ? 'false' : 'true' }}"
>
  <div class="lead-popup-panel" role="dialog" aria-modal="true" aria-label="Форма обратной связи">
    <div class="lead-popup-head">
      <div>
        <p class="lead-popup-kicker">Обратная связь</p>
        <h2 class="lead-popup-title">Оставьте контакт и задачу</h2>
        <p class="lead-popup-text">Коротко разберем ситуацию и вернемся с понятным следующим шагом</p>
      </div>
      <button type="button" class="lead-popup-close" aria-label="Закрыть форму">×</button>
    </div>

    <div class="lead-popup-body">
      <form action="{{ route('site.inquiries.store') }}" method="POST" class="lead-popup-form">
        @csrf
        <input type="hidden" name="name" value="Заявка с сайта">
        <input type="hidden" name="landing_title" value="{{ $title ?? ($siteSettings->site_name ?? 'Сайт') }}">
        <input type="hidden" name="offer_type" value="">
        <input type="hidden" name="calculator_snapshot" value="{{ old('calculator_snapshot') }}">
        <input type="hidden" name="page_url" value="{{ request()->fullUrl() }}">
        <input type="hidden" name="form_anchor" value="lead-popup">

        <label class="lead-popup-field">
          <span>Контакт</span>
          <input
            type="text"
            name="contact"
            value="{{ old('contact') }}"
            class="lead-popup-input"
            placeholder="Телефон, Telegram или email"
          >
          @if($errorBag->has('contact'))
            <div class="lead-popup-error">{{ $errorBag->first('contact') }}</div>
          @endif
        </label>

        <label class="lead-popup-field">
          <span>Задача</span>
          <textarea
            name="message"
            rows="5"
            class="lead-popup-textarea"
            placeholder="Коротко опишите задачу"
          >{{ old('message') }}</textarea>
        </label>

        <button type="submit" class="lead-popup-submit">Отправить</button>
        <p class="lead-popup-note">Отправляя форму, вы оставляете контакт для связи по вашей задаче</p>
      </form>
    </div>
  </div>
</div>

<script>
  (function () {
    var popup = document.getElementById('lead-popup');
    if (!popup) return;

    var panel = popup.querySelector('.lead-popup-panel');
    var closeBtn = popup.querySelector('.lead-popup-close');
    var offerInput = popup.querySelector('input[name="offer_type"]');
    var calculatorSnapshotInput = popup.querySelector('input[name="calculator_snapshot"]');
    var pageUrlInput = popup.querySelector('input[name="page_url"]');
    var titleInput = popup.querySelector('input[name="landing_title"]');
    var contactInput = popup.querySelector('input[name="contact"]');

    function openPopup(trigger) {
      if (offerInput && trigger) {
        offerInput.value = trigger.getAttribute('data-lead-offer') || trigger.textContent.trim();
      }

      if (calculatorSnapshotInput) {
        calculatorSnapshotInput.value = trigger
          ? (trigger.getAttribute('data-lead-calculator') || '')
          : '';
      }

      if (pageUrlInput) {
        pageUrlInput.value = window.location.href;
      }

      if (titleInput) {
        titleInput.value = document.title;
      }

      popup.classList.add('is-open');
      popup.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';

      window.setTimeout(function () {
        if (contactInput) contactInput.focus();
      }, 40);
    }

    function closePopup() {
      popup.classList.remove('is-open');
      popup.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    document.addEventListener('click', function (event) {
      var trigger = event.target.closest('[data-lead-open]');
      if (trigger) {
        event.preventDefault();
        openPopup(trigger);
        return;
      }

      var contactLink = event.target.closest('a[href]');
      if (contactLink) {
        try {
          var url = new URL(contactLink.getAttribute('href'), window.location.origin);
          var isCtaLink = contactLink.classList.contains('btn') || contactLink.classList.contains('site-link');

          if (isCtaLink && url.pathname === '/contacts') {
            event.preventDefault();
            openPopup(contactLink);
            return;
          }
        } catch (e) {}
      }

      if (event.target === popup || event.target.closest('.lead-popup-close')) {
        event.preventDefault();
        closePopup();
      }
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && popup.classList.contains('is-open')) {
        closePopup();
      }
    });

    @if($errorBag->has('contact'))
      document.body.style.overflow = 'hidden';
    @endif
  })();
</script>
