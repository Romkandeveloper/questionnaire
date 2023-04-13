import axios from "axios";
import {ca} from "vuetify/locale";

export const auth = {
    state: () => ({
        isAuth: false,
    }),

    mutations: {
        setIsAuth(state, status) {
            state.isAuth = status;
        }
    },

    actions: {
        async register({commit, dispatch}, registerData) {
            try{
                const res = await axios.post('/api/register', registerData);
                commit('setIsAuth', true);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async login({commit, dispatch}, loginData) {
            try{
                const res = await axios.post('/api/login', loginData);
                commit('setIsAuth', true);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async logout({commit, dispatch}) {
            try{
                const res = await axios.post('/api/logout');
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
        }

    },

    getters: {},
};
