
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


const title = document.querySelector("#title");
const titles = [
    "postoffice",
    "postOffice",
    "Yūbinkyoku",
    "yūBiNkyOku",
    "pOStOffic3",
    "postoffice",
    "PostOffice",
];

let date = new Date();
let previous_time;
let current_time;
const glitch_length = 2000;
const pause_length = 10000;
glitchTitle();
setInterval(glitchTitle, glitch_length + pause_length);

function glitchTitle() {
    date = new Date();
    previous_time = date.getTime();

    let intervalID = setInterval(() => {
        const random = Math.floor(Math.random() * ((titles.length - 1) - 0 + 1) + 0);
        title.innerHTML = titles[random];

        date = new Date();
        current_time = date.getTime();
        if ((current_time - previous_time) > glitch_length) {
            clearInterval(intervalID);
            title.innerHTML = "PostOffice🏣";
        }
    }, 50 + Math.random() * 150);
}
