<?php

declare(strict_types=1);

namespace App\DTO\BannedWord;


class BannedWordDTO implements \JsonSerializable
{
    private string $word;

    public function __construct(string $word)
    {
        $this->word = $word;
    }

    public function getWord(): string
    {
        return $this->word;
    }

    public function jsonSerialize(): array
    {
       return [
           'word' => $this->getWord()
       ];
    }
}
