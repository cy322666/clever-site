<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JsPluginRequest;
use App\Models\JsPlugin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JsPluginController extends Controller
{
    public function index(Request $request): View
    {
        $query = JsPlugin::query();

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where('title', 'like', "%{$q}%");
        }

        $plugins = $query->orderBy('sort_order')->latest()->paginate(15)->withQueryString();

        return view('admin.js-plugins.index', compact('plugins'));
    }

    public function create(): View
    {
        $plugin = new JsPlugin();

        return view('admin.js-plugins.create', compact('plugin'));
    }

    public function store(JsPluginRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        JsPlugin::create($data);

        return redirect()->route('admin.js-plugins.index')->with('success', 'JS плагин создан.');
    }

    public function edit(JsPlugin $jsPlugin): View
    {
        $plugin = $jsPlugin;

        return view('admin.js-plugins.edit', compact('plugin'));
    }

    public function update(JsPluginRequest $request, JsPlugin $jsPlugin): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $jsPlugin->update($data);

        return redirect()->route('admin.js-plugins.index')->with('success', 'JS плагин обновлен.');
    }

    public function destroy(JsPlugin $jsPlugin): RedirectResponse
    {
        $jsPlugin->delete();

        return back()->with('success', 'JS плагин удален.');
    }
}
