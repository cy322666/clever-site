<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function __invoke(): View
    {
        return view('site.about.index', [
            'caseStudies' => CaseStudy::query()
                ->published()
                ->orderBy('sort_order')
                ->latest('published_at')
                ->take(3)
                ->get(),
        ]);
    }
}
