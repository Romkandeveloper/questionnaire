<template>
  <v-layout>
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