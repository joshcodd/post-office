@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="grid justify-items-center">
        @foreach ($posts as $post)
            <div class="w-2/4 m-5 rounded-xl shadow-md overflow-hidden">
                <div class="w-100  h-96">
                    <img class="w-full h-full  object-cover " src={{ asset(rand(0, 3) . '.jpg') }} alt="">
                </div>

                <div class="py-4 px-6">
                    <div class="font-bold mb-2 text-xl">
                        {{ $post->title }}
                    </div>
                    <p class="text-base text-gray-600 whitespace-pre-line">{{ $post->content }}</p>
                </div>

                <div class="flow-root px-6 pt-4 pb-2">
                    <span
                        class="float-left rounded-full px-4 py-2 text-sm font-semibold mr-2 mb-2 border  text-black border-black  hover:bg-black hover:text-white
                        "><a
                            href="{{ route('posts.show', ['id' => $post->id]) }}">View post</a>
                    </span>

                    <div class=" float-right mt-1 ml-2 ">
                        {{ $post->comments->count() }}
                    </div>
                    <button id={{ 'comment_btn_' . $post->id }} onclick="handleCommentBtnClick(this.id)"
                        class="group  mt-1 mb-2 inline-block float-right">
                        <svg xmlns=" http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                            <path
                                d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"
                                id={{ 'comment_btn_clear_' . $post->id }} class="invisible  group-hover:visible " />

                            <path
                                d="M22 3v13h-11.643l-4.357 3.105v-3.105h-4v-13h20zm2-2h-24v16.981h4v5.019l7-5.019h13v-16.981zm-5 6h-14v-1h14v1zm0 2h-14v1h14v-1zm-6 3h-8v1h8v-1z"
                                id={{ 'comment_btn_fill_' . $post->id }} class="visible  group-hover:invisible" />
                        </svg>
                    </button>
                </div>

                <div id={{ 'comments_' . $post->id }} name="scrollable_comments"
                    class="overflow-scroll transition-all duration-500 ease-in-out max-h-0 bg-gray-100 pb-0 mb-0">

                    <div v-for="comment in commentList[{{ $post->id }}]"
                        class="m-5 rounded-xl shadow-md overflow-hidden bg-white px-5 py-2">

                        <span class="block font-semibold border-b border-bg-gray-400 mb-1.5">
                            @{{ comment . user . first_name }}
                            @{{ comment . user . surname }}
                            <span class="float-right font-thin">
                                @{{ comment . updated_at }}
                            </span>
                        </span>

                        <p class="whitespace-pre-line">@{{ comment . content }}</p>

                    </div>

                </div>

                <div class="bg-white items-center">
                    <textarea
                        class="form-textarea md:w-3/4 lg:w-4/5 mt-2.5 ml-4 border border-gray-400 outline-none rounded resize-none focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                        rows="1" placeholder="Write a comment ..." v-model="commentContentText"></textarea>

                    <button
                        class="border  block  ml-4 md:ml-0 sm:inline sm:float-right rounded px-3 py-1 text-sm font-semibold text-black border-black my-4 mr-4 hover:bg-black hover:text-white"
                        @click="addComment({{ $post->id }})">
                        Post
                    </button>
                </div>
            </div>
        @endforeach

        <div class="m-10">
            {{ $posts->links('vendor.pagination.tailwind') }}
        </div>

    </div>
@endsection
