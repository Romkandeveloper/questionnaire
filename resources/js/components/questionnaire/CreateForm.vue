<template>
  <v-form v-model="valid">
    <v-card-text class="pb-0">
      <v-text-field
          name="question"
          label="question"
          type="text"
          v-model="fields.question"
          :rules="[...rules.defaultRules]"
      ></v-text-field>
      <div v-for="(input, index) in fields.answers">
        <div class="d-flex">
          <v-text-field
              label="answer"
              class="flex-grow-1"
              type="text"
              v-model="input.value"
              :rules="[...rules.defaultRules]"
          ></v-text-field>
          <v-text-field
              label="votes"
              type="number"
              class="flex-shrink-1"
              v-model="input.votes"
              :rules="[...rules.numberRules]"
          ></v-text-field>
          <v-btn-group>
            <v-btn
                variant="flat"
                color="primary"
                @click.prevent="addField(fields.answers)"
            >
              Add
            </v-btn>
            <v-btn
                variant="flat"
                color="error"
                @click.prevent="removeField(fields.answers, index)"
            >
              Remove
            </v-btn>
          </v-btn-group>
        </div>
      </div>
    </v-card-text>
    <v-card-actions class="mt-2 mx-2 d-flex flex-column">
      <v-btn
          class="w-100 mb-2"
          size="large"
          color="warning"
          variant="flat"
          :disabled="!valid"
          :loading="loading"
          @click.prevent="store(false)"
      >
        Save
      </v-btn>
      <v-btn
          class="w-100"
          size="large"
          color="success"
          variant="flat"
          :disabled="!valid"
          :loading="loading"
          @click.prevent="store(true)"
      >
        Publish
      </v-btn>
    </v-card-actions>
  </v-form>
</template>

<script>
import {mapActions} from "vuex";
import router from "../../router";

export default {
  name: "QuestionnaireCreateForm",

  data() {
    return {
      fields: {
        question: '',
        isPublish: true,
        answers: [{value: '', votes: ''}],
      },
      rules: {
        defaultRules: [v => !!v || 'Row is required'],
        numberRules: [v  => v >= 0 || 'Enter greater or equal 0 value'],
      },
      valid: true,
      loading: false,
      errors: [],
    }
  },

  computed: {

  },

  methods: {
    ...mapActions(['storeQuestionnaire']),

    addField() {
      this.fields.answers.push({value: '', votes: ''});
    },
    removeField(index) {
      if (this.fields.answers.length > 1) {
        this.fields.answers.splice(index, 1);
      }
    },

    store(isPublish) {
      this.loading = true;
      this.storeQuestionnaire({
        question: this.fields.question,
        answers: this.fields.answers,
        isPublish: isPublish
      }).then(res => {
        router.push({name: 'user.profile'});
      }).catch(e => {
        alert(e.response.data.message);
        this.valid = false;
      }).finally(() => {
        this.loading = false;
      });
    }
  },
}
</script>

<style>
</style>

