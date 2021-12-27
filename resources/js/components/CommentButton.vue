<template>
  <div>
    <div :id="'comment_count_' + postId" class="float-right mt-1.5 ml-2">
      {{ numComments }}
    </div>

    <button
      :id="'comment_btn_' + postId"
      v-on:click="handleCommentBtnClick(postId)"
      class="group inline-block float-right mt-1.5 mb-2"
      aria-label="Reveal comments"
    >
      <svg width="25" height="25" viewBox="0 0 24 24" class="text-gray-700">
        <path
          fill="#404040"
          d="M0 1v16.981h4v5.019l7-5.019h13v-16.981h-24zm13 12h-8v-1h8v1zm6-3h-14v-1h14v1zm0-3h-14v-1h14v1z"
          :id="'comment_btn_clear_' + postId"
          class="group-hover:visible invisible"
        />

        <path
          fill="#404040"
          d="M22 3v13h-11.643l-4.357 3.105v-3.105h-4v-13h20zm2-2h-24v16.981h4v5.019l7-5.019h13v-16.981zm-5 6h-14v-1h14v1zm0 2h-14v1h14v-1zm-6 3h-8v1h8v-1z"
          :id="'comment_btn_fill_' + postId"
          class="group-hover:invisible visible"
        />
      </svg>
    </button>
  </div>
</template>

<script>
import common from "./common";

export default {
  props: {
    postId: {
      type: Number,
    },
    numComments: {
      type: Number,
    },
  },

  methods: {
    handleCommentBtnClick: function (id) {
      // Hide and Show comments.
      const comments = document.querySelector("#comments_" + id);
      comments.classList.toggle("max-h-0");
      comments.classList.toggle("max-h-96");

      // Fill icon on click.
      const comment_btn_clear = document.querySelector(
        "#comment_btn_clear_" + id
      );
      const comment_btn_fill = document.querySelector(
        "#comment_btn_fill_" + id
      );
      comment_btn_clear.classList.toggle("invisible");
      comment_btn_fill.classList.toggle("invisible");
      common.scrollCommentsBottom();
    },
  },
};
</script>
