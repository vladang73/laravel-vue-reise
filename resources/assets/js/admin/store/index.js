import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

//modules
import users from '@admin/store/modules/users';
import auth from "./modules/auth";
import booking from "./modules/booking";
import scheduling from "./modules/scheduling";
import texts from "./modules/texts";

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        users, auth, booking, scheduling, texts
    },
    plugins: [
        createPersistedState(createPersistedState())
    ]
});