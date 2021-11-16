<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOwnsPost
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
        $post = $request->post;
        if (Auth::User()->id == $post->user->id) {
            return $next($request);
        } else {
            $error_message = 'You do not have permission to perform this action.';
            $redirect = 'posts.index';
            if (request()->wantsJson()) {
                return response()->json([
                    'message' => $error_message,
                    'redirect' => route($redirect)
                ], 401);
            }
            Session::flash('message', $error_message);
            return redirect()->route($redirect);
        }
    }
}