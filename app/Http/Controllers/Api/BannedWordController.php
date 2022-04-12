<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannedWord\AddWordRequest;
use App\Http\Requests\BannedWord\UpdateWordRequest;
use App\Models\BannedWord;
use App\Service\BannedWord\BannedWordService;
use Illuminate\Http\JsonResponse;

class BannedWordController extends Controller
{
    public function addNewWord(AddWordRequest $request, BannedWordService $bannedWordService): JsonResponse
    {
        $bannedWordService->addNewWord($request->get('word'));

        return response()->json([
            'success' => true
        ]);
    }

    public function getWords(BannedWordService $bannedWordService): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $bannedWordService->getWords()
        ]);
    }

    public function updateWord(
        BannedWord $bannedWord,
        UpdateWordRequest $request,
        BannedWordService $bannedWordService
    ): JsonResponse
    {
        $bannedWordService->updateWord($bannedWord, $request->get('word'));

        return response()->json([
            'success' => true
        ]);
    }

    public function deleteWord(BannedWord $bannedWord, BannedWordService $bannedWordService): JsonResponse
    {
        $bannedWordService->deleteWord($bannedWord);

        return response()->json([
            'success' => true
        ]);
    }
}
