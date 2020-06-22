<template>
<table class="table">
  <thead>
    <tr>
      <th scope="col">File Title</th>
      <th scope="col">Timer</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">Title</th>
      <td><base-timer :time-passed="timePassed"></base-timer></td>
      <td><button type="button" class="btn btn-danger">Delete</button></td>
    </tr>
  </tbody>
</table>
</template>

<script>
import BaseTimer from "./BaseTimer";
export default {
  data() {
    return {
      timePassed: 0
    };
  },
  methods: {

  },
  mounted: {

  },
  components: {
    BaseTimer
  }
};
</script>

<style>
</style>