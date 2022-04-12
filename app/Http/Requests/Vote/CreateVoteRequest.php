<?php

declare(strict_types=1);

namespace App\Http\Requests\Vote;

use App\Models\Vote;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateVoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id'    => Rule::exists('users','id'),
            'comment_id' => Rule::exists('comments','id'),
            'vote'       => [
                'required',
                Rule::in([Vote::VOTE_LIKE, Vote::VOTE_DISLIKE]),
            ],
        ];
    }
}
