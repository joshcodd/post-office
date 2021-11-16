<template>
  <div class="">
    <div
      :id="'comments_' + post.id"
      name="scrollable_comments"
      class="
        overflow-scroll
        transition-all
        duration-500
        ease-in-out
        bg-gray-100
      "
      :class="[
        isClosed ? 'max-h-0' : 'max-h-96',
        isBubbleStyle ? '' : 'border-t border-b border-bg-gray-400',
      ]"
    >
      <div
        v-for="comment in commentList[post.id]"
        :key="comment.id"
        class="overflow-hidden bg-white"
        :class="[
          isBubbleStyle
            ? 'py-2 px-5 m-5 rounded-xl shadow-md'
            : 'py-3 border-b border-bg-gray-400',
        ]"
      >
        <span
          v-if="isBubbleStyle"
          class="block font-semibold border-b border-bg-gray-400 mb-1.5"
        >
          {{ comment.user.first_name }}
          {{ comment.user.surname }}

          <div class="float-right">
            <span class="inline font-thin"> {{ comment.updated_at }} </span>

            <div
              v-if="comment.user.id == userId"
              class="inline relative bottom-0.5 text-xs"
            >
              <round-button
                :click-func="() => handleCommentEditClick(comment.id)"
                class="ml-2 px-1.5 py-0.1"
              >
                Edit
              </round-button>

              <round-button
                :click-func="() => toggleHidden(comment.id)"
                class="
                  ml-1
                  px-1.5
                  py-0.1
                  text-spotify
                  border-spotify
                  hover:bg-spotify
                "
              >
                X
              </round-button>
            </div>
          </div>
        </span>

        <span v-else class="block font-semibold mb-1.5">
          {{ comment.user.first_name }} {{ comment.user.surname }}

          <div
            v-if="comment.user.id == userId"
            class="float-right inline relative bottom-0.5"
          >
            <round-button
              :click-func="() => handleCommentEditClick(comment.id)"
              class="mr-1 px-1.5 py-0.1 text-xs"
            >
              Edit
            </round-button>

            <round-button
              :click-func="() => toggleHidden(comment.id)"
              class="
                px-1.5
                py-0.1
                text-spotify
                border-spotify
                hover:bg-spotify
                text-xs
              "
            >
              X
            </round-button>
          </div>

          <span class="block text-xs font-thin">
            {{ comment.updated_at }}
          </span>
        </span>

        <p
          :id="'comments_content_' + comment.id"
          class="w-full break-all whitespace-pre-line"
        >{{ comment.content }}
        </p>

        <div :id="'comments_edit_containter_' + comment.id" class="hidden">
          <textarea
            :id="'comments_edit_text_' + comment.id"
            class="
              text-s
              w-full
              border border-gray-400
              outline-none
              rounded
              resize-none
              focus:outline-none
              focus:ring-2
              focus:ring-gray-400
              focus:border-transparent
              px-1.5
              py-0.5
            "
            oninput="contentTextAreaResize(this)"
            rows="1"
            v-model="commentEditText[comment.id]"
          ></textarea>

          <div class="inline float-right">
            <square-button
              :click-func="() => editComment(comment.id)"
              class="ml-2 px-1.5 py-0.3 text-sm"
            >
              Save
            </square-button>
          </div>
        </div>
      </div>
    </div>

    <div
      class="flex items-center"
      :class="[isBubbleStyle ? 'px-4 py-4' : ' py-5']"
    >
      <textarea
        class="
          form-textarea
          focus:outline-none
          focus:ring-2
          focus:ring-gray-400
          focus:border-transparent
          flex-grow
          border border-gray-400
          rounded
          outline-none
          resize-none
        "
        rows="1"
        placeholder="Write a comment ..."
        v-model="commentContentText"
      ></textarea>

      <square-button
        :click-func="() => addComment(post.id)"
        class="px-3 py-1 ml-3 text-sm"
      >
        Post
      </square-button>
    </div>

    <delete-confirm
      :isVisible="isConfirmOpen"
      :buttonLink="() => handleCommentDeleteClick(openCommentID)"
      :toggleHidden="() => toggleHidden(0)"
    ></delete-confirm>
  </div>
</template>

<script>
import common from "./common";
import DeleteConfirm from "./DeleteConfirm.vue";
import RoundButton from "./RoundButton.vue";
import SquareButton from "./SquareButton.vue";

export default {
  components: { DeleteConfirm, RoundButton, SquareButton },
  props: {
    post: {
      type: Object,
    },
    userId: {
      type: Number,
    },
    isClosed: {
      type: Boolean,
    },
    isBubbleStyle: {
      type: Boolean,
      default: true,
    },
  },

  data() {
    return {
      commentList: [],
      commentContentText: "",
      commentEditText: [],
      isConfirmOpen: false,
      openCommentID: 0,
    };
  },

  mounted() {
    axios
      .get(config.routes.comments_index)
      .then((response) => {
        this.commentList = [];
        for (let i = 0; i < response.data.length; i++) {
          const current_post_id = response.data[i].post_id;
          if (this.commentList[current_post_id] == undefined) {
            this.commentList[current_post_id] = response.data.filter(function (
              comment
            ) {
              return comment.post_id === current_post_id;
            });
          }
        }
      })
      .catch((response) => {
        console.log(response);
      });

    common.scrollCommentsBottom();
  },

  methods: {
    toggleHidden: function (comment_id) {
      this.openCommentID = comment_id;
      this.isConfirmOpen = !this.isConfirmOpen;
    },

    handleCommentEditClick: function (comment_id) {
      let input_area = document.getElementById(
        "comments_edit_text_" + comment_id
      );

      let comment_content = document.getElementById(
        "comments_content_" + comment_id
      );

      let comment_edit_container = document.getElementById(
        "comments_edit_containter_" + comment_id
      );

      comment_content.classList.toggle("hidden");
      comment_edit_container.classList.toggle("hidden");
      input_area.value = comment_content.innerHTML;
    },

    handleCommentDeleteClick: function (comment_id) {
      axios
        .delete(`${config.routes.comments_delete}/${comment_id}`, {
          headers: {
            "Content-type": "application/json",
            Authorization: `Bearer ${config.token}`,
          },
        })
        .then((response) => {
          const post_id = response.data.post_id;
          const filtered_post = this.commentList[post_id].filter((comment) => {
            return comment.id !== comment_id;
          });
          this.$set(this.commentList, post_id, filtered_post);
          this.isConfirmOpen = false;
          let count = document.getElementById(
            `comment_count_${response.data.post_id}`
          );
          count.innerHTML = parseInt(count.innerHTML) - 1;
        })
        .catch((error) => {
          if (error.response) {
            console.log(error.response);
          }
        });
    },

    addComment: function (post_id) {
      axios
        .post(config.routes.comments_store, {
          headers: {
            "Content-type": "application/json",
            Authorization: `Bearer ${config.token}`,
          },
          post_id: post_id,
          content: this.commentContentText,
        })
        .then((response) => {
          // Add to comment list and increase comment count.
          this.commentList[response.data.post_id].push(response.data);
          this.commentContentText = "";
          let count = document.getElementById(
            `comment_count_${response.data.post_id}`
          );
          count.innerHTML = parseInt(count.innerHTML) + 1;

          this.$nextTick(function () {
            common.scrollCommentsBottom();
          });
        })
        .catch((response) => {
          console.log(response);
        });
    },

    editComment: function (comment_id) {
      axios
        .put(`${config.routes.comments_update}/${comment_id}`, {
          headers: {
            "Content-type": "application/json",
            Authorization: `Bearer ${config.token}`,
          },
          content: this.commentEditText[comment_id],
        })
        .then((response) => {
          const post_id = response.data.post_id;
          const post = this.commentList[post_id];
          post.find((x) => x.id === comment_id).content =
            this.commentEditText[comment_id];

          let comment_content = document.getElementById(
            "comments_content_" + comment_id
          );
          comment_content.innerHTML = this.commentEditText[comment_id];
          this.handleCommentEditClick(comment_id);
        })
        .catch((error) => {
          // Last resort -> should never run.
          if (error.response) {
            const response = error.response.data;
            window.location.href = response.redirect;
            alert(response.message);
          }
        });
    },
  },
};
</script>
