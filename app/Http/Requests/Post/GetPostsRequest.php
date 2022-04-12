<?php

declare(strict_types=1);

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetPostsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'perPage'        => 'required|integer|between:1,100',
            'orderBy'        => [
                'required',
                Rule::in(['created_at', 'likes_count', 'dislikes_count', 'comments_count']),
            ],
            'orderDirection' => [
                'required',
                Rule::in(['ASC', 'DESC']),
            ],
        ];
    }
}
