import axios from 'axios';

export default {
  get() {
    return axios.get('auth/user').then(res => res.data);
  },
  list() {
    return axios.get('users').then(res => res.data.results);
  },
  create(user) {
    return axios.post('users', user).then(res => res.data);
  },
};
