@php
    $metrikaId = trim((string) config('seo.yandex_metrika_id'));
    $webvisorEnabled = (bool) config('seo.yandex_metrika_webvisor');
@endphp

@if($metrikaId !== '')
    <!-- Yandex.Metrika counter -->
    <script>
        (function(m,e,t,r,i,k,a){
            m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();
            k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a);
        })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js', 'ym');

        ym({{ Js::from($metrikaId) }}, 'init', {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: {{ $webvisorEnabled ? 'true' : 'false' }}
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/{{ rawurlencode($metrikaId) }}" style="position:absolute; left:-9999px;" alt=""></div></noscript>
    <!-- /Yandex.Metrika counter -->
@endif
