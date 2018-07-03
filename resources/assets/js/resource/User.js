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
  update(user) {
    const apiPath = 'users/';
    return axios.put(apiPath + user.id, user).then(res => res.data);
  },
  delete(id) {
    const apiPath = 'users/';
    return axios.delete(apiPath + id).then(res => res.data);
  },
};
