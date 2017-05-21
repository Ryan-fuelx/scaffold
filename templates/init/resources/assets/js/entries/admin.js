/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('../bootstrap');
require('../custom');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import Vue from 'vue';
import VueRouter from 'vue-router';
import ElementUI from 'element-ui';
import store from '../commons/store';
Vue.use(VueRouter);
Vue.use(ElementUI);

var routes = [].concat(
  // require('Modules/Dashboard/resources/assets/routes.js').default,
// Modules routes
);

const router = new VueRouter({
  routes, // （缩写）相当于 routes: routes,
  linkActiveClass: 'active'
});

const app = new window.Vue({
  router: router,
  store: store
}).$mount('#app');
