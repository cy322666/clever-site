<?php

namespace Tests\Feature\Public;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesPublicContent;
use Tests\TestCase;

class LandingPageTest extends TestCase
{
    use CreatesPublicContent;
    use RefreshDatabase;

    public function test_published_landing_opens_and_renders_seo_meta(): void
    {
        $landing = $this->createLanding([
            'slug' => 'audit-crm-test',
            'title' => 'Аудит CRM',
            'h1' => 'Аудит CRM для бизнеса',
            'meta_title' => 'Аудит CRM под ключ',
            'meta_description' => 'Разбор CRM, потерь и точек роста',
            'canonical_url' => '/solutions/audit-crm-test',
        ]);

        $response = $this->get(route('site.landings.show', $landing->slug));

        $response->assertOk();
        $response->assertSee('Аудит CRM для бизнеса');
        $response->assertSee('<title>Аудит CRM под ключ</title>', false);
        $response->assertSee('<meta name="description" content="Разбор CRM, потерь и точек роста">', false);
        $response->assertSee('<link rel="canonical" href="'.url('/solutions/audit-crm-test').'">', false);
    }

    public function test_missing_landing_slug_returns_404(): void
    {
        $response = $this->get(route('site.landings.show', 'missing-landing'));

        $response->assertNotFound();
    }

    public function test_draft_landing_is_not_publicly_available(): void
    {
        $landing = $this->createLanding([
            'slug' => 'draft-landing',
            'status' => 'draft',
        ]);

        $response = $this->get(route('site.landings.show', $landing->slug));

        $response->assertNotFound();
    }

    public function test_extended_landing_sections_render(): void
    {
        $landing = $this->createLanding([
            'slug' => 'perevnedrenie-test',
            'sections' => [
                [
                    'type' => 'cards',
                    'kicker' => 'Типовые признаки хаоса',
                    'title' => 'Когда CRM мешает',
                    'items' => [
                        ['title' => 'Сделки живут мимо CRM', 'text' => 'Менеджеры работают в чатах'],
                    ],
                ],
                [
                    'type' => 'case_examples',
                    'kicker' => 'Примеры кейсов',
                    'title' => 'Где вернули контроль',
                    'items' => [
                        [
                            'label' => 'Производство',
                            'title' => 'Навели порядок в продажах',
                            'text' => 'Убрали хаос в воронке',
                            'result' => 'руководитель видит потери',
                            'url' => '/case-studies/proizvodstvo-crm',
                        ],
                    ],
                ],
            ],
        ]);

        $response = $this->get(route('site.landings.show', $landing->slug));

        $response->assertOk();
        $response->assertSee('Типовые признаки хаоса');
        $response->assertSee('Сделки живут мимо CRM');
        $response->assertSee('Примеры кейсов');
        $response->assertSee('Навели порядок в продажах');
    }
}
