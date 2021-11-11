<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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
    if (Auth::check()) {
        return redirect()->route('posts.index');
    } else {
        return view('welcome');
    }
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('posts', [PostController::class, 'index'])->middleware(['auth'])->middleware(['auth'])->name('posts.index');

Route::get('posts/{id}', [PostController::class, 'show'])->middleware(['auth'])->middleware(['auth'])->name('posts.show');

Route::get('users/{id}', [UserController::class, 'show'])->middleware(['auth'])->middleware(['auth'])->name('users.show');

Route::get('user/me', [UserController::class, 'showMyProfile'])->middleware(['auth'])->name('users.show.me');

Route::get('user/create-token', [UserController::class, 'generateToken'])->middleware(['auth'])->name('users.create.token');

require __DIR__ . '/auth.php';