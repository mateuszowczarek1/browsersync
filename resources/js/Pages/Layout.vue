<script setup>
import TheHeader from './components/TheHeader.vue';
import TheFooter from './components/TheFooter.vue';
import { useAuthStore } from '../store/userStore';

const auth = useAuthStore();
const user = JSON.parse(localStorage.getItem("user"));

</script>
<template>

<TheHeader :user="user" />

<main class="text-default grid lg:grid-cols-2 grid-cols-1 gap-4 mx-4">
    <slot></slot>
</main>


<TheFooter />

</template>
