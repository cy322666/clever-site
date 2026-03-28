<?php

namespace Database\Seeders;

use App\Models\LandingPage;
use Illuminate\Database\Seeder;

class LandingPageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = require database_path('seeders/data/landing_pages.php');

        foreach ($pages as $page) {
            if (array_key_exists('related_pages', $page) && ! array_key_exists('related_slugs', $page)) {
                $page['related_slugs'] = $page['related_pages'];
            }

            if (array_key_exists('anchors', $page)) {
                $page = array_merge($page, $page['anchors']);
            }

            unset($page['related_pages']);
            unset($page['anchors']);

            LandingPage::query()->updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}
