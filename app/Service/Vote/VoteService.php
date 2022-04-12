<?php

declare(strict_types=1);

namespace App\Service\Vote;

use App\DTO\Vote\VoteDTOFactory;
use App\DTO\Vote\VoteDTO;
use App\Models\Vote;
use Illuminate\Support\Facades\Log;

class VoteService
{

    private bool $shouldLog;
    private VoteDTOFactory $voteDTOFactory;

    public function __construct(bool $shouldLog, VoteDTOFactory $voteDTOFactory)
    {
        $this->shouldLog = $shouldLog;
        $this->voteDTOFactory = $voteDTOFactory;
    }

    public function vote(int $userId, int $commentId, string $vote): VoteDTO
    {
        $voteModel = Vote::updateOrCreate(
            ['user_id' => $userId, 'comment_id' => $commentId],
            ['vote' => $vote]
        );

        if ($this->shouldLog) {
            Log::info('Vote was upserted: ' . $voteModel->id);
        }

        return $this->voteDTOFactory->buildFromModel($voteModel);
    }
}
