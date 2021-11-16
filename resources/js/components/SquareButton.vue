<template>
  <button
    v-on:click="clickFunc"
    :class="classStyle"
    class="
      hover:bg-gray-700 hover:text-white
      font-semibold
      text-black
      border border-black
      rounded
    "
  >
    <slot></slot>
  </button>
</template>

<script>
export default {
  props: {
    clickFunc: {
      type: Function,
    },
    classStyle: {
      type: String,
    },
  },
};
</script>
