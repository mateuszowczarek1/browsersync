<script setup>
defineProps({user: Object})
</script>

<template>
    <h1 class="block mt-4 font-bold text-4xl text-violet-500 mb-2">{{user.firstName}} is the besto</h1>
    <h2>Should be working now</h2>
</template>
