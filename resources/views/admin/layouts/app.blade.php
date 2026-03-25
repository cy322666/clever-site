<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Админка' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100">
    <div class="min-h-screen md:grid md:grid-cols-[260px_1fr]">
        @include('admin.partials.sidebar')
        <main class="p-4 md:p-8">
            @if(session('success'))
                <x-alert class="mb-4">{{ session('success') }}</x-alert>
            @endif

            @if($errors->any())
                <x-alert type="error" class="mb-4">{{ $errors->first() }}</x-alert>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
