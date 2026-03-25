<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CaseStudyRequest extends FormRequest
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
        $caseStudyId = $this->route('case_study')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('case_studies', 'slug')->ignore($caseStudyId)],
            'client_name' => ['nullable', 'string', 'max:255'],
            'niche' => ['nullable', 'string', 'max:255'],
            'result_summary' => ['nullable', 'string'],
            'problem_block' => ['nullable', 'string'],
            'solution_block' => ['nullable', 'string'],
            'result_block' => ['nullable', 'string'],
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
