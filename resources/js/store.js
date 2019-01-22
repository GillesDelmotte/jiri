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
    dashboard: null,
    dashboardUser: null,
    currentJiri: null,
    modifyJiri: null,
    modifyJudges: null,
    modifyStudents: null,
    modifyProjects: null,
    test: []
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
    },
    setDashboard(state, data){
        state.dashboard = data
    },
    setDashboardUser(state, data){
        state.dashboardUser = data
    },
    setCurrentJiri(state, data){
        state.currentJiri = data
    },
    setModifyJiri(state, data){
        state.modifyJiri = data
    },
    setModifyJudges(state, data){
        state.modifyJudges = data
    },
    setModifyStudents(state, data){
        state.modifyStudents = data
    },
    setModifyProjects(state, data){
        state.modifyProjects = data
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
    },
    setDashboard({commit, state}){
        return new Promise((resolve, reject) => {
            window.axios.get('/dashboard')
                .then(response => {
                    commit('setDashboard', response.data);
                    resolve();
                })
                .catch(error => console.error(error))

            Echo.channel('adminScore')
                .listen('.score.created', (e) => {
                    this.state.test.push(e)
                    console.log({e})
                })



        })
    },
    setUserForCurrentJiri({commit, state}){
        return new Promise((resolve, reject) => {
            window.axios.get('/dashboardUser')
                .then(response => {
                    commit('setDashboardUser', response.data)
                    resolve();
                })
                .catch(error => console.error(error))
        })
    },
    setCurrentJiri({commit, state}){
        return new Promise((resolve, reject) => {
            window.axios.get('/dashboardJiri')
                .then(response => {
                    commit('setCurrentJiri', response.data)
                    resolve();
                })
                .catch(error => console.error(error))
        })
    },
    setModifyJiri({commit, state}, data){
        return new Promise((resolve, reject) => {
            window.axios.post('/setModifyJiri', {id: data})
                .then(response => {
                    commit('setModifyJiri', response.data)
                    resolve();
                })
                .catch(error => console.error(error))
        })
    },
    setModifyJudges({commit, state}, data){
        return new Promise((resolve, reject) => {
            window.axios.post('/setModifyJudges', {id: data})
                .then(response =>{
                    commit('setModifyJudges', response.data);
                    resolve();
                })
                .catch(error => console.error(error))
        })
    },
    setModifyStudents({commit, state}, data){
        return new Promise((resolve, reject) =>{
            window.axios.post('/setModifyStudents', {id: data})
                .then(response =>{
                    commit('setModifyStudents', response.data);
                    resolve();
                })
                .catch(error => console.error(error))
        })
    },
    setModifyProjects({commit, state}, data){
        return new Promise((resolve, reject) =>{
            window.axios.post('setModifyProjects', {id: data})
                .then(response => {
                    commit('setModifyProjects', response.data)
                    resolve()
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
