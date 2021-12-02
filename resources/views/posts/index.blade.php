@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="grid justify-items-center">
        @foreach ($posts as $post)
            <div class="sm:w-2/3 md:w-1/2 m-5 rounded-xl shadow-md overflow-hidden">
                @if ($post->image_path)
                    <div class="w-100  h-96">
                        <img class="w-full h-full object-cover" src="{{ asset('storage/images' . $post->image_path) }}"
                            alt="post_image">
                    </div>
                @endif

                <div class="py-4 px-6">
                    <div class="font-bold mb-2 text-xl">
                        {{ $post->title }}

                        <a href="{{ route('users.show', ['user' => $post->user->id]) }}"
                            class="block mt-1 font-normal text-base whitespace-nowrap hover:underline leading-4">By
                            {{ $post->user->first_name }}
                            {{ $post->user->surname }}</a>

                    </div>

                    <p class="text-base text-gray-600 whitespace-pre-line">{{ $post->content }}</p>
                </div>

                <div class="flow-root px-6 pt-4 pb-3">
                    <a class="float-left rounded-full px-4 py-2 text-sm font-semibold mr-2 mb-2 border  text-black border-black  hover:bg-gray-700 hover:text-white"
                        href="{{ route('posts.show', ['post' => $post->id]) }}">View post</a>

                    @if (Auth::User()->user_role == 'admin')
                        <delete-confirm-state route="{{ route('posts.destroy', $post->id) }}"
                            class-style="px-4 py-2 font-semibold text-sm" csfr-token="{{ csrf_token() }}">
                        </delete-confirm-state>
                    @elseif (Auth::User()->id == $post->user->id)
                        <a class="float-left rounded-full px-4 py-2 text-sm font-semibold mr-2 mb-2 border  text-black border-black  hover:bg-gray-700 hover:text-white"
                            href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit post</a>
                    @endif

                    <comment-button :post-id="{{ $post->id }}" :num-comments="{{ $post->comments->count() }}">
                    </comment-button>

                    <div class="h-7 mr-4 mt-1 float-right">
                        <like-button :post-id="{{ $post->id }}" :num-likes="{{ $post->likes->count() }}"
                            :post-liked="@json($post->likes->contains('user_id', Auth::user()->id))">
                        </like-button>
                    </div>
                </div>

                <time-stamp timestamp="{{ $post->created_at->format('c') }}"
                    class-style="ml-6 block text-xs font-semibold leading-4">
                </time-stamp>

                <comment-section :post="{{ $post }}" :user-id={{ Auth::User()->id }}
                    user-role="{{ Auth::User()->user_role }}" :is-closed=" true">
                </comment-section>

            </div>
        @endforeach

        <div class="m-10">
            {{ $posts->links('vendor.pagination.tailwind') }}
        </div>

    </div>
@endsection
