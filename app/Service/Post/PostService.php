<?php

declare(strict_types=1);

namespace App\Service\Post;

use App\DTO\Post\PostDTO;
use App\DTO\Post\PostDTOFactory;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class PostService
{
    private bool $shouldLog;
    private PostDTOFactory $postDTOFactory;

    public function __construct(bool $shouldLog, PostDTOFactory $postDTOFactory)
    {
        $this->shouldLog = $shouldLog;
        $this->postDTOFactory = $postDTOFactory;
    }

    public function createPost(string $title, string $description, int $authorId, int $categoryId, array $tags): PostDTO
    {
        $post = new Post();

        $post->title = $title;
        $post->description = $description;
        $post->author_id = $authorId;
        $post->category_id = $categoryId;

        $post->save();

        $post->tags()->attach($tags);

        if ($this->shouldLog) {
            Log::info('Post was created: ' . $post->id);
        }

        return $this->postDTOFactory->buildFromModel(
            $post->withCount('likes')
            ->withCount('dislikes')
            ->withCount('comments')
            ->where(['id' => $post->id])
            ->find($post->id));
    }

    public function getPosts(int $perPage, string $orderBy, string $orderDirection)
    {
        return Post::withCount('likes')
                ->withCount('dislikes')
                ->withCount('comments')
                ->with('author')
                ->orderBy($orderBy, $orderDirection)
                ->paginate($perPage);
    }

    public function updatePost(
        Post $post,
        string $title,
        string $description,
        int $authorId,
        int $categoryId,
        array $tags
    ): PostDTO
    {
        $post->title = $title;
        $post->description = $description;
        $post->author_id = $authorId;
        $post->category_id = $categoryId;

        $post->save();

        $post->tags()->sync($tags);

        if ($this->shouldLog) {
            Log::info('Post was updated: ' . $post->id);
        }

        return $this->postDTOFactory->buildFromModel($post);
    }

    public function deletePost(Post $post): void
    {
        $post->delete();

        if ($this->shouldLog) {
            Log::info('Post was deleted: ' . $post->id);
        }
    }

    public function search(
        string $searchField,
        $searchValue,
        int $perPage,
        string $orderBy,
        string $orderDirection
    ) {
        $query = Post::withCount('likes')
            ->withCount('dislikes')
            ->withCount('comments');

        if ($searchField === 'author_id') {
            $query->where(['author_id' => $searchValue]);
        } else if ($searchField === 'category_id') {
            $query->where(['category_id' => $searchValue]);
        } else if ($searchField === 'tag_id') {
            $query->whereHas('tags', function($q) use($searchValue) {
                $q->where('tag_id', $searchValue);
            });
        } else {
            $query->where($searchField, 'LIKE', "%{$searchValue}%");
        }

        return $query
            ->orderBy($orderBy, $orderDirection)
            ->paginate($perPage)
            ->appends([
                'searchField'       => $searchField,
                'searchValue'       => $searchValue,
                'perPage'           => $perPage,
                'orderBy'           => $orderBy,
                'orderDirection'    => $orderDirection
            ]);
    }

    public function getPostWithCounts(int $id): Post
    {
        return Post::withCount('likes')
            ->withCount('dislikes')
            ->withCount('comments')
            ->with('tags')
            ->where(['id' => $id])
            ->find($id);
    }
}
