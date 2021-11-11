const home_text_1 = document.querySelector("#home_text_1");
const home_text_2 = document.querySelector("#home_text_2");
const home_text_3 = document.querySelector("#home_text_3");


const titles = [
    "postoffice",
    "postOffice",
    "Yūbinkyoku",
    "yūBiNkyOku",
    "yūBiNkyO便局",
    "pOStOffic3",
    "postoffice",
    "Po便局Office",
    "郵便局"
];

const delay_string_1 = home_text_1.textContent;
const delay_string_2 = home_text_2.textContent;
const delay_string_3 = home_text_3.textContent;
glitchText(home_text_1, titles , delay_string_1, 2000);
glitchText(home_text_3, titles , delay_string_3, 1000);
setInterval(function() { glitchText(home_text_1, titles , delay_string_1, 2000); }, 2000 + 15000);
setInterval(function() { glitchText(home_text_2, titles , delay_string_2, 1500); }, 1500 + 28000);
setInterval(function() { glitchText(home_text_3, titles , delay_string_3, 1000); },  1000 + 35000);
