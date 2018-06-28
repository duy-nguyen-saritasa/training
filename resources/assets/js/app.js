import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
import VueAuth from '@websanova/vue-auth';

import App from './App';
import AuthDriver from './driver/Auth';
import createRouter from './router';

Vue.use(VueAxios, axios);

Vue.router = createRouter();
axios.defaults.baseURL = '/api';

/* eslint-disable global-require */
Vue.use(VueAuth, {
  auth: AuthDriver,
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
  refreshData: {
    url: 'auth/refresh', method: 'PUT', enabled: true, interval: 30,
  },
});
/* eslint-enable global-require */

App.router = Vue.router;

new Vue(App).$mount('#app');

// eslint-disable-next-line no-new
// new Vue({
//   el: '#app',
//   router,
//   components: {App},
//   render: app => app(App),
// });
