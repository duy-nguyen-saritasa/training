import userResource from '../resource/User';

export default {
  get() {
    return userResource.get();
  },
  loadList() {
    return userResource.list();
  },
};
