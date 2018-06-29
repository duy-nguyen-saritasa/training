import Vue from 'vue';
import VueRouter from 'vue-router';

import Home from '../components/Home';
import About from '../components/About';
import Login from '../components/Login';
import UserList from '../components/User/List';

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
        meta: {
          auth: true,
        },
      },
      {
        path: '/user',
        name: 'user-list',
        components: {
          default: UserList,
        },
        meta: {
          auth: true,
        },
      },
      {
        path: '/about',
        name: 'about',
        components: {
          default: About,
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
