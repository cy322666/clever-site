<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\SiteInquiryRequest;
use App\Models\LandingPage;
use App\Models\SiteInquiry;
use Illuminate\Http\RedirectResponse;

class SiteInquiryController extends Controller
{
    public function store(SiteInquiryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $landing = null;

        if (! empty($data['landing_slug'])) {
            $landing = LandingPage::query()
                ->published()
                ->where('slug', $data['landing_slug'])
                ->first();
        }

        SiteInquiry::query()->create([
            'name' => $data['name'],
            'contact' => $data['contact'],
            'message' => $data['message'] ?: null,
            'landing_slug' => $landing?->slug ?? $data['landing_slug'] ?? null,
            'landing_title' => $landing?->displayTitle() ?? $data['landing_title'] ?? null,
            'offer_type' => $data['offer_type'] ?? null,
            'page_url' => $data['page_url'] ?? null,
            'status' => 'new',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        $target = url()->previous() ?: route('site.home');

        return redirect($target.'#landing-form')
            ->with('landing_form_success', 'Заявка отправлена. Вернемся с конкретным следующим шагом по вашей задаче.');
    }
}
