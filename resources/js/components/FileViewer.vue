<template>
  <div class="col-md-4">
    <div class="thumbnail">
      <img src="http://via.placeholder.com/140x100" alt />
      <div class="caption">
        <h3>File Title</h3>
      </div>
    </div>
    <base-timer :time-passed="timePassed"></base-timer>
  </div>
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