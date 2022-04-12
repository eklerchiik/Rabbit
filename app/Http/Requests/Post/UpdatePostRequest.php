<?php

declare(strict_types=1);

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|unique:posts|max:255',
            'description' => 'required',
            'author_id'   => 'required|integer',
            'category_id' => 'required|integer',
            'tags'        => 'required|array',
            'tags.*'      => 'exists:tags,id'
        ];
    }
}
