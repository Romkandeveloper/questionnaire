<template>
  <default-layout>
    <v-row>
      <v-col cols="12">
        <Header />
      </v-col>
      <v-col cols="5">
        <span v-if="loading">Loading...</span>
        <create-form
            v-else
            :item="item"
        >
        </create-form>
      </v-col>
    </v-row>
  </default-layout>
</template>

<script>

import DefaultLayout from "../../layouts/DefaultLayout.vue";
import Header from "../../components/Header.vue";
import CreateForm from "../../components/questionnaire/CreateForm.vue";
import {mapActions, mapState} from "vuex";

export default {
  name: "Create",
  components: {Header, DefaultLayout, CreateForm },

  data() {
    return {
        loading: true,
    }
  },

  mounted() {
    this.getQuestionnaire(this.$route.params.id)
        .catch(e => alert(e.response.data.message))
        .finally(() => this.loading = false);
  },

  computed: {
    ...mapState({
      item: state => state.questionnaire.currentItem,
    }),
  },
  methods: {
    ...mapActions(['getQuestionnaire']),
  },
}
</script>

<style>
</style>

