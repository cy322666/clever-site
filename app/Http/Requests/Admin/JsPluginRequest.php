<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class JsPluginRequest extends FormRequest
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
        $pluginId = $this->route('js_plugin')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('js_plugins', 'slug')->ignore($pluginId)],
            'placement' => ['required', Rule::in(['head', 'body_end'])],
            'script_snippet' => ['required', 'string'],
            'status' => ['required', Rule::in(['draft', 'published'])],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
