<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FaqRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $title = $this->filled('title') ? $this->string('title') : $this->string('question');

        $this->merge([
            'title' => $title,
            'slug' => $this->filled('slug') ? Str::slug($this->string('slug')) : Str::slug($title),
        ]);
    }

    public function rules(): array
    {
        $faqId = $this->route('faq')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('faqs', 'slug')->ignore($faqId)],
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
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
