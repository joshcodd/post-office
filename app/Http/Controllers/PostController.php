<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use App\Rules\OneWord;
use App\Services\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

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

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request,  Facebook $fb)
    {
        $validated_post = $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:10',
            'image' => 'mimes:jpeg,png',
        ]);

        $post = new Post();
        $post->user_id = Auth::User()->id;
        $post->title = $validated_post['title'];
        $post->content = $validated_post['content'];
        $post->image_path = $this->uploadImage($request);
        $post->save();

        $tags = explode(',', $request['tags']);
        foreach ($tags as $tag) {
            $request->request->add(['name' => $tag]);
            $this->apiTagAdd($request, $post);
        }

        $fb->postStatus($post);

        $request->session()->flash('message', 'Posted!');
        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $validated_post = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'mimes:jpeg,png',
        ]);

        $post->title = $validated_post['title'];
        $post->content = $validated_post['content'];
        if ($request['hasUpdatedImage'] != null) {
            $post->image_path = $this->uploadImage($request);
        }
        $post->save();

        $request->session()->flash('message', 'Post has been edited!');
        return view('posts.show', ['post' => $post]);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('message', 'Your post has been deleted.');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $resized = Image::make($file)->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('webp', 90);

            $original_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $file_path = "images/" . md5(time()) . '_' . $original_name . ".webp";
            Storage::disk('s3')->put($file_path, (string)$resized, 'public');

            $s3_url = Storage::disk('s3')->url($file_path);
            return $s3_url;
        } else {
            return null;
        }
    }

    public function apiTagAdd(Request $request, Post $post)
    {
        $error_messages = ['name.required' => 'Tag cannot be empty.'];
        $rules = ['name' => ["required", new OneWord]];
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

        $tag_name = trim($request['name']);
        $existing_tag = Tag::firstWhere('name', $tag_name);
        if ($existing_tag) {
            if ($post->tags->contains($existing_tag->id)) {
                return response()->json([
                    'messages' => ["Already tagged!"],
                ], 400);
            }
            $post->tags()->attach($existing_tag->id);
            return $existing_tag;
        } else {
            $tag = new Tag();
            $tag->name = $tag_name;
            $tag->save();
            $post->tags()->attach($tag->id);
            return $tag;
        }
    }

    public function apiTagRemove(Post $post, Tag $tag)
    {
        $post->tags()->detach($tag);
        return $tag;
    }
}