import axios from "axios";

export const questionnaire = {
    state: () => ({

    }),

    mutations: {

    },

    actions: {
        async storeQuestionnaire({}, data) {
            try{
                await axios.post('/api/questionnaire', data);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },
    },

    getters: {},
};

