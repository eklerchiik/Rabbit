<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\SearchPostRequest;
use App\Models\Subscription;
use App\Service\Category\CategoryService;
use App\Service\Post\PostService;
use App\Service\Tag\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    public function index(
        PostService     $postService,
        TagService      $tagService,
        CategoryService $categoryService
    )
    {
        $posts = $postService->getPosts(5, 'created_at', 'DESC');

        $latestPosts = $postService->getPosts(4, 'created_at', 'DESC');

        $tags = $tagService->getTags();

        $category = $categoryService->getCategories();

        return view('index', [
            'posts'       => $posts,
            'latestPosts' => $latestPosts,
            'tags'        => $tags,
            'categories'  => $category
        ]);
    }

    public function search(
        SearchPostRequest $request,
        PostService       $postService,
        TagService        $tagService,
        CategoryService   $categoryService
    )
    {
        $results = $postService->search(
            $request->get('searchField'),
            $request->get('searchValue'),
            (int)$request->get('perPage'),
            $request->get('orderBy'),
            $request->get('orderDirection')
        );

        $latestPosts = $postService->getPosts(4, 'created_at', 'DESC');

        $tags = $tagService->getTags();

        $category = $categoryService->getCategories();

        return view('index', [
            'posts'       => $results,
            'latestPosts' => $latestPosts,
            'tags'        => $tags,
            'categories'  => $category,
        ]);
    }

    public function createSubscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'  => 'required|unique:subscriptions'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), Response::HTTP_BAD_REQUEST);
        }

        $subscription = new Subscription();

        $subscription->email = $request->get('email');

        $subscription->save();

        return redirect('/');
    }
}
