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

<footer class="site-footer">
    <div class="container">
        <div class="site-footer-grid">
            <div>
                <p class="site-footer-title">Clever</p>
                <p class="site-footer-text">Наводим порядок в продажах: внедрение, перевнедрение и развитие amoCRM.</p>
                <div class="site-footer-bank">
                    <p class="site-footer-title">Реквизиты</p>
                    <div class="site-footer-bank-grid">
                        <div>
                            <span class="site-footer-bank-label">Наименование</span>
                            <strong>Индивидуальный предприниматель Трофимов Вячеслав Михайлович</strong>
                        </div>
                        <div>
                            <span class="site-footer-bank-label">ИНН</span>
                            <strong>025508490244</strong>
                        </div>
                        <div>
                            <span class="site-footer-bank-label">Расчётный счёт</span>
                            <strong>40802810314500038154</strong>
                        </div>
                        <div>
                            <span class="site-footer-bank-label">Название банка</span>
                            <strong>ООО "Банк Точка"</strong>
                        </div>
                        <div>
                            <span class="site-footer-bank-label">БИК</span>
                            <strong>044525104</strong>
                        </div>
                        <div>
                            <span class="site-footer-bank-label">Корреспондентский счёт</span>
                            <strong>30101810745374525104</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <p class="site-footer-title">Услуги</p>
                <ul class="site-footer-list">
                    <li><a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}">Внедрение</a></li>
                    <li><a href="{{ route('site.landings.show', 'audit-amocrm') }}">Аудит amoCRM</a></li>
                    <li><a href="{{ route('site.landings.show', 'perevnedrenie-amocrm') }}">Перевнедрение</a></li>
                    <li><a href="{{ route('site.landings.show', 'razrabotka-crm') }}">Разработка</a></li>
                    <li><a href="{{ route('site.landings.show', 'reanimaciya-amocrm') }}">Реанимация amoCRM</a></li>
                    <li><a href="{{ route('site.landings.show', 'analitika-prodazh-v-amocrm') }}">Аналитика продаж</a></li>
                    <li><a href="{{ route('site.landings.show', 'raspredelenie-lidov-amocrm') }}">Распределение лидов</a></li>
                    <li><a href="{{ route('site.landings.show', 'obrabotka-zayavok-crm') }}">Обработка заявок</a></li>
                    <li><a href="{{ route('site.landings.show', 'avtozadachi-amocrm') }}">Автозадачи</a></li>
                    <li><a href="{{ route('site.landings.show', 'integraciya-whatsapp-amocrm') }}">WhatsApp и amoCRM</a></li>
                </ul>
            </div>

            <div>
                <p class="site-footer-title">Контакты</p>
                <ul class="site-footer-list">
                    <li><a href="/case-studies">Кейсы</a></li>
                    <li><a href="/articles">Статьи</a></li>
                    <li><a href="/widgets">Виджеты</a></li>
                    <li><a href="/policy">Политика конфиденциальности</a></li>
                </ul>
            </div>
        </div>

        <div class="site-footer-meta">
            <p>© 2026 Clever · Интегратор amoCRM</p>
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
