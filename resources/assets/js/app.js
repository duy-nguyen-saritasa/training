import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';

import App from './App';
import createRouter from './router';

const router = createRouter();

Vue.use(VueAxios, axios);
axios.defaults.baseURL = '/api';

Vue.router = router;

/* eslint-disable global-require */
Vue.use(require('@websanova/vue-auth'), {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
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
