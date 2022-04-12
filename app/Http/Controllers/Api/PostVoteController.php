<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostVote\CreatePostVoteRequest;
use App\Service\PostVote\PostVoteService;
use Illuminate\Http\JsonResponse;

class PostVoteController extends Controller
{
    public function createPostVote(CreatePostVoteRequest $request, PostVoteService $postVoteService): JsonResponse
    {
        $postVoteDTO = $postVoteService->vote(
            $request->get('user_id'),
            $request->get('post_id'),
            $request->get('vote')
        );

        return response()->json([
            'success'   => true,
            'data'      => $postVoteDTO
        ]);
    }
}
