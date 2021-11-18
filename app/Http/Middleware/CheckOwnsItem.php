<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckOwnsItem
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
        if ($request->post) {
            $request_id = $request->post->user->id;
        } else if ($request->comment) {
            $request_id = $request->comment->user->id;
        }

        if (Auth::User()->id == $request_id) {
            return $next($request);
        } else {
            $error_message = 'You do not have permission to perform this action.';
            if (request()->wantsJson()) {
                return response()->json([
                    'message' => $error_message,
                    'redirect' => back()->getTargetUrl(),
                ], 401);
            }
            Session::flash('message', $error_message);
            return redirect()->back();
        }
    }
}