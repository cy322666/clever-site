<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    public function index(): View
    {
        return view('site.case-studies.index', [
            'caseStudies' => CaseStudy::query()
                ->where('status', 'published')
                ->orderBy('sort_order')
                ->paginate(9),
        ]);
    }

    public function show(string $slug): View
    {
        $caseStudy = CaseStudy::query()
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.case-studies.show', compact('caseStudy'));
    }
}
