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
                    class="overflow-scroll transition-all duration-500 ease-in-out max-h-0 bg-gray-100 pb-0 mb-0">
                    @foreach ($post->comments as $comment)

                        <div class="m-5 rounded-xl shadow-md overflow-hidden bg-white px-5 py-2">
                            <span class="block font-semibold border-b border-bg-gray-400 mb-1.5">
                                {{ $comment->user->first_name }}
                                {{ $comment->user->surname }}

                                <span class="float-right font-thin">
                                    {{ $comment->updated_at->format('Y-m-d') }}
                                </span>
                            </span>

                            <span class="">
                                {{ $comment->content }}
                            </span>

                        </div>
                    @endforeach
                </div>


                <div class="bg-white items-center">
                    <textarea
                        class="form-textarea md:w-3/4 lg:w-4/5 mt-2.5 ml-4 border border-gray-400 outline-none rounded resize-none focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                        rows="1" placeholder="Write a comment ..."></textarea>

                    <span
                        class="border  block  ml-4 md:ml-0 sm:inline sm:float-right rounded px-3 py-1 text-sm font-semibold text-black border-black my-4 mr-4 hover:bg-black hover:text-white"><a
                            href="{{ $post->link }}">Post</a>

                    </span>
                </div>

                <script>
                    function handleCommentBtnClick(id) {
                        const comments_id = "#comments_" + id.substring('comment_btn_'.length);
                        const comments = document.querySelector(comments_id);;
                        comments.classList.toggle("max-h-0");
                        comments.classList.toggle("max-h-96")
                    }
                </script>
            </div>
        @endforeach
    </div>
@endsection
