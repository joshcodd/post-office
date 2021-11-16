<template>
  <div class="inline-block">
    <round-button
      :click-func="() => toggleHidden()"
      class-style="text-spotify border-spotify hover:bg-spotify px-3 py-1 text-xs"
      >Delete post</round-button
    >
    <delete-confirm
      :isVisible="isConfirmOpen"
      :route="route"
      :toggleHidden="() => toggleHidden()"
      :csfrToken="csfrToken"
    ></delete-confirm>
  </div>
</template>

<script>
import RoundButton from "./RoundButton.vue";
export default {
  components: { RoundButton },
  props: {
    route: {
      type: String,
      default: "",
    },

    csfrToken: {
      type: String,
    },
  },

  data() {
    return {
      isConfirmOpen: false,
    };
  },

  methods: {
    toggleHidden: function () {
      this.isConfirmOpen = !this.isConfirmOpen;
    },
  },
};
</script>
