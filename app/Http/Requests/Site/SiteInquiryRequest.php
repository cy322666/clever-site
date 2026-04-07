<?php

namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiteInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'contact' => trim((string) $this->input('contact')),
            'message' => trim((string) $this->input('message')),
            'landing_slug' => $this->filled('landing_slug') ? trim((string) $this->input('landing_slug')) : null,
            'landing_title' => $this->filled('landing_title') ? trim((string) $this->input('landing_title')) : null,
            'offer_type' => $this->filled('offer_type') ? trim((string) $this->input('offer_type')) : null,
            'page_url' => $this->filled('page_url') ? trim((string) $this->input('page_url')) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'contact' => ['required', 'string', 'max:190'],
            'message' => ['nullable', 'string', 'max:3000'],
            'landing_slug' => ['nullable', 'string', Rule::exists('landing_pages', 'slug')],
            'landing_title' => ['nullable', 'string', 'max:255'],
            'offer_type' => ['nullable', 'string', 'max:255'],
            'page_url' => ['nullable', 'url', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Укажите имя',
            'contact.required' => 'Укажите телефон, Telegram или email',
            'landing_slug.exists' => 'Страница лендинга не найдена',
            'page_url.url' => 'Некорректный адрес страницы',
        ];
    }
}
