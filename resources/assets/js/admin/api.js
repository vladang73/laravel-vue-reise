import axios from "axios";
import store from "./store";

const urlPrefix = "/api/admin";

export default {
    urls: {
        users: `${urlPrefix}/users`,
        holidayTypes: `${urlPrefix}/holiday-types`,
        travelAgencies: `${urlPrefix}/travel-agencies`,
        booking: `${urlPrefix}/booking`,
        reservation: `${urlPrefix}/reservation`,
        scheduling: `${urlPrefix}/scheduling`,
        upload: {
            avatar: `${urlPrefix}/upload-avatar`
        },
        texts: `${urlPrefix}/texts/update`

    },

    postRequest(url, params) {
        return axios.post(url, { token: store.getters['auth/getUserToken'], ...params });
    },

    getRequest(url) {
        if(url.indexOf('?') === -1) {
            url = url + '?token=' + store.getters['auth/getUserToken'];
        } else {
            url = url + '&token=' + store.getters['auth/getUserToken'];
        }
        console.log(url);
        return axios.get(url);

    },

    putRequest(url, params) {
        return axios.put(url, { token: store.getters['auth/getUserToken'], ...params });
    },

    deleteRequest(url) {
        return axios.delete(url + '?token=' + store.getters['auth/getUserToken']);
    }
}