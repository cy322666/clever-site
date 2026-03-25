<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Вход в админку</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="grid min-h-screen place-items-center bg-slate-100">
    <form action="{{ route('admin.login.store') }}" method="POST" class="w-full max-w-md card space-y-4">
        @csrf
        <h1 class="text-2xl font-semibold">Вход администратора</h1>
        <x-form.input name="email" label="Эл. почта" type="email" />
        <x-form.input name="password" label="Пароль" type="password" />
        <x-button type="submit" class="w-full">Войти</x-button>
    </form>
</body>
</html>
