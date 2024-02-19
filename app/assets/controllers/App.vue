<script setup>
    import CurrentPets from "../components/CurrentPets.vue";
    import Header from '../components/Header.vue'
    import FormA from '../components/FormA.vue'
    import Footer from '../components/Footer.vue'

    import '../styles/app.scss'

    defineProps({});

    // Load data from server-side render (SSR) on initial load to avoid an ajax call
    const pets = JSON.parse(document.querySelector("#app").getAttribute('data-pets'))
</script>

<template>
    <Header/>
    <div class="container-fluid content-area mt-3">
        <div class="row">
            <div class="col">
                <FormA/>
                <CurrentPets v-bind:pets="pets"/>
                <Footer/>
            </div>
        </div>
    </div>
</template>
