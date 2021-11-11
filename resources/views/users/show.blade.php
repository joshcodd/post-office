@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="relative text-center">
        <img class="w-full h-96  object-cover " src={{ asset(rand(0, 3) . '.jpg') }} alt="">

        <h1 class=" absolute px-14 py-5  bg-gray-100 text-center text-3xl font-bold text-black rounded-sm name_title">
            {{ $user->first_name }}
            {{ $user->surname }}
        </h1>
    </div>

    <div class="p-10 column-2 md:column-3 lg:column-4 mx-auto">
        @foreach ($user->posts as $post)
            <div class="break-inside  pb-10">
                <div class="break-inside mx-1 md:mx-5 rounded-xl shadow-md overflow-hidden">
                    <div class="w-100  h-100">
                        <img class="w-full h-full  object-cover " src={{ asset(rand(0, 3) . '.jpg') }} alt="">
                    </div>

                    <div class="py-3 px-4">
                        <div class="font-bold mb-1 text-md">
                            {{ $post->title }}
                        </div>
                        <p class="text-sm text-gray-600 whitespace-pre-line">
                            {{ implode(' ', array_slice(explode(' ', $post->content), 0, 50)) . '.......' }}</p>
                    </div>

                    <div class="flow-root px-4 pt-2 pb-2">
                        <span
                            class="float-left rounded-full px-2.5 py-1.5 text-xs font-semibold mr-2 mb-2 border  text-black border-black  hover:bg-gray-700 hover:text-white
                                        "><a
                                href="{{ route('posts.show', ['id' => $post->id]) }}">View post</a>
                        </span>

                        <div class=" float-right mt-1 ml-2 text-sm">
                            {{ $post->comments->count() }}
                        </div>

                        <svg xmlns=" http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                            class="text-gray-700 mt-1 mb-2 inline-block float-right">
                            <path fill="#404040"
                                d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"
                                id={{ 'comment_btn_clear_' . $post->id }} />
                        </svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
