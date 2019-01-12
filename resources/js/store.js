import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

const state = {
    currentUser: null,
    userJiries: null,
    allUsers: null,
    allStud: null,
    allProjects: null,
    allStudentsForProjects: null,
};

const getters = {};

const mutations = {
    setCurrentUser(state, user) {
        state.currentUser = user
    },
    setUserJiries(state, jiries) {
        state.userJiries = jiries
    },
    setAllUsers(state, users) {
        state.allUsers = users
    },
    setAllStud(state, students) {
        state.allStud = students
    },
    setAllProjects(state, projects) {
        state.allProjects = projects
    },
    setAllStudentsForProjects(state, students) {
        state.allStudentsForProjects = students
    }
};

const actions = {
    setCurrentUser({commit}) {
        return new Promise((resolve, reject) => {
            window.axios.get('/authenticated-user')
                .then(response => {
                    commit('setCurrentUser', response.data)
                    resolve()
                })
        })
    },
    setUserJiries({commit, state}) {
        return new Promise((resolve, reject) => {
            window.axios.get('/api/jiri?api_token=' + state.currentUser.api_token)
                .then(response => {
                    commit('setUserJiries', response.data);
                    resolve();
                })
                .catch(error => console.error(error))
        })
    },
    setAllUsers({commit, state}) {
        return new Promise((resolve, reject) => {
            window.axios.get('/api/user?api_token=' + state.currentUser.api_token)
                .then(response => {
                    commit('setAllUsers', response.data);
                    resolve();
                })
                .catch(error => console.error(error))
        })
    },
    setAllStud({commit, state}) {
        return new Promise((resolve, reject) => {
            window.axios.get('/api/student?api_token=' + state.currentUser.api_token)
                .then(response => {
                    commit('setAllStud', response.data);
                    resolve();
                })
                .catch(error => console.error(error))
        })
    },
    setAllProjects({commit, state}) {
        return new Promise((resolve, reject) => {
            window.axios.get('/api/project?api_token=' + state.currentUser.api_token)
                .then(response => {
                    commit('setAllProjects', response.data);
                    resolve();
                })
                .catch(error => console.error(error))
        })
    },
    setAllStudentsForProjects({commit, state}) {
        return new Promise((resolve, reject) => {
            window.axios.get('/api/studentsForProjects?api_token=' + state.currentUser.api_token)
                .then(response => {
                    commit('setAllStudentsForProjects', response.data);
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
