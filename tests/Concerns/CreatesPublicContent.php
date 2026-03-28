<?php

namespace Tests\Concerns;

use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\LandingPage;
use App\Models\Widget;

trait CreatesPublicContent
{
    protected function createLanding(array $attributes = []): LandingPage
    {
        return LandingPage::query()->create(array_merge([
            'page_type' => 'service',
            'title' => 'Тестовый лендинг',
            'slug' => 'testovyj-lending',
            'short_title' => 'Тестовый лендинг',
            'h1' => 'Тестовый лендинг',
            'excerpt' => 'Короткое описание лендинга',
            'meta_title' => 'Meta title лендинга',
            'meta_description' => 'Meta description лендинга',
            'canonical_url' => '/solutions/testovyj-lending',
            'status' => 'published',
            'sort_order' => 10,
            'sections' => [
                [
                    'type' => 'hero',
                    'kicker' => 'Услуга',
                    'lead' => 'Лендинг для проверки публичного рендера',
                    'highlights' => ['Контроль лидов', 'Нормальная аналитика'],
                    'panel_title' => 'Что болит',
                    'panel_items' => ['Теряются заявки', 'Нет прозрачности'],
                    'primary_cta' => ['label' => 'Получить разбор', 'url' => '/contacts'],
                ],
            ],
            'anchor_variants' => ['Тестовый лендинг', 'Разбор CRM'],
            'related_slugs' => null,
        ], $attributes));
    }

    protected function createArticle(array $attributes = []): Article
    {
        return Article::query()->create(array_merge([
            'title' => 'Тестовая статья',
            'slug' => 'testovaya-statya',
            'excerpt' => 'Короткое описание статьи',
            'short_description' => 'Краткий текст статьи для карточки',
            'full_content' => null,
            'content_blocks' => [
                ['type' => 'heading', 'level' => 2, 'text' => 'Почему это важно'],
                ['type' => 'paragraph', 'text' => 'Статья должна корректно рендериться на публичной странице'],
            ],
            'status' => 'published',
            'sort_order' => 0,
            'seo_title' => 'SEO title статьи',
            'seo_description' => 'SEO description статьи',
            'canonical_url' => null,
            'published_at' => now()->subDay(),
        ], $attributes));
    }

    protected function createCaseStudy(array $attributes = []): CaseStudy
    {
        return CaseStudy::query()->create(array_merge([
            'title' => 'Тестовый кейс',
            'slug' => 'testovyj-kejs',
            'client_name' => 'ООО Тест',
            'niche' => 'B2B',
            'result_summary' => 'Собрали прозрачный контур продаж',
            'problem_block' => "- Терялись лиды\n- Руководитель не видел картину",
            'solution_block' => "- Собрали воронку\n- Настроили контроль",
            'result_block' => "- Убрали потери\n- Ускорили обработку",
            'metrics_block' => "- Конверсия выросла на 18%\n- Скорость реакции сократилась в 2 раза",
            'short_description' => 'Кейс по внедрению и контролю продаж',
            'status' => 'published',
            'sort_order' => 0,
            'seo_title' => 'SEO title кейса',
            'seo_description' => 'SEO description кейса',
            'canonical_url' => null,
            'published_at' => now()->subDay(),
        ], $attributes));
    }

    protected function createWidget(array $attributes = []): Widget
    {
        return Widget::query()->create(array_merge([
            'title' => 'Тестовый виджет',
            'slug' => 'testovyj-vidzhet',
            'price_text' => 'от 10 000 ₽',
            'platform_compatibility' => 'amoCRM, Telegram',
            'external_link' => 'https://example.com/widget',
            'short_description' => 'Короткое описание виджета',
            'full_content' => 'Подробности по тестовому виджету',
            'status' => 'published',
            'sort_order' => 0,
            'seo_title' => 'SEO title виджета',
            'seo_description' => 'SEO description виджета',
        ], $attributes));
    }
}
