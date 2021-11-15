<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $post_author = Post::findOrFail($request->id)->user;
        if (Auth::User()->id == $post_author->id) {
            return $next($request);
        } else {
            Session::flash('message', 'You do not have permission to perform this action.');
            return redirect()->route('posts.index');
        }
    }
}