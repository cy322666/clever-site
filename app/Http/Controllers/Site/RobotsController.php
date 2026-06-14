<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        $publicUrl = rtrim((string) config('seo.public_url'), '/');
        $host = parse_url($publicUrl, PHP_URL_HOST);

        $content = implode("\n", [
            'User-agent: *',
            'Allow: /',
            'Disallow: /admin',
            '',
            $host ? 'Host: '.$host : null,
            'Sitemap: '.route('site.sitemap'),
            '',
        ]);

        return response($content)->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
