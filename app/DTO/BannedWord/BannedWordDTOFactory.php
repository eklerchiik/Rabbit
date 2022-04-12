<?php

declare(strict_types=1);

namespace App\DTO\BannedWord;

use App\Models\BannedWord;
use Illuminate\Database\Eloquent\Collection;

class BannedWordDTOFactory
{
    public function buildFromModel(BannedWord $bannedWord): BannedWordDTO
    {
        return new BannedWordDTO($bannedWord->word);
    }

    public function buildFromModelCollection(Collection $words): array
    {
        $wordsDTOs = [];

        foreach ($words as $word) {
            $wordsDTOs[] = $this->buildFromModel($word);
        }

        return $wordsDTOs;
    }
}
