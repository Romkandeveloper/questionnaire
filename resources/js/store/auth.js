import axios from "axios";

export const auth = {
    state: () => ({
        isAuth: false,
        isCheckAuth: false,
    }),

    mutations: {
        setIsAuth(state, status) {
            state.isAuth = status;
            state.isCheckAuth = true;
        }
    },

    actions: {
        async register({commit, dispatch}, registerData) {
            try{
                await axios.post('/api/register', registerData);
                commit('setIsAuth', true);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async login({commit, dispatch}, loginData) {
            try{
                await axios.post('/api/login', loginData);
                commit('setIsAuth', true);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async logout({commit, dispatch}) {
            try{
                await axios.post('/api/logout');
                commit('setIsAuth', false);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async checkLoginStatus({commit}) {
            try {
                const res = await axios.get('/api/login/status');
                commit('setIsAuth', res.data.status);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },
    },

    getters: {},
};

