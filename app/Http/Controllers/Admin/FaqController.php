<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FaqController extends Controller
{
    public function index(Request $request): View
    {
        $query = Faq::query();

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where('title', 'like', "%{$q}%")
                ->orWhere('question', 'like', "%{$q}%");
        }

        $faqs = $query->latest()->paginate(15)->withQueryString();

        return view('admin.faqs.index', compact('faqs'));
    }

    public function create(): View
    {
        $faq = new Faq();

        return view('admin.faqs.create', compact('faq'));
    }

    public function store(FaqRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('uploads/faqs', 'public');
        }

        Faq::create($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ создан.');
    }

    public function edit(Faq $faq): View
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(FaqRequest $request, Faq $faq): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            if ($faq->cover_image) {
                Storage::disk('public')->delete($faq->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('uploads/faqs', 'public');
        }

        $faq->update($data);

        return redirect()->route('admin.faqs.index')->with('success', 'FAQ обновлен.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        if ($faq->cover_image) {
            Storage::disk('public')->delete($faq->cover_image);
        }

        $faq->delete();

        return back()->with('success', 'FAQ удален.');
    }
}
