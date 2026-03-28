<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\JsPlugin;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __invoke(): Response
    {
        $file = resource_path('static/home-main.html');

        if (! is_file($file)) {
            abort(404, 'Главная страница не найдена.');
        }

        $html = file_get_contents($file);
        $html = $this->injectSharedNavigation($html);
        $html = $this->injectCompactCasesFromDatabase($html);

        $plugins = JsPlugin::query()
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->get();

        $head = $plugins->where('placement', 'head')->map->renderedSnippet()->implode("\n");
        $bodyEnd = $plugins->where('placement', 'body_end')->map->renderedSnippet()->implode("\n");

        if ($head !== '') {
            if (str_contains($html, '</head>')) {
                $html = str_replace('</head>', "\n{$head}\n</head>", $html);
            } else {
                $html = $head."\n".$html;
            }
        }

        if ($bodyEnd !== '') {
            if (str_contains($html, '</body>')) {
                $html = str_replace('</body>', "\n{$bodyEnd}\n</body>", $html);
            } else {
                $html .= "\n{$bodyEnd}";
            }
        }

        return response($html, 200)
            ->header('Content-Type', 'text/html; charset=UTF-8');
    }

    private function injectSharedNavigation(string $html): string
    {
        $navHtml = view('site.partials.nav')->render();

        $pattern = '#<nav class="cmdf5-inspired-nav">.*?</nav>#s';
        $replaced = preg_replace($pattern, $navHtml, $html, 1);

        return is_string($replaced) ? $replaced : $html;
    }

    private function injectCompactCasesFromDatabase(string $html): string
    {
        $cardsHtml = $this->buildCompactCardsHtml(4);

        $pattern = '#(<div class="cases-compact-track" id="casesTrack">\s*)(.*?)(\s*</div>\s*</div>\s*</section>)#s';
        $replaced = preg_replace($pattern, '$1'.$cardsHtml.'$3', $html, 1);

        return is_string($replaced) ? $replaced : $html;
    }

    private function buildCompactCardsHtml(int $limit = 4): string
    {
        $cards = [];

        $caseStudies = CaseStudy::query()
            ->where('status', 'published')
            ->orderByRaw('CASE WHEN sort_order IS NULL THEN 1 ELSE 0 END')
            ->orderBy('sort_order')
            ->latest('updated_at')
            ->limit($limit)
            ->get();

        foreach ($caseStudies as $caseStudy) {
            $cards[] = [
                'meta' => $caseStudy->client_name
                    ? 'Кейс - '.$caseStudy->client_name
                    : 'Кейс',
                'title' => $caseStudy->title,
                'text' => $this->normalizePreviewText(
                    $caseStudy->result_summary
                    ?: $caseStudy->short_description
                    ?: $caseStudy->problem_block
                    ?: $caseStudy->full_content
                ),
                'url' => route('site.case-studies.show', ['slug' => $caseStudy->slug], false),
                'link_label' => 'Открыть кейс',
            ];
        }

        $rendered = [];

        if ($cards === []) {
            $rendered[] = '<article class="cases-mini-card">
        <div class="cases-mini-meta">Кейсы</div>
        <h3 class="cases-mini-title">Пока нет опубликованных кейсов</h3>
        <p class="cases-mini-text">Добавьте кейсы в админке, и они автоматически появятся в этом блоке.</p>
        <a class="cases-mini-link" href="/admin/case-studies">Перейти в админку</a>
      </article>';
        } else {
            foreach ($cards as $card) {
                $meta = e($card['meta']);
                $title = e($card['title']);
                $text = e($card['text']);
                $url = e($card['url']);
                $linkLabel = e($card['link_label']);

                $rendered[] = "<article class=\"cases-mini-card\">\n        <div class=\"cases-mini-meta\">{$meta}</div>\n        <h3 class=\"cases-mini-title\">{$title}</h3>\n        <p class=\"cases-mini-text\">{$text}</p>\n        <a class=\"cases-mini-link\" href=\"{$url}\">{$linkLabel}</a>\n      </article>";
            }
        }

        $rendered[] = '<article class="cases-mini-card cases-mini-card-more">
        <div class="cases-mini-meta">Ещё кейсы</div>
        <h3 class="cases-mini-title">Перейти к остальным кейсам</h3>
        <a class="cases-mini-link cases-mini-link-more" href="/case-studies">Смотреть кейсы <span aria-hidden="true">→</span></a>
      </article>';

        return implode("\n\n      ", $rendered);
    }

    private function normalizePreviewText(?string $value): string
    {
        $plain = trim((string) preg_replace('/\s+/u', ' ', strip_tags((string) $value)));

        return Str::limit($plain !== '' ? $plain : 'Открыть материал и посмотреть подробности проекта.', 140);
    }
}
