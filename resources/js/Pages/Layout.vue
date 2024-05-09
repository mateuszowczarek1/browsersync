<script setup>
import TheHeader from './components/TheHeader.vue';
import TheFooter from './components/TheFooter.vue';
import { useAuthStore } from '../store/userStore';

const auth = useAuthStore();
</script>
<template>

<TheHeader :user="auth.user" />

    <main class="text-default flex items-start gap-4 lg:flex-row flex-col mx-4">
        <slot></slot>
    </main>

<TheFooter />

</template>
