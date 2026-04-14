<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\Service;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    public function index(): View
    {
        return view('site.case-studies.index', [
            'caseStudies' => CaseStudy::query()
                ->published()
                ->orderBy('sort_order')
                ->latest('published_at')
                ->paginate(9),
            'relatedServices' => Service::query()
                ->where('status', 'published')
                ->orderBy('sort_order')
                ->limit(3)
                ->get(),
            'relatedArticles' => Article::query()
                ->published()
                ->orderBy('sort_order')
                ->latest('published_at')
                ->limit(3)
                ->get(),
        ]);
    }

    public function show(string $slug): View
    {
        $caseStudy = CaseStudy::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.case-studies.show', compact('caseStudy'));
    }
}
