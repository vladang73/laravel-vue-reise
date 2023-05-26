import axios from 'axios'
import store from "../store";

let getHeaders = (headers) => {
    let basicHeader = {'Content-type': 'application/json'};
    return Object.assign(basicHeader, headers)
};

//for files
let getFormData = (data) => {
    let formData = new FormData();

    for (let index in data) {
        if (data.hasOwnProperty(index)) {
            let attr = data[index];
            formData.append(index, attr)
        }
    }

    return formData;
};

const requester = {
    post(url, data, headers = {}, formDataConvert = false) {
        return new Promise(function (resolve, reject) {
            axios.post(url, formDataConvert ? getFormData(data) : data,
                {
                    headers: getHeaders(headers)
                }
            ).then(response => {
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },

    get(url, data = {}, headers = {}, auth = true) {
        data.token = userToken;
        return new Promise(function (resolve, reject) {
            axios.get(url,
                {
                    params: data,
                    headers: getHeaders(headers, auth)
                }
            ).then(response => {
                resolve(response);
            }).catch(error => {
                reject(error);
            })
        });
    },

    put(url, data, headers = {}, formDataConvert = false, auth = true) {
        data['_method'] = 'PATCH';

        return new Promise(function (resolve, reject) {
            axios.put(url, formDataConvert ? getFormData(data) : data,
                {
                    headers: getHeaders(headers, auth)
                }
            ).then(response => {
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },

    delete(url, data = {}, headers = {}, auth = true) {
        return new Promise(function (resolve, reject) {
            axios.delete(url,
                {
                    headers: getHeaders(headers, auth)
                }
            ).then(response => {
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },
};

export default requester;