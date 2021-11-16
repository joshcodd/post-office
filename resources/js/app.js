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
    "round-button",
    require("./components/RoundButton.vue").default
);

Vue.component(
    "square-button",
    require("./components/SquareButton.vue").default
);

const app = new Vue({
    el: "#app",
});
