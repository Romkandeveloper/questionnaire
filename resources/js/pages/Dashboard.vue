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
import {mapActions} from "vuex";

export default {
  name: "Dashboard",
  components: {Header, DefaultLayout },

  data() {
    return {

    }
  },

  mounted() {
    this.checkLoginStatus();
  },

  computed: {

  },
  methods: {
      ...mapActions(['checkLoginStatus']),
  },
}
</script>

<style>
</style>

