<template>
  <auth-layout>
    <v-card class="elevation-12 px-10 rounded-xl">
      <v-row class="pt-10 pb-5">
        <v-col cols="12" class="d-flex justify-center py-0">
          <h1 class="text-lg-h4 font-weight-bold">Register</h1>
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
          <v-text-field
              id="confirmPassword"
              prepend-inner-icon="mdi-lock-check"
              name="confirmPassword"
              label="Confirm password"
              type="password"
              v-model="fields.confirmPassword"
              :rules="[
                  ...rules.defaultRules,
                  ...rules.passwordRules,
                  ...rules.confirmPasswordRules
              ]"
          ></v-text-field>
        </v-card-text>
        <v-card-actions class="mt-2 mx-2">
          <v-btn
              class="w-100"
              size="large"
              color="success"
              variant="flat"
              :disabled="!valid || !isSamePasswords"
              :loading="loading"
              @click.p.prevent="submit"
          >
            Create account
          </v-btn>
        </v-card-actions>
        <v-row class="py-10">
          <v-col col="12" class="d-flex justify-center">
            <div>Have already an account?
              <router-link :to="{name: 'user.login'}" class="text-black">
                <span class="font-weight-bold ">Login here</span>
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
  name: "RegisterPage",
  components: { AuthLayout },

  data() {
    return {
      fields: {
        email: null,
        password: null,
        confirmPassword: null,
      },
      rules: {
        defaultRules: [v => !!v || 'Row is required'],
        emailRules: [
          v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
        ],
        passwordRules: [
          v => (v && v.length >= 8) || 'Password must have 8 or more symbols',
        ],
        confirmPasswordRules: [
          v => (v && v == this.fields.password) || 'Passwords aren`t same',
        ],
      },
      valid: false,
      loading: false,
      errors: [],
    }
  },
  computed: {
    isSamePasswords() {
      return this.fields.password === this.fields.confirmPassword;
    }
  },
  methods: {
    ...mapActions(['register']),

    submit() {
      this.loading = true;
      this.register({
        email: this.fields.email,
        password: this.fields.password,
        password_confirmation: this.fields.confirmPassword,
      }).then(res => {
        router.push({name: 'dashboard'});
      }).catch(e => {
        alert('Error');
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

