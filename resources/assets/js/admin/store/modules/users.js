import requester from '@admin/helpers/requester';

const apiBaseUrl = '/api/admin/users';

// initial state
const state = {
    list: [],
    item: null,
};

// getters
const getters = {
    getList: state => state.list,
    getItem: state => state.item
};

// mutations
const mutations = {
    setListMutation(state, data) {
        state.list = data
    },
    setItemMutation(state, data) {
        state.item = data
    },
};

// actions
const actions = {
    setList({commit}) {
        return requester.get(apiBaseUrl)
            .then((response) => {
                    commit('setListMutation', response.data.data)
                }
            )
    },
    getItem({commit}, payload) {
        return requester.get(apiBaseUrl + payload + '/edit')
            .then((response) => {
                commit('setItemMutation', response.data.data)
            })
    },
    createItem({commit}, payload) {
        if (payload.hasOwnProperty('image')) delete payload['image'];

        return requester.post(apiBaseUrl, payload, {}, true)
    },
    updateItem({commit}, payload) {
        if (payload.hasOwnProperty('image')) delete payload['image'];

        return requester.put(apiBaseUrl + payload.id, payload, {}, true);
    },
    deleteItem({commit}, payload) {
        return requester.delete(apiBaseUrl + payload.id);
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}