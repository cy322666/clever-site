<?php

namespace Tests\Feature\Public;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Tests\Concerns\CreatesPublicContent;
use Tests\TestCase;

class SeoIndexingTest extends TestCase
{
    use CreatesPublicContent;
    use RefreshDatabase;

    public function test_robots_exposes_public_host_and_sitemap(): void
    {
        config(['seo.public_url' => 'https://clevercrm.pro']);
        URL::forceRootUrl('https://clevercrm.pro');
        URL::forceScheme('https');

        $response = $this->get(route('site.robots'));

        $response->assertOk();
        $response->assertSee('User-agent: *');
        $response->assertSee('Allow: /');
        $response->assertSee('Disallow: /admin');
        $response->assertSee('Host: clevercrm.pro');
        $response->assertSee('Sitemap: https://clevercrm.pro/sitemap.xml');
    }

    public function test_sitemap_uses_model_canonical_urls(): void
    {
        config(['seo.public_url' => 'https://clevercrm.pro']);
        URL::forceRootUrl('https://clevercrm.pro');
        URL::forceScheme('https');

        $this->createLanding([
            'slug' => 'canonical-landing',
            'canonical_url' => '/solutions/canonical-landing',
        ]);

        $this->createArticle([
            'slug' => 'canonical-article',
            'canonical_url' => '/articles/canonical-article',
        ]);

        $this->createCaseStudy([
            'slug' => 'canonical-case',
            'canonical_url' => '/case-studies/canonical-case',
        ]);

        $response = $this->get(route('site.sitemap'));

        $response->assertOk();
        $response->assertSee('<loc>https://clevercrm.pro/solutions/canonical-landing</loc>', false);
        $response->assertSee('<loc>https://clevercrm.pro/articles/canonical-article</loc>', false);
        $response->assertSee('<loc>https://clevercrm.pro/case-studies/canonical-case</loc>', false);
    }

    public function test_yandex_metrika_is_rendered_on_homepage_and_layout_pages(): void
    {
        config([
            'seo.public_url' => 'https://clevercrm.pro',
            'seo.yandex_metrika_id' => '12345678',
            'seo.yandex_metrika_webvisor' => true,
        ]);

        $homeResponse = $this->get(route('site.home'));
        $contactsResponse = $this->get(route('site.contacts'));

        $homeResponse->assertOk();
        $homeResponse->assertSee('https://mc.yandex.ru/metrika/tag.js', false);
        $homeResponse->assertSee("ym('12345678', 'init'", false);

        $contactsResponse->assertOk();
        $contactsResponse->assertSee('https://mc.yandex.ru/metrika/tag.js', false);
        $contactsResponse->assertSee("ym('12345678', 'init'", false);
    }
}
