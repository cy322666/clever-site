<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? ($siteSettings->site_name ?? 'CRM Integrator') }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'Внедрение и перевнедрение amoCRM. Наведём порядок в продажах, уберём потери заявок и настроим контроль. Интегратор с 2020 года, 150+ проектов.' }}">
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

    <script>
        (function () {
            var nav = document.querySelector('.cmdf5-inspired-nav');
            if (!nav) return;

            var threshold = 30;
            var scrolled = false;

            function check() {
                var next = window.scrollY > threshold;
                if (next !== scrolled) {
                    scrolled = next;
                    nav.classList.toggle('nav-scrolled', next);
                }
            }

            window.addEventListener('scroll', check, { passive: true });
            check();
        })();
    </script>

    {!! $globalJsPlugins['body_end'] ?? '' !!}
</body>
</html>
