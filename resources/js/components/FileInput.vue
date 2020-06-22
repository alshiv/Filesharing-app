<template>
  <div class="form-group">
    <div class="input-group">
      <input
        type="text"
        readonly
        disabled
        :value="getFilesName()"
        class="form-control"
        placeholder="Choose your files"
      />
      <span class="input-group-append">
        <button
          v-if="files.length"
          class="btn btn-outline-secondary"
          type="button"
          @click="$emit('file-clear')"
        >Clear</button>
        <button
          class="btn btn-outline-secondary"
          type="button"
          @click="showFilePicker"
        >Click to upload</button>
      </span>
    </div>
    <input type="file" ref="file" style="display:none" @change="selectFile" multiple/>
  </div>
</template>

<script>
export default {
  props: ['files'],
  methods: {
    showFilePicker() {
      this.$refs.file.click();
    },
    selectFile(event) {
      let files = event.target.files;
      this.$emit("file-change", files);
    },
    getFilesName() {
        let filesName = []

        if (this.files.length > 0){
            for (let file of this.files) {
                filesName.push(file.name)
            }
        }

        return filesName.join(", ");
    }
  }
};
</script>

<style></style>