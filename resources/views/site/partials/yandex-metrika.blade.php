@php
    $metrikaId = trim((string) config('seo.yandex_metrika_id'));
    $webvisorEnabled = (bool) config('seo.yandex_metrika_webvisor');
    $metrikaJsId = ctype_digit($metrikaId) ? $metrikaId : Js::from($metrikaId);
    $metrikaTagUrl = 'https://mc.yandex.ru/metrika/tag.js?id='.rawurlencode($metrikaId);
@endphp

@if($metrikaId !== '')
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)
        })(window, document,'script',{{ Js::from($metrikaTagUrl) }}, 'ym');

        ym({!! $metrikaJsId !!}, 'init', {ssr:true, webvisor:{{ $webvisorEnabled ? 'true' : 'false' }}, clickmap:true, ecommerce:"dataLayer", referrer: document.referrer, url: location.href, accurateTrackBounce:true, trackLinks:true});
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/{{ rawurlencode($metrikaId) }}" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
@endif
