<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? ($siteSettings->site_name ?? 'CRM Integrator') }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Маркетинговый сайт CRM-интегратора' }}">
    @if(!empty($robots))
        <meta name="robots" content="{{ $robots }}">
    @endif
    @if(!empty($canonical))
        <link rel="canonical" href="{{ $canonical }}">
    @endif
    @stack('meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {!! $globalJsPlugins['head'] ?? '' !!}
</head>
<body class="min-h-screen">
    @include('site.partials.nav')

    <main class="site-main">
        @yield('content')
    </main>

    <x-site-footer />

    {!! $globalJsPlugins['body_end'] ?? '' !!}
</body>
</html>
