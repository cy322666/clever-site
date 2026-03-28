<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $compactCaseStudies = CaseStudy::query()
            ->published()
            ->orderByRaw('CASE WHEN sort_order IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sort_order')
            ->latest('updated_at')
            ->limit(4)
            ->get()
            ->map(function (CaseStudy $caseStudy): array {
                return [
                    'title' => $caseStudy->title,
                    'meta' => $caseStudy->client_name
                        ? 'Кейс - '.$caseStudy->client_name
                        : 'Кейс',
                    'text' => $this->normalizePreviewText(
                        $caseStudy->result_summary
                        ?: $caseStudy->short_description
                        ?: $caseStudy->problem_block
                        ?: $caseStudy->full_content
                    ),
                    'url' => route('site.case-studies.show', ['slug' => $caseStudy->slug]),
                ];
            });

        return view('site.home', [
            'seoTitle' => 'Интегратор amoCRM для роста продаж и контроля заявок | CleverCRM',
            'metaDescription' => 'Внедрение, перевнедрение и аудит amoCRM для B2B-команд. Убираем потери в продажах, наводим контроль по заявкам и возвращаем деньги из клиентской базы.',
            'canonicalUrl' => url('/'),
            'ogImageUrl' => url('/images/hero-sales-system-v3.png'),
            'compactCaseStudies' => $compactCaseStudies,
        ]);
    }

    private function normalizePreviewText(?string $value): string
    {
        $plain = trim((string) preg_replace('/\s+/u', ' ', strip_tags((string) $value)));

        return Str::limit($plain !== '' ? $plain : 'Открыть материал и посмотреть подробности проекта.', 140);
    }
}
