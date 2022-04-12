<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tag\CreateTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use App\Service\Tag\TagService;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function createTag(CreateTagRequest $request, TagService $tagService): JsonResponse
    {
        $tagService->createTag($request->get('title'));

        return response()->json([
            'success' => true
        ]);
    }

    public function getTags(TagService $tagService): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data'    => $tagService->getTags()
        ]);
    }

    public function updateTag(
        Tag $tag,
        UpdateTagRequest $request,
        TagService $tagService
    ): JsonResponse
    {
        $tagService->updateTag($tag, $request->get('title'));

        return response()->json([
            'success' => true
        ]);
    }

    public function deleteTag(Tag $tag, TagService $tagService): JsonResponse
    {
        $tagService->deleteTag($tag);

        return response()->json([
            'success' => true
        ]);
    }
}
