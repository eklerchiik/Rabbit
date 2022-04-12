<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DTO\Post\PostDTOFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\GetPostsRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Requests\Post\SearchPostRequest;
use App\Models\Post;
use App\Service\Post\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function createPost(CreatePostRequest $request, PostService $postService): JsonResponse
    {
        $postDTO = $postService->createPost(
            $request->get('title'),
            $request->get('description'),
            $request->get('author_id'),
            $request->get('category_id'),
            $request->get('tags')
        );

        return response()->json([
            'success' => true,
            'post_id' => $postDTO
        ]);
    }

    public function getPosts(GetPostsRequest $request, PostService $postService): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $postService->getPosts(
                (int) $request->get('perPage'),
                $request->get('orderBy'),
                $request->get('orderDirection'))
        ]);
    }

    public function getPost(int $id, PostDTOFactory $postDTOFactory, PostService $postService): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $postDTOFactory->buildFromModel($postService->getPostWithCounts($id))
        ]);
    }

    public function updatePost(int $id, UpdatePostRequest $request, PostService $postService): JsonResponse
    {
        $postDTO = $postService->updatePost(
            $postService->getPostWithCounts($id),
            $request->get('title'),
            $request->get('description'),
            $request->get('author_id'),
            $request->get('category_id'),
            $request->get('tags')
        );

        return response()->json([
            'success' => true,
            'data'    => $postDTO
        ]);
    }

    public function deletePost(Post $post, PostService $postService): JsonResponse
    {
        $postService->deletePost($post);

        return response()->json([
            'success' => true
        ]);
    }

    public function search(SearchPostRequest $request, PostService $postService): JsonResponse
    {
        $results = $postService->search(
            $request->get('searchField'),
            $request->get('searchValue'),
            (int) $request->get('perPage'),
            $request->get('orderBy'),
            $request->get('orderDirection')
        );

        return response()->json([
            'success' => true,
            'data'    => $results
        ]);
    }
}
