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
      <v-col cols="6">
        <v-data-table
            v-model:sort-by="sortBy"
            :headers="headers"
            :items="items"
            class="elevation-1"
        >
          <template v-slot:item.question="{ item }">
            <router-link :to="{name: 'questionnaire.create'}" class="text-black">
              {{ item }}
            </router-link>
          </template>
          <template v-slot:item.is_publish="{ item }">
            <router-link :to="{name: 'questionnaire.create'}" class="text-black">
              {{ item }}
            </router-link>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
  </default-layout>
</template>

<script>

import DefaultLayout from "../layouts/DefaultLayout.vue";
import Header from "../components/Header.vue";
import {mapActions, mapState} from "vuex";

export default {
  name: "Profile",
  components: {Header, DefaultLayout},

  data() {
    return {
      sortBy: [{ key: 'question', order: 'asc' }],
      headers: [
        { title: 'Question', align: 'start', key: 'question' },
        { title: 'Created', key: 'created_at' },
        { title: 'Publish', key: 'is_publish' },
      ],
    }
  },

  mounted() {
    this.getOwnQuestionnaires();
  },

  computed: {
    ...mapState({
      items: state => state.questionnaire.customItems,
    }),

  },
  methods: {
      ...mapActions(['getOwnQuestionnaires']),
  },
}
</script>

<style>
</style>

