export default {
  request(req, token) {
    const authVar = 'Bearer ';

    // eslint-disable-next-line
    this.options.http._setHeaders.call(this, req, {
      Authorization: authVar + token,
    });
  },
  response(res) {
    return res.data.token;
  },
};
