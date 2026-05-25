<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\LandingPage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $niche = trim((string) $request->query('niche', ''));
        $taskOptions = [
            'implementation' => 'Внедрение',
            'reimplementation' => 'Перевнедрение',
            'analytics' => 'Аналитика',
            'development' => 'Разработка',
        ];
        $task = trim((string) $request->query('task', ''));
        $task = array_key_exists($task, $taskOptions) ? $task : '';
        $taskKeywords = [
            'implementation' => ['с нуля', 'запуск crm', 'новая crm', 'новую crm', 'первичн'],
            'reimplementation' => ['перевнедр', 'пересобр', 'перезапуск', 'реанимац', 'порядок', 'perevnedren', 'reanimaci', 'peresobr', 'perezapusk'],
            'analytics' => ['аналитик', 'datalens', 'дашборд', 'отчет', 'отчёт', 'analitik'],
            'development' => ['разработ', 'api', 'виджет', 'скрипт', 'кастом', 'razrabot', 'widget'],
        ];
        $searchColumns = [
            'slug',
            'title',
            'client_name',
            'short_description',
            'result_summary',
            'problem_block',
            'solution_block',
            'result_block',
            'metrics_block',
            'full_content',
        ];

        $caseStudiesQuery = CaseStudy::query()
            ->published()
            ->when($niche !== '', static function ($query) use ($niche): void {
                $query->where('niche', $niche);
            })
            ->when($task !== '', static function ($query) use ($task, $taskKeywords, $searchColumns): void {
                $query->where(static function ($builder) use ($task, $taskKeywords, $searchColumns): void {
                    foreach ($taskKeywords[$task] as $keyword) {
                        foreach ($searchColumns as $column) {
                            $builder->orWhere($column, 'like', "%{$keyword}%");
                        }
                    }
                });
            })
            ->when($search !== '', static function ($query) use ($search, $searchColumns): void {
                $query->where(static function ($builder) use ($search, $searchColumns): void {
                    foreach ($searchColumns as $column) {
                        $builder->orWhere($column, 'like', "%{$search}%");
                    }
                });
            })
            ->orderBy('sort_order')
            ->latest('published_at');

        return view('site.case-studies.index', [
            'caseStudies' => $caseStudiesQuery
                ->paginate(9)
                ->withQueryString(),
            'tickerCaseStudies' => CaseStudy::query()
                ->published()
                ->orderBy('sort_order')
                ->latest('published_at')
                ->get(),
            'caseNiches' => CaseStudy::query()
                ->published()
                ->whereNotNull('niche')
                ->where('niche', '!=', '')
                ->distinct()
                ->orderBy('niche')
                ->pluck('niche'),
            'filters' => [
                'q' => $search,
                'niche' => $niche,
                'task' => $task,
            ],
            'taskOptions' => $taskOptions,
            'relatedLandings' => LandingPage::query()
                ->published()
                ->orderBy('sort_order')
                ->limit(6)
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
