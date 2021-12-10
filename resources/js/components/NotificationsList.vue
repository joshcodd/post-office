<template>
  <div class="flex flex-col-reverse">
    <div
      v-for="(notification, index) in notifications"
      :key="`notif_${index}`"
      class="flex items-center w-full py-3 pl-6 border-b"
    >
      <div>
        <svg height="20" width="20">
          <circle
            cx="10"
            cy="10"
            r="8"
            stroke="black"
            stroke-width="1.5"
            :fill="notification.read_at != null ? 'none' : 'black'"
          />
        </svg>
      </div>
      <div class="px-5">
        <a
          :href="notification.data.user_link"
          class="hover:underline font-bold"
        >
          {{ notification.data.first_name }}
          {{ notification.data.surname }}
        </a>

        <span v-if="notification.type == 'App\\Notifications\\RecievedLike'">
          has liked your
          <a
            :href="notification.data.post_link"
            class="hover:underline font-bold"
          >
            {{ notification.data.type }}
          </a>
        </span>

        <span
          v-else-if="notification.type == 'App\\Notifications\\RecievedComment'"
        >
          commented on your
          <a
            :href="notification.data.post_link"
            class="hover:underline font-bold"
          >
            post
          </a>
        </span>

        <time-stamp
          :timestamp="notification.created_at"
          class-style="block text-xs font-thin"
        >
        </time-stamp>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    notifications: {
      type: Array,
    },
  },
};
</script>
