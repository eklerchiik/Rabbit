<?php

declare(strict_types=1);

namespace App\DTO\Category;

class CategoryDTO implements \JsonSerializable
{
    private string $title;
    private int $categoryId;

    public function __construct(string $title, int $categoryId)
    {
        $this->title = $title;
        $this->categoryId = $categoryId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => $this->getTitle(),
            'id'    => $this->getCategoryId()
        ];
    }
}
