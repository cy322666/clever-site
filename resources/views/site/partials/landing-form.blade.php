@php($errorBag = $errors ?? new \Illuminate\Support\ViewErrorBag)

<section class="landing-section" id="landing-form">
    <div class="landing-form-wrap">
        <div class="landing-form-grid">
            <div>
                <p class="landing-kicker">Заявка с лендинга</p>
                <h2 class="landing-form-title">{{ $formConfig['title'] }}</h2>
                <p class="landing-form-text">{{ $formConfig['text'] }}</p>

                <div class="mt-6 grid gap-3 md:grid-cols-3">
                    <div class="landing-form-note">
                        <p class="landing-form-note-title">Формат</p>
                        <p class="landing-form-note-text">Короткий разбор без лишней продажи и без общих советов</p>
                    </div>
                    <div class="landing-form-note">
                        <p class="landing-form-note-title">Что смотрим</p>
                        <p class="landing-form-note-text">Где теряются заявки, база клиентов и деньги внутри CRM</p>
                    </div>
                    <div class="landing-form-note">
                        <p class="landing-form-note-title">Что получите</p>
                        <p class="landing-form-note-text">Понятный следующий шаг: аудит, внедрение, перевнедрение или интеграция</p>
                    </div>
                </div>
            </div>

            <div class="landing-form-card">
                @if(session('landing_form_success'))
                    <x-alert class="mb-4">{{ session('landing_form_success') }}</x-alert>
                @endif

                <form action="{{ route('site.inquiries.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="landing_slug" value="{{ $landing->slug }}">
                    <input type="hidden" name="landing_title" value="{{ $landing->displayTitle() }}">
                    <input type="hidden" name="offer_type" value="{{ $formConfig['offer_type'] }}">
                    <input type="hidden" name="page_url" value="{{ request()->fullUrl() }}">
                    <input type="hidden" name="form_anchor" value="landing-form">

                    <div class="space-y-2">
                        <label for="landing_inquiry_name" class="text-sm font-medium text-slate-700">Имя</label>
                        <input
                            id="landing_inquiry_name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            class="landing-form-input"
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
                            class="landing-form-input"
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
                            class="landing-form-input min-h-[140px]"
                            placeholder="Например: теряются заявки, нужна интеграция, CRM уже стоит но не дает результата"
                        >{{ old('message') }}</textarea>
                        @if($errorBag->has('message'))
                            <p class="text-xs text-red-600">{{ $errorBag->first('message') }}</p>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary w-full">
                        {{ $formConfig['button'] }}
                    </button>

                    <p class="text-xs leading-6 text-slate-500">
                        Отправляя форму, вы оставляете контакт для обратной связи по вашей задаче
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>
