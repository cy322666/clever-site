<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CaseStudyRequest;
use App\Models\CaseStudy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CaseStudyController extends Controller
{
    public function index(Request $request): View
    {
        $query = CaseStudy::query();

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where('title', 'like', "%{$q}%")
                ->orWhere('client_name', 'like', "%{$q}%");
        }

        $caseStudies = $query->latest()->paginate(15)->withQueryString();

        return view('admin.case-studies.index', compact('caseStudies'));
    }

    public function create(): View
    {
        $caseStudy = new CaseStudy();

        return view('admin.case-studies.create', compact('caseStudy'));
    }

    public function store(CaseStudyRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('uploads/case-studies', 'public');
        }

        CaseStudy::create($data);

        return redirect()->route('admin.case-studies.index')->with('success', 'Кейс создан.');
    }

    public function edit(CaseStudy $caseStudy): View
    {
        return view('admin.case-studies.edit', compact('caseStudy'));
    }

    public function update(CaseStudyRequest $request, CaseStudy $caseStudy): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            if ($caseStudy->cover_image) {
                Storage::disk('public')->delete($caseStudy->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('uploads/case-studies', 'public');
        }

        $caseStudy->update($data);

        return redirect()->route('admin.case-studies.index')->with('success', 'Кейс обновлен.');
    }

    public function destroy(CaseStudy $caseStudy): RedirectResponse
    {
        if ($caseStudy->cover_image) {
            Storage::disk('public')->delete($caseStudy->cover_image);
        }

        $caseStudy->delete();

        return back()->with('success', 'Кейс удален.');
    }
}
