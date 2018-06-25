import Vue from 'vue';
import Router from 'vue-router';

import Home from '../components/Home';

Vue.use(Router);

const createRouter = function () {
  return new Router({
    mode: 'history',
    fallback: false,
    routes: [
      {
        path: '/',
        name: 'Home',
        components: {
          default: Home,
        },
        meta: {
          hasSidebar: true,
        },
      },
    ],
  });
};

export default createRouter;
