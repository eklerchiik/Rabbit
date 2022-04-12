<?php

declare(strict_types=1);

namespace App\DTO\Vote;

use App\Models\Vote;

class VoteDTOFactory
{
    public function buildFromModel(Vote $vote): VoteDTO
    {
        return new VoteDTO($vote->user_id, $vote->comment_id, $vote->vote);
    }
}
