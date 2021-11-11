let app = new Vue({
    el: "#root",
    data: {
        commentList: [],
        commentContentText: '',
    },

    mounted() {
        axios.get(config.routes.comments_index).then(response => {
            this.commentList = [];
            for (let i = 0; i < response.data.length; i++) {
                const current_post_id = response.data[i].post_id;
                if (this.commentList[current_post_id] == undefined) {
                    this.commentList[current_post_id] = response.data.filter(function(comment) {
                        return comment.post_id === current_post_id;
                    });
                }
            }
        }).catch(response => {
            console.log(response);
        });
    },

    updated() {
        this.$nextTick(function() {
            const comment_scrolls = document.getElementsByName("scrollable_comments");
            for (let i = 0; i < comment_scrolls.length; i++) {
                comment_scrolls[i].scrollTop = comment_scrolls[i].scrollHeight;
            }
        });
    },

    methods: {
        addComment: function(post_id) {
            axios.post(config.routes.comments_store, {
                headers: {
                     "Content-type": "application/json",
                     "Authorization": `Bearer ${config.token}`,
                },
                user_id: 1, //TODO
                post_id: post_id,
                content: this.commentContentText,
            }).then(response => {
                // Add to comment list and increase comment count.
                this.commentList[response.data.post_id].push(response.data);
                this.commentContentText = "";
                let count = document.getElementById(`comment_count_${response.data.post_id}`);
                count.innerHTML = parseInt(count.innerHTML) + 1;
            }).catch(response => {
                console.log(response);
            });
        },
    }
});