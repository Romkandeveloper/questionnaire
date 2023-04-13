<template>
  <v-form v-model="valid">
    <v-card-text class="pb-0">
      <v-text-field
          name="title"
          label="title"
          type="text"
          v-model="fields.title"
          :rules="[...rules.defaultRules]"
      ></v-text-field>
      <div v-for="(input, index) in fields.answers">
        <v-text-field
            label="answer"
            type="text"
            v-model="input.value"
            :rules="[...rules.defaultRules]"
        ></v-text-field>
        <v-text-field
            label="votes"
            type="number"
            v-model="input.votes"
            :rules="[...rules.defaultRules]"
        ></v-text-field>
        <v-btn-group>
          <v-btn
              variant="flat"
              @click.prevent="addField(fields.answers)"
          >
            Add
          </v-btn>
          <v-btn
              variant="flat"
              @click.prevent="removeField(fields.answers, index)"
          >
            Remove
          </v-btn>
        </v-btn-group>
      </div>
    </v-card-text>
    <v-card-actions class="mt-2 mx-2">
      <v-btn
          class="w-100"
          size="large"
          color="success"
          variant="flat"
          :disabled="!valid"
          :loading="loading"
          @click.prevent="() => console.log('Hi')"
      >
        Create
      </v-btn>
    </v-card-actions>
  </v-form>
</template>

<script>


export default {
  name: "QuestionnaireCreateForm",

  data() {
    return {
      fields: {
        question: null,
        answers: [{value: 'Yes', votes: 12}, {value: 'No', votes: 0}],
      },
      rules: {
        defaultRules: [v => !!v || 'Row is required'],
      },
      valid: false,
      loading: false,
      errors: [],
    }
  },

  computed: {

  },

  methods: {
    addField() {
      this.fields.answers.push({value: '', votes: 0});
    },
    removeField(index) {
      if (this.fields.answers.length > 1) {
        this.fields.answers.splice(index, 1);
      }
    }
  },
}
</script>

<style>
</style>

