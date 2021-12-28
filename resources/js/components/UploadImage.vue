<template>
  <div class="my-3">
    <div
      class="image_spacer flex items-center text-center bg-gray-100 border border-gray-400 border-dashed"
    >
      <camera-icon v-if="imagePath == null"></camera-icon>

      <img
        v-if="imagePath != null"
        class="z-10 w-full"
        :src="imagePath != null ? imagePath : ''"
        alt=""
      />
    </div>

    <label
      for="create_img_upload"
      class="mt-3 cursor-pointer border inline-block rounded px-5 py-2.5 text-sm font-semibold text-black border-black hover:bg-gray-700    
        hover:text-white"
      >Upload Image</label
    >

    <button
      type="button"
      v-if="imagePath != null"
      class="mt-3 cursor-pointer border inline-block rounded px-5 py-2.5 text-sm font-semibold text-black border-black hover:bg-gray-700  
        hover:text-white"
      @click="removeImage()"
    >
      Remove Image
    </button>

    <input
      type="file"
      name="image"
      @change="previewImage"
      id="create_img_upload"
      class="hidden"
    />

    <input
      type="checkbox"
      name="hasUpdatedImage"
      class="hidden"
      :checked="hasUpdatedImage"
    />
  </div>
</template>

<script>
import CameraIcon from "./CameraIcon.vue";

export default {
  components: { CameraIcon },
  props: {
    imagePathDefault: {
      type: String,
      default: null,
    },
  },

  data() {
    return {
      imagePath: this.imagePathDefault,
      hasUpdatedImage: false,
    };
  },

  methods: {
    previewImage: function (event) {
      const img_file = event.target.files[0];
      if (img_file) {
        this.imagePath = URL.createObjectURL(img_file);
        this.hasUpdatedImage = true;
      }
    },

    removeImage: function () {
      let img_input = document.getElementById("create_img_upload");
      img_input.value = "";
      this.imagePath = null;
      this.hasUpdatedImage = true;
    },
  },
};
</script>
