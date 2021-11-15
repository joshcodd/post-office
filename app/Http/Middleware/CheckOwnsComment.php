<?php

namespace App\Http\Middleware;

use App\Models\Comment;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOwnsComment
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
        $comment_author = Comment::findOrFail($request->id)->user;
        if (Auth::User()->id == $comment_author->id) {
            return $next($request);
        } else {
            $error_message = 'You do not have permission to perform this action.';
            $redirect = 'home';
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