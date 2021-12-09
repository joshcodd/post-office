<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function apiLike(Request $request)
    {
        if ($request->comment) {
            $item = Comment::findOrFail($request->comment);
        } else if ($request->post) {
            $item = Post::findOrFail($request->post);
        } else {
            return response()->json([
                'messages' => ["Item does not exist."],
            ], 404);
        }

        $user_id = Auth::user()->id;
        if (!$item->likes->contains('user_id', $user_id)) {
            $like = $item->likes()->create(['user_id' => 1]);
            return response()->json([
                'like' => $like,
            ], 200);
        } else {
            return response()->json([
                'messages' => ["Item is already liked."],
            ], 403);
        }
    }

    public function apiUnlike(Like $like)
    {
        $like->delete();
    }
}