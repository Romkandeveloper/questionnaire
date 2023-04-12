import axios from "axios";

export const auth = {
    state: () => ({

    }),

    mutations: {

    },

    actions: {
        async register({commit, dispatch}, registerData) {
            try{
                const res = await axios.post('/api/register', registerData);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async login({commit, dispatch}, loginData) {
            try{
                const res = await axios.post('/api/login', loginData);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },
    },

    getters: {},
};
