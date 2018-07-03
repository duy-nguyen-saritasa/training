<template>
    <div class="container">
        <RegisterUserModal/>
        <EditUserModal @success="showMessage" ref="userUpdateComp"></EditUserModal>
        <h1 class="my-4 text-center text-lg-left">User List</h1>
        <button data-toggle="modal" data-target="#registerModal" class="btn btn-success">Add</button>
        <div class="row">
            <div class="alert alert-info m-1" v-if="message">
                <strong>{{ message }}</strong>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordred table-striped" ref="tableUser">
                        <tr>
                            <th>No</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tr v-for="user in users">
                            <td>{{user.id }}</td>
                            <td>{{user.first_name}}</td>
                            <td>{{user.last_name}}</td>
                            <td>{{user.email}}</td>
                            <td>
                                <button v-on:click="updateUser(user)" data-toggle="modal" type="button"
                                        class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </button>
                            </td>
                            <td></td>
                        </tr>
                        <tr v-if="!users">
                            <td colspan="6">Not found</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

    </div>
</template>

<script type="javascript">
  import userService from '../../services/User';
  import RegisterUserModal from './Modal/Register';
  import EditUserModal from './Modal/Edit';

  export default {
    components: {
      RegisterUserModal,
      EditUserModal,
    },
    data() {
      return {
        users: null,
        user_update: {},
        message: null,
    }
    },
    mounted() {
      this.loadList();
    },
    methods: {
      async loadList() {
        this.users = await userService.loadList().catch(function (e) {
          alert(e);
        });
      },
      updateUser(user) {
        this.$refs.userUpdateComp.setUser(user);
        $('#updateUserModal').modal('show');
      },
      showMessage(message) {
        this.message = message;
        this.loadList();
      }
    }
  };
</script>
