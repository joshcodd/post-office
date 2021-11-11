const ham_burger = document.querySelector("button.ham-burger");
const mobile_menu = document.querySelector(".mobile-menu");
ham_burger.addEventListener("click", () => {
    mobile_menu.classList.toggle("hidden");
});

function handleCommentBtnClick(id) {
    // Hide and Show comments.
    const comments_id = id.substring('comment_btn_'.length);
    const comments = document.querySelector("#comments_" + comments_id);
    comments.classList.toggle("max-h-0");
    comments.classList.toggle("max-h-96");

    // Fill icon on click.
    const comment_btn_clear = document.querySelector("#comment_btn_clear_" + comments_id);
    const comment_btn_fill = document.querySelector("#comment_btn_fill_" + comments_id);
    comment_btn_clear.classList.toggle("invisible");
    comment_btn_fill.classList.toggle("invisible");
}

const titles = [
    "postoffice",
    "postOffice",
    "Yūbinkyoku",
    "yūBiNkyOku",
    "pOStOffic3",
    "postoffice",
    "PostOffice",
];

const glitch_length = 2000;
const pause_length = 10000;

const title = document.querySelector("#title");
const delay_string = title.textContent;
glitchText(title, titles, delay_string, glitch_length);
setInterval(function() { glitchText(title, titles, delay_string, glitch_length); }, glitch_length + pause_length);
