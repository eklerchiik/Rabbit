<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\BannedWordController;
use App\Http\Controllers\Api\PostVoteController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\VoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Posts routes
Route::post('/posts', [PostController::class, 'createPost']);
Route::get('/posts', [PostController::class, 'getPosts']);
Route::get('/posts/{post}', [PostController::class, 'getPost']);
Route::put('/posts/{post}', [PostController::class, 'updatePost']);
Route::delete('/posts/{post}', [PostController::class, 'deletePost']);
Route::get('/search', [PostController::class, 'search']);

//Comments routes
Route::post('/comments', [CommentController::class, 'createComment']);
Route::get('/comments', [CommentController::class, 'getComments']);
Route::get('/comments/{comment}', [CommentController::class, 'getComment']);
Route::put('/comments/{comment}', [CommentController::class, 'updateComment']);
Route::delete('/comments/{comment}', [CommentController::class,  'deleteComment']);

//Banned word routes
Route::post('/words', [BannedWordController::class, 'addNewWord']);
Route::get('/words', [BannedWordController::class, 'getWords']);
Route::post('/words/{bannedWord}', [BannedWordController::class, 'updateWord']);
Route::delete('/words/{bannedWord}', [BannedWordController::class,  'deleteWord']);

//Vote routes
Route::post('/comments/vote', [VoteController::class, 'createVote']);
Route::post('/posts/postVote', [PostVoteController::class, 'createPostVote']);

//Category routes
Route::post('/categories', [CategoryController::class, 'createCategory']);
Route::get('/categories', [CategoryController::class, 'getCategories']);
Route::post('/categories/{category}', [CategoryController::class, 'updateCategory']);
Route::delete('/categories/{category}', [CategoryController::class,  'deleteCategory']);

//Tag routes
Route::post('/tags', [TagController::class, 'createTag']);
Route::get('/tags', [TagController::class, 'getTags']);
Route::post('/tags/{tag}', [TagController::class, 'updateTag']);
Route::delete('/tags/{tag}', [TagController::class,  'deleteTag']);
