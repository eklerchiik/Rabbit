<?php

declare(strict_types=1);

namespace App\DTO\Post;

use App\DTO\Category\CategoryDTOFactory;
use App\DTO\Tag\TagDTOFactory;
use App\DTO\User\UserDTOFactory;
use App\Models\Post;

class PostDTOFactory
{
    private TagDTOFactory $tagDTOFactory;
    private CategoryDTOFactory $categoryDTOFactory;
    private UserDTOFactory $userDTOFactory;

    public function __construct(
        TagDTOFactory $tagDTOFactory,
        CategoryDTOFactory $categoryDTOFactory,
        UserDTOFactory $userDTOFactory
    ) {
        $this->tagDTOFactory = $tagDTOFactory;
        $this->categoryDTOFactory = $categoryDTOFactory;
        $this->userDTOFactory = $userDTOFactory;
    }

    public function buildFromModel(Post $post): PostDTO
    {
        return new PostDTO(
            $post->id,
            $post->title,
            $post->description,
            $post->author_id,
            $this->categoryDTOFactory->buildFromModel($post->category),
            $this->userDTOFactory->buildFromModel($post->author),
            $post->created_at,
            $post->likes_count,
            $post->dislikes_count,
            $post->comments_count,
            $this->tagDTOFactory->buildFromModelCollection($post->tags)
        );
    }

    public function buildFromModelCollection(array $posts): array
    {
        $postDTOs = [];

        foreach ($posts as $post) {
            $postDTOs[] = $this->buildFromModel($post);
        }

        return $postDTOs;
    }
}
