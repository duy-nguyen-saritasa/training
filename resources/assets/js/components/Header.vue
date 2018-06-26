<template>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <router-link :to="{ name: 'home' }" class="navbar-brand">PHP Laravel + VueJS Training</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">
                            <router-link :to="{ name: 'home' }">Home</router-link>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <router-link :to="{ name: 'about' }">About</router-link>
                        </a>
                    </li>
                    <li class="nav-item" v-if="$auth.ready()">
                        <a class="nav-link" data-toggle="modal" data-target="#loginModal">Login</a>
                    </li>
                    <li class="nav-item" v-if="$auth.ready()">
                        <a class="nav-link" href="#">
                            <router-link :to="{ name: 'logout' }">Logout</router-link>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
  export default {};
</script>
