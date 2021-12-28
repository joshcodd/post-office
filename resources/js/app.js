require("./bootstrap");

require("alpinejs");

window.Vue = require("vue").default;

// Components
Vue.component(
    "comment-button",
    require("./components/CommentButton.vue").default
);

Vue.component(
    "comment-section",
    require("./components/CommentSection.vue").default
);

Vue.component(
    "delete-confirm",
    require("./components/DeleteConfirm.vue").default
);

Vue.component(
    "delete-confirm-state",
    require("./components/DeleteConfirmState.vue").default
);

Vue.component(
    "round-button",
    require("./components/RoundButton.vue").default
);

Vue.component(
    "square-button",
    require("./components/SquareButton.vue").default
);

Vue.component(
    "time-stamp",
    require("./components/TimeStamp.vue").default
);

Vue.component(
    "edit-tags",
    require("./components/EditTags.vue").default
);

Vue.component(
    "add-tags",
    require("./components/AddTags.vue").default
);

Vue.component(
    "like-button",
    require("./components/LikeButton.vue").default
);

Vue.component(
    "heart-icon",
    require("./components/HeartIcon.vue").default
);

Vue.component(
    "heart-icon-outline",
    require("./components/HeartIconOutline.vue").default
);

Vue.component(
    "notification-list",
    require("./components/NotificationsList.vue").default
);

Vue.component(
    "notification-count",
    require("./components/NotificationCount.vue").default
);

Vue.component(
    "notification-nav-link",
    require("./components/NotificationNav.vue").default
);

Vue.component(
    "logo",
    require("./components/Logo.vue").default
);

const app = new Vue({
    el: "#app",
});
