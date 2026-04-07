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
            ->limit(3)
            ->get()
            ->map(function (CaseStudy $caseStudy): array {
                return [
                    'title' => $caseStudy->title,
                    'meta' => $caseStudy->client_name ?: ($caseStudy->niche ?: 'Проект'),
                    'problem' => $this->extractPreviewLine(
                        $caseStudy->problem_block,
                        $caseStudy->short_description
                            ?: $caseStudy->full_content
                            ?: 'Терялись заявки и не хватало контроля по продажам.',
                    ),
                    'solution' => $this->extractPreviewLine(
                        $caseStudy->solution_block,
                        'Пересобрали CRM, воронки и ключевые сценарии работы команды.',
                    ),
                    'result' => $this->extractPreviewLine(
                        $caseStudy->result_summary ?: $caseStudy->result_block,
                        'Продажи стали управляемее, а цифры по воронке понятнее.',
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

    private function extractPreviewLine(?string $value, string $fallback): string
    {
        $source = trim((string) $value);

        if ($source === '') {
            return $this->normalizePreviewText($fallback);
        }

        $lines = preg_split('/\R/u', strip_tags($source)) ?: [];

        foreach ($lines as $line) {
            $line = trim(preg_replace('/^[\-\x{2022}\s]+/u', '', $line));

            if ($line !== '') {
                return $this->normalizePreviewText($line);
            }
        }

        return $this->normalizePreviewText($fallback);
    }
}
