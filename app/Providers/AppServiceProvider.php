<?php

namespace App\Providers;

use App\Models\JsPlugin;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $rootUrl = rtrim((string) (config('seo.public_url') ?: config('app.asset_url') ?: config('app.url')), '/');

        if ($rootUrl !== '' && ! str_contains($rootUrl, 'localhost')) {
            URL::forceRootUrl($rootUrl);

            if (str_starts_with($rootUrl, 'https://')) {
                URL::forceScheme('https');
            }
        }

        View::composer(['site.*', 'admin.*', 'errors.*', 'components.*'], function ($view): void {
            $view->with('siteSettings', SiteSetting::query()->first());
        });

        View::composer(['site.*', 'errors.*'], function ($view): void {
            $plugins = JsPlugin::query()
                ->where('status', 'published')
                ->orderBy('sort_order')
                ->get();

            $head = $plugins->where('placement', 'head')->map->renderedSnippet()->implode("\n");
            $bodyEnd = $plugins->where('placement', 'body_end')->map->renderedSnippet()->implode("\n");

            $view->with('globalJsPlugins', [
                'head' => $head,
                'body_end' => $bodyEnd,
            ]);
        });
    }
}
