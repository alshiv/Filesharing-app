<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Upload file here</div>

          <div class="card-body">
            <form @submit.prevent="handleSubmit">
              <file-input :files="files" v-on:file-change="setFiles" @file-clear="clearFiles"></file-input>
              <div class="form-group">
                <button class="btn btn-success" type="submit" :disabled="disableUploadButton">Upload</button>
              </div>
              <progress-bar :progress="progress" v-if="isUploading"></progress-bar>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ProgressBar from "./ProgressBar.vue";
import FileInput from "./FileInput";
export default {
  methods: {
    clearFiles() {
      this.files = []
      this.disableUploadButton = true
    },
    async handleSubmit() {
      this.isUploading = true;
      this.disableUploadButton = true;
      let formData = new FormData();
      for (let file of this.files) {
        formData.append("file_name[]", file, file.name);
      }
      formData.append("username", this.auth_user.username);
      await axios
        .post("/api/files", formData, {
          onUploadProgress: e => {
            if (e.lengthComputable) {
              this.progress = (e.loaded / e.total) * 100;
            }
          }
        })
        .then(response => {
          console.log(response);
          setTimeout(() => {
            this.isUploading = false;
            this.files = [];
          }, 1000)
        })
        .catch(error => {
          console.log(error.message);
        });
    },
    setFiles(files) {
      if (files !== undefined) {
        this.files = files;
        this.disableUploadButton = false;
      }
    }
  },
  components: {
    FileInput,
    ProgressBar
  },
  data() {
    return {
      files: [],
      progress: 0,
      isUploading: false,
      disableUploadButton: true
    };
  },
  props: ['auth_user']
};
</script>

<style>
</style>