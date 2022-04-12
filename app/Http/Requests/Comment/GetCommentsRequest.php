<?php

declare(strict_types=1);

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetCommentsRequest extends FormRequest
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
                Rule::in(['likes_count', 'dislikes_count', 'created_at']),
            ],
            'orderDirection' => [
                'required',
                Rule::in(['ASC', 'DESC']),
            ],
        ];
    }
}
