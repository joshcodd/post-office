@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="grid justify-items-center">
        @foreach ($posts as $post)
            <div class="w-2/4 m-5 rounded-xl shadow-md overflow-hidden">
                <img class="" src={{ asset('placeholder.jpg') }} alt="">
                <div class="py-4 px-6">
                    <div class="font-bold mb-2 text-xl">
                        {{ $post->title }}
                    </div>
                    <p class="text-base text-gray-600">
                        {{ $post->content }}
                    </p>
                </div>


                <div class="flow-root px-6 pt-4 pb-2">
                    <span
                        class="float-left bg-gray-400 rounded-full px-4 py-1.5 text-sm font-semibold text-gray-100 mr-2 mb-2"><a
                            href="{{ $post->link }}">View post</a>
                    </span>

                    <img id={{ 'comment_btn_' . $post->id }} onclick="handleCommentBtnClick(this.id)"
                        class="float-right mt-0.2 mr-2 mb-2"
                        src="https://img.icons8.com/material-rounded/30/000000/quote.png" />
                </div>

                <div id={{ 'comments_' . $post->id }}
                    class="transition-all duration-500 ease-in-out  overflow-auto max-h-0 bg-gray-400 pb-0 mb-0">
                    @foreach ($post->comments as $comment)
                        <div class="m-5 rounded-xl shadow-md overflow-hidden">
                            {{ $comment->content }}
                        </div>
                    @endforeach
                </div>

                <script>
                    function handleCommentBtnClick(id) {
                        const comments_id = "#comments_" + id.substring('comment_btn_'.length);
                        const comments = document.querySelector(comments_id);
                        // comments.classList.toggle("hidden");
                        comments.classList.toggle("max-h-80");
                        comments.classList.toggle("max-h-0")
                    }
                </script>
            </div>
        @endforeach
    </div>
@endsection
