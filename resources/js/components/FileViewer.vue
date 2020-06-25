<template>
  <table class="table" v-if="items.length">
    <thead>
      <tr>
        <th scope="col">File Title</th>
        <th scope="col">Timer</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="item in items" :key="item.id">
        <th scope="row">{{item.title}}</th>
        <td>
          <base-timer :time-passed-prop="item.time_passed"></base-timer>
        </td>
        <td>
          <button type="button" class="btn btn-danger" @click='deleteFile' :data-id="item.id" :data-filename="item.file_name">Delete</button>
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
      id: '',
    };
  },
  methods: {
      getFiles() {
          axios.get('/files/get-json')
          .then(response => {   
              this.items = response.data;
              console.log(this.items)
          })
          .catch(error => {
              console.log(error.message);
          })
      },
      async deleteFile(event){
          let formData = new FormData();
          this.filepath = event.target.getAttribute('data-filename');
          this.id = event.target.getAttribute('data-id');
          formData.append("filepath", this.filepath);
          formData.append("id", this.id);
          await axios.post('/api/files/delete', formData)
          .then(response => {
              console.log(response)
              this.getFiles();
          })
          .catch(error => {
              console.log(error.message)
          })
      },
  },
  mounted() {
      this.getFiles();
  },
  components: {
    BaseTimer
  },
};
</script>

<style>
</style>