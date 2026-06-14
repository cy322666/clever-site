<?php

return [
    'public_url' => env('PUBLIC_SITE_URL', env('APP_URL', 'https://clevercrm.pro')),

    'google_site_verification' => env('GOOGLE_SITE_VERIFICATION'),
    'yandex_site_verification' => env('YANDEX_SITE_VERIFICATION'),

    'yandex_metrika_id' => env('YANDEX_METRIKA_ID'),
    'yandex_metrika_webvisor' => (bool) env('YANDEX_METRIKA_WEBVISOR', true),
];
