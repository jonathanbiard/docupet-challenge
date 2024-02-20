<script setup>
    import '../styles/CurrentPets.scss'

    defineProps({
        isLoading: Boolean,
        pets: {
            type: Object,
            default() {
                return {
                    id: Number,
                    breed: String | null,
                    breedMix: String | null,
                    name: String,
                    age: Number | null,
                    birthday: String | null,
                    gender: String,
                    isDangerous: Boolean,
                }
            }
        }
    });
</script>

<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-auto mb-2 fs-3">
                Current Pets
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-auto mb-5 py-4 px-5 table-area">
                <div v-if="isLoading" class="d-flex justify-content-center">
                    <div class="spinner-border text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <table v-else class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Age</th>
                            <th scope="col">Birthday</th>
                            <th scope="col">Breed</th>
                            <th scope="col">Breed Mix</th>
                            <th scope="col">Dangerous</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="pet in pets">
                            <th scope="row">{{ pet.id }}</th>
                            <td>{{ pet.name }}</td>
                            <td>{{ pet.gender }}</td>
                            <td>{{ pet.age ?? '-' }}</td>
                            <td>{{ pet.birthday ?? '-' }}</td>
                            <td>{{ pet.breed ?? '-' }}</td>
                            <td>{{ pet.breedMix ?? '-' }}</td>
                            <td class="text-end">
                                <img v-if="pet.isDangerous" class="dangerous-icon" src="/images/danger-sign.png" alt="Danger"/>
                                <span v-else>-</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>