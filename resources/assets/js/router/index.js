import Vue from 'vue';
import Router from 'vue-router';

import Home from '../components/Home';
import About from '../components/About';
import Register from '../components/Register';

Vue.use(Router);

const createRouter = function () {
  return new Router({
    mode: 'history',
    fallback: false,
    routes: [
      {
        path: '/',
        name: 'home',
        components: {
          default: Home,
        },
      },
      {
        path: '/about',
        name: 'about',
        components: {
          default: About,
        },
        meta: {
          auth: false,
        },
      },
      {
        path: '/register',
        name: 'register',
        components: {
          default: Register,
        },
        meta: {
          auth: false,
        },
      },
      {
        path: '/404',
        name: 'error-404',
        components: {
          default: About,
        },
        meta: {
          auth: false,
        },
      }, {
        path: '/403',
        name: 'error-403',
        components: {
          default: About,
        },
        meta: {
          auth: false,
        },
      }, {
        path: '/502',
        name: 'error-502',
        components: {
          default: About,
        },
        meta: {
          auth: false,
        },
      },
    ],
  });
};

export default createRouter;
