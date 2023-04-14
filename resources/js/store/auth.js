import axios from "axios";

export const auth = {
    state: () => ({
        isAuth: false,
        isCheckAuth: false,
        user: null,
    }),

    mutations: {
        setIsAuth(state, status) {
            state.isAuth = status;
            state.isCheckAuth = true;
        },

        setUser(state, data) {
            state.user = data;
        }
    },

    actions: {
        async register({commit, dispatch}, registerData) {
            try{
                const res = await axios.post('/api/register', registerData);
                commit('setIsAuth', true);
                commit('setUser', res.data.user);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async login({commit, dispatch}, loginData) {
            try{
                const res = await axios.post('/api/login', loginData);
                commit('setIsAuth', true);
                commit('setUser', res.data.user);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async logout({commit, dispatch}) {
            try{
                await axios.post('/api/logout');
                commit('setIsAuth', false);
                commit('setUser', null);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async checkLoginStatus({commit}) {
            try {
                const res = await axios.get('/api/login/status');
                commit('setIsAuth', res.data.status);
                commit('setUser', res.data.user);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },
    },

    getters: {},
};

