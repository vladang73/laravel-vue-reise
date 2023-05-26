import axios from "axios";

const state = {
  _user: {
    token: userToken,
    name: userName,
    image: null
  }
};

const mutations = {
    setUser(state, data) {
        state._user.token = data.token;
        state._user.name = data.name;
        state._user.image = data.image;
    }
};

const actions = {
    setToken({commit}) {
        axios.get('auth/getToken').then((response) => {
                commit('setUser', response.data)
            }
        );
    }
};

const getters = {
  getUserToken: state => state._user.token,
  getUserName: state => state._user.name,
  getImage: state => state._user.image,
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters
};
