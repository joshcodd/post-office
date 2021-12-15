<template>
  <a href="/" class="font-garamond flex px-2 py-4 text-2xl">
    {{ logoText }}
  </a>
</template>

<script>
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

export default {
  data() {
    return {
      logoText: "PostOffice🏣",
    };
  },

  methods: {
    glitchText: function () {
      console.log("hey");
      date = new Date();
      previous_time = date.getTime();

      let intervalID = setInterval(() => {
        const random = Math.floor(
          Math.random() * (titles.length - 1 - 0 + 1) + 0
        );
        this.logoText = titles[random];

        date = new Date();
        current_time = date.getTime();
        if (current_time - previous_time > glitch_length) {
          clearInterval(intervalID);
          this.logoText = "PostOffice🏣";
        }
      }, 50 + Math.random() * 150);
    },
  },

  mounted: function () {
    this.glitchText();
    setInterval(this.glitchText, glitch_length + pause_length);
  },
};
</script>
