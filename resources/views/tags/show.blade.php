@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <div class="grid justify-items-center">
        <div class="text-3xl mt-8 mb-2">
            #{{ $tag->name }}
        </div>
        <div class="px-5 py-10 grid md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($tag->posts as $post)
                <div class="h-96  rounded-xl shadow-md overflow-hidden">
                    @if ($post->image_path)
                        <div class="w-100  h-40">
                            <img class="w-full h-full  object-cover"
                                src="{{ asset('storage/images' . $post->image_path) }}" alt="post_image">
                        </div>
                    @endif

                    <div class="pt-3 px-4">
                        <div class="font-bold mb-1 text-md">
                            {{ $post->title }}
                        </div>
                        <p class="text-sm text-gray-600 whitespace-pre-line">
                            {{ implode(' ', array_slice(explode(' ', $post->content), 0, 20)) . '.......' }}</p>
                    </div>

                    <div class="top-80 sticky pb-2 px-4 pt-0 mb-1">
                        <div class="flex pb-0.5">
                            <div class="flex-grow">
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}"
                                    class="float-left rounded-full px-2 py-1 text-xs font-semibold mr-2 mb-2 border  text-black border-black  hover:bg-gray-700 hover:text-white">View
                                    post
                                </a>

                                @if (Auth::User()->user_role == 'admin')
                                    <delete-confirm-state route="{{ route('posts.destroy', $post->id) }}"
                                        csfr-token="{{ csrf_token() }}" class-style="float-left">
                                    </delete-confirm-state>
                                @elseif (Auth::User()->id == $post->user->id)
                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                        class="float-left rounded-full px-2 py-1 text-xs font-semibold mr-2 mb-2 border  text-black border-black  hover:bg-gray-700 hover:text-white">Edit
                                        post
                                    </a>
                                @endif
                            </div>

                            <div class="whitespace-nowrap float-right">
                                <svg xmlns=" http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                    class="text-gray-700 mt-0.5 inline-block">
                                    <path fill="#404040"
                                        d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"
                                        id={{ 'comment_btn_clear_' . $post->id }} />
                                </svg>
                                <div class="ml-0.3 text-sm inline-block">{{ $post->comments->count() }}</div>
                            </div>
                        </div>
                        <time-stamp timestamp="{{ $post->created_at->format('c') }}"
                            class-style=" relative  block text-xs font-semibold leading-4">
                        </time-stamp>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection
