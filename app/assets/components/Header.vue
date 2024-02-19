<script setup>
    import '../styles/Header.scss'

    defineProps({});
</script>

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
</template>