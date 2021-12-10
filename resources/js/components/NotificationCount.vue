<template>
  <div
    v-if="initialCount > 0"
    name="notification_count"
    class="w-5 h-5 absolute circle bg-spotify pt-0.5 text-xs font-bold"
  >
    {{ initialCount }}
  </div>
</template>

<script>
export default {
  props: {
    initialCount: {
      type: Number,
      default: 0,
    },
  },
};
</script>
