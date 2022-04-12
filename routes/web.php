<?php

use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\SinglePostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index']);
Route::get( '/posts/{id}', [SinglePostController::class, 'getPost']);
Route::get('/search', [IndexController::class, 'search']);
Route::post('/comments', [SinglePostController::class, 'createComment']);
Route::post('/subscriptions', [IndexController::class, 'createSubscription']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
