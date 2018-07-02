<template>
    <!-- The Modal -->
    <div class="modal fade" id="registerModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form autocomplete="off" @submit.prevent="register" method="post">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Register User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="msg-login-error" class="alert alert-danger" v-if="errors">
                            <ul>
                                <li v-for="error in errors">{{ error.messages[0] }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="first_name"><b>First name</b></label>
                            <input type="text" placeholder="First name" name="first_name" v-model="body.user.first_name"
                                   >
                        </div>

                        <div class="form-group">
                            <label for="last_name"><b>Last name</b></label>
                            <input type="text" placeholder="First name" name="last_name" v-model="body.user.last_name"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="email"><b>Email</b></label>
                            <input type="text" placeholder="Last name" name="email" v-model="body.user.email"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="password"><b>Password</b></label>
                            <input type="password" placeholder="Enter Password" name="password"
                                   v-model="body.user.password" required>
                        </div>

                        <div class="form-group">
                            <button type="submit">Register</button>
                        </div>
                    </div>
                </form>

                <!-- Modal footer -->
                <div class="modal-footer">

                </div>

            </div>
        </div>
    </div>
</template>

<script>
  // import userListComponent from '../User/List';
  import userService from '../../services/User';

  export default {
    data() {
      return {
        body: {
          user: {
            first_name: '',
          },
        },
        errors: null,
      };
    },
    methods: {
      register() {
        const app = this;
        userService.create(app.body.user).then(() => {
          // Hide register modal
          $('#registerModal').modal('hide');
          // Reload page
          app.$router.go(app.$router.currentRoute);
        }).catch((e) => {
          app.errors = e.response.data.errors;
        });
      },
    },
  };
</script>