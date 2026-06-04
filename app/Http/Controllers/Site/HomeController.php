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
    private const HOMEPAGE_DIRECTION_CASE_SLUGS = [
        'kak-my-vystroili-kommunikacii-v-seti-klinik-krasoty-i-rabotaem-s-klientom-uze-2-goda',
        'kak-crm-mozet-nacat-mesat-prodazam-perezapusk-amocrm-dlia-obrazovatelnogo-proekta-necto',
        'b2b-analitika-datalens',
        'kak-pravilno-vybrat-mesto-dlia-vidzeta-v-amocrm-keis-art-estate',
    ];

    public function __invoke(): View
    {
        $siteSettings = SiteSetting::query()->first();

        $services = Service::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->limit(4)
            ->get();

        $caseStudies = CaseStudy::query()
            ->published()
            ->whereNotIn('slug', self::HOMEPAGE_DIRECTION_CASE_SLUGS)
            ->orderByRaw('CASE WHEN sort_order IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sort_order')
            ->latest('updated_at')
            ->limit(12)
            ->get()
            ->unique('slug')
            ->take(6)
            ->values();

        $testimonials = Testimonial::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->limit(4)
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
            'caseStudies',
            'testimonials',
            'faqs',
            'footerServices',
            'headPlugins',
            'bodyEndPlugins',
        ));
    }
}
