<?php

declare(strict_types=1);

namespace App\Service\PostVote;

use App\DTO\PostVote\PostVoteDTOFactory;
use App\DTO\PostVote\PostVoteDTO;
use App\Models\PostVote;
use Illuminate\Support\Facades\Log;

class PostVoteService
{

    private bool $shouldLog;
    private PostVoteDTOFactory $postVoteDTOFactory;

    public function __construct(bool $shouldLog, PostVoteDTOFactory $postVoteDTOFactory)
    {
        $this->shouldLog = $shouldLog;
        $this->postVoteDTOFactory = $postVoteDTOFactory;
    }

    public function vote(int $userId, int $postId, string $vote): PostVoteDTO
    {
        $postVoteModel = PostVote::updateOrCreate(
            ['user_id' => $userId, 'post_id' => $postId],
            ['vote' => $vote]
        );

        if ($this->shouldLog) {
            Log::info('Post vote was upserted: ' . $postVoteModel->id);
        }

        return $this->postVoteDTOFactory->buildFromModel($postVoteModel);
    }
}
