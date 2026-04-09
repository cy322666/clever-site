<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\SiteInquiryRequest;
use App\Models\LandingPage;
use App\Models\SiteInquiry;
use App\Services\TelegramNotifier;
use Illuminate\Http\RedirectResponse;
use Throwable;

class SiteInquiryController extends Controller
{
    public function __construct(
        private readonly TelegramNotifier $telegramNotifier,
    ) {
    }

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

        $inquiry = SiteInquiry::query()->create([
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

        try {
            $this->telegramNotifier->sendSiteInquiry($inquiry);
        } catch (Throwable $exception) {
            report($exception);
        }

        $target = url()->previous() ?: route('site.home');
        $anchor = $data['form_anchor'] ?? 'landing-form';

        return redirect($target.'#'.$anchor)
            ->with('landing_form_success', 'Заявка отправлена. Вернемся с конкретным следующим шагом по вашей задаче.');
    }
}
