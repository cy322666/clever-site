@php($errorBag = $errors ?? new \Illuminate\Support\ViewErrorBag)

<section class="landing-section" id="landing-form">
    <div class="site-page-hero-box">
        <div class="grid gap-6 lg:grid-cols-[minmax(0,1.05fr)_minmax(360px,0.95fr)] lg:items-start">
            <div>
                <p class="site-kicker">Разбор CRM</p>
                <h2 class="site-title">{{ $formConfig['title'] }}</h2>
                <p class="site-subtitle">{{ $formConfig['text'] }}</p>

                <div class="mt-6 grid gap-4 md:grid-cols-3">
                    <article class="site-card">
                        <p class="site-kicker">Формат</p>
                        <p class="site-card-text mt-3">Короткий разбор без лишней продажи и общих советов.</p>
                    </article>
                    <article class="site-card">
                        <p class="site-kicker">Что смотрим</p>
                        <p class="site-card-text mt-3">Где теряются заявки, база клиентов и деньги внутри CRM.</p>
                    </article>
                    <article class="site-card">
                        <p class="site-kicker">Что получите</p>
                        <p class="site-card-text mt-3">Понятный следующий шаг: аудит, внедрение, перевнедрение или интеграция.</p>
                    </article>
                </div>
            </div>

            <div class="site-card">
                @if(session('landing_form_success'))
                    <x-alert class="mb-4">{{ session('landing_form_success') }}</x-alert>
                @endif

                <form action="{{ route('site.inquiries.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="landing_slug" value="{{ $landing->slug }}">
                    <input type="hidden" name="landing_title" value="{{ $landing->displayTitle() }}">
                    <input type="hidden" name="offer_type" value="{{ $formConfig['offer_type'] }}">
                    <input type="hidden" name="page_url" value="{{ request()->fullUrl() }}">

                    <div class="space-y-2">
                        <label for="landing_inquiry_name" class="text-sm font-medium text-slate-700">Имя</label>
                        <input
                            id="landing_inquiry_name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-4 focus:ring-slate-200/70"
                            placeholder="Как к вам обращаться"
                        >
                        @if($errorBag->has('name'))
                            <p class="text-xs text-red-600">{{ $errorBag->first('name') }}</p>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <label for="landing_inquiry_contact" class="text-sm font-medium text-slate-700">Контакт</label>
                        <input
                            id="landing_inquiry_contact"
                            name="contact"
                            type="text"
                            value="{{ old('contact') }}"
                            class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-4 focus:ring-slate-200/70"
                            placeholder="Телефон, Telegram или email"
                        >
                        @if($errorBag->has('contact'))
                            <p class="text-xs text-red-600">{{ $errorBag->first('contact') }}</p>
                        @endif
                    </div>

                    <div class="space-y-2">
                        <label for="landing_inquiry_message" class="text-sm font-medium text-slate-700">Коротко о задаче</label>
                        <textarea
                            id="landing_inquiry_message"
                            name="message"
                            rows="5"
                            class="min-h-[140px] w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-4 focus:ring-slate-200/70"
                            placeholder="Например: теряются заявки, нужна интеграция, CRM уже стоит, но не дает результата"
                        >{{ old('message') }}</textarea>
                        @if($errorBag->has('message'))
                            <p class="text-xs text-red-600">{{ $errorBag->first('message') }}</p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-full">
                        {{ $formConfig['button'] }}
                    </button>

                    <p class="text-xs leading-6 text-slate-500">
                        Отправляя форму, вы оставляете контакт для обратной связи по вашей задаче.
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
