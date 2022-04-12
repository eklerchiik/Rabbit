<?php

declare(strict_types=1);

namespace App\DTO\Vote;

class VoteDTO implements \JsonSerializable
{
    private int $userId;
    private int $commentId;
    private string $vote;

    public function __construct(int $userId, int $commentId, string $vote)
    {
        $this->userId = $userId;
        $this->commentId = $commentId;
        $this->vote = $vote;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCommentId(): int
    {
        return $this->commentId;
    }

    public function getVote(): string
    {
        return $this->vote;
    }

    public function jsonSerialize(): array
    {
        return [
            'userId'    => $this->getUserId(),
            'commentId' => $this->getCommentId(),
            'vote'      => $this->getVote(),
        ];
    }
}
