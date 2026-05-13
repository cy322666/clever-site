<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('site.landings.show', ['slug' => 'vnedrenie-amocrm'], 301);
    }

    public function implementation(): RedirectResponse
    {
        return redirect()->route('site.landings.show', ['slug' => 'vnedrenie-amocrm'], 301);
    }

    public function development(): RedirectResponse
    {
        return redirect()->route('site.landings.show', ['slug' => 'razrabotka-crm'], 301);
    }

    public function resuscitation(): RedirectResponse
    {
        return redirect()->route('site.landings.show', ['slug' => 'reanimaciya-amocrm'], 301);
    }

    public function show(string $slug): RedirectResponse
    {
        $map = [
            'vnedrenie-crm' => 'vnedrenie-amocrm',
            'perevnedrenie-crm' => 'perevnedrenie-amocrm',
            'reanimaciya-amocrm' => 'reanimaciya-amocrm',
            'razrabotka-crm' => 'razrabotka-crm',
            'audit-amocrm' => 'audit-amocrm',
            'soprovozhdenie-crm' => 'soprovozhdenie-amocrm',
            'skvoznaya-analitika' => 'analitika-prodazh-v-amocrm',
            'kupit-licenzii' => 'skolko-stoit-amocrm',
        ];

        return redirect()->route('site.landings.show', ['slug' => $map[$slug] ?? $slug], 301);
    }
}
