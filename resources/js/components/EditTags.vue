<template>
  <div class="mb-7 mt-5">
    <div
      v-for="tag in tagsList"
      :key="`tag_${tag.id}`"
      class="rounded-xl inline-block my-1 mr-2 text-sm bg-gray-100 border"
    >
      <div class="inline-block ml-3 mr-1">
        {{ tag.name }}
      </div>

      <button
        type="button"
        v-on:click="() => handleDeleteClick(postId, tag.id)"
        class="text-spotify inline-block pr-2 text-base"
      >
        x
      </button>
    </div>

    <div class="block">
      <input
        type="text"
        v-model="inputTag"
        placeholder="Add a tag.."
        class="
          inline-block
          rounded-xl
          px-3
          text-sm
          py-0.5
          mt-3
          focus:outline-none
          focus:ring-2
          focus:ring-gray-400
          focus:border-transparent
          border-gray-400
          text-gray-600
        "
      />

      <round-button
        type="button"
        :click-func="() => handleAddClick(postId)"
        class-style="inline ml-1 px-1.5 py-1.5 mb-2"
        ><svg
          xmlns="http://www.w3.org/2000/svg"
          class="font-red-100 text-red-100"
          width="9.5"
          height="9.5"
          viewBox="0 0 24 24"
          stroke-width="0.1"
        >
          <path d=" M24 10h-10v-10h-4v10h-10v4h10v10h4v-10h10z" /></svg
      ></round-button>

      <div class="w-full h-20">
        <div
          v-for="(message, index) in errorMessages"
          :key="`error${index}`"
          class="text-spotify block py-1 text-sm"
        >
          {{ message }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import RoundButton from "./RoundButton.vue";
export default {
  components: { RoundButton },
  props: {
    tags: {
      type: Array,
    },
    postId: {
      type: String,
    },
  },

  data() {
    return {
      tagsList: this.tags,
      inputTag: "",
      errorMessages: [],
    };
  },

  methods: {
    handleAddClick: function (post_id) {
      let route = config.routes.add_tag;
      route = route.replace("first", post_id);
      axios
        .post(route, {
          headers: {
            "Content-type": "application/json",
            Authorization: `Bearer ${config.token}`,
          },
          name: this.inputTag,
        })
        .then((response) => {
          this.tagsList.push(response.data);
          this.inputTag = "";
        })
        .catch((error) => {
          if (error.response) {
            this.errorMessages = this.errorMessages.concat(
              error.response.data.messages
            );
          }
        });

      this.$nextTick(function () {
        this.errorMessages = [];
      });
    },

    handleDeleteClick: function (post_id, tag_id) {
      let route = config.routes.delete_tag;
      route = route.replace("first", post_id);
      route = route.replace("second", tag_id);
      axios
        .delete(route, {
          headers: {
            "Content-type": "application/json",
            Authorization: `Bearer ${config.token}`,
          },
        })
        .then((response) => {
          this.tagsList = this.tagsList.filter((tag) => {
            return tag.id != tag_id;
          });
        })
        .catch((error) => {
          if (error.response) {
            console.log(error.response);
          }
        });
    },
  },
};
</script>
