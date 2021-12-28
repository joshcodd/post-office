<template>
  <div class="mb-7 mt-5">
    <div
      v-for="(tag, index) in tagsList"
      :key="`tag_${index}`"
      class="rounded-xl inline-block my-1 mr-2 text-sm bg-gray-100 border"
    >
      <div class="inline-block ml-3 mr-1">
        {{ tag }}
      </div>

      <button
        type="button"
        v-on:click="() => handleDeleteClick(tag)"
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
        class="inline-block 
        rounded-xl px-3 
        text-sm py-0.5 mt-3 
        focus:outline-none focus:ring-2 
        focus:ring-gray-400 focus:border-transparent 
        border-gray-400 text-gray-600"
      />

      <round-button
        type="button"
        :click-func="() => handleAddClick()"
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
          role="alert"
        >
          {{ message }}
        </div>
      </div>
    </div>
    <input type="hidden" v-model="tagsList" name="tags" />
  </div>
</template>

<script>
import RoundButton from "./RoundButton.vue";
export default {
  components: { RoundButton },
  props: {},

  data() {
    return {
      tagsList: [],
      inputTag: "",
      errorMessages: [],
    };
  },

  methods: {
    handleAddClick: function () {
      this.errorMessages = [];
      let tag = this.inputTag.trim();
      if (tag.split(" ").length != 1) {
        this.errorMessages.push("A tag must be a singular word.");
      } else if (this.tagsList.includes(tag)) {
        this.errorMessages.push(`${tag} has already been tagged.`);
      } else {
        this.tagsList.push(tag);
      }
      this.inputTag = "";
    },

    handleDeleteClick: function (current_tag) {
      this.tagsList = this.tagsList.filter((tag) => {
        return tag != current_tag;
      });
    },
  },
};
</script>
