@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="grid justify-items-center">
        <div class="sm:w-2/3 md:w-1/2 m-5 rounded-xl ">
            <form method="POST" enctype="multipart/form-data" action="{{ route('posts.update', ['post' => $post->id]) }}">
                @method('PUT')
                @csrf

                <div class="border-b border-gray-700 font-nunito font-light mb-5 text-xl p-2">
                    Edit post
                </div>

                <textarea id="edit_title" oninput='contentTextAreaResize(this)'
                    class="font-garamond font-bold text-5xl
                        form-textarea w-full border border-gray-400 outline-none rounded focus:outline-none focus:ring-2 focus:ring-gray-400 
                        focus:border-transparent"
                    rows="1" placeholder="Write a title ..." name="title">{{ $post->title }}</textarea>

                <upload-image image-path-default={{ $post->image_path }}></upload-image>

                <textarea id="edit_content" oninput='contentTextAreaResize(this)'
                    class="text-xl text-gray-600 whitespace-pre-line form-textarea w-full border border-gray-400 outline-none rounded 
                        focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                    rows="5" placeholder="Write post content ..." name="content">{{ $post->content }}</textarea>
                <edit-tags post-id={{ $post->id }} :tags="{{ $post->tags }}"></edit-tags>

                <script type="application/javascript">
                    let title_area = document.getElementById("edit_title");
                    let content_area = document.getElementById("edit_content");
                    title_area.style.height = `${title_area.scrollHeight}px`;
                    content_area.style.height = `${content_area.scrollHeight}px`;
                </script>

                <div class="bg-white inline items-center mt-5 mb-20 float-right">
                    <button type="submit" value="submit"
                        class="border ml-5 rounded px-5 py-2.5 text-sm font-semibold text-black border-black hover:bg-gray-700 hover:text-white">Save
                    </button>

                    <a href="{{ url()->previous() }}"
                        class="border rounded ml-2 px-5 py-2.5 text-sm font-semibold text-black border-black  hover:bg-gray-700     
                            hover:text-white">Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection
