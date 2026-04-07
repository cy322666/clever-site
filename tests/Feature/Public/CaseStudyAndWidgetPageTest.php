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
