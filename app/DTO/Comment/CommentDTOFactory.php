<?php

declare(strict_types=1);

namespace App\DTO\Comment;

use App\DTO\User\UserDTOFactory;
use App\Models\Comment;

class CommentDTOFactory
{
    private UserDTOFactory $userDTOFactory;

    public function __construct(UserDTOFactory $userDTOFactory)
    {
        $this->userDTOFactory = $userDTOFactory;
    }

    public function buildFromModel(Comment $comment): CommentDTO
    {
        return new CommentDTO(
            $comment->id,
            $comment->user_id,
            $comment->post_id,
            $comment->text,
            $comment->created_at,
            $comment->likes_count,
            $comment->dislikes_count,
            $this->userDTOFactory->buildFromModel($comment->author)
        );
    }

    public function buildFromModelCollection(array $comments): array
    {
        $commentDTOs = [];

        foreach ($comments as $comment) {
            $commentDTOs[] = $this->buildFromModel($comment);
        }

        return $commentDTOs;
    }
}
