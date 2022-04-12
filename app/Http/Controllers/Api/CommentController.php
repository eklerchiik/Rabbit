<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Comment\CommentDTOFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Requests\Comment\GetCommentsRequest;
use App\Models\Comment;
use App\Service\Comment\CommentService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function createComment(CreateCommentRequest $request, CommentService $commentService): JsonResponse
    {
        $commentDTO = $commentService->createComment(
            $request->get('post_id'),
            $request->get('user_id'),
            $request->get('text')
        );

        return response()->json([
            'success' => true,
            'data'    => $commentDTO
        ]);
    }

    public function getComments(GetCommentsRequest $request, CommentService $commentService): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $commentService->getComments(
                (int) $request->get('perPage'),
                $request->get('orderBy'),
                $request->get('orderDirection'))
    ]);
    }

    public function getComment(int $id, CommentDTOFactory $commentDTOFactory, CommentService $commentService): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $commentDTOFactory->buildFromModel($commentService->getCommentWithCounts($id))
        ]);
    }

    public function updateComment(
        int $id,
        UpdateCommentRequest $request,
        CommentService $commentService
    ): JsonResponse {

        $commentDTO = $commentService->updateComment(
            $commentService->getCommentWithCounts($id),
            $request->get('post_id'),
            $request->get('user_id'),
            $request->get('text')
        );

        return response()->json([
            'success' => true,
            'data'    => $commentDTO
        ]);
    }

    public function deleteComment(Comment $comment, CommentService $commentService): JsonResponse
    {
        $commentService->deleteComment($comment);

        return response()->json([
            'success' => true
        ]);
    }
}
