import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            redirect: '/dashboard',
            meta: {}
        },
        {
            name: 'user.register',
            path: '/register',
            component: () => import('./pages/Register.vue'),
            meta: {}
        },
        {
            name: 'user.login',
            path: '/login',
            component: () => import('./pages/Login.vue'),
            meta: {}
        },
        {
            name: 'dashboard',
            path: '/dashboard',
            component: () => import('./pages/Dashboard.vue'),
            meta: {}
        },
    ],
});

router.beforeEach(async (to, from, next) => {
    //auth
    return next();
});

export default router;