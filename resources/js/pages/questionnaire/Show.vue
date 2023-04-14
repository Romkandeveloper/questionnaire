<template>
  <default-layout>
    <v-row>
      <v-col cols="12">
        <Header />
      </v-col>
      <v-row class="px-6">
        <v-col cols="12">
          <span v-if="loading">Loading...</span>
          <div v-else>
            <v-card width="400">
              <v-card-item>
                <v-card-title>{{ item.question }}</v-card-title>
                <v-card-subtitle>{{ item.created_at}}</v-card-subtitle>
                <v-card-subtitle>Status : {{ item.is_publish ? 'Published' : 'Not published'}}</v-card-subtitle>
              </v-card-item>
              <v-card-subtitle>Votes:</v-card-subtitle>
              <div v-for="answer in item.answers">
                <v-card-subtitle>{{ answer.value }} : {{ answer.votes }} votes</v-card-subtitle>
              </div>
              <v-card-actions>
                <v-btn-group>
                  <router-link :to="{name: 'questionnaire.edit', params: {id: item.id}}" class="text-black">
                    <v-btn
                        variant="flat"
                        color="warning"
                        class="h-100"
                        :loading="deleting"
                    >
                      Edit
                    </v-btn>
                  </router-link>
                  <v-btn
                      variant="flat"
                      color="error"
                      :loading="deleting"
                      @click.prevent="removeQuestionnaire"
                  >
                    Remove
                  </v-btn>
                </v-btn-group>
              </v-card-actions>
            </v-card>
          </div>
        </v-col>
      </v-row>
    </v-row>
  </default-layout>
</template>

<script>

import DefaultLayout from "../../layouts/DefaultLayout.vue";
import Header from "../../components/Header.vue";
import {mapActions, mapMutations, mapState} from "vuex";
import router from "../../router";

export default {
  name: "Show",
  components: {Header, DefaultLayout  },

  data() {
    return {
      loading: true,
      deleting: false,
    }
  },

  mounted() {
    this.getQuestionnaire(this.$route.params.id)
        .catch(e => alert(e.response.data.message))
        .finally(() => this.loading = false);
  },

  unmounted() {
    this.setCurrentItem(null);
  },

  computed: {
    ...mapState({
      item: state => state.questionnaire.currentItem,
    }),
  },
  methods: {
    ...mapMutations(['setCurrentItem']),
    ...mapActions(['getQuestionnaire', 'deleteQuestionnaire']),

    removeQuestionnaire() {
      this.loading = true;
      this.deleteQuestionnaire(this.item.id).then(res => {
        router.push({name: 'user.profile'});
      }).catch(e => {
        alert(e.response.data.message);
      }).finally(() => {
        this.loading = false;
      });
    }
  },
}
</script>

<style>
</style>

