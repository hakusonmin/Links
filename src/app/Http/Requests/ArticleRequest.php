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
            'title' => 'required|string|max:50',
            'priority' => 'required|in:High,Middle,Low',
            'genres' => 'required|array|max:3',
            'genres.*' => 'required|string|max:10',
            'links' => 'nullable|array|max:5',
            'links.*.title' => 'nullable|string|max:50',
            'links.*.link_url' => 'nullable|url|max:255',
            'links.*.comment' => 'nullable|string|max:500',
            'content' => 'required|string|max:200000',
        ];
    }

    //link_urlをurlと間違えることあるからチェック..
    //↓これで 片方でLinkがタイトルとURLセットで保存されていることを保証できる..
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            foreach ($this->input('links', []) as $index => $link) {
                $title = $link['title'] ?? null;
                $link_url = $link['link_url'] ?? null;

                if ($title && !$link_url) {
                    $validator->errors()->add("links.$index.link_url", 'URLを入力してください。');
                }

                if ($link_url && !$title) {
                    $validator->errors()->add("links.$index.title", 'タイトルを入力してください。');
                }
            }
        });
    }
}
