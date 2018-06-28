import userResource from '../resource/User';

export default {
  loadList() {
    return userResource.list();
  },
};
