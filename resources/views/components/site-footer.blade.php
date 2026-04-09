<style>
    footer.sf-footer {
      margin-top: 0 !important;
      border-top: none !important;
      background: #0f0f11 !important;
      padding: 64px 0 32px !important;
      color: #fff !important;
      font-family: 'Manrope', 'Segoe UI', system-ui, sans-serif !important;
    }
    .nf-wrap { max-width:1120px; margin:0 auto; padding:0 32px; }
    .nf-grid { display:grid; grid-template-columns:1.5fr 1fr 1fr 1fr; gap:40px; margin-bottom:40px; }
    .nf-brand-name { font-size:20px !important; font-weight:700 !important; color:#fff !important; margin:0 0 12px 0 !important; }
    .nf-brand-text { font-size:14px !important; line-height:1.6 !important; color:rgba(255,255,255,.4) !important; margin:0 0 20px 0 !important; }
    .nf-socials { display:flex; gap:10px; }
    .nf-social { width:40px; height:40px; border-radius:50%; background:rgba(255,255,255,.05); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,.45); transition:all .2s; text-decoration:none; }
    .nf-social:hover { background:rgba(249,115,22,.12); color:#f97316; }
    .nf-social svg { width:18px; height:18px; }
    .nf-col-title { margin:0 0 16px 0 !important; font-size:12px !important; font-weight:700 !important; text-transform:uppercase; letter-spacing:.1em; color:rgba(255,255,255,.3) !important; }
    .nf-list { margin:0; padding:0; list-style:none; }
    .nf-list li+li { margin-top:10px; }
    .nf-list a { font-size:14px !important; color:rgba(255,255,255,.5) !important; text-decoration:none; transition:color .2s; }
    .nf-list a:hover { color:#fff !important; }
    .nf-bottom { padding-top:24px; border-top:1px solid rgba(255,255,255,.06); display:flex; justify-content:space-between; align-items:center; }
    .nf-bottom span { font-size:13px; color:rgba(255,255,255,.25); }
    @media (max-width:980px) {
      .nf-grid { grid-template-columns:1fr; gap:28px; }
      .nf-bottom { flex-direction:column; gap:8px; }
    }
</style>

<footer class="sf-footer site-footer">
    <div class="nf-wrap">
      <div class="nf-grid">
        <div class="nf-brand">
          <h3 class="nf-brand-name">{{ $siteSettings->site_name ?? 'CleverCRM' }}</h3>
          <p class="nf-brand-text">Интегратор amoCRM и CRM-экосистем для роста продаж</p>
          <div class="nf-socials">
            <a href="{{ $siteSettings->telegram_link ?? '#' }}" class="nf-social" target="_blank" rel="noreferrer" aria-label="Telegram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21.2 4.4 2.4 10.8c-.6.2-.6.6 0 .8l4.8 1.8 1.8 5.8c.1.4.5.5.8.2l2.6-2.2 4.8 3.6c.4.3 1 .1 1.1-.4L22 5.2c.1-.6-.4-1-.8-.8Z"/><path d="m9 13.6 8.4-6.4"/></svg></a>
            <a href="{{ $siteSettings->vk_link ?? '#' }}" class="nf-social" target="_blank" rel="noreferrer" aria-label="VK"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12.785 16.146s.382-.042.578-.252c.18-.193.174-.556.174-.556s-.025-1.698.764-1.95c.778-.247 1.777 1.645 2.836 2.373.8.55 1.41.43 1.41.43l2.83-.04s1.48-.09.778-1.247c-.058-.095-.41-.858-2.107-2.425-1.777-1.64-1.538-1.373.602-4.208 1.303-1.726 1.824-2.78 1.66-3.23-.155-.432-1.115-.318-1.115-.318l-3.19.02s-.236-.033-.412.073c-.173.103-.284.345-.284.345s-.51 1.357-1.19 2.512c-1.434 2.436-2.008 2.564-2.242 2.413-.545-.352-.408-1.415-.408-2.17 0-2.36.357-3.342-.697-3.598-.35-.085-.607-.14-1.5-.15-1.148-.013-2.12.004-2.67.274-.367.18-.65.58-.477.603.213.028.696.13.952.48.33.453.32 1.472.32 1.472s.188 2.78-.443 3.123c-.434.236-1.03-.245-2.31-2.448-.654-1.127-1.15-2.373-1.15-2.373s-.095-.233-.266-.358C5.17 5.4 4.9 5.36 4.9 5.36l-3.03.02s-.456.013-.623.21c-.149.177-.012.542-.012.542s2.395 5.606 5.107 8.432c2.486 2.594 5.31 2.424 5.31 2.424h1.134Z"/></svg></a>
            <a href="{{ $siteSettings->youtube_link ?? '#' }}" class="nf-social" target="_blank" rel="noreferrer" aria-label="YouTube"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M23.5 6.19a3.02 3.02 0 0 0-2.12-2.14C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.38.55A3.02 3.02 0 0 0 .5 6.19 31.6 31.6 0 0 0 0 12a31.6 31.6 0 0 0 .5 5.81 3.02 3.02 0 0 0 2.12 2.14c1.88.55 9.38.55 9.38.55s7.5 0 9.38-.55a3.02 3.02 0 0 0 2.12-2.14A31.6 31.6 0 0 0 24 12a31.6 31.6 0 0 0-.5-5.81ZM9.55 15.57V8.43L15.82 12l-6.27 3.57Z"/></svg></a>
          </div>
        </div>
        <div>
          <p class="nf-col-title">Услуги</p>
          <ul class="nf-list">
            <li><a href="/solutions/vnedrenie-amocrm">Внедрение</a></li>
            <li><a href="/solutions/perevnedrenie-amocrm">Перевнедрение</a></li>
            <li><a href="/solutions/soprovozhdenie-amocrm">Сопровождение</a></li>
            <li><a href="/solutions/analitika-prodazh-v-amocrm">Аналитика</a></li>
            <li><a href="/solutions/razrabotka-crm">Разработка</a></li>
            <li><a href="/solutions/reanimaciya-amocrm">Реанимация</a></li>
            <li><a href="/solutions/audit-amocrm">Аудит</a></li>
            <li><a href="/solutions/skolko-stoit-amocrm">Купить amoCRM</a></li>
          </ul>
        </div>
        <div>
          <p class="nf-col-title">Компания</p>
          <ul class="nf-list">
            <li><a href="/case-studies">Кейсы</a></li>
            <li><a href="/articles">Статьи</a></li>
            <li><a href="/widgets">Виджеты</a></li>
          </ul>
        </div>
        <div>
          <p class="nf-col-title">Контакты</p>
          <ul class="nf-list">
            <li><a href="/contacts">Контактная страница</a></li>
            @if($siteSettings->telegram_link ?? false)
            <li><a href="{{ $siteSettings->telegram_link }}">Telegram</a></li>
            @endif
            @if($siteSettings->email ?? false)
            <li><a href="mailto:{{ $siteSettings->email }}">{{ $siteSettings->email }}</a></li>
            @endif
            @if($siteSettings->phone ?? false)
            <li><a href="tel:{{ $siteSettings->phone }}">{{ $siteSettings->phone }}</a></li>
            @endif
          </ul>
        </div>
      </div>
      <div class="nf-bottom">
        <span>&copy; {{ date('Y') }} {{ $siteSettings->site_name ?? 'CleverCRM' }} &middot; CRM-интегратор</span>
        <span>Все права защищены</span>
      </div>
    </div>
</footer>

<script>
// Social icons hover
document.querySelectorAll('.sf-footer .nf-social').forEach(function(a) {
  a.addEventListener('mouseenter', function() {
    a.style.setProperty('color', '#f97316', 'important');
    a.style.setProperty('background', 'rgba(249,115,22,.12)', 'important');
    a.querySelectorAll('svg, svg *').forEach(function(el) {
      if (el.hasAttribute('fill') && el.getAttribute('fill') !== 'none') el.style.setProperty('fill', '#f97316', 'important');
      if (el.hasAttribute('stroke') && el.getAttribute('stroke') !== 'none') el.style.setProperty('stroke', '#f97316', 'important');
    });
  });
  a.addEventListener('mouseleave', function() {
    a.style.setProperty('color', 'rgba(255,255,255,.45)', 'important');
    a.style.setProperty('background', 'rgba(255,255,255,.05)', 'important');
    a.querySelectorAll('svg, svg *').forEach(function(el) {
      if (el.hasAttribute('fill') && el.getAttribute('fill') !== 'none') el.style.setProperty('fill', 'currentColor', 'important');
      if (el.hasAttribute('stroke') && el.getAttribute('stroke') !== 'none') el.style.setProperty('stroke', 'currentColor', 'important');
    });
  });
});
</script>
