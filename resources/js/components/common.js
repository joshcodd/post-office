export default {
    scrollCommentsBottom() {
        const comment_scrolls = document.getElementsByName(
            "scrollable_comments"
        );

        for (let i = 0; i < comment_scrolls.length; i++) {
            comment_scrolls[i].scrollTop = comment_scrolls[i].scrollHeight;
        }
    },
};
