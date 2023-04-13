<template>
  <auth-layout>
    <v-card class="elevation-12 px-10 rounded-xl">
      <v-row class="pt-10 pb-5">
        <v-col cols="12" class="d-flex justify-center py-0">
          <h1 class="text-lg-h4 font-weight-bold">Login</h1>
        </v-col>
        <v-col cols="12" class="d-flex justify-center py-0 my-2">
          <div class="title-decoration"></div>
        </v-col>
      </v-row>
      <v-form v-model="valid">
        <v-card-text class="pb-0">
          <v-text-field
              prepend-inner-icon="mdi-email"
              name="userEmail"
              label="Email"
              type="email"
              v-model="fields.email"
              :rules="[...rules.defaultRules, ...rules.emailRules]"
          ></v-text-field>
          <v-text-field
              id="password"
              prepend-inner-icon="mdi-lock"
              name="password"
              label="Password"
              type="password"
              v-model="fields.password"
              :rules="[...rules.defaultRules, ...rules.passwordRules]"
          ></v-text-field>
        </v-card-text>
        <v-card-actions class="mt-2 mx-2">
          <v-btn
              class="w-100"
              size="large"
              color="success"
              variant="flat"
              :disabled="!valid"
              :loading="loading"
              @click.p.prevent="submit"
          >
            Login
          </v-btn>
        </v-card-actions>
        <v-row class="py-10">
          <v-col col="12" class="d-flex justify-center">
            <div>Dont have an account?
              <router-link :to="{name: 'user.register'}" class="text-black">
                <span class="font-weight-bold ">Register here</span>
              </router-link>
            </div>
          </v-col>
        </v-row>
      </v-form>
    </v-card>
  </auth-layout>
</template>

<script>

import AuthLayout from "../layouts/AuthLayout.vue";
import { mapActions } from 'vuex';
import router from "../router";

export default {
  name: "LoginPage",
  components: { AuthLayout },

  data() {
    return {
      fields: {
        email: null,
        password: null,
      },
      rules: {
        defaultRules: [v => !!v || 'Row is required'],
        emailRules: [
          v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
        passwordRules: [
          v => (v && v.length >= 8) || 'Password must have 8 or more symbols',
        ],
      },
      valid: false,
      loading: false,
      errors: [],
    }
  },
  computed: {

  },
  methods: {
    ...mapActions(['login']),

    submit() {
      this.loading = true;
      this.login({
        email: this.fields.email,
        password: this.fields.password,
      }).then(res => {
        router.push({name: 'dashboard'});
      }).catch(e => {
        alert(e.response.data.message);
        this.valid = false;
      }).finally(() => {
        this.loading = false;
      });
    },
  },
}
</script>

<style>
</style>

