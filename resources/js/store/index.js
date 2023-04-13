import Vuex from 'vuex';
import {auth} from './auth';
import {questionnaire} from "./questionnaire";

export default new Vuex.Store({
    modules: {
        auth,
        questionnaire
    }
});