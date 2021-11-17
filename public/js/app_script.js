
function handleHamBurgerClick() {
    let mobile_menu = document.getElementById("mobile-menu");
    mobile_menu.classList.toggle("hidden");
}

function notificationsClick(ismobile) {
    const notifications = document.getElementById("notification_popup");
    if (ismobile) {
        window.location.href = config.routes.notifications;
    }

    console.log(notifications);

    if (notifications.classList.contains('hidden')) {
        axios.post(config.routes.clear_notifications);

        document.getElementsByName('notification_count').forEach((e) => {
            e.classList.add('hidden');
        });
    }
    notifications.classList.toggle("hidden");
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
setInterval(function () {
    glitchText(title, titles, delay_string, glitch_length);
}, glitch_length + pause_length);

function contentTextAreaResize(element) {
    element.style.height = "auto";
    element.style.height = element.scrollHeight + "px";
}

function previewImage(image_element) {
    let img_preview = document.getElementById("create_post_img");
    const img_file = image_element.files[0];
    if (img_file) {
        let remove_button = document.getElementById("create_remove_image");
        remove_button.classList.remove("hidden");
        img_preview.src = URL.createObjectURL(img_file);
    }
}

function removeImage() {
    let img_input = document.getElementById("create_img_upload");
    let img_preview = document.getElementById("create_post_img");
    img_input.value = "";
    img_preview.src = "";

    let remove_button = document.getElementById("create_remove_image");
    remove_button.classList.toggle("hidden");
}

function hideParent(element) {
    element.parentElement.classList.toggle("hidden");
}
