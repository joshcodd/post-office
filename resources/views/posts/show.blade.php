@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="grid justify-items-center">
        <div class="sm:w-2/3 md:w-1/2 m-5 rounded-xl ">
            <div class="font-garamond font-bold mb-2 text-5xl">
                {{ $post->title }}
            </div>

            <div class="w-full font-semibold mb-2 text-xl inline-block">
                <a href="{{ route('users.show', ['user' => $post->user->id]) }}" class="hover:underline">
                    {{ $post->user->first_name }}
                    {{ $post->user->surname }}</a>
                <div class="font-thin ml-5 text-base inline-block">
                    {{ $post->updated_at->format('Y-m-d') }}
                </div>


                <div class="float-right mt-0.5 ">
                    @if (Auth::User()->user_role == 'admin' || Auth::User()->id == $post->user->id)
                        <delete-confirm-state route="{{ route('posts.destroy', $post->id) }}"
                            csfr-token="{{ csrf_token() }}">
                        </delete-confirm-state>
                    @endif

                    @if (Auth::User()->id == $post->user->id)
                        <a class="
                            rounded-full px-3 py-1 text-xs font-semibold border text-black border-black hover:bg-gray-700 hover:text-white"
                            href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit post</a>
                    @endif
                </div>

            </div>

            @if ($post->image_path)
                <img class="w-full" src="{{ asset('storage/images' . $post->image_path) }}" alt="post_image">
            @endif

            <div class="py-5">
                <p class="text-xl text-gray-600 whitespace-pre-line">{{ $post->content }}</p>
            </div>

            <div class="mt-7">
                @foreach ($post->tags as $tag)
                    <a href="{{ route('tags.show', ['tag' => $tag->id]) }}"
                        class="inline-block px-2.5 py-0.5 text-sm border rounded-xl bg-gray-100 m-1 hover:bg-gray-200">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>

            <div class="flow-root pt-4 pb-2">
                <comment-button :post-id="{{ $post->id }}" :num-comments="{{ $post->comments->count() }}">
                </comment-button>

                <div class="mr-4 mt-1 float-right">
                    <like-button :item-id="{{ $post->id }}" :likes="{{ $post->likes->load('user') }}"
                        :current-user-id={{ Auth::User()->id }} width="7">
                    </like-button>
                </div>
            </div>

            <comment-section :post="{{ $post }}" :user-id={{ Auth::User()->id }}
                user-role="{{ Auth::User()->user_role }}" :is-closed=" false" :is-bubble-style="false">
            </comment-section>

        </div>

    </div>
@endsection
