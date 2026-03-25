<aside class="border-r border-slate-200 bg-white p-4">
    <a href="{{ route('admin.dashboard') }}" class="block text-lg font-semibold text-slate-900">
        Админка
    </a>

    <nav class="mt-6 space-y-1 text-sm">
        <a class="block rounded px-3 py-2 hover:bg-slate-100" href="{{ route('admin.services.index') }}">Услуги</a>
        <a class="block rounded px-3 py-2 hover:bg-slate-100" href="{{ route('admin.case-studies.index') }}">Кейсы</a>
        <a class="block rounded px-3 py-2 hover:bg-slate-100" href="{{ route('admin.articles.index') }}">Статьи</a>
        <a class="block rounded px-3 py-2 hover:bg-slate-100" href="{{ route('admin.widgets.index') }}">Виджеты</a>
        <a class="block rounded px-3 py-2 hover:bg-slate-100" href="{{ route('admin.js-plugins.index') }}">JS плагины</a>
        <a class="block rounded px-3 py-2 hover:bg-slate-100" href="{{ route('admin.testimonials.index') }}">Отзывы</a>
        <a class="block rounded px-3 py-2 hover:bg-slate-100" href="{{ route('admin.faqs.index') }}">FAQ</a>
        <a class="block rounded px-3 py-2 hover:bg-slate-100" href="{{ route('admin.site-settings.edit') }}">Настройки</a>
        <a class="block rounded px-3 py-2 hover:bg-slate-100" href="{{ route('site.home') }}" target="_blank">Открыть сайт</a>
    </nav>

    <form class="mt-6" action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <x-button variant="secondary" type="submit" class="w-full">Выйти</x-button>
    </form>
</aside>
