<template>
  <default-layout>
    <v-row>
      <v-col cols="12">
        <Header />
      </v-col>
      <v-col cols="5">
        <create-form></create-form>
      </v-col>
    </v-row>
  </default-layout>
</template>

<script>

import DefaultLayout from "../../layouts/DefaultLayout.vue";
import Header from "../../components/Header.vue";
import CreateForm from "../../components/questionnaire/CreateForm.vue";

export default {
  name: "Create",
  components: {Header, DefaultLayout, CreateForm },

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

