@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="grid justify-items-center">
        <div class="w-2/4 m-5 rounded-xl ">
            <div class="font-garamond font-bold mb-2 text-5xl">
                {{ $post->title }}
            </div>

            <div class="w-full font-semibold mb-2 text-xl inline-block">
                <a href="{{ route('users.show', ['id' => $post->user->id]) }}" class="hover:underline">
                    {{ $post->user->first_name }}
                    {{ $post->user->surname }}</a>
                <div class="font-thin ml-5 text-base inline-block">
                    {{ $post->updated_at->format('Y-m-d') }}
                </div>

                @if (Auth::User()->id == $post->user->id)
                    <a class="mt-0.5 float-right rounded-full px-3 py-1 text-xs font-semibold border text-black border-black  hover:bg-gray-700 hover:text-white"
                        href="{{ route('posts.edit', ['id' => $post->id]) }}">Edit post</a>
                @endif
            </div>

            <img class="" src={{ asset(rand(0, 3) . '.jpg') }} alt="">
            <div class="py-5">
                <p class="text-xl text-gray-600 whitespace-pre-line">{{ $post->content }}</p>
            </div>

            <div class="flow-root  pt-4 pb-2">
                <div id={{ 'comment_count_' . $post->id }} class=" float-right mt-1 ml-2 ">
                    {{ $post->comments->count() }}
                </div>
                <button id={{ 'comment_btn_' . $post->id }} onclick="handleCommentBtnClick(this.id)"
                    class="group  mt-1 mb-2 inline-block float-right">
                    <svg xmlns=" http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                        <path fill="#404040"
                            d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"
                            id={{ 'comment_btn_clear_' . $post->id }} class="visible  group-hover:invisible " />

                        <path fill="#404040"
                            d="M22 3v13h-11.643l-4.357 3.105v-3.105h-4v-13h20zm2-2h-24v16.981h4v5.019l7-5.019h13v-16.981zm-5 6h-14v-1h14v1zm0 2h-14v1h14v-1zm-6 3h-8v1h8v-1z"
                            id={{ 'comment_btn_fill_' . $post->id }} class="invisible  group-hover:visible" />
                    </svg>
                </button>
            </div>

            <x-comment-section :post="$post" :isclosed="false" :isbubblestyle="false"></x-comment-section>

            <div class="bg-white items-center mt-5 mb-20">
                <textarea oninput='this.style.height = this.scrollHeight + "px"'
                    class=" form-textarea w-full sm:w-3/4 lg:w-4/5  border border-gray-400 outline-none rounded  focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                    rows="1" placeholder="Write a comment ..." v-model="commentContentText"></textarea>

                <button
                    class="border  block   md:ml-0 sm:inline sm:float-right rounded px-5 py-2.5 text-sm font-semibold text-black border-black  hover:bg-gray-700 hover:text-white"
                    @click="addComment({{ $post->id }})">Post
                </button>
            </div>
        </div>

    </div>
@endsection
