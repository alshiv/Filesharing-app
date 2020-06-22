<template>
  <div class="progress">
      <div class="progress-bar progress-bar-info" role="progressbar" :style="{ width: getProgress }">
          {{ getProgress }}
      </div>
  </div>
</template>

<script>
export default {
    props: {
        progress: {
            type: Number,
            default: 0
        }
    },
    computed: {
        getProgress() {
            return Math.round(this.progress) + '%'
        }
    }
}
</script>

<style>

</style>