import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

const state = {
    currentUser: null,
    userJiries: null
};
const getters = {};
const mutations = {
    setCurrentUser(state, user){
        state.currentUser = user
    },
    setUserJiries(state, jiries){
        state.userJiries = jiries
    }
};
const actions = {
    setCurrentUser({commit}){
        return new Promise((resolve, reject)=> {
            window.axios.get('/authenticated-user')
                .then(response => {
                    commit('setCurrentUser', response.data)
                    resolve()
                })
        })
    },
    setUserJiries({commit, state}){
            return new Promise((resolve, reject) => {
                window.axios.get('/api/jiri?api_token=' + state.currentUser.api_token)
                    .then(response => {
                        commit('setUserJiries', response.data);
                        resolve();
                    })
                    .catch(error => console.error(error))
            })
    }
};

export default new Vuex.Store({
    state,
    getters,
    mutations,
    actions
})
