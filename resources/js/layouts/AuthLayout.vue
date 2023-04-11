<template>
  <v-layout style="min-height: 100vh" class="background-blue">
    <v-row justify="center" align="center" class="ma-0">
      <v-col cols="4">
        <slot></slot>
      </v-col>
    </v-row>
  </v-layout>
</template>

<script>
export default {
  name: "AuthLayout"
}
</script>

<style scoped>
.background-blue {
  background-color: #74EBD5;
  background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);
}
.v-alert-title {
  font-size: 16px;
}
.title-decoration {
  display: block;
  height: 6px;
  width: 50px;
  background-color: #4caf4f;
}
</style>