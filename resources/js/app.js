/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Vuex from 'vuex'

Vue.use(Vuex)
window.Vue = require('vue').default;

import {router} from "./router";
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';
import Vue from 'vue'
import store from './store/index'
import VueRouter from 'vue-router'

Vue.use(require('vue-cookies'))
Window.store = store

Vue.use(VueRouter)


import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.use(BootstrapVue)

Vue.use(IconsPlugin)
Vue.use(VueRouter);


router.beforeEach((to, from, next) => {

    if (!to.meta.middleware) {
        return next()
    }
    const middlweare = to.meta.middleware

    const context = {
        to,
        from,
        next,
    }
    return middlweare[0]({
        ...context
    })
})



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store

});
