import axios from "axios";

export const auth = {
    state: () => ({
        isAuth: document.cookie.includes("PHPSESSID"),
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
    },

    getters: {},
};
