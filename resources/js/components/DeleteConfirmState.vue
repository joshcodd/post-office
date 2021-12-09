<template>
  <div class="inline-block">
    <round-button
      :click-func="() => toggleHidden()"
      class-style="text-spotify border-spotify hover:bg-spotify"
      :class="classStyle"
      >Delete</round-button
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

    classStyle: {
      type: String,
      default: "px-3 py-1 text-xs",
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
