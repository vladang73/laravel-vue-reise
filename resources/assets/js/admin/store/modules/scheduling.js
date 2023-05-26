import requester from '@admin/helpers/requester';

const apiColorsUrl = '/api/admin/handbook/get-colors';
const apiCitiesUrl = '/api/admin/handbook/get-cities';
const apiSchedulingUrl = '/api/admin/scheduling';

const state = {
    colors: [],
    cities: [],
    scheduling: []

};

// getters
const getters = {
    getColors: state => state.colors,
    getCities: state => state.cities,
    getScheduling: state => state.scheduling
};

// mutations
const mutations = {
    setColorsMutation(state, data) {
        state.colors = data;
    },
    setCitiesMutation(state, data) {
        state.cities = data;
    },
    setSchedulingMutation(state, data) {
        state.scheduling = data;
    }
};

// actions
const actions = {
    setColors({commit}) {
        return requester.get(apiColorsUrl)
            .then((response) => {
                commit('setColorsMutation', response.data)
                }
            )
    },
    setCities({commit}) {
        return requester.get(apiCitiesUrl)
            .then((response) => {
                    commit('setCitiesMutation', response.data)
                }
            )
    },

    setScheduling({commit}, payload) {
        if(payload && payload.year && payload.week) {
            return requester.get(apiSchedulingUrl + '?year=' + payload.year + '&week=' + payload.week)
                .then((response) => {
                    commit('setSchedulingMutation', response.data);
                })
        } else {
            return requester.get(apiSchedulingUrl)
                .then((response) => {
                    commit('setSchedulingMutation', response.data);
                })
        }
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}