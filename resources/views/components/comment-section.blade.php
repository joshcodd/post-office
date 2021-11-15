@props(['post', 'isclosed' => true, 'isbubblestyle' => true])

<div id={{ 'comments_' . $post->id }} name="scrollable_comments"
    class="overflow-scroll transition-all duration-500 ease-in-out bg-gray-100
    {{ $isclosed ? 'max-h-0' : 'max-h-96' }}
    {{ $isbubblestyle ? '' : 'border-t border-b border-bg-gray-400' }}">

    <div v-for="comment in commentList[{{ $post->id }}]"
        class="overflow-hidden bg-white
        {{ $isbubblestyle ? 'py-2 px-5 m-5 rounded-xl shadow-md' : 'py-3 border-b border-bg-gray-400' }}">

        @if ($isbubblestyle)
            <span class="block font-semibold border-b border-bg-gray-400 mb-1.5">
                @{{ comment . user . first_name }}
                @{{ comment . user . surname }}

                <div class="float-right ">
                    <span class="inline font-thin">
                        @{{ comment . updated_at }}
                    </span>

                    <div v-if="comment.user.id == {{ Auth::User()->id }}" class="inline relative bottom-0.5">
                        <button @click="handleCommentEditClick(comment . id)"
                            class="rounded-full ml-2 px-1.5 py-0.1  text-xs font-semibold  border  text-black border-black top-0 hover:bg-gray-700 hover:text-white">Edit
                        </button>

                        <button @click="handleCommentDeleteClick(comment . id)"
                            class="rounded-full ml-1 px-1.5 py-0.1 text-xs font-semibold border text-spotify border-spotify top-0 hover:bg-spotify hover:text-white">X
                        </button>
                    </div>
                </div>
            </span>
        @else
            <span class="block font-semibold  mb-1.5">
                @{{ comment . user . first_name }}
                @{{ comment . user . surname }}

                <div v-if="comment.user.id == {{ Auth::User()->id }}" class="float-right inline relative bottom-0.5">
                    <button @click="handleCommentEditClick(comment . id)"
                        class="rounded-full mr-1 px-1.5 py-0.1  text-xs font-semibold border text-black border-black top-0 hover:bg-gray-700 hover:text-white">Edit
                    </button>

                    <button @click="handleCommentDeleteClick(comment . id)"
                        class="rounded-full px-1.5 py-0.1 text-xs font-semibold border text-spotify border-spotify top-0 hover:bg-spotify hover:text-white">X
                    </button>
                </div>

                <span class="block font-thin text-xs">
                    @{{ comment . updated_at }}
                </span>
            </span>
        @endif

        <p :id="'comments_content_'+comment.id" class="w-full
        break-all whitespace-pre-line">@{{ comment . content }}</p>

        <div :id="'comments_edit_containter_' + comment.id" class="hidden">
            <textarea :id="'comments_edit_text_' + comment.id"
                class="text-s w-full border border-gray-400 outline-none rounded resize-none focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent px-1.5 py-0.5"
                oninput='contentTextAreaResize(this)' rows="1" v-model="commentEditText[comment.id]"></textarea>

            <div class="float-right inline">
                <button
                    class="border ml-2  rounded px-1.5 py-0.3 text-sm font-semibold text-black border-black  hover:bg-gray-700 hover:text-white"
                    @click="editComment(comment.id)">Save
                </button>
            </div>
        </div>

    </div>
</div>

<div class="flex items-center {{ $isbubblestyle ? 'px-4 py-4' : ' py-5' }}">
    <textarea
        class="form-textarea flex-grow border border-gray-400 outline-none rounded resize-none focus:outline-none focus:ring-2 focus:ring-gray-400 focus:border-transparent"
        rows="1" placeholder="Write a comment ..." v-model="commentContentText"></textarea>

    <button
        class="border rounded px-3 py-1 ml-3 text-sm font-semibold text-black border-black hover:bg-gray-700 hover:text-white"
        @click="addComment({{ $post->id }})">
        Post
    </button>
</div>
