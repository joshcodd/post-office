<template>
  <div
    class="
      bg-opacity-70fixed
      top-0
      bottom-0
      left-0
      right-0
      z-50
      w-full
      h-full
      bg-white
    "
    :class="isVisible ? '' : 'hidden'"
  >
    <div
      class="
        left-1/2
        top-1/2
        rounded-2xl
        p-7
        fixed
        overflow-hidden
        text-center
        transform
        -translate-x-1/2 -translate-y-1/2
        bg-white
        shadow-md
        opacity-100
      "
    >
      <div class="block pb-3">Are you sure?</div>

      <round-button
        :click-func="() => toggleHidden()"
        class-style="mr-4 px-3.5 py-1 text-sm"
      >
        Cancel
      </round-button>

      <form
        v-if="route != ''"
        method="POST"
        :action="route"
        class="inline-block"
      >
        <input type="hidden" name="_token" :value="csfrToken" />
        <input type="hidden" name="_method" value="DELETE" />
        <button
          type="submit"
          value="submit"
          class="
            rounded-full
            px-3.5
            py-1
            text-sm
            font-semibold
            border
            text-spotify
            border-spotify
            hover:bg-spotify hover:text-white
          "
        >
          Delete
        </button>
      </form>

      <button
        v-else
        class="
          rounded-full
          px-3.5
          py-1
          text-sm
          font-semibold
          border
          text-spotify
          border-spotify
          hover:bg-spotify hover:text-white
        "
        v-on:click="buttonLink()"
      >
        Delete
      </button>
    </div>
  </div>
</template>

<script>
import RoundButton from "./RoundButton.vue";
export default {
  components: { RoundButton },
  props: {
    isVisible: {
      type: Boolean,
    },
    route: {
      type: String,
      default: "",
    },
    buttonLink: {
      type: Function,
    },
    toggleHidden: {
      type: Function,
    },
    csfrToken: {
      type: String,
    },
  },
};
</script>
