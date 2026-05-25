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
