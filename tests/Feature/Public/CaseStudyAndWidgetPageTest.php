<?php

namespace Tests\Feature\Public;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesPublicContent;
use Tests\TestCase;

class CaseStudyAndWidgetPageTest extends TestCase
{
    use CreatesPublicContent;
    use RefreshDatabase;

    public function test_published_case_study_opens(): void
    {
        $caseStudy = $this->createCaseStudy([
            'slug' => 'crm-audit-case',
            'title' => 'Кейс по аудиту CRM',
        ]);

        $response = $this->get(route('site.case-studies.show', $caseStudy->slug));

        $response->assertOk();
        $response->assertSee('Кейс по аудиту CRM');
        $response->assertSee('Цифры и метрики');
    }

    public function test_draft_case_study_is_not_publicly_available(): void
    {
        $caseStudy = $this->createCaseStudy([
            'slug' => 'draft-case-study',
            'status' => 'draft',
        ]);

        $response = $this->get(route('site.case-studies.show', $caseStudy->slug));

        $response->assertNotFound();
    }

    public function test_case_studies_can_be_filtered_by_niche(): void
    {
        $this->createCaseStudy([
            'slug' => 'medicine-case',
            'title' => 'Кейс для клиники',
            'niche' => 'Медицина',
        ]);

        $this->createCaseStudy([
            'slug' => 'factory-case',
            'title' => 'Кейс для производства',
            'niche' => 'Производство',
        ]);

        $response = $this->get(route('site.case-studies.index', ['niche' => 'Медицина']));

        $response->assertOk();
        $response->assertSee('Кейс для клиники');
        $response->assertDontSee('Кейс для производства');
    }

    public function test_ticker_keeps_all_cases_when_list_is_filtered(): void
    {
        $this->createCaseStudy([
            'slug' => 'medicine-case',
            'title' => 'Кейс для клиники',
            'niche' => 'Медицина',
        ]);

        $this->createCaseStudy([
            'slug' => 'factory-case',
            'title' => 'Кейс для производства',
            'niche' => 'Производство',
        ]);

        $response = $this->get(route('site.case-studies.index', ['niche' => 'Медицина']));

        $response->assertOk();
        $response->assertSee('case-studies/factory-case');
        $response->assertDontSee('<h3 class="cases-tl-title">Кейс для производства</h3>', false);
    }

    public function test_case_studies_can_be_searched(): void
    {
        $this->createCaseStudy([
            'slug' => 'analytics-case',
            'title' => 'Собрали аналитику продаж',
            'result_summary' => 'Руководитель видит конверсию и потери по каналам',
        ]);

        $this->createCaseStudy([
            'slug' => 'duplicates-case',
            'title' => 'Убрали дубли в CRM',
            'result_summary' => 'Очистили базу и навели порядок',
        ]);

        $response = $this->get(route('site.case-studies.index', ['q' => 'конверсию']));

        $response->assertOk();
        $response->assertSee('Собрали аналитику продаж');
        $response->assertDontSee('Убрали дубли в CRM');
    }

    public function test_case_studies_can_be_filtered_by_task(): void
    {
        $this->createCaseStudy([
            'slug' => 'analytics-case',
            'title' => 'Собрали аналитику продаж',
            'solution_block' => 'Собрали дашборд и отчеты для руководителя',
        ]);

        $this->createCaseStudy([
            'slug' => 'development-case',
            'title' => 'Разработка интеграции с API',
            'solution_block' => 'Написали кастомный скрипт обмена данными',
        ]);

        $response = $this->get(route('site.case-studies.index', ['task' => 'analytics']));

        $response->assertOk();
        $response->assertSee('Собрали аналитику продаж');
        $response->assertDontSee('<h3 class="cases-tl-title">Разработка интеграции с API</h3>', false);
    }

    public function test_case_study_cards_keep_detailed_flow_on_detail_page(): void
    {
        $caseStudy = $this->createCaseStudy([
            'slug' => 'compact-card-case',
            'title' => 'Компактный кейс в списке',
            'short_description' => 'Короткое описание для карточки списка.',
            'problem_block' => 'До проекта заявки терялись между этапами.',
            'solution_block' => 'Пересобрали воронку и контроль задач.',
            'result_block' => 'После проекта руководитель видит потери.',
        ]);

        $indexResponse = $this->get(route('site.case-studies.index'));

        $indexResponse->assertOk();
        $indexResponse->assertSee('Короткое описание для карточки списка.');
        $indexResponse->assertDontSee('cases-tl-block-label', false);
        $indexResponse->assertDontSee('До проекта заявки терялись между этапами.');

        $detailResponse = $this->get(route('site.case-studies.show', $caseStudy->slug));

        $detailResponse->assertOk();
        $detailResponse->assertSee('Ситуация до');
        $detailResponse->assertSee('Что сделали');
        $detailResponse->assertSee('Что стало');
        $detailResponse->assertDontSee('case-executive-flow', false);
    }

    public function test_case_study_detail_shows_cover_image_when_present(): void
    {
        $caseStudy = $this->createCaseStudy([
            'slug' => 'case-with-cover',
            'title' => 'Кейс с обложкой',
            'cover_image' => 'uploads/case-studies/cover.jpg',
        ]);

        $response = $this->get(route('site.case-studies.show', $caseStudy->slug));

        $response->assertOk();
        $response->assertSee('case-cover-section', false);
        $response->assertSee('storage/uploads/case-studies/cover.jpg');
        $response->assertSee('alt="Кейс с обложкой"', false);
    }

    public function test_case_study_detail_hides_cover_block_without_image(): void
    {
        $caseStudy = $this->createCaseStudy([
            'slug' => 'case-without-cover',
            'cover_image' => null,
        ]);

        $response = $this->get(route('site.case-studies.show', $caseStudy->slug));

        $response->assertOk();
        $response->assertDontSee('case-cover-section', false);
    }

    public function test_homepage_shows_six_compact_case_cards_without_featured_case(): void
    {
        foreach (range(1, 7) as $index) {
            $this->createCaseStudy([
                'slug' => 'home-case-'.$index,
                'title' => 'Кейс на главной '.$index,
                'short_description' => 'Описание не должно выводиться в карточке '.$index,
                'result_summary' => 'Результат не должен выводиться в карточке '.$index,
                'cover_image' => $index === 1 ? 'uploads/case-studies/home-cover.jpg' : null,
                'sort_order' => $index,
            ]);
        }

        $response = $this->get(route('site.home'));

        $response->assertOk();
        $response->assertSee('Кейс на главной 1');
        $response->assertSee('Кейс на главной 6');
        $response->assertDontSee('Кейс на главной 7');
        $response->assertDontSee('cs-featured cr-featured', false);
        $response->assertDontSee('Описание не должно выводиться в карточке 1');
        $response->assertDontSee('Результат не должен выводиться в карточке 1');
        $response->assertSee('cs-mini-preview', false);
        $response->assertSee('storage/uploads/case-studies/home-cover.jpg');
        $response->assertSee('Читать полностью →');
    }

    public function test_published_widget_opens(): void
    {
        $widget = $this->createWidget([
            'slug' => 'test-widget',
            'title' => 'Виджет для amoCRM',
        ]);

        $response = $this->get(route('site.widgets.show', $widget->slug));

        $response->assertOk();
        $response->assertSee('Виджет для amoCRM');
    }

    public function test_missing_widget_slug_returns_404(): void
    {
        $response = $this->get(route('site.widgets.show', 'missing-widget'));

        $response->assertNotFound();
    }
}
