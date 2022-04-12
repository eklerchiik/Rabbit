<?php

declare(strict_types=1);

namespace App\DTO\PostVote;

class PostVoteDTO implements \JsonSerializable
{
    private int $userId;
    private int $postId;
    private string $vote;

    public function __construct(int $userId, int $postId, string $vote)
    {
        $this->userId = $userId;
        $this->postId = $postId;
        $this->vote = $vote;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getVote(): string
    {
        return $this->vote;
    }

    public function jsonSerialize(): array
    {
        return [
            'userId'    => $this->getUserId(),
            'postId'    => $this->getPostId(),
            'vote'      => $this->getVote(),
        ];
    }
}
