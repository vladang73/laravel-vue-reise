import requester from '@admin/helpers/requester';

const apiHolidayBaseUrl = '/api/admin/holiday-types';
const apiAgencyBaseUrl = '/api/admin/travel-agencies';
const apiProvidersBaseUrl = 'api/admin/handbook/get-providers';
const apiGendersBaseUrl = 'api/admin/handbook/get-genders';
const apiLocationsUrl = 'api/admin/handbook/get-locations';

const state = {
    holidayTypes: [],
    travelAgencies: [],
    providers: [],
    genders: [],
    locations: []
};

// getters
const getters = {
    getHolidayTypes: state => state.holidayTypes,
    getTravelAgencies: state => state.travelAgencies,
    getProviders: state => state.providers,
    getGenders: state => state.genders,
    getLocations: state => state.locations
};

// mutations
const mutations = {
    setHolidayTypesMutation(state, data) {
        state.holidayTypes = data;
    },
    setTravelAgencyMutation(state, data) {
        state.travelAgencies = data;
    },
    setProvidersMutation(state, data) {
        state.providers = data;
    },
    setGendersMutation(state, data) {
        state.genders = data;
    },
    setLocationsMutation(state, data) {
        state.locations = data;
    }
};

// actions
const actions = {
    setHolidayTypes({commit}) {
        return requester.get(apiHolidayBaseUrl)
            .then((response) => {
                    commit('setHolidayTypesMutation', response.data.data)
                }
            )
    },
    setTravelAgencies({commit}) {
        return requester.get(apiAgencyBaseUrl)
            .then((response) => {
                    commit('setTravelAgencyMutation', response.data.data)
                }
            )
    },
    setProviders({commit}) {
        return requester.get(apiProvidersBaseUrl)
            .then((response) => {
                    commit('setProvidersMutation', response.data)
                }
            )
    },
    setGenders({commit}) {
        return requester.get(apiGendersBaseUrl)
            .then((response) => {
                    commit('setGendersMutation', response.data)
                }
            )
    },
    setLocations({commit}) {
        return requester.get(apiLocationsUrl)
            .then((response) => {
                    commit('setLocationsMutation', response.data)
                }
            )
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}