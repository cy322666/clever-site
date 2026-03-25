<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WidgetRequest;
use App\Models\Widget;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WidgetController extends Controller
{
    public function index(Request $request): View
    {
        $query = Widget::query();

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where('title', 'like', "%{$q}%");
        }

        $widgets = $query->latest()->paginate(15)->withQueryString();

        return view('admin.widgets.index', compact('widgets'));
    }

    public function create(): View
    {
        $widget = new Widget();

        return view('admin.widgets.create', compact('widget'));
    }

    public function store(WidgetRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('uploads/widgets', 'public');
        }

        Widget::create($data);

        return redirect()->route('admin.widgets.index')->with('success', 'Виджет создан.');
    }

    public function edit(Widget $widget): View
    {
        return view('admin.widgets.edit', compact('widget'));
    }

    public function update(WidgetRequest $request, Widget $widget): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            if ($widget->cover_image) {
                Storage::disk('public')->delete($widget->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('uploads/widgets', 'public');
        }

        $widget->update($data);

        return redirect()->route('admin.widgets.index')->with('success', 'Виджет обновлен.');
    }

    public function destroy(Widget $widget): RedirectResponse
    {
        if ($widget->cover_image) {
            Storage::disk('public')->delete($widget->cover_image);
        }

        $widget->delete();

        return back()->with('success', 'Виджет удален.');
    }
}
