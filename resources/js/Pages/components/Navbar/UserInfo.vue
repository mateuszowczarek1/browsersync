<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    user: Object
})
</script>

<template>
    <div
        class="xl:ml-auto xl:mt-0 mt-3 flex md:flex-row flex-col gap-4 items-center bg-green/10 xl:px-4 py-8 rounded-bl-lg">
        <div v-if="user" class="xl:flex xl:flex-row flex-col items-center xl:gap-2 self-center mx-2 p-1 text-xl ">
            <div>
                <div class="mb-2">
                    <img :src="user.avatar" alt="User Image" class="rounded-xl h-[10vh] mx-auto" />
                </div>

                <p class="font-sm mb-2 text-green">{{ user.name }}</p>
                <Link href="/user" method="get" as="button" type="button"
                    class="border-2 py-1 px-2 rounded-bl-lg border-green-400 xl:mx-2 mx-2 my-1 hover:bg-white/15 transition-colors duration-300 bg-white/5">
                User Profile
                </Link>
                <Link @click="auth.clearUser()" href="/logout" method="delete" as="button" type="button"
                    class="border-2 py-1 px-2 rounded-bl-lg border-green-600 xl:mx-2 mx-2 my-1 hover:bg-white/15 transition-colors duration-300 bg-white/5">
                Logout
                </Link>
            </div>
        </div>
        <div v-else>
            <Link href="/login" method="get" as="button" type="button"
                class="border-2 py-1 px-2 rounded-bl-lg border-green-400 xl:mx-2 mx-2 my-1 hover:bg-white/15 transition-colors duration-300 bg-white/5">
            Login
            </Link>
            <Link href="/register" method="get" as="button" type="button"
                class="border-2 py-1 px-2 rounded-bl-lg border-green-600 xl:mx-2 mx-2 my-1 hover:bg-white/15 transition-colors duration-300">
            Register
            </Link>
        </div>
    </div>
</template>
