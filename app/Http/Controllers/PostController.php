<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts_per_page = 10;
        $posts = Post::orderBy('created_at', 'desc')->paginate($posts_per_page);

        $word_limit = 50;
        foreach ($posts as $post) {
            $words = explode(' ', $post->content);
            $words_culled = array_slice($words, 0, $word_limit);
            $post->content = implode(' ', $words_culled) . ".......";
        }
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_post = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'mimes:jpeg,png',
        ]);

        $post = new Post();
        $post->user_id = Auth::User()->id;
        $post->title = $validated_post['title'];
        $post->content = $validated_post['content'];
        $post->image_path = $this->uploadImage($request);
        $post->save();

        $request->session()->flash('message', 'Posted!');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $validated_post = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'mimes:jpeg,png',
        ]);

        $post->title = $validated_post['title'];
        $post->content = $validated_post['content'];
        $post->image_path = $this->uploadImage($request);
        $post->save();

        $request->session()->flash('message', 'Post has been edited!');
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('message', 'Your post has been deleted.');
    }

    public function uploadImage(Request $request)
    {
        $dir = 'public/images';
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store($dir);
            return substr($path, strlen($dir));
        } else {
            return null;
        }
    }
}