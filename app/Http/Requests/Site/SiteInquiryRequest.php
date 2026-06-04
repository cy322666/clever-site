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
            'calculator_snapshot' => $this->filled('calculator_snapshot') ? trim((string) $this->input('calculator_snapshot')) : null,
            'landing_slug' => $this->filled('landing_slug') ? trim((string) $this->input('landing_slug')) : null,
            'landing_title' => $this->filled('landing_title') ? trim((string) $this->input('landing_title')) : null,
            'offer_type' => $this->filled('offer_type') ? trim((string) $this->input('offer_type')) : null,
            'page_url' => $this->filled('page_url') ? trim((string) $this->input('page_url')) : null,
            'form_anchor' => $this->filled('form_anchor') ? trim((string) $this->input('form_anchor')) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'contact' => ['required', 'string', 'max:190'],
            'message' => [
                'nullable',
                'string',
                'max:3000',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if ($this->hasSpamEnglishWords((string) $value)) {
                        $fail('Проверьте описание задачи и отправьте заявку еще раз.');
                    }
                },
            ],
            'calculator_snapshot' => ['nullable', 'string', 'max:4000'],
            'landing_slug' => ['nullable', 'string', Rule::exists('landing_pages', 'slug')],
            'landing_title' => ['nullable', 'string', 'max:255'],
            'offer_type' => ['nullable', 'string', 'max:255'],
            'page_url' => ['nullable', 'url', 'max:500'],
            'form_anchor' => ['nullable', 'string', 'max:80'],
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

    private function hasSpamEnglishWords(string $message): bool
    {
        if ($message === '') {
            return false;
        }

        preg_match_all('/[A-Za-z][A-Za-z\'-]{2,}/u', $message, $matches);

        if (empty($matches[0])) {
            return false;
        }

        $allowedWords = [
            'airtable',
            'albato',
            'amocrm',
            'api',
            'avito',
            'bitrix',
            'bitrix24',
            'calltouch',
            'crm',
            'datalens',
            'docs',
            'drive',
            'facebook',
            'google',
            'instagram',
            'kommo',
            'lptracker',
            'mango',
            'meta',
            'microsoft',
            'onlinepbx',
            'power',
            'powerbi',
            'retailcrm',
            'roistat',
            'sheets',
            'telegram',
            'tilda',
            'uis',
            'vk',
            'webhook',
            'webhooks',
            'whatsapp',
            'wordpress',
            'yandex',
            'youtube',
        ];

        $allowedWords = array_fill_keys($allowedWords, true);

        foreach ($matches[0] as $word) {
            $normalizedWord = mb_strtolower(str_replace(['-', '\''], '', $word));

            if (! isset($allowedWords[$normalizedWord])) {
                return true;
            }
        }

        return false;
    }
}
