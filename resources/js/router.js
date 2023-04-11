import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: () => import('./pages/Register.vue'),
            meta: {}
        },
    ],
});

router.beforeEach(async (to, from, next) => {
    //auth
    return next();
});

export default router;