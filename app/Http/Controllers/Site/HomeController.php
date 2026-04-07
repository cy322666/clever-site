<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\Faq;
use App\Models\JsPlugin;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $siteSettings = SiteSetting::query()->first();

        $services = Service::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        $allCases = CaseStudy::query()
            ->where('status', 'published')
            ->orderByRaw('CASE WHEN sort_order IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sort_order')
            ->latest('updated_at')
            ->limit(4)
            ->get();

        $featuredCase = $allCases->shift();
        $caseStudies = $allCases;

        $testimonials = Testimonial::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        $faqs = Faq::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->limit(6)
            ->get();

        $footerServices = Service::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->get();

        $plugins = JsPlugin::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->get();

        $headPlugins = $plugins->where('placement', 'head')->map->renderedSnippet()->implode("\n");
        $bodyEndPlugins = $plugins->where('placement', 'body_end')->map->renderedSnippet()->implode("\n");

        return view('site.home-main', compact(
            'siteSettings',
            'services',
            'featuredCase',
            'caseStudies',
            'testimonials',
            'faqs',
            'footerServices',
            'headPlugins',
            'bodyEndPlugins',
        ));
    }
}
