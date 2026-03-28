<section class="landing-section">
    <div class="site-page-hero-box">
        @if(!empty($section['title']))
            <h2 class="landing-section-heading">{{ $section['title'] }}</h2>
        @endif

        @if(!empty($section['items']) && is_array($section['items']))
            <div class="landing-faq mt-6">
                @foreach($section['items'] as $item)
                    <article class="landing-faq-item">
                        <h3 class="landing-faq-question">{{ $item['question'] ?? 'Вопрос' }}</h3>
                        @if(!empty($item['answer']))
                            <p class="landing-faq-answer">{{ $item['answer'] }}</p>
                        @endif
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
