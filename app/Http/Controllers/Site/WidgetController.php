<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Widget;
use Illuminate\View\View;

class WidgetController extends Controller
{
    public function index(): View
    {
        return view('site.widgets.index', [
            'widgets' => Widget::query()
                ->where('status', 'published')
                ->orderBy('sort_order')
                ->paginate(9),
        ]);
    }

    public function show(string $slug): View
    {
        $widget = Widget::query()
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('site.widgets.show', compact('widget'));
    }
}
