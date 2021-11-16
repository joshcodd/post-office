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

const app = new Vue({
    el: "#app",
});
