import axios from "axios";

export const questionnaire = {
    state: () => ({
        //items: [],
        customItems: [],
        currentItem: null,
    }),

    mutations: {
        setCustomItems(state, items) {
            state.customItems = items;
        },
        addCustomItem(state, item) {
            state.customItems.unshift(item);
        },
        setCurrentItem(state, item) {
            state.currentItem = item;
        }
        // setItems(state, items) {
        //     state.items = items;
        // }
    },

    actions: {
        async storeQuestionnaire({commit, dispatch}, data) {
            try{
                await axios.post('/api/questionnaire', data);
                commit('addCustomItem', data)
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async getOwnQuestionnaires({commit, dispatch}) {
            try{
                const res = await axios.get('/api/questionnaire/custom');
                commit('setCustomItems', res.data.items)
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async getQuestionnaire({commit, dispatch}, id) {
            try{
                const res = await axios.get(`/api/questionnaire?id=${id}`);
                commit('setCurrentItem', res.data.item)
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },

        async deleteQuestionnaire({commit, dispatch}, id) {
            try{
                const res = await axios.delete(`/api/questionnaire?id=${id}`);
                commit('setCurrentItem', null);
            } catch (e) {
                throw e;
            }

            return Promise.resolve();
        },


        // async getAllQuestionnaires({commit, dispatch}) {
        //     try{
        //         const res = await axios.get('/api/questionnaire');
        //         commit('setItems', res.data.items)
        //     } catch (e) {
        //         throw e;
        //     }
        //
        //     return Promise.resolve();
        // },
    },

    getters: {},
};

