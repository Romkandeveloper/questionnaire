<template>
  <router-view v-if="!loading"></router-view>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "App.vue",
  data() {
    return {
      loading: true,
    }
  },
  methods: {
    ...mapActions(['checkLoginStatus']),
  },

  beforeMount() {
    this.checkLoginStatus().then(res => {
      this.loading = false
    });
  },
}
</script>

<style scoped>

</style>