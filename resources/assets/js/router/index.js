import Vue from 'vue';
import Router from 'vue-router';

import Home from '../components/Home';
import Hello from '../components/Hello';
import Login from '../components/Login';
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
        path: '/hello',
        name: 'hello',
        components: {
          default: Hello,
        },
        meta: {
          auth: true,
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
    ],
  });
};

export default createRouter;
