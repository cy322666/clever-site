<?php

namespace Tests\Feature\Public;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesPublicContent;
use Tests\TestCase;

class ArticlePageTest extends TestCase
{
    use CreatesPublicContent;
    use RefreshDatabase;

    public function test_published_article_opens_and_renders_blocks(): void
    {
        $article = $this->createArticle([
            'slug' => 'perevnedrenie-crm',
            'title' => 'Почему бизнесу нужно перевнедрение CRM',
        ]);

        $response = $this->get(route('site.articles.show', $article->slug));

        $response->assertOk();
        $response->assertSee('Почему бизнесу нужно перевнедрение CRM');
        $response->assertSee('Почему это важно');
        $response->assertSee('Статья должна корректно рендериться на публичной странице');
    }

    public function test_draft_article_is_not_publicly_available(): void
    {
        $article = $this->createArticle([
            'slug' => 'draft-article',
            'status' => 'draft',
        ]);

        $response = $this->get(route('site.articles.show', $article->slug));

        $response->assertNotFound();
    }
}
