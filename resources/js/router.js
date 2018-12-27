import VueRouter from 'vue-router';
import Vue from 'vue';
import routes from './routes.js'

Vue.use(VueRouter);

export default new VueRouter({
    routes,
})
