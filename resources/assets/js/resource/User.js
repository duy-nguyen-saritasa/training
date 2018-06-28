import axios from 'axios';

export default {
  list() {
    // I will using store to handle non-asynchronous
    return axios.get('auth/user').then(res => res.data);
  },
};
