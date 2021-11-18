<?php

use App\Http\Controllers\CommentController;
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

Route::middleware('auth:sanctum')->get('comments', [CommentController::class, 'apiIndex'])->name('api.comments.index');

Route::middleware('auth:sanctum')->post('comments', [CommentController::class, 'apiStore'])->name('api.comments.store');

Route::middleware('auth:sanctum', 'item.owner')->put('comments/{comment}', [CommentController::class, 'apiUpdate'])->name('api.comments.update');

Route::middleware('auth:sanctum', 'item.owner')->delete('comments/{comment}', [CommentController::class, 'apiDestroy'])->name('api.comments.destroy');

Route::middleware('auth:sanctum')->post('users/clear-notifications', [UserController::class, 'clearNotifications'])->name('api.users.clear-notifictions');