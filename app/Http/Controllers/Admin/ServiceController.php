<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Service::query();

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where('title', 'like', "%{$q}%");
        }

        $services = $query->latest()->paginate(15)->withQueryString();

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        $service = new Service();

        return view('admin.services.create', compact('service'));
    }

    public function store(ServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('uploads/services', 'public');
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Услуга создана.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            if ($service->cover_image) {
                Storage::disk('public')->delete($service->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('uploads/services', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Услуга обновлена.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        if ($service->cover_image) {
            Storage::disk('public')->delete($service->cover_image);
        }

        $service->delete();

        return back()->with('success', 'Услуга удалена.');
    }
}
