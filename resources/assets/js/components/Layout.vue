<template>
    <div class="w-100">
        <Header/>

        <!-- Page Content -->
        <router-view/>
        <!-- End Page Content -->

        <Footer/>
        <!-- Modal -->
        <LoginModal/>
    </div>
</template>

<script>
  import Header from '../components/Header';
  import Footer from '../components/Footer';
  import LoginModal from './Modal/Login';

  export default {
    name: 'Layout',
    components: {
      Header,
      Footer,
      LoginModal,
    },
  };
</script>
