<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function edit(): View
    {
        $siteSetting = SiteSetting::query()->firstOrCreate([], [
            'site_name' => 'CRM Integrator',
        ]);

        return view('admin.site-settings.edit', compact('siteSetting'));
    }

    public function update(SiteSettingRequest $request): RedirectResponse
    {
        $siteSetting = SiteSetting::query()->firstOrCreate([], [
            'site_name' => 'CRM Integrator',
        ]);

        $siteSetting->update($request->validated());

        return back()->with('success', 'Настройки сайта обновлены.');
    }
}
