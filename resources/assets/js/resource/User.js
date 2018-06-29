import axios from 'axios';

export default {
  get() {
    return axios.get('auth/user').then(res => res.data);
  },
  list() {
    return axios.get('auth/user').then(res => res.data);
  },
};
