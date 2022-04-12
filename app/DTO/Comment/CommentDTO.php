<?php

declare(strict_types=1);

namespace App\DTO\Comment;

use App\DTO\User\UserDTO;
use Carbon\Carbon;

class CommentDTO implements \JsonSerializable
{
    private int $id;
    private int $userId;
    private int $postId;
    private string $text;
    private Carbon $created_at;
    private int $likesCount;
    private int $dislikesCount;
    private UserDTO $author;

    public function __construct(
        int $id,
        int $userId,
        int $postId,
        string $text,
        Carbon $created_at,
        int $likesCount,
        int $dislikesCount,
        UserDTO $author
    ) {
        $this->id = $id;
        $this->userId = $userId;
        $this->postId = $postId;
        $this->text = $text;
        $this->created_at = $created_at;
        $this->likesCount = $likesCount;
        $this->dislikesCount = $dislikesCount;
        $this->author = $author;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getPostId(): int
    {
        return $this->postId;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getLikesCount(): int
    {
        return $this->likesCount;
    }

    public function getDislikesCount(): int
    {
        return $this->dislikesCount;
    }

    public function getAuthor(): UserDTO
    {
        return $this->author;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'             => $this->getId(),
            'user_id'        => $this->getUserId(),
            'post_id'        => $this->getPostId(),
            'text'           => $this->getText(),
            'created_at'     => $this->getCreatedAt(),
            'likes_count'    => $this->getLikesCount(),
            'dislikes_count' => $this->getDislikesCount(),
            'author'         => $this->getAuthor()
        ];
    }
}
