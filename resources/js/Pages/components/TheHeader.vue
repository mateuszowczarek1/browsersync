<script setup>
import {Link} from '@inertiajs/vue3';
import {useAuthStore} from '../../store/userStore';
import Navbar from './Navbar/Navbar.vue';
import UserInfo from './Navbar/UserInfo.vue';

const auth = useAuthStore();
defineProps({
    user: Object,
});

</script>
<template>
    <header class="text-center mx-4 xl:p-2 mb-4 mt-2 h-auto">
        <nav class="flex xl:items-center xl:flex-wrap xl:flex-row flex-col justify-center  xl:gap-0">
          <Navbar :user="user" />
          <UserInfo :user="user" />
        </nav>

    </header>
</template>
