<template>
  <div class="flex items-center">
    <button
      :id="`like_btn_${itemId}`"
      v-on:click="handleLikeBtnClick()"
      class="group relative"
    >
      <div
        class="group-hover:visible relative"
        :class="currentHasLiked ? `visible w-${width}` : `invisible w-${width}`"
      >
        <heart-icon></heart-icon>
      </div>

      <div
        class="absolute top-0"
        :class="currentHasLiked ? `invisible w-${width}` : `visible w-${width}`"
      >
        <heart-icon-outline></heart-icon-outline>
      </div>
    </button>

    <button
      :id="'like_count_' + itemId"
      class="hover:underline ml-1"
      v-on:click="isPopUpOpen = !isPopUpOpen"
    >
      {{ likes.length }}
    </button>

    <div
      v-if="isPopUpOpen"
      class="bg-opacity-70 fixed inset-0 z-50 text-sm text-center bg-white"
    >
      <div
        class="
          left-1/2 top-1/2 rounded-2xl fixed transform
          -translate-x-1/2 -translate-y-1/2 bg-gray-100 shadow-md opacity-100
        "
      >
        <div class="w-96 h-96 rounded-2xl pt-2.5 overflow-scroll">
          <div
            v-for="(like, index) in likes"
            :key="`like_${index}`"
            class="flex items-center w-full py-3 pl-6 border-b"
          >
            <div>
              <svg height="15" width="15">
                <circle
                  cx="7.5"
                  cy="7.5"
                  r="6"
                  stroke="black"
                  stroke-width="1.5"
                  fill="none"
                />
              </svg>
            </div>
            <div class="px-5">
              Liked by
              <a
                :href="`users/${like.user_id}`"
                class="hover:underline font-bold"
              >
                {{ like.user.first_name }}
                {{ like.user.surname }}
              </a>
            </div>
          </div>
        </div>
        <round-button
          :click-func="() => (isPopUpOpen = !isPopUpOpen)"
          class-style="px-3.5 py-1 text-sm my-3"
        >
          Close
        </round-button>
      </div>
    </div>
  </div>
</template>

<script>
import HeartIcon from "./HeartIcon.vue";

export default {
  components: { HeartIcon },
  props: {
    itemId: {
      type: Number,
    },

    isComment: {
      type: Boolean,
      default: false,
    },

    likes: {
      type: Array,
    },

    currentUserId: {
      type: Number,
    },

    width: {
      type: String,
    },
  },

  data() {
    return {
      currentHasLiked: this.hasLiked(),
      isPopUpOpen: false,
    };
  },

  methods: {
    handleLikeBtnClick: function () {
      if (this.hasLiked()) {
        this.unlikeItem();
      } else {
        this.likeItem();
      }
    },

    likeItem: function () {
      let comment_id = this.itemId;
      let post_id = this.itemId;
      if (this.isComment) {
        post_id = null;
      } else {
        comment_id = null;
      }
      axios
        .post(config.routes.like_store, {
          headers: {
            "Content-type": "application/json",
            Authorization: `Bearer ${config.token}`,
          },
          post: post_id,
          comment: comment_id,
        })
        .then((response) => {
          this.currentHasLiked = true;
          this.likes.push(response.data.like);
        })
        .catch((error) => {
          if (error.response) {
            console.log(error.response);
          }
        });
    },

    unlikeItem: function () {
      const like_index = this.likes.findIndex(
        (like) => like.user_id == this.currentUserId
      );
      const like_id = this.likes[like_index].id;

      let route = config.routes.like_destroy;
      route = route.replace("first", like_id);
      axios
        .delete(route, {
          headers: {
            "Content-type": "application/json",
            Authorization: `Bearer ${config.token}`,
          },
        })
        .then((response) => {
          this.currentHasLiked = false;
          this.likes.splice(like_index, 1);
        })
        .catch((error) => {
          if (error.response) {
            console.log(error.response);
          }
        });
    },

    hasLiked: function () {
      const hasLiked =
        this.likes.filter((like) => like.user_id === this.currentUserId)
          .length > 0;
      if (hasLiked) {
        return true;
      }
      return false;
    },
  },
};
</script>
