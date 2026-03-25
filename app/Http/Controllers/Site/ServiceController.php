<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('site.services.index', [
            'services' => Service::query()
                ->where('status', 'published')
                ->orderBy('sort_order')
                ->paginate(9),
        ]);
    }

    public function show(string $slug): View
    {
        $service = Service::query()
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.services.show', compact('service'));
    }

    public function implementation(): View
    {
        $service = Service::query()->where('slug', 'vnedrenie-crm')->first();

        $caseStudies = CaseStudy::query()
            ->where('status', 'published')
            ->orderByRaw('CASE WHEN sort_order IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sort_order')
            ->latest('updated_at')
            ->limit(2)
            ->get();

        return view('site.services.vnedrenie-amocrm', [
            'service' => $service,
            'caseStudies' => $caseStudies,
        ]);
    }

    public function development(): View
    {
        $service = Service::query()->where('slug', 'razrabotka-crm')->first();

        $caseStudies = CaseStudy::query()
            ->where('status', 'published')
            ->orderByRaw('CASE WHEN sort_order IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sort_order')
            ->latest('updated_at')
            ->limit(2)
            ->get();

        return view('site.services.razrabotka-amocrm', [
            'service' => $service,
            'caseStudies' => $caseStudies,
        ]);
    }

    public function resuscitation(): View
    {
        $service = Service::query()->where('slug', 'reanimaciya-amocrm')->first();

        $caseStudies = CaseStudy::query()
            ->where('status', 'published')
            ->orderByRaw('CASE WHEN sort_order IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sort_order')
            ->latest('updated_at')
            ->limit(2)
            ->get();

        return view('site.services.reanimaciya-amocrm', [
            'service' => $service,
            'caseStudies' => $caseStudies,
        ]);
    }
}
