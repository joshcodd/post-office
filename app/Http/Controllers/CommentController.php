<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\RecievedComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function apiUpdate(Request $request, Comment $comment)
    {
        $error_messages = ['content.required' => 'Comment cannot be empty.'];
        $rules = ['content' => 'required'];
        $validator = Validator::make(
            $request->all(),
            $rules,
            $error_messages
        );

        if ($validator->fails()) {
            return response()->json([
                'messages' => $validator->errors()->all(),
            ], 400);
        }

        $comment->content = $request['content'];
        $comment->save();
        return $comment;
    }

    public function apiStore(Request $request)
    {
        $error_messages = ['content.required' => 'Comment cannot be empty.'];
        $rules = ['content' => 'required'];
        $validator = Validator::make(
            $request->all(),
            $rules,
            $error_messages
        );

        if ($validator->fails()) {
            return response()->json([
                'messages' => $validator->errors()->all(),
            ], 400);
        }

        $comment = new Comment();
        $comment->post_id = $request['post_id'];
        $comment->user_id = Auth::User()->id;
        $comment->content = $request['content'];
        $comment->save();

        $user = $comment->post->user;
        $user->notify(new RecievedComment($comment));
        return $comment->load('user');
    }

    public function apiIndex()
    {
        $comments = Comment::get()->load('user');
        return $comments;
    }

    public function apiPostComments(Post $post)
    {
        return $post->comments->load('user', 'likes');
    }

    public function apiDestroy(Comment $comment)
    {
        $comment->delete();
        return $comment->load('user');
    }
}