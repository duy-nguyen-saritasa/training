<template>
    <div class="container">
        <RegisterUserModal @register="userRegistered" ref="userRegistComp" />
        <EditUserModal @update="userUpdated" ref="userUpdateComp"></EditUserModal>
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
                                <button v-on:click="updateUser(user)" type="button"
                                        class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </button>
                            </td>
                            <td>
                                <button v-on:click="deleteUser(user.id)" type="button"
                                        class="btn btn-danger btn-sm">
                                    <span class="glyphicon glyphicon-edit"></span> Delete
                                </button>
                            </td>
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
        // Set init data for update from
        this.$refs.userUpdateComp.processUpdate(user);
        // Hide update modal
        $('#updateUserModal').modal('show');
      },
      userRegistered(message){
        // Reload user list
        this.loadList();
        // Set success message
        this.showMessage(message);
      },
      deleteUser(id) {
        const app = this;
        if (confirm("Are you sure to delete user ID : " + id + " ?")) {
          userService.delete(id).then(() => {
            app.showMessage('Deleted success');
            this.loadList();
          });
        }
      },
      userUpdated(message) {
        // Reload user list
        this.loadList();
        // Set success message
        this.showMessage(message);
      },
      showMessage(message) {
        this.message = message;
      }
    }
  };
</script>
