@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="grid justify-items-center">
        <div class="w-2/4 m-5 rounded-xl ">
            <div class="font-garamond font-bold mb-2 text-5xl">
                {{ $post->title }}
            </div>

            <div class="font-semibold mb-2 text-xl inline-block">
                {{ $post->user->first_name }}
                {{ $post->user->surname }}
                <div class="font-thin ml-5 text-base inline-block">
                    {{ $post->updated_at->format('Y-m-d') }}
                </div>
            </div>

            <img class="" src={{ asset(rand(0, 3) . '.jpg') }} alt="">
            <div class="py-5">
                <p class="text-xl text-gray-600">
                    {{ $post->content }}
                </p>
            </div>

            <div class="flow-root  pt-4 pb-2">

                <div id={{ 'comment_btn_' . $post->id }} onclick="handleCommentBtnClick(this.id)"
                    class="group float-right mt-1 mb-2">
                    <div id={{ 'comment_btn_clear_' . $post->id }}
                        class=" visible  group-hover:invisible absolute inline-block">
                        <svg xmlns=" http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                            <path
                                d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z" />
                        </svg>
                    </div>

                    <div id={{ 'comment_btn_fill_' . $post->id }} class="invisible  group-hover:visible inline-block">
                        <svg xmlns=" http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                            <path
                                d="M22 3v13h-11.643l-4.357 3.105v-3.105h-4v-13h20zm2-2h-24v16.981h4v5.019l7-5.019h13v-16.981zm-5 6h-14v-1h14v1zm0 2h-14v1h14v-1zm-6 3h-8v1h8v-1z" />
                        </svg>

                    </div>
                    <div class="inline-block float-right ml-2 ">
                        {{ $post->comments->count() }}
                    </div>

                </div>
            </div>

            <div id={{ 'comments_' . $post->id }} name="scrollable_comments"
                class="overflow-scroll transition-all duration-500 ease-in-out max-h-96 bg-gray-100 pb-0 mb-0 border-t border-b border-bg-gray-400">

                <div v-for="comment in commentList[{{ $post->id }}]"
                    class="overflow-hidden bg-white  py-3 border-b border-bg-gray-400">

                    <span class="block font-semibold  mb-1.5">
                        @{{ comment . user . first_name }}
                        @{{ comment . user . surname }}
                        <span class="block font-thin text-xs">
                            @{{ comment . updated_at }}
                        </span>
                    </span>

                    <span class="">
                        @{{ comment . content }}
                    </span>

                </div>

            </div>


            <div class="bg-white items-center mt-5 mb-20">
                <textarea oninput='this.style.height = this.scrollHeight + "px"'
                    class=" form-textarea w-full sm:w-3/4 lg:w-4/5  border border-gray-400 outline-none rounded  focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                    rows="1" placeholder="Write a comment ..." v-model="commentContentText"></textarea>

                <span
                    class="border  block   md:ml-0 sm:inline sm:float-right rounded px-5 py-2.5 text-sm font-semibold text-black border-black  hover:bg-black hover:text-white"><a
                        @click="addComment({{ $post->id }})">Post</a>
                </span>
            </div>
        </div>

    </div>
@endsection
