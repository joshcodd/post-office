@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="relative text-center">
        <img id="create_post_img" class="w-full h-96 object-cover "
            src={{ $user->header ? asset('storage/images' . $user->header->image_path) : asset('marble.jpg') }} alt="">

        @if (Auth::User()->id == $user->id)
            <div class="absolute headerEditDialog">
                <form method="POST" enctype="multipart/form-data" class="inline-block"
                    action="{{ route('users.header.upload', ['user' => $user->id]) }}">
                    @csrf
                    <label for="header_img_upload"
                        class="cursor-pointer border rounded-3xl px-2 py-1.5 text-xs font-semibold 
                        text-white border-white hover:bg-white hover:text-black">
                        Upload header
                    </label>
                    <input type='file' name="image" onchange="this.form.submit()" id="header_img_upload"
                        class="hidden" />
                </form>

                <form method="POST" action="{{ route('users.header.destroy', ['user' => $user->id]) }}"
                    class="inline-block">
                    @method('DELETE')
                    @csrf
                    <button type="submit"
                        class="border rounded-3xl px-2 py-1.5 text-xs font-semibold 
                        text-spotify border-spotify  hover:bg-spotify hover:text-white">
                        Remove header
                    </button>
                </form>
            </div>
        @endif

        <h1 class=" absolute px-14 py-5  bg-gray-100 text-center text-3xl font-bold text-black rounded-sm name_title">
            {{ $user->first_name }}
            {{ $user->surname }}
        </h1>
    </div>

    <div class="p-10 sm:column-3 lg:column-4 mx-auto w-full">
        @foreach ($user->posts as $post)
            <div class="break-inside pb-10">
                <div class="break-inside mx-1 md:mx-5 rounded-xl shadow-md overflow-hidden">
                    @if ($post->image_path)
                        <div class="w-100  h-100">
                            <img class="w-full h-full  object-cover"
                                src="{{ asset('storage/images' . $post->image_path) }}" alt="post_image">
                        </div>
                    @endif

                    <div class="py-3 px-4">
                        <div class="font-bold mb-1 text-md">
                            {{ $post->title }}
                        </div>
                        <p class="text-sm text-gray-600 whitespace-pre-line">{{ implode(' ', array_slice(explode(' ', $post->content), 0, 50)) 
                        . '.......' }}</p>
                    </div>

                    <div class="flex px-4 pt-2 pb-3 items-center">
                        <div class="flex-grow items-center text-black">
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}"
                                class="rounded-full px-2 py-0.5 text-xs font-semibold mr-1 border border-black 
                                hover:bg-gray-700 hover:text-white">View</a>

                            @if (Auth::User()->user_role == 'admin')
                                <delete-confirm-state route="{{ route('posts.destroy', $post->id) }}"
                                    csfr-token="{{ csrf_token() }}" class-style="px-2 py-0.5 text-xs font-semibold">
                                </delete-confirm-state>
                            @elseif (Auth::User()->id == $post->user->id)
                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}"
                                    class="rounded-full px-2 py-0.5 text-xs font-semibold mr-1 border text-black border-black 
                                    hover:bg-gray-700 hover:text-white">Edit</a>
                            @endif
                        </div>

                        <div class="flex items-center text-sm mt-px">
                            <like-button :item-id="{{ $post->id }}" :likes="{{ $post->likes->load('user') }}"
                                :current-user-id={{ Auth::User()->id }} width="6" class="ml-3.5">
                            </like-button>

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                class="text-gray-700 ml-4 mr-1 mt-px">
                                <path fill="#404040"
                                    d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"
                                    id={{ 'comment_btn_clear_' . $post->id }} />
                            </svg>
                            {{ $post->comments->count() }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
