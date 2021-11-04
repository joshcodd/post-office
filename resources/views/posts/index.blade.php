@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="grid justify-items-center">
        @foreach ($posts as $post)
            <div class="w-2/4 m-5 rounded-xl shadow-md overflow-hidden">
                <img class="" src={{ asset('placeholder.jpg') }} alt="">
                <div class="py-4 px-6">
                    <div class="font-bold mb-2 text-xl">
                        {{ $post->title }}
                    </div>
                    <p class="text-base text-gray-600">
                        {{ $post->content }}
                    </p>
                </div>

                <div class="flow-root px-6 pt-4 pb-2">
                    <span
                        class="float-left bg-gray-400 rounded-full px-4 py-1.5 text-sm font-semibold text-gray-100 mr-2 mb-2"><a
                            href="{{ $post->link }}">View post</a>
                    </span>

                    <div id={{ 'comment_btn_' . $post->id }} onclick="handleCommentBtnClick(this.id)"
                        class="group float-right mt-0.5 mb-2">
                        <div id={{ 'comment_btn_clear_' . $post->id }}
                            class=" invisible  group-hover:visible absolute inline-block">
                            <svg xmlns=" http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                                <path
                                    d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z" />
                            </svg>
                        </div>

                        <div id={{ 'comment_btn_fill_' . $post->id }} class="visible  group-hover:invisible inline-block">
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

                        <span class="">
                            @{{ comment . content }}
                        </span>

                    </div>

                </div>


                <div class="bg-white items-center">
                    <textarea
                        class="form-textarea md:w-3/4 lg:w-4/5 mt-2.5 ml-4 border border-gray-400 outline-none rounded resize-none focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
                        rows="1" placeholder="Write a comment ..." v-model="commentContentText"></textarea>

                    <span
                        class="border  block  ml-4 md:ml-0 sm:inline sm:float-right rounded px-3 py-1 text-sm font-semibold text-black border-black my-4 mr-4 hover:bg-black hover:text-white"><a
                            @click="addComment({{ $post->id }})">Post</a>
                    </span>
                </div>

                <script type="application/javascript">
                    function handleCommentBtnClick(id) {
                        // Hide and Show comments.
                        const comments_id = id.substring('comment_btn_'.length);
                        const comments = document.querySelector("#comments_" + comments_id);
                        comments.classList.toggle("max-h-0");
                        comments.classList.toggle("max-h-96")

                        // Fill icon on click.
                        const comment_btn_clear = document.querySelector("#comment_btn_clear_" + comments_id);
                        const comment_btn_fill = document.querySelector("#comment_btn_fill_" + comments_id);
                        comment_btn_clear.classList.toggle("invisible");
                        comment_btn_fill.classList.toggle("invisible");
                    }
                </script>
            </div>
        @endforeach
    </div>
@endsection
