<?php

declare(strict_types=1);

namespace App\Service\BannedWord;

class BannedWordVerificationService
{
    private BannedWordService $bannedWordService;

    public function __construct(BannedWordService $bannedWordService)
    {
        $this->bannedWordService = $bannedWordService;
    }

    public function verify(string $text): bool
    {
        $bannedWords = $this->bannedWordService->getWords();

        foreach ($bannedWords as $bannedWord) {
            if (str_contains($text, $bannedWord->getWord())) {
                return false;
            }
        }

        return true;
    }
}
