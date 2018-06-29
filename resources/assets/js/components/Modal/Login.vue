<template>
    <!-- The Modal -->
    <div class="modal fade" id="loginModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form autocomplete="off" @submit.prevent="login" method="post">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Login to Your Account</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="msg-login-error" class="alert alert-danger" v-if="error">
                            <strong>Login error ! Please try again !</strong>
                        </div>

                        <div class="form-group">
                            <label for="email"><b>Email</b></label>
                            <input type="text" placeholder="Enter Username" name="email" v-model="email" required>
                        </div>

                        <div class="form-group">
                            <label for="password"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="password" v-model="password"
                                   required>
                        </div>

                        <div class="form-group">
                            <button type="submit">Login</button>
                            <label>
                                <input type="checkbox" name="remember" v-model="$auth.rememberMe"> Remember me
                            </label>
                        </div>
                    </div>
                </form>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <router-link :to="{ name: 'register' }" data-dismiss="modal">Register</router-link>
                    - <a href="#">Forgot Password</a>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
  import userService from '../../services/User';

  export default {
    data() {
      return {
        email: null,
        password: null,
        error: false,
        user: null,
        context: 'account context',
      };
    },
    methods: {
      login() {
        const app = this;

        this.$auth.login({
          params: {
            email: app.email,
            password: app.password,
          },
          async success() {
            // Hide login-modal after login
            $('#loginModal').modal('hide');

            // Get and set user to auth
            const user = await userService.get();
            app.$auth.user(user);
          },
          error() {
            // Set error status
            app.error = true;
          },
          rememberMe: false,
          redirect: '/',
          fetchUser: true,
        });
      },
      getUser() {

      },
    },
  };
</script>
