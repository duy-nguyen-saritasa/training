<template>
    <div class="container">
        <h1 class="my-4 text-center text-lg-left">User List</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordred table-striped">
                        <tr>
                            <th>No</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        <tr v-for="user in users">
                            <td>{{user.no }}</td>
                            <td>{{user.first_name}}</td>
                            <td>{{user.last_name}}</td>
                            <td>{{user.email}}</td>
                            <td></td>
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

  export default {
    data() {
      return {
        users: null,
      }
    },
    created() {
      this.loadList();
    },
    methods: {
      async loadList() {
        const user = await userService.loadList();
        this.users = { user };
      }
    }
  };
</script>
