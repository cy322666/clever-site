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
    private const IMAGE_FIELDS = ['cover_image', 'gallery_image_2', 'gallery_image_3'];

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
        $data = $this->handleImageUploads($request, $data);

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
        $data = $this->handleImageUploads($request, $data, $widget);

        $widget->update($data);

        return redirect()->route('admin.widgets.index')->with('success', 'Виджет обновлен.');
    }

    public function destroy(Widget $widget): RedirectResponse
    {
        foreach (self::IMAGE_FIELDS as $field) {
            if ($widget->{$field}) {
                Storage::disk('public')->delete($widget->{$field});
            }
        }

        $widget->delete();

        return back()->with('success', 'Виджет удален.');
    }

    private function handleImageUploads(WidgetRequest $request, array $data, ?Widget $widget = null): array
    {
        foreach (self::IMAGE_FIELDS as $field) {
            if (! $request->hasFile($field)) {
                continue;
            }

            if ($widget?->{$field}) {
                Storage::disk('public')->delete($widget->{$field});
            }

            $data[$field] = $request->file($field)->store('uploads/widgets', 'public');
        }

        return $data;
    }
}
