<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\DTO\Comment\CommentDTOFactory;
use App\DTO\Post\PostDTOFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateCommentRequest;
use App\Models\Comment;
use App\Service\Category\CategoryService;
use App\Service\Comment\CommentService;
use App\Service\Post\PostService;
use App\Service\Tag\TagService;

class SinglePostController extends Controller
{

    public function getPost(
        int $postId,
        PostService $postService,
        TagService $tagService,
        PostDTOFactory $postDTOFactory,
        CategoryService $categoryService,
        CommentService $commentService,
        CommentDTOFactory $commentDTOFactory
    ) {
        $postModel = $postService->getPostWithCounts($postId);

        $postDTO = $postDTOFactory->buildFromModel($postModel);

        $latestPosts = $postService->getPosts(4, 'created_at', 'DESC');

        $tags = $tagService->getTags();

        $category = $categoryService->getCategories();

        $comment =  $commentService->getPostComments($postId);

        $comments = $commentDTOFactory->buildFromModelCollection($comment);

          return view('post', [
            'post'          => $postDTO,
            'latestPosts'   => $latestPosts,
            'tags'          => $tags,
            'categories'    => $category,
            'comments'      => $comments,
        ]);

    }

    public function createComment(CreateCommentRequest $request)
    {
        $comment = new Comment();

        $comment->user_id = $request->get('user_id');
        $comment->post_id = $request->get('post_id');
        $comment->text    = $request->get('text');

        $comment->save();

        return redirect('/posts/' . $request->get('post_id'));
    }
}
