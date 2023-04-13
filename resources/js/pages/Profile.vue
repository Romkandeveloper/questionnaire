<template>
  <default-layout>
    <v-row>
      <v-col cols="12">
        <Header />
      </v-col>
    </v-row>
  </default-layout>
</template>

<script>

import DefaultLayout from "../layouts/DefaultLayout.vue";
import Header from "../components/Header.vue";

export default {
  name: "Profile",
  components: {Header, DefaultLayout},

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

