<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('posts/{post}/comments', [CommentController::class, 'apiPostComments'])->name('api.comments.index');

Route::middleware('auth:sanctum')->post('comments', [CommentController::class, 'apiStore'])->name('api.comments.store');

Route::middleware('auth:sanctum', 'write.access')->put('comments/{comment}', [CommentController::class, 'apiUpdate'])->name('api.comments.update');

Route::middleware('auth:sanctum', 'write.access')->delete('comments/{comment}', [CommentController::class, 'apiDestroy'])->name('api.comments.destroy');

Route::middleware('auth:sanctum')->post('users/clear-notifications', [UserController::class, 'clearNotifications'])->name('api.users.clear-notifictions');

Route::middleware('auth:sanctum', 'write.access')->post('posts/{post}/tags', [PostController::class, 'apiTagAdd'])->name('api.posts.tag.create');

Route::middleware('auth:sanctum', 'write.access')->delete('posts/{post}/tags/{tag}', [PostController::class, 'apiTagRemove'])->name('api.posts.tag.delete');

Route::middleware('auth:sanctum')->post('posts/{post}/like', [PostController::class, 'apiLike'])->name('api.posts.like');

Route::middleware('auth:sanctum')->delete('posts/{post}/like', [PostController::class, 'apiUnlike'])->name('api.posts.unlike');

Route::middleware('auth:sanctum')->get('posts/{post}/hasliked', [PostController::class, 'apiHasLiked'])->name('api.posts.hasLiked');