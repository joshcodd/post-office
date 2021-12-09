<template>
  <div class="h-full">
    <button
      :id="`like_btn_${itemId}`"
      v-on:click="handleLikeBtnClick()"
      class="group relative inline-block w-auto h-full"
    >
      <svg
        height="100%"
        style="enable-background: new 0 0 512 512"
        version="1.1"
        viewBox="0 0 512 512"
        width="100%"
        xml:space="preserve"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        class="group-hover:visible relative"
        :class="currentHasLiked ? 'visible' : 'invisible '"
        :id="`like_btn_fill_${itemId}`"
      >
        <path
          d="M365.4,59.628c60.56,0,109.6,49.03,109.6,109.47c0,109.47-109.6,
          171.8-219.06,281.271 C146.47,340.898,37,278.568,37,169.099c0-60.44,
          49.04-109.47,109.47-109.47c54.73,0,82.1,27.37,109.47,82.1 C283.3,
          86.999,310.67,59.628,365.4,59.628z"
          style="fill: #df493a"
        />
      </svg>

      <svg
        height="100%"
        style="enable-background: new 0 0 512 512"
        version="1.1"
        viewBox="0 0 512 512"
        width="100%"
        xml:space="preserve"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        class="absolute top-0"
        :class="currentHasLiked ? 'invisible ' : 'visible '"
        :id="`like_btn_stroke_${itemId}`"
      >
        <path
          d="M255.937,461.368c-2.652,0-5.196-1.054-7.071-2.929 c-26.65-26.65-53.021-50.236-78.522-73.046C132.019,
          351.116,95.82,318.74,69.956,285.047c-29.304-38.173-42.952-74.699-42.952-114.948c0-65.874,53.592-119.467,
          119.466-119.467c55.362,0,84.611,26.631,109.467,70.721 c24.856-44.09,54.105-70.721,
          109.467-70.721c65.944,0,119.594,53.593,119.594,119.467c0,40.231-13.65,76.743-42.958,114.903 c-25.866,
          33.679-62.061,66.036-100.38,100.294c-25.547,22.839-51.963,46.454-78.651,73.144 C261.132,460.314,
          258.589,461.368,255.937,461.368z  M146.47,70.632c-54.846,0-99.466,44.621-99.466,99.467 c0,78.147,
          60.313,132.091,136.672,200.387c23.462,20.985,47.653,42.622,72.261,66.802c24.648-24.219,48.886-45.888,
          72.393-66.902 c76.356-68.263,136.668-122.181,136.668-200.287c0-54.846-44.678-99.467-99.594-99.467c-46.531,
          0-71.896,19.322-100.522,76.572 c-1.694,3.388-5.156,5.528-8.944,5.528l0,0c-3.788,
          0-7.25-2.14-8.944-5.528C218.367,89.954,193.001,70.632,146.47,70.632z"
        />
      </svg>
    </button>

    <button
      :id="'like_count_' + itemId"
      class="flex items-center float-right h-full ml-1 hover:underline"
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
export default {
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
