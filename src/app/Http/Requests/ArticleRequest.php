<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'priority' => 'required|in:High,Middle,Low',
            'genres' => 'required|array|max:3',
            'genres.*' => 'required|string|max:50',
            'links' => 'nullable|array|max:5',
            'links.*.title' => 'nullable|string|max:255',
            'links.*.url' => 'nullable|url|max:255',
            'content' => 'required|string',
        ];
    }
}
