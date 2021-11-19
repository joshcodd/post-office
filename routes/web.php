<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use App\Models\Tag;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth.login');
})->middleware(['guest'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('posts', [PostController::class, 'index'])->middleware(['auth'])->name('posts.index');

Route::post('posts', [PostController::class, 'store'])->middleware(['auth'])->name('posts.store');

Route::get('posts/create', [PostController::class, 'create'])->middleware(['auth'])->name('posts.create');

Route::get('posts/{post}', [PostController::class, 'show'])->middleware(['auth'])->name('posts.show');

Route::put('posts/{post}', [PostController::class, 'update'])->middleware(['auth', 'write.access'])->name('posts.update');

Route::delete('posts/{post}', [PostController::class, 'destroy'])->middleware(['auth', 'write.access'])->name('posts.destroy');

Route::get('posts/{post}/edit', [PostController::class, 'edit'])->middleware(['auth', 'write.access'])->name('posts.edit');

Route::get('users/me', [UserController::class, 'showMyProfile'])->middleware(['auth'])->name('users.show.me');

Route::get('users/notifications', [UserController::class, 'notifications'])->middleware(['auth'])->name('users.notifications');

Route::post('users/create-token', [UserController::class, 'generateToken'])->middleware(['auth'])->name('users.create.token');

Route::get('users/{user}', [UserController::class, 'show'])->middleware(['auth'])->name('users.show');

Route::get('tags/{tag}', function (Tag $tag) {
    return View('tags.show', ['tag' => $tag]);
})->middleware(['auth'])->name('tags.show');


require __DIR__ . '/auth.php';