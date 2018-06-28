import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../components/Home';
import About from '../components/About';
import Login from '../components/Login';
import Register from '../components/Register';

Vue.use(VueRouter);

const createRouter = function () {
  return new VueRouter({
    mode: 'history',
    hashbang: false,
    linkActiveClass: 'active',
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
          auth: true,
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
        path: '/login',
        name: 'login',
        components: {
          default: Login,
        },
        meta: {
          auth: false,
        },
      },
    ],
  });
};

export default createRouter;
