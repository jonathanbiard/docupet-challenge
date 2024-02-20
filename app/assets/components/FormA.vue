<script setup>
    import { ref } from 'vue'
    import '../styles/FormA.scss'
    import PetService from "../services/PetService";

    const props = defineProps({
        breeds: {
            type: Array,
            default() {
                return {
                    id: Number,
                    petType: String,
                    name: String,
                    isDangerous: Boolean,
                }
            }
        }
    });

    const emit = defineEmits(['reloadPets'])

    const petType = ref(null)
    const name = ref('')
    const breed = ref('')
    const unknownBreed = ref(null)
    const mixedBreed = ref('')
    const gender = ref(null)
    const birthdayKnown = ref(null)
    const age = ref(null)
    const birthDay = ref(null)
    const birthMonth = ref(null)
    const birthYear = ref(null)
    const showComplexBreedsSection = ref(true)
    const saveInProgress = ref(false)
    const saveErrorCode = ref(0)

    const handleGenderClick = (newValue) => {
        gender.value = newValue;
    }

    const handleBirthdayKnownClick = (newValue) => {
        birthdayKnown.value = newValue;
    }

    const handleBreedBlur = () => {
        if (!props.breeds.find((b) => b.name === breed.value)) {
            breed.value = ''
            showComplexBreedsSection.value = true
        }

        if (breed.value) {
            unknownBreed.value = null
            mixedBreed.value = null
            showComplexBreedsSection.value = false
        }
    }

    const formToPet = () => {
        return {
            id: 1,
            breed: breed.value !== '' ? breed.value : null,
            breedMix: unknownBreed.value === 'mixed' ? mixedBreed.value : '[Unknown]',
            name: name.value,
            age: birthdayKnown.value === 'no' ? age.value : null,
            birthday: birthdayKnown.value === 'yes'
                ? `${birthYear.value.toString()}` +
                    `-${birthMonth.value.toString().padStart(2, '0')}` +
                    `-${birthDay.value.toString().padStart(2, '0')}`
                : null,
            gender: gender.value,
        }
    }

    const handleSave = async () => {
        saveInProgress.value = true

        const saveResult = await PetService.save(formToPet())

        if (saveResult === 0) {
            emit('reloadPets')
            resetForm()
        } else {
            saveErrorCode.value = saveResult
        }

        saveInProgress.value = false
    }

    const resetForm = () => {
        petType.value = null
        name.value = ''
        breed.value = ''
        unknownBreed.value = null
        mixedBreed.value = ''
        gender.value = null
        birthdayKnown.value = null
        age.value = null
        birthDay.value = null
        birthMonth.value = null
        birthYear.value = null
    }
</script>

<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-auto form-area my-5 px-5 pt-4 pb-5">
                <div class="row">
                    <div class="col">
                        <img class="paw-trail" src="/images/paw-trail.png" alt="Paw Trail"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col fs-4 mt-3 tell-us-title">
                        Tell us about your animal
                    </div>
                </div>
                <div class="row">
                    <div class="col fs-6 mt-3">
                        What is your pet?
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-2">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="petType" id="petTypeDog" value="Dog" v-model="petType">
                            <label class="form-check-label" for="petTypeDog">Dog</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="petType" id="petTypeCat" value="Cat" v-model="petType">
                            <label class="form-check-label" for="petTypeCat">Cat</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col fs-6 mt-3">
                        <label for="petName" class="form-label">
                            What is its name?
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" class="form-control" :class="{ 'is-invalid': saveErrorCode === 1 }" id="petName" v-model="name">
                    </div>
                </div>
                <div class="row">
                    <div class="col fs-6 mt-3">
                        <label for="breed" class="form-label">
                            What breed are they?
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group">
                            <input
                                type="text"
                                class="form-control"
                                list="breedOptions"
                                id="breed"
                                :placeholder="petType ? `Can't find your ${petType.toLowerCase()}'s breed?` : ''"
                                v-model="breed"
                                :disabled="!petType"
                                @blur="handleBreedBlur"
                            >
                            <span class="input-group-text search-icon-container" id="breed-addon">
                                <img class="search-icon" src="/images/search-icon.svg" alt="Search"/>
                            </span>
                            <datalist id="breedOptions">
                                <option v-for="breed in breeds.filter((b) => b.petType === petType)" :value="breed.name">
                                    {{ breed.name }}
                                </option>
                            </datalist>
                        </div>
                    </div>
                </div>
                <div v-if="showComplexBreedsSection">
                    <div class="row justify-content-center">
                        <div class="col-10 fs-6 mt-3">
                            Choose One
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-10 mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="unknownBreed" id="unknownBreedUnknown" value="unknown" v-model="unknownBreed">
                                <label class="form-check-label" for="unknownBreedUnknown">I don't know</label>
                            </div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="unknownBreed" id="unknownBreedMixed" value="mixed" v-model="unknownBreed">
                                <label class="form-check-label" for="unknownBreedMixed">It's a mix</label>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-10 mt-2">
                            <input type="text" class="form-control" id="mixedBreed" placeholder="E.g.: Collie, poodle, lab" :disabled="unknownBreed !== 'mixed'" v-model="mixedBreed">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col fs-6 mt-3">
                        What gender are they?
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 mt-2">
                        <div class="input-group">
                            <input
                                type="button"
                                class="form-control"
                                :class="[ gender === 'male' ? 'switch-selected' : 'switch-unselected' ]"
                                value="Male"
                                @click="handleGenderClick('male')"
                            >
                            <input
                                type="button"
                                class="form-control"
                                :class="[ gender === 'female' ? 'switch-selected' : 'switch-unselected' ]"
                                value="Female"
                                @click="handleGenderClick('female')"
                            >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col fs-6 mt-3">
                        Do you know their date of birth?
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 mt-2">
                        <div class="input-group">
                            <input
                                type="button"
                                class="form-control"
                                :class="[ birthdayKnown === 'yes' ? 'switch-selected' : 'switch-unselected' ]"
                                value="Yes"
                                @click="handleBirthdayKnownClick('yes')"
                            >
                            <input
                                type="button"
                                class="form-control"
                                :class="[ birthdayKnown === 'no' ? 'switch-selected' : 'switch-unselected' ]"
                                value="No"
                                @click="handleBirthdayKnownClick('no')"
                            >
                        </div>
                    </div>
                </div>
                <div v-if="birthdayKnown === 'no'">
                    <div class="row">
                        <div class="col fs-6 mt-3">
                            <label for="age" class="form-label">
                                Approximate Age
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <select class="form-select" id="age" v-model="age">
                                <option v-for="index in 20" :value="index">{{ index }}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div v-if="birthdayKnown === 'yes'">
                    <div class="row">
                        <div class="col fs-6 mt-3">
                            <label for="birthDay" class="form-label">
                                Birthdate
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="row mb-1">
                                <div class="col-4 birthday-part-labels">
                                    Month
                                </div>
                                <div class="col-4 birthday-part-labels">
                                    Day
                                </div>
                                <div class="col-4 birthday-part-labels">
                                    Year
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <select class="form-select" id="birthMonth" v-model="birthMonth">
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-select" id="birthDay" v-model="birthDay">
                                        <option v-for="index in 31" :value="index">{{ index }}</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select class="form-select" id="birthYear" v-model="birthYear">
                                        <option v-for="index in 20" :value="2025 - index">{{ 2025 - index }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-5 text-center">
                        <button
                            v-if="!saveInProgress"
                            type="button"
                            class="btn btn-primary continue-button"
                            @click="handleSave()"
                        >
                            Continue
                        </button>
                        <button
                            v-else
                            type="button"
                            class="btn btn-primary continue-button"
                            disabled
                        >
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            <span class="ms-2">Saving...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>