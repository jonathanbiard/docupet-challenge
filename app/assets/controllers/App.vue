<script setup>
    import { ref } from 'vue'
    import CurrentPets from "../components/CurrentPets.vue";
    import Header from '../components/Header.vue'
    import FormA from '../components/FormA.vue'
    import Footer from '../components/Footer.vue'
    import PetService from "../services/PetService";

    import '../styles/app.scss'

    defineProps({});

    // Load data from server-side render (SSR) on initial load to avoid an ajax call
    const pets = ref(JSON.parse(document.querySelector("#app").getAttribute('data-pets')))
    const breeds = ref(JSON.parse(document.querySelector("#app").getAttribute('data-breeds')))

    const isLoading = ref(false)

    const reloadPets = async () => {
        isLoading.value = true

        pets.value = await PetService.getAll()

        isLoading.value = false
    }
</script>

<template>
    <Header/>
    <div class="container-fluid content-area mt-3">
        <div class="row">
            <div class="col">
                <FormA @reload-pets="reloadPets" v-bind:breeds="breeds"/>
                <CurrentPets v-bind:is-loading="isLoading" v-bind:pets="pets"/>
                <Footer/>
            </div>
        </div>
    </div>
</template>
