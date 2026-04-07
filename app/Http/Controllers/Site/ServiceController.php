<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ServiceController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('site.landings.show', 'vnedrenie-amocrm');
    }

    public function implementation(): RedirectResponse
    {
        return redirect()->route('site.landings.show', 'vnedrenie-amocrm');
    }

    public function development(): RedirectResponse
    {
        return redirect()->route('site.landings.show', 'razrabotka-crm');
    }

    public function resuscitation(): RedirectResponse
    {
        return redirect()->route('site.landings.show', 'reanimaciya-amocrm');
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

        return redirect()->route('site.landings.show', $map[$slug] ?? $slug);
    }
}
