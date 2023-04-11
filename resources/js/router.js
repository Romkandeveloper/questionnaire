import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'user.register',
            path: '/',
            component: () => import('./pages/Register.vue'),
            meta: {}
        },
        {
            name: 'user.login',
            path: '/login',
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