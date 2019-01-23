
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');
 import Vue from 'vue'
 import App from './App.vue'

Vue.config.productionTip = false

import VueFire from 'vuefire';
Vue.use(VueFire);



const app = new Vue({
    el: '#app',

    components: { App },

    template : '<App/>'
});
