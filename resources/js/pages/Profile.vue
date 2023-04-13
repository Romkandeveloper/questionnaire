<template>
  <default-layout>
    <v-row>
      <v-col cols="12">
        <Header />
      </v-col>
      <v-col cols="12">
        <router-link :to="{name: 'questionnaire.create'}" class="text-black">
          <v-btn
              class="text-none ms-4 text-white"
              color="blue-darken-4"
              rounded="0"
              variant="flat"
          >
            Create
          </v-btn>
        </router-link>
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

