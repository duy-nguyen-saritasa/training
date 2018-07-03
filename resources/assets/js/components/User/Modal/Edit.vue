<template>
    <!-- The Modal -->
    <div class="modal fade" id="updateUserModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form autocomplete="off" @submit.prevent="edit" method="post">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div id="msg-login-error" class="alert alert-danger" v-if="error">
                            <strong>{{ error }}</strong>
                        </div>
                        <div id="msg-login-errors" class="alert alert-danger" v-if="errors">
                            <ul>
                                <li v-for="error in errors">{{ error.messages[0] }}</li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="first_name"><b>First name</b></label>
                            <input type="text" placeholder="First name" name="first_name"
                                   v-model="userUpdate.first_name">
                        </div>

                        <div class="form-group">
                            <label for="last_name"><b>Last name</b></label>
                            <input type="text" placeholder="First name" name="last_name" v-model="userUpdate.last_name"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="email"><b>Email</b></label>
                            <input type="text" placeholder="Last name" name="email" v-model="userUpdate.email" required>
                        </div>

                        <div class="form-group">
                            <label for="password"><b>New Password</b></label>
                            <input type="password" placeholder="Enter Password" name="password"
                                   v-model="userUpdate.password">
                        </div>

                        <div class="form-group">
                            <button type="submit">Update</button>
                        </div>
                    </div>
                </form>

                <!-- Modal footer -->
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
</template>

<script>
  import userService from '../../../services/User';

  export default {
    data() {
      return {
        userUpdate: {},
        errors: null,
        error: null,
      };
    },
    methods: {
      setUser(user) {
        // this.clearErrorMessage();
        // Set user params
        this.userUpdate.id = user.id;
        this.userUpdate.first_name = user.first_name;
        this.userUpdate.last_name = user.last_name;
        this.userUpdate.email = user.email;
        this.userUpdate.password = '';
        $('#updateUserModal').modal('show');
      },
      edit() {
        const app = this;
        // Update request
        userService.update(this.userUpdate).then(() => {
          // Hide register modal
          $('#updateUserModal').modal('hide');
          // Update success
          app.$emit('success', 'Update success');
        }).catch((e) => {
          // Set errors
          app.errors = e.response.data.errors || null;
          if (app.errors == null) {
            app.error = e.response.data.message || null;
          }
        });
      },
      clearErrorMessage() {
        this.errors = null;
        this.error = null;
      },
    },
  };
</script>