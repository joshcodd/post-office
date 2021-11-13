@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="grid justify-items-center">
        <div class=" md:w-1/2 m-5 rounded-xl ">
            <form method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}">
                @method('PUT')
                @csrf

                <div class="border-b border-gray-700 font-nunito font-light mb-5 text-xl p-2">
                    Edit post
                </div>

                <textarea oninput='contentTextAreaResize(this)'
                    class="font-garamond font-bold text-5xl
                    form-textarea w-full border border-gray-400 outline-none rounded focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                    rows="1" placeholder="Write a title ..." name="title">{{ $post->title }}</textarea>

                <div class="my-3">
                    <div class="flex items-center image_spacer border-gray-400 bg-gray-100 border-dashed border text-center">
                        <x-camera-icon>
                        </x-camera-icon>
                        <img id="create_post_img" src="#" alt="" />
                    </div>

                    <label for="create_img_upload"
                        class="mt-3 cursor-pointer border inline-block rounded px-5 py-2.5 text-sm font-semibold text-black border-black  hover:bg-gray-700 hover:text-white">Upload
                        Image</label>

                    <button type="button"
                        class="mt-3 cursor-pointer border inline-block rounded px-5 py-2.5 text-sm font-semibold text-black border-black  hover:bg-gray-700 hover:text-white hidden"
                        id="create_remove_image" onclick='removeImage()'>Remove Image
                    </button>

                    <input type='file' onchange='previewImage(this)' id="create_img_upload" class="hidden" />
                </div>

                <textarea oninput='contentTextAreaResize(this)'
                    class="
                    text-xl text-gray-600 whitespace-pre-line
                    form-textarea w-full border border-gray-400 outline-none rounded  focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                    rows="5" placeholder="Write post content ..." name="content">{{ $post->content }}</textarea>

                <div class="bg-white  items-center mt-5 mb-20">
                    <button type="submit" value="submit"
                        class="border inline-block  ml-5 sm:inline sm:float-right rounded px-5 py-2.5 text-sm font-semibold text-black border-black  hover:bg-gray-700 hover:text-white">Post
                    </button>

                    <a href="{{ route('posts.show', ['id' => $post->id]) }}"
                        class="border inline-block  md:ml-0 sm:inline sm:float-right rounded px-5 py-2.5 text-sm font-semibold text-black border-black  hover:bg-gray-700 hover:text-white">Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection
