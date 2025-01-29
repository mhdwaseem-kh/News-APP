<?php

namespace App\Http\Requests\ArticleRequests;


use Illuminate\Foundation\Http\FormRequest;

class ArticleListRequest extends FormRequest
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
            'page' => 'numeric|min:1',
            'perPage' => 'numeric|min:1',
            'category_id' => 'numeric|exists:categories,id',
            'author_id' => 'numeric|exists:authors,id',
            'from_date' => 'date|date_format:Y-m-d',
            'to_date' => 'date|date_format:Y-m-d',

        ];
    }
}
