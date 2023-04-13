<template>
  <default-layout>
    <v-row>
      <v-col cols="12">
        <Header />
        <div class="py-16 text-h1 text-center font-weight-bold">404</div>
      </v-col>
    </v-row>
  </default-layout>
</template>

<script>

import DefaultLayout from "../layouts/DefaultLayout.vue";
import Header from "../components/Header.vue";

export default {
  name: "Dashboard",
  components: {Header, DefaultLayout },

  data() {
    return {

    }
  },

  computed: {

  },
  methods: {

  },
}
</script>

<style>
</style>

