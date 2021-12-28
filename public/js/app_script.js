
function handleHamBurgerClick() {
    let mobile_menu = document.getElementById("mobile-menu");
    mobile_menu.classList.toggle("hidden");
}

function contentTextAreaResize(element) {
    element.style.height = "auto";
    element.style.height = element.scrollHeight + "px";
}

function hideParent(element) {
    element.parentElement.classList.toggle("hidden");
}
