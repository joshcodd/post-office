@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="grid justify-items-center">
        @foreach ($posts as $post)
            <div class="sm:w-2/3 md:w-1/2 m-5 rounded-xl shadow-md overflow-hidden">
                <div class="w-100  h-96">
                    <img class="w-full h-full  object-cover " src={{ asset(rand(0, 3) . '.jpg') }} alt="">
                </div>

                <div class="py-4 px-6">
                    <div class="font-bold mb-2 text-xl">
                        {{ $post->title }}

                        <a href="{{ route('users.show', ['id' => $post->user->id]) }}"
                            class="font-light mb-2 text-base whitespace-nowrap hover:underline">By
                            {{ $post->user->first_name }}
                            {{ $post->user->surname }}</a>
                    </div>

                    <p class="text-base text-gray-600 whitespace-pre-line">{{ $post->content }}</p>
                </div>

                <div class="flow-root px-6 pt-4 pb-2">
                    <a class="float-left rounded-full px-4 py-2 text-sm font-semibold mr-2 mb-2 border  text-black border-black  hover:bg-gray-700 hover:text-white"
                        href="{{ route('posts.show', ['id' => $post->id]) }}">View post</a>

                    @if (Auth::User()->id == $post->user->id)
                        <a class="float-left rounded-full px-4 py-2 text-sm font-semibold mr-2 mb-2 border  text-black border-black  hover:bg-gray-700 hover:text-white"
                            href="{{ route('posts.edit', ['id' => $post->id]) }}">Edit post</a>
                    @endif

                    <div id={{ 'comment_count_' . $post->id }} class=" float-right mt-1 ml-2 ">
                        {{ $post->comments->count() }}
                    </div>
                    <button id={{ 'comment_btn_' . $post->id }} v-on:click="handleCommentBtnClick({{ $post->id }})"
                        class="group  mt-1 mb-2 inline-block float-right">
                        <svg xmlns=" http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                            class="text-gray-700">
                            <path fill="#404040"
                                d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"
                                id={{ 'comment_btn_clear_' . $post->id }} class="invisible  group-hover:visible " />

                            <path fill="#404040"
                                d="M22 3v13h-11.643l-4.357 3.105v-3.105h-4v-13h20zm2-2h-24v16.981h4v5.019l7-5.019h13v-16.981zm-5 6h-14v-1h14v1zm0 2h-14v1h14v-1zm-6 3h-8v1h8v-1z"
                                id={{ 'comment_btn_fill_' . $post->id }} class="visible  group-hover:invisible" />
                        </svg>
                    </button>
                </div>

                <x-comment-section :post="$post"></x-comment-section>

            </div>
        @endforeach

        <div class="m-10">
            {{ $posts->links('vendor.pagination.tailwind') }}
        </div>

    </div>
@endsection
