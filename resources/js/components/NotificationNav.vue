<template>
  <div class="relative">
    <button
      class="hoverSplitContainer font-nunito m-50-important font-light"
      @click="handleNotificationClick()"
    >
      <notification-count
        :initial-count="unreadCount"
        class="-right-6 -top-1"
      ></notification-count>

      <div class="topHalf">Notifications</div>
      <div class="bottomHalf">Notifications</div>
    </button>

    <div
      id="notification_popup"
      v-if="notificationsOpen"
      class="top-12 -right-36 absolute"
    >
      <div class="popup-tag"></div>
      <div
        class="
          w-96
          max-h-96
          rounded-xl
          py-2
          overflow-scroll
          bg-gray-100
          shadow-lg
        "
      >
        <notification-list :notifications="notificationsList">
        </notification-list>
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

    unreadNum: {
      type: Number,
    },

    userId: {
      type: Number,
    },
  },

  data() {
    return {
      notificationsOpen: false,
      unreadCount: this.unreadNum,
      notificationsList: this.notifications.reverse(),
    };
  },

  mounted() {
    Echo.private(`App.Models.User.${this.userId}`).notification(
      (notification) => {
        this.unreadCount += 1;
        this.notificationsList.push(notification.data);
      }
    );
  },

  methods: {
    handleNotificationClick: function () {
      this.notificationsOpen = !this.notificationsOpen;
      this.unreadCount = 0;
      if (!this.notificationsOpen) {
        this.markUnread();
        axios.post(config.routes.clear_notifications);
      }
    },

    markUnread: function () {
      this.notificationsList.forEach((notification) => {
        notification.read_at = Date.now();
      });
    },
  },
};
</script>
