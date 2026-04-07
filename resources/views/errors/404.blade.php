@extends('site.layouts.app', [
    'title' => 'Страница не найдена',
    'metaDescription' => 'Запрошенная страница не найдена.',
    'robots' => 'noindex,follow',
])

@section('content')
    <section class="site-section">
        <div class="container-wrap">
            <div class="error-hero">
                <p class="error-code">Ошибка 404</p>
                <h1 class="error-title">Страница не найдена</h1>
                <p class="error-text">
                    Возможно, ссылка устарела, страница была перемещена или адрес введен с ошибкой.
                    Ниже быстрые переходы в ключевые разделы сайта.
                </p>

                <div class="error-actions">
                    <a href="{{ route('site.home') }}" class="btn btn-primary">На главную</a>
                    <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}" class="btn btn-secondary">Смотреть решения</a>
                    <a href="{{ route('site.contacts') }}" class="btn btn-secondary">Связаться</a>
                </div>
            </div>

            <div class="error-links">
                <article class="site-card">
                    <p class="site-kicker">Популярное</p>
                    <h2 class="site-card-title mt-3">SEO-лендинги</h2>
                    <p class="site-card-text">Посмотрите тестовые лендинги на новом модуле с единым шаблоном и перелинковкой.</p>
                    <a href="{{ route('site.landings.show', 'vnedrenie-amocrm') }}" class="site-link">Открыть пример</a>
                </article>

                <article class="site-card">
                    <p class="site-kicker">Кейсы</p>
                    <h2 class="site-card-title mt-3">Реализованные проекты</h2>
                    <p class="site-card-text">Кейсы помогут быстро вернуться к контенту, если вы искали решение под похожую задачу.</p>
                    <a href="{{ route('site.case-studies.index') }}" class="site-link">Перейти к кейсам</a>
                </article>

                <article class="site-card">
                    <p class="site-kicker">Контакт</p>
                    <h2 class="site-card-title mt-3">Нужна помощь с навигацией?</h2>
                    <p class="site-card-text">Если искали конкретную услугу по amoCRM, можно сразу написать нам и мы направим на нужный раздел.</p>
                    <a href="{{ route('site.contacts') }}" class="site-link">Перейти в контакты</a>
                </article>
            </div>
        </div>
    </section>
@endsection
