<template>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col"/>
            <div class="col text-center">
                <img src="/images/docupet-logo-sm-shelter.png" alt="DocuPet Logo"/>
            </div>
            <div class="col d-flex align-items-end justify-content-end help-save-text">
                <span class="help"><a href="#">Help</a></span>
                <span class="save mx-4"><a href="#">Save and Finish Later</a></span>
            </div>
        </div>
    </div>
    <div class="container-fluid content-area mt-3">
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
                            <input class="form-check-input" type="radio" name="petType" id="petTypeDog" value="Dog">
                            <label class="form-check-label" for="petTypeDog">Dog</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="petType" id="petTypeCat" value="Cat">
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
                        <input type="text" class="form-control" id="petName" placeholder="Dexter">
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
                            <input type="text" class="form-control" list="breedOptions" id="breed" placeholder="Type to search...">
                            <span class="input-group-text" id="breed-addon">
                                <img class="search-icon" src="/images/search-icon.svg" alt="Search"/>
                            </span>
                            <datalist id="breedOptions">
                                <option value="Siamese"/>
                                <option value="Persian"/>
                                <option value="House"/>
                                <option value="Tiger"/>
                                <option value="Golden Retriever"/>
                                <option value="Border Collie"/>
                                <option value="Labrador"/>
                                <option value="Wolf"/>
                            </datalist>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col fs-6 mt-3">
                        What gender are they?
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-2">
                        <div class="input-group">
                            <input type="button" class="form-control" value="Male">
                            <input type="button" class="form-control" value="Female">
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male">
                            <label class="form-check-label" for="genderMale">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female">
                            <label class="form-check-label" for="genderFemale">Female</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-4 text-center">
                        <input class="btn btn-primary continue-button px-5" type="button" value="Continue">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    defineProps({
        number: Number
    });
</script>
