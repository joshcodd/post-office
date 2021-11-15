let app = new Vue({
    el: "#root",
    data: {
        commentList: [],
        commentContentText: "",
        commentEditText: [],
    },

    mounted() {
        axios
            .get(config.routes.comments_index)
            .then((response) => {
                this.commentList = [];
                for (let i = 0; i < response.data.length; i++) {
                    const current_post_id = response.data[i].post_id;
                    if (this.commentList[current_post_id] == undefined) {
                        this.commentList[current_post_id] =
                            response.data.filter(function (comment) {
                                return comment.post_id === current_post_id;
                            });
                    }
                }
            })
            .catch((response) => {
                console.log(response);
            });
    },

    updated() {
        this.$nextTick(function () {
            const comment_scrolls = document.getElementsByName(
                "scrollable_comments"
            );
            for (let i = 0; i < comment_scrolls.length; i++) {
                comment_scrolls[i].scrollTop = comment_scrolls[i].scrollHeight;
            }
        });
    },

    methods: {
        handleCommentEditClick: function (comment_id) {
            let input_area = document.getElementById(
                "comments_edit_text_" + comment_id
            );

            let comment_content = document.getElementById(
                "comments_content_" + comment_id
            );

            let comment_edit_container = document.getElementById(
                "comments_edit_containter_" + comment_id
            );

            comment_content.classList.toggle("hidden");
            comment_edit_container.classList.toggle("hidden");
            input_area.value = comment_content.innerHTML;
        },

        addComment: function (post_id) {
            axios
                .post(config.routes.comments_store, {
                    headers: {
                        "Content-type": "application/json",
                        Authorization: `Bearer ${config.token}`,
                    },
                    post_id: post_id,
                    content: this.commentContentText,
                })
                .then((response) => {
                    // Add to comment list and increase comment count.
                    this.commentList[response.data.post_id].push(response.data);
                    this.commentContentText = "";
                    let count = document.getElementById(
                        `comment_count_${response.data.post_id}`
                    );
                    count.innerHTML = parseInt(count.innerHTML) + 1;
                })
                .catch((response) => {
                    console.log(response);
                });
        },

        editComment: function (comment_id) {
            axios
                .put(`${config.routes.comments_update}/${comment_id}`, {
                    headers: {
                        "Content-type": "application/json",
                        Authorization: `Bearer ${config.token}`,
                    },
                    content: this.commentEditText[comment_id],
                })
                .then((response) => {
                    const post_id = response.data.post_id;
                    const post = this.commentList[post_id];
                    post.find((x) => x.id === comment_id).content =
                        this.commentEditText[comment_id];

                    let comment_content = document.getElementById(
                        "comments_content_" + comment_id
                    );
                    comment_content.innerHTML =
                        this.commentEditText[comment_id];
                    this.handleCommentEditClick(comment_id);
                })
                .catch((error) => {
                    // Last resort -> should never run.
                    if (error.response) {
                        const response = error.response.data;
                        window.location.href = response.redirect;
                        alert(response.message);
                    }
                });
        },
    },
});
