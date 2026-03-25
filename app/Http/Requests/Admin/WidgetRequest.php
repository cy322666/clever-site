<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class WidgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->filled('slug') ? Str::slug($this->string('slug')) : Str::slug($this->string('title')),
        ]);
    }

    public function rules(): array
    {
        $widgetId = $this->route('widget')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('widgets', 'slug')->ignore($widgetId)],
            'price_text' => ['nullable', 'string', 'max:255'],
            'platform_compatibility' => ['nullable', 'string', 'max:255'],
            'external_link' => ['nullable', 'url'],
            'short_description' => ['nullable', 'string'],
            'full_content' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'max:4096'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string'],
        ];
    }
}
