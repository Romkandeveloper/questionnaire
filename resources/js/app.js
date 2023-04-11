import { createApp } from 'vue';
import { createVuetify } from 'vuetify';

import App from './App.vue';
import router from './router';

// Vuetify
import 'vuetify/styles'
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';

//Vuex
import store from './store';

const vuetify = createVuetify({
    components,
    directives,
})

const app = createApp(App)
    .use(vuetify)
    .use(router)
    .use(store)
    .mount('#app')
