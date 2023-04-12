import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            redirect: '/dashboard',
            meta: {
                auth: {
                    login: false,
                    only: false,
                },
            }
        },
        {
            name: 'user.register',
            path: '/register',
            component: () => import('./pages/Register.vue'),
            meta: {
                auth: {
                    login: false,
                    only: true,
                },
            }
        },
        {
            name: 'user.login',
            path: '/login',
            component: () => import('./pages/Login.vue'),
            meta: {
                auth: {
                    login: false,
                    only: true,
                },
            }
        },
        {
            name: 'dashboard',
            path: '/dashboard',
            component: () => import('./pages/Dashboard.vue'),
            meta: {
                auth: {
                    login: false,
                    only: false,
                },
            }
        },
    ],
});

router.beforeEach(async (to, from, next) => {
    const isAuth = document.cookie.includes("PHPSESSID");
    const login = to.meta.auth && to.meta.auth.login;
    const only = to.meta.auth && to.meta.auth.only;

    if (login) {
        if (isAuth) return next();
        return next({name: 'user.login'});
    } else {
        if (only) {
            if (isAuth) return next(from.fullPath);
            return next();
        } else return next();
    }
});

export default router;