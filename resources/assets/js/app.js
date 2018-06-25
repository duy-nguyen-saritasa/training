import Vue from 'vue';

import createRouter from './router';

const router = createRouter();

// eslint-disable-next-line no-new
new Vue({
  el: '#app',
  router,
});
