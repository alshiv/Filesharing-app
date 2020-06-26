<template>
  <table class="table" v-if="items.length">
    <thead>
      <tr>
        <th scope="col">File Title</th>
        <th scope="col">Time Left</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in items" :key="item.id">
        <th scope="row">{{ item.title }}</th>
        <td>
          <base-timer
            :time-passed-prop="item.time_passed"
            v-on:time-end="changeState($event, item.id)"
          ></base-timer>
        </td>
        <td>
          <button
            type="button"
            class="btn btn-danger"
            @click="deleteFile"
            :data-id="item.id"
            :data-filename="item.file_name"
            v-if="item.state"
            :disabled="isDeleting"
          >Delete</button>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import BaseTimer from "./BaseTimer";
export default {
  data() {
    return {
      items: {},
      filepath: [],
      id: "",
      isDeleting: false
    };
  },
  methods: {
    async getFiles() {
      await axios
        .get("/files/get-json")
        .then(response => {
          this.items = response.data;
          for (let key in this.items) {
            if (this.items[key].time_passed > 3600) {
              this.items[key].state = false;
            } else {
              this.items[key].state = true;
            }
          }
          console.log(this.items);
        })
        .catch(error => {
          console.log(error.message);
        });
    },
    async deleteFile(event) {
      let formData = new FormData();
      this.filepath = event.target.getAttribute("data-filename");
      this.id = event.target.getAttribute("data-id");
      formData.append("filepath", this.filepath);
      formData.append("id", this.id);
      this.isDeleting = true;
      await axios
        .post("/api/files/delete", formData)
        .then(response => {
          console.log(response);
          setTimeout(() => {
            this.getFiles();
            this.isDeleting = false;
          }, 100);
        })
        .catch(error => {
          console.log(error.message);
          this.isDeleting = false;
        });
    },
    changeState(e, id) {
      this.getFiles();
    }
  },
  mounted() {
    this.getFiles();
  },
  components: {
    BaseTimer
  }
};
</script>

<style></style>
