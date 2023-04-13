<template>
  <section class="header">
    <div class="header__wrapper">
      <router-link :to='{name: "dashboard"}' class="text-decoration-none">
        <h1 class="text-h6 font-weight-bold text-uppercase">Questionnaire</h1>
      </router-link>
      <div v-if="!login" class="d-flex">
        <router-link :to='{name: "user.login"}' class="text-decoration-none">
          <v-btn
              variant="plain"
              size="small"
              class="mr-2"
              rounded="pill"
              color="#000"
          >
            Sign in
          </v-btn>
        </router-link>
        <router-link :to='{name: "user.register"}' class="text-decoration-none">
          <v-btn
              variant="flat"
              size="small"
              class="btn-black"
              rounded="pill"
          >
            Sign up
          </v-btn>
        </router-link>
      </div>
      <v-btn
          v-else
          rounded="pill"
          variant="flat"
          size="small"
          class="btn-black"
          :loading="loading"
          @click.p.prevent="submit"
      >
        Logout
      </v-btn>
    </div>
  </section>
</template>

<script>
import {mapActions, mapState} from "vuex";

export default {
  name: "Header",

  computed: {
    ...mapState({
      login: state => state.auth.isAuth,
    }),
  },

  data() {
    return {
      loading: false,
    }
  },

  methods: {
    ...mapActions(['logout']),

    submit() {
      this.loading = true;
      this.logout()
          .finally(() => {
            this.loading = false;
          });
    }
  },
}
</script>

<style scoped>
.header {
  padding: 10px;
  border-bottom: 1px solid #000;
}
.header__wrapper {
  display: flex;
  justify-content: space-between;
}

.btn-black {
  background-color: #000;
  color: #fff;
}

.header__link {
  transition: .3s ease-in-out;
}
.header__link:hover {
  transform: scale(1.2);
}
</style>
