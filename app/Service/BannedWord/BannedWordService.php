<?php

declare(strict_types=1);

namespace App\Service\BannedWord;

use App\DTO\BannedWord\BannedWordDTOFactory;
use App\Models\BannedWord;
use Illuminate\Support\Facades\Log;

class BannedWordService
{
    private bool $shouldLog;
    private BannedWordDTOFactory $bannedWordDTOFactory;

    public function __construct(bool $shouldLog, BannedWordDTOFactory $bannedWordDTOFactory)
    {
        $this->shouldLog = $shouldLog;
        $this->bannedWordDTOFactory = $bannedWordDTOFactory;
    }

    public function addNewWord(string $word): string
    {
        $bannedWord = new BannedWord();

        $bannedWord->word = $word;

        $bannedWord->save();

        if ($this->shouldLog) {
            Log::info('Banned word was created: ' . $bannedWord->id);
        }

        return $bannedWord->word;
    }

    public function getWords(): array
    {
        return $this->bannedWordDTOFactory->buildFromModelCollection(BannedWord::all());
    }

    public function updateWord(BannedWord $bannedWord, string $word): void
    {
        $bannedWord->word = $word;

        $bannedWord->save();

        if ($this->shouldLog) {
            Log::info('Banned word was updated: ' . $bannedWord->id);
        }
    }

    public function deleteWord(BannedWord $bannedWord): void
    {
        $bannedWord->delete();

        if ($this->shouldLog) {
            Log::info('Banned word was deleted: ' . $bannedWord->id);
        }
    }
}
