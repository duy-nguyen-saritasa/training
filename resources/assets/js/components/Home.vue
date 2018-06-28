<template>
    <div class="container">
        <h1 class="my-4 text-center text-lg-left">User info</h1>

        <div class="row text-center text-lg-left" v-if="$auth.ready()">
            <ul class="list-group">
                <li class="list-group-item">First name : <b>{{$auth.user().first_name}}</b></li>
                <li class="list-group-item">Last name : <b>{{user.last_name}}</b></li>
                <li class="list-group-item">Email : <b>{{user.email}}</b></li>
            </ul>
        </div>
        <div class="row text-center text-lg-left" v-if="!$auth.ready()">
            Please login
        </div>
    </div>
</template>

<script>
  export default {
    name: 'Home',
    data() {
      return {
        user: this.$auth.user(),
      };
    },
  };
</script>
