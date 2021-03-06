<template>
  <div class="">
    <div
      :id="`comments_${post.id}`"
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
      <div class="sticky top-0 z-50">
        <div
          v-for="(message, index) in errorMessages"
          :key="`message_${index}`"
          class="bg-gray-50 z-50 block p-2 text-center border-b border-gray-400"
          role="alert"
        >
          <p class="text-spotify inline">{{ message }}</p>
          <button
            class="right-3 relative inline float-right"
            onclick="hideParent(this)"
          >
            x
          </button>
        </div>
      </div>

      <div
        v-for="comment in commentList"
        :key="`cmnt_${comment.id}`"
        class="overflow-hidden bg-white"
        :class="[
          isBubbleStyle
            ? 'py-2 px-5 m-5 rounded-xl shadow-md'
            : 'py-3 border-b border-bg-gray-400',
        ]"
      >
        <div
          v-if="isBubbleStyle"
          class="border-bg-gray-400 flex items-center font-semibold border-b"
        >
          <a
            v-on:click="handleUserNameClick(comment.user_id)"
            class="hover:underline cursor-pointer"
          >
            {{ comment.user.first_name }}
            {{ comment.user.surname }}
          </a>

          <div class="flex items-center justify-end flex-grow">
            <div class="flex items-center ml-3 text-xs">
              <time-stamp
                :timestamp="comment.updated_at"
                class-style="inline font-thin text-sm mr-2"
              >
              </time-stamp>

              <like-button
                :item-id="comment.id"
                :is-comment="true"
                :likes="comment.likes"
                :current-user-id="userId"
                width="w-5"
              >
              </like-button>
            </div>

            <div class="flex items-center text-xs">
              <span v-if="comment.user.id == userId">
                <round-button
                  :click-func="() => handleCommentEditClick(comment.id)"
                  class="z-10 ml-2 px-1.5 py-0.1"
                >
                  Edit
                </round-button>
              </span>

              <span v-if="comment.user.id == userId || userRole == 'admin'">
                <round-button
                  :click-func="() => toggleHidden(comment.id)"
                  class="
                    z-10
                    ml-2
                    px-1.5
                    py-0.1
                    text-spotify
                    border-spotify
                    hover:bg-spotify
                  "
                  >X</round-button
                >
              </span>
            </div>
          </div>
        </div>

        <div v-else class="block font-semibold mb-1.5">
          <div class="flex items-center">
            <a
              v-on:click="handleUserNameClick(comment.user_id)"
              class="hover:underline cursor-pointer"
            >
              {{ comment.user.first_name }}
              {{ comment.user.surname }}
            </a>

            <div class="flex items-center justify-end flex-grow">
              <div class="mt-px text-xs">
                <like-button
                  :item-id="comment.id"
                  :is-comment="true"
                  :likes="comment.likes"
                  :current-user-id="userId"
                  width="w-5"
                >
                </like-button>
              </div>

              <span v-if="comment.user.id == userId">
                <round-button
                  :click-func="() => handleCommentEditClick(comment.id)"
                  class="mr-1 ml-2 px-1.5 py-0.1 text-xs"
                >
                  Edit
                </round-button>
              </span>

              <span v-if="comment.user.id == userId || userRole == 'admin'">
                <round-button
                  :click-func="() => toggleHidden(comment.id)"
                  class="
                    px-1.5
                    py-0.1
                    text-spotify
                    border-spotify
                    hover:bg-spotify
                    text-xs
                    ml-2
                  "
                  >X</round-button
                >
              </span>
            </div>
          </div>

          <time-stamp
            :timestamp="comment.updated_at"
            class-style="block text-xs font-thin"
          >
          </time-stamp>
        </div>

        <p
          :id="`comments_content_${comment.id}`"
          class="w-full break-all whitespace-pre-line"
        >{{ comment.content }}</p>

        <div :id="`comments_edit_containter_${comment.id}`" class="hidden">
          <textarea
            :id="`comments_edit_text_${comment.id}`"
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
      :class="[isBubbleStyle ? 'px-4 pb-4 pt-3' : ' py-5']"
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
import LikeButton from "./LikeButton.vue";
import RoundButton from "./RoundButton.vue";
import SquareButton from "./SquareButton.vue";

export default {
  components: { DeleteConfirm, RoundButton, SquareButton, LikeButton },
  props: {
    post: {
      type: Object,
    },
    userId: {
      type: Number,
    },
    userRole: {
      type: String,
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
      errorMessages: [],
    };
  },

  mounted() {
    let route = config.routes.comments_index;
    route = route.replace("first", this.post.id);
    axios
      .get(route)
      .then((response) => {
        this.commentList = response.data;
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
      const input_area = document.getElementById(
        "comments_edit_text_" + comment_id
      );
      const comment_content = document.getElementById(
        "comments_content_" + comment_id
      );
      const comment_edit_container = document.getElementById(
        "comments_edit_containter_" + comment_id
      );
      comment_content.classList.toggle("hidden");
      comment_edit_container.classList.toggle("hidden");
      input_area.value = comment_content.innerHTML;
      contentTextAreaResize(input_area);
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
          const comment_index = this.commentList.findIndex(
            (comment) => comment.id == comment_id
          );
          this.commentList.splice(comment_index, 1);
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
          let new_comment = response.data;
          new_comment.likes = [];
          this.commentList.push(new_comment);
          this.commentContentText = "";
          let count = document.getElementById(
            `comment_count_${response.data.post_id}`
          );
          count.innerHTML = parseInt(count.innerHTML) + 1;
          this.$nextTick(function () {
            common.scrollCommentsBottom();
          });
        })
        .catch((error) => {
          if (error.response) {
            this.flashMessages(error.response.data.messages);
          }
        });
    },

    flashMessages: function (messages) {
      messages.forEach((element) => {
        this.errorMessages.push(element);
      });
    },

    handleUserNameClick: function (user_id) {
      window.location.href = `${config.routes.profile_show}/${user_id}`;
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
          this.commentList.find((x) => x.id === comment_id).content =
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
            this.flashMessages(error.response.data.messages);
          }
        });
    },
  },
};
</script>
