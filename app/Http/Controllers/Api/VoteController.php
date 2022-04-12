<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vote\CreateVoteRequest;
use App\Service\Vote\VoteService;
use Illuminate\Http\JsonResponse;

class VoteController extends Controller
{
    public function createVote(CreateVoteRequest $request, VoteService $voteService): JsonResponse
    {
        $voteDTO = $voteService->vote(
            $request->get('user_id'),
            $request->get('comment_id'),
            $request->get('vote')
        );

        return response()->json([
            'success'   => true,
            'data'      => $voteDTO
        ]);
    }
}
