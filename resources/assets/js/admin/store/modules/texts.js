import requester from '@admin/helpers/requester';
const apiTextsUrl = 'api/admin/texts';

const state = {
    texts: []
};

const mutations = {
    setTextsMutation(state, data) {
        state.texts = data;
    },
};

const actions = {
    setTexts({commit}, data) {
        return requester.get(apiTextsUrl + "?provider_id=" + data)
            .then((response) => {
                    commit('setTextsMutation', response.data.data)
                }
            )
    },
};

const getters = {
    getTexts: state => state.texts,
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
