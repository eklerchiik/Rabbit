<?php

declare(strict_types=1);

namespace App\Service\Comment;

use App\DTO\Comment\CommentDTO;
use App\DTO\Comment\CommentDTOFactory;
use App\Models\Comment;
use Illuminate\Support\Facades\Log;

class CommentService
{
    private bool $shouldLog;
    private CommentDTOFactory $commentDTOFactory;

    public function __construct(bool $shouldLog, CommentDTOFactory $commentDTOFactory)
    {
        $this->shouldLog = $shouldLog;
        $this->commentDTOFactory = $commentDTOFactory;
    }

    public function createComment(int $postId, int $userId, string $text): CommentDTO
    {
        $comment = new Comment();

        $comment->post_id = $postId;
        $comment->user_id = $userId;
        $comment->text = $text;
        $comment->status = Comment::STATUS_NEW;

        $comment->save();

        if ($this->shouldLog) {
            Log::info('Comment was created: ' . $comment->id);
        }

         return $this->commentDTOFactory->buildFromModel($comment->withCount('likes')
             ->withCount('dislikes')
             ->where(['id' => $comment->id])
             ->find($comment->id));
    }

    public function getComments(int $perPage, string $orderBy, string $orderDirection)
    {
        return $this->commentDTOFactory->buildFromModelCollection(
            Comment::where('status', Comment::STATUS_VERIFIED)
                ->withCount('likes')
                ->withCount('dislikes')
                ->orderBy($orderBy, $orderDirection)
                ->simplePaginate($perPage)
                ->all()
        );
    }

    public function updateComment(Comment $comment, int $postId, int $userId, string $text): CommentDTO
    {
        $comment->post_id = $postId;
        $comment->user_id = $userId;
        $comment->text = $text;

        $comment->save();

        if ($this->shouldLog) {
            Log::info('Comment was updated: ' . $comment->id);
        }

        return $this->commentDTOFactory->buildFromModel($comment);
    }

    public function deleteComment(Comment $comment): void
    {
        $comment->delete();

        if ($this->shouldLog) {
            Log::info('Comment was deleted: ' . $comment->id);
        }
    }

    public function getCommentWithCounts(int $id): Comment
    {
        return Comment::withCount('likes')
            ->withCount('dislikes')
            ->where(['id' => $id])
            ->find($id);
    }

    public function getPostComments(int $postId): array
    {
        return Comment::where('status', Comment::STATUS_VERIFIED)
                ->withCount('likes')
                ->withCount('dislikes')
                ->where(['post_id' => $postId])
                ->get()
                ->all();
    }
}
