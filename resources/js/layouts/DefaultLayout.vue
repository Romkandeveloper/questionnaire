<template>
  <v-layout style="min-height: 100vh" class="background-gray">
        <slot></slot>
  </v-layout>
</template>

<script>
export default {
  name: "DefaultLayout"
}
</script>

<style scoped>
.background-gray {
  background-color: #e5e4e4;
}
</style>