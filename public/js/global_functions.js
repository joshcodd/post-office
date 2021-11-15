let date = new Date();
let previous_time;
let current_time;

function glitchText(element, glitch_strings, delay_text, length) {
    date = new Date();
    previous_time = date.getTime();

    let intervalID = setInterval(() => {
        const random = Math.floor(
            Math.random() * (glitch_strings.length - 1 - 0 + 1) + 0
        );
        element.innerHTML = glitch_strings[random];

        date = new Date();
        current_time = date.getTime();
        if (current_time - previous_time > length) {
            clearInterval(intervalID);
            element.innerHTML = delay_text;
        }
    }, 50 + Math.random() * 150);
}

function toggleHidden(id) {
    if (typeof id === "string") {
        document.getElementById(id).classList.toggle("hidden");
    } else {
        id.classList.toggle("hidden");
    }
}
