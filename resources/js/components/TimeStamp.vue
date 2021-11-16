<template>
  <div :class="classStyle">
    {{ display_time }}
  </div>
</template>

<script>
export default {
  props: {
    timestamp: {
      type: String,
      default: "Just Now",
    },
    classStyle: {
      type: String,
      default: "",
    },
  },

  data() {
    return {
      display_time: this.timestamp,
    };
  },

  mounted() {
    const milliseconds_diff = new Date() - Date.parse(this.display_time);
    const minutes_since = milliseconds_diff / 60000;
    const hours_since = minutes_since / 60;
    const days_since = hours_since / 24;
    const weeks_since = days_since / 7;
    const months_since = days_since / 30.417;
    const years_since = days_since / 12;

    let plural = "";
    if (minutes_since < 60) {
      plural = minutes_since >= 2 ? "s" : "";
      this.display_time = `${Math.trunc(minutes_since)} minute${plural} ago`;
    } else if (hours_since < 24) {
      plural = hours_since >= 2 ? "s" : "";
      this.display_time = `${Math.trunc(hours_since)} hour${plural} ago`;
    } else if (days_since < 7) {
      plural = days_since >= 2 ? "s" : "";
      this.display_time = `${Math.trunc(days_since)} day${plural} ago`;
    } else if (weeks_since < 4) {
      plural = weeks_since >= 2 ? "s" : "";
      this.display_time = `${Math.trunc(weeks_since)} week${plural} ago`;
    } else if (months_since < 12) {
      plural = months_since >= 2 ? "s" : "";
      this.display_time = `${Math.trunc(months_since)} month${plural} ago`;
    } else if (years_since < 12) {
      plural = years_since >= 2 ? "s" : "";
      this.display_time = `${Math.trunc(years_since)} year${plural} ago`;
    }
  },
};
</script>
