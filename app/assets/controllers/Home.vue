<template>
    <h1>Random number test</h1>
    <div class="important">{{ number }}</div>
</template>

<script setup>
    defineProps({
        number: Number
    });
</script>
