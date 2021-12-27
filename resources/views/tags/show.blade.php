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
                            <img class="w-full h-full  object-cover" src="{{ $post->image_path }}" alt="post_image">
                        </div>
                    @endif

                    <div class="pt-3 px-4">
                        <div class="font-bold mb-1 text-md">
                            {{ $post->title }}
                        </div>
                        <p class="text-sm text-gray-600 
                        whitespace-pre-line">{{ implode(' ', array_slice(explode(' ', $post->content), 0, 20)) . '.......' }}</p>
                    </div>

                    <div class="top-80 sticky px-4">
                        <div class="flex pb-0.5 mb-2">
                            <div class="flex-grow">
                                <a href="{{ route('posts.show', ['post' => $post->id]) }}"
                                    class="rounded-full px-2 py-1 text-xs font-semibold mr-0.5 border 
                                    text-black border-black  hover:bg-gray-700 hover:text-white">View</a>

                                @if (Auth::User()->user_role == 'admin')
                                    <delete-confirm-state route="{{ route('posts.destroy', $post->id) }}"
                                        csfr-token="{{ csrf_token() }}" class-style="px-2 py-1 text-xs font-semibold">
                                    </delete-confirm-state>
                                @elseif (Auth::User()->id == $post->user->id)
                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                        class="rounded-full px-2 py-1 text-xs font-semibold mr-2 
                                        border text-black border-black  hover:bg-gray-700 hover:text-white">Edit</a>
                                @endif
                            </div>

                            <div class="flex items-center text-sm mt-px">
                                <like-button :item-id="{{ $post->id }}" :likes="{{ $post->likes->load('user') }}"
                                    :current-user-id={{ Auth::User()->id }} width="w-6" class="ml-3.5 mr-3">
                                </like-button>

                                <svg xmlns=" http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                    class="text-gray-700 mt-0.5 mr-1">
                                    <path fill="#404040"
                                        d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"
                                        id={{ 'comment_btn_clear_' . $post->id }} />
                                </svg>
                                {{ $post->comments->count() }}
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
