<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SiteSettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'telegram_link' => ['nullable', 'url'],
            'youtube_link' => ['nullable', 'url'],
            'vk_link' => ['nullable', 'url'],
            'max_link' => ['nullable', 'url'],
            'teletype_link' => ['nullable', 'url'],
            'address' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string'],
        ];
    }
}
