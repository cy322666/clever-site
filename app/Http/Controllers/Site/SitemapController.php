<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\SitemapBuilder;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(SitemapBuilder $builder): Response
    {
        return response()
            ->view('site.sitemap.xml', $builder->build())
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
