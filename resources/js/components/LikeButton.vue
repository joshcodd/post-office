<template>
  <div class="float-right mr-5">
    <button
      :id="`like_btn_${postId}`"
      v-on:click="handleLikeBtnClick(postId)"
      class="group mt-0.5 mb-2 inline-block relative"
    >
      <svg
        height="32px"
        style="enable-background: new 0 0 512 512"
        version="1.1"
        viewBox="0 0 512 512"
        width="32px"
        xml:space="preserve"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        class="group-hover:visible relative"
        :class="currentHasLiked ? 'visible' : 'invisible '"
        :id="`like_btn_fill_${postId}`"
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
        height="32px"
        style="enable-background: new 0 0 512 512"
        version="1.1"
        viewBox="0 0 512 512"
        width="32px"
        xml:space="preserve"
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        class="absolute top-0"
        :class="currentHasLiked ? 'invisible ' : 'visible '"
        :id="`like_btn_stroke_${postId}`"
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

    <div class="ml-1 mt-1.5 inline-block float-right">
      <div :id="'like_count_' + postId">
        {{ currentNumLikes }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    postId: {
      type: Number,
    },
    numLikes: {
      type: Number,
    },

    postLiked: {
      type: Boolean,
    },
  },

  data() {
    return {
      currentNumLikes: this.numLikes,
      currentHasLiked: this.postLiked,
    };
  },

  methods: {
    likePost: function (post_id) {
      let route = config.routes.like;
      route = route.replace("first", post_id);
      axios
        .post(route, {
          headers: {
            "Content-type": "application/json",
            Authorization: `Bearer ${config.token}`,
          },
        })
        .then((response) => {
          this.currentNumLikes += 1;
          this.currentHasLiked = true;
        })
        .catch((error) => {
          if (error.response) {
            console.log(error.response);
          }
        });
    },

    unlikePost: function (post_id) {
      let route = config.routes.unlike;
      route = route.replace("first", post_id);
      axios
        .delete(route, {
          headers: {
            "Content-type": "application/json",
            Authorization: `Bearer ${config.token}`,
          },
        })
        .then((response) => {
          this.currentNumLikes -= 1;
          this.currentHasLiked = false;
        })
        .catch((error) => {
          if (error.response) {
            console.log(error.response);
          }
        });
    },

    hasLikedPost: function (post_id) {
      let route = config.routes.hasLiked;
      route = route.replace("first", post_id);
      const request = axios.get(route, {
        headers: {
          "Content-type": "application/json",
          Authorization: `Bearer ${config.token}`,
        },
      });
      return request.then((response) => response.data.hasLiked);
    },

    handleLikeBtnClick: async function (id) {
      let route = config.routes.hasLiked;
      route = route.replace("first", id);
      axios
        .get(route, {
          headers: {
            "Content-type": "application/json",
            Authorization: `Bearer ${config.token}`,
          },
        })
        .then((response) => {
          if (response.data.hasLiked) {
            this.unlikePost(id);
          } else {
            this.likePost(id);
          }
        });
    },
  },
};
</script>
