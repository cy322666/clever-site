<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? ($siteSettings->site_name ?? 'CRM Integrator') }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Маркетинговый сайт CRM-интегратора' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {!! $globalJsPlugins['head'] ?? '' !!}
</head>
<body class="min-h-screen">
    @include('site.partials.top-nav')

    <main class="site-main">
        @yield('content')
    </main>

    <x-site-footer />
    @include('site.partials.lead-popup')

    {!! $globalJsPlugins['body_end'] ?? '' !!}
</body>
</html>
