<?php

declare(strict_types=1);

namespace App\DTO\PostVote;

use App\Models\PostVote;

class PostVoteDTOFactory
{
    public function buildFromModel(PostVote $vote): PostVoteDTO
    {
        return new PostVoteDTO($vote->user_id, $vote->post_id, $vote->vote);
    }
}
