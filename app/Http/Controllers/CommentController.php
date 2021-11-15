<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function apiUpdate(Request $request, $id)
    {
        $validator = Validator::make([$request['content']], ['required']);
        if ($validator->fails()) {
            return response()->json([
                'messages' => $validator->errors,
            ], 400);
        }

        $comment = Comment::findOrFail($id);
        $comment->content = $request['content'];
        $comment->save();
        return $comment;
    }

    public function apiStore(Request $request)
    {
        $validator = Validator::make([$request['content']], ['required']);
        if ($validator->fails()) {
            return response()->json([
                'messages' => $validator->errors,
            ], 400);
        }

        $comment = new Comment();
        $comment->post_id = $request['post_id'];
        $comment->user_id = Auth::User()->id;
        $comment->content = $request['content'];
        $comment->save();
        return $comment->load('user');
    }

    public function apiIndex()
    {
        $comments = Comment::get()->load('user');
        return $comments;
    }

    public function apiDestroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return $comment->load('user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}