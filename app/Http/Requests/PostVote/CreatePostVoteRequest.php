<?php

declare(strict_types=1);

namespace App\Http\Requests\PostVote;

use App\Models\PostVote;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePostVoteRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => Rule::exists('users','id'),
            'post_id' => Rule::exists('posts','id'),
            'vote'    => [
                'required',
                Rule::in([PostVote::VOTE_LIKE, PostVote::VOTE_DISLIKE]),
            ],
        ];
    }
}
