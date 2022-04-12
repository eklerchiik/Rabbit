<?php

declare(strict_types=1);

namespace App\DTO\Tag;

class TagDTO implements \JsonSerializable
{
    private string $title;
    private int $id;

    public function __construct(string $title, int $id)
    {
        $this->title = $title;
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getTagId(): int
    {
        return $this->id;
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => $this->getTitle(),
            'id'    => $this->getTagId()
        ];
    }
}
