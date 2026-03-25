<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\CaseStudy;
use App\Models\Faq;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\Widget;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'services' => Service::count(),
                'caseStudies' => CaseStudy::count(),
                'articles' => Article::count(),
                'widgets' => Widget::count(),
                'testimonials' => Testimonial::count(),
                'faqs' => Faq::count(),
            ],
        ]);
    }
}
