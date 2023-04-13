<template>
  <router-view></router-view>
</template>

<script>
export default {
  name: "App.vue",

  beforeCreate() {
    this.$store.dispatch('checkLoginStatus');
  },
}
</script>

<style scoped>

</style>