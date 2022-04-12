<?php

declare(strict_types=1);

namespace App\DTO\Post;

use App\DTO\Category\CategoryDTO;
use App\DTO\User\UserDTO;
use Carbon\Carbon;

class PostDTO implements \JsonSerializable
{
    private int $id;
    private string $title;
    private string $description;
    private int $authorId;
    private CategoryDTO $category;
    private UserDTO $author;
    private Carbon $created_at;
    private int $likesCount;
    private int $dislikesCount;
    private int $commentsCount;
    private array $tags;

    public function __construct(
        int $id,
        string $title,
        string $description,
        int $authorId,
        CategoryDTO $category,
        UserDTO $author,
        Carbon $created_at,
        int $likesCount,
        int $dislikesCount,
        int $commentsCount,
        array $tags
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->authorId = $authorId;
        $this->category = $category;
        $this->author = $author;
        $this->created_at = $created_at;
        $this->likesCount = $likesCount;
        $this->dislikesCount = $dislikesCount;
        $this->commentsCount = $commentsCount;
        $this->tags = $tags;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAuthorId(): int
    {
        return $this->authorId;
    }

    public function getCategory(): CategoryDTO
    {
        return $this->category;
    }

    public function getAuthor(): UserDTO
    {
        return $this->author;
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

    public function getCommentsCount(): int
    {
        return $this->commentsCount;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function jsonSerialize(): array
    {
        return [
            'id'             => $this->getId(),
            'title'          => $this->getTitle(),
            'description'    => $this->getDescription(),
            'author_id'      => $this->getAuthorId(),
            'category'       => $this->getCategory(),
            'author'         => $this->getAuthor(),
            'created_at'     => $this->getCreatedAt(),
            'likes_count'    => $this->getLikesCount(),
            'dislikes_count' => $this->getDislikesCount(),
            'comments_count' => $this->getCommentsCount(),
            'tags'           => $this->getTags()
        ];
    }
}
