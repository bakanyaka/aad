<template>
    <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        <app-navigation></app-navigation>

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
           <app-topnavbar></app-topnavbar>

            <!-- Main view  -->
            <router-view></router-view>

            <!-- Footer -->
            <app-footer></app-footer>

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->
</template>

<script>
    import Navigation from './components/Navigation/Navigation.vue'
    import TopNavbar from './components/Navigation/TopNavbar.vue'
    import Footer from './components/Footer.vue'
    export default {
        components: {
            'app-navigation': Navigation,
            'app-topnavbar': TopNavbar,
            'app-footer': Footer
        },
        data () {
            return {
                msg: 'Hello world!'
            }
        }
    }
</script>

<style>
    .example {
        color: red;
    }
</style>