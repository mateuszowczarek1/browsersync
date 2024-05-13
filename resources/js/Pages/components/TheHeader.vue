<script setup>
import {Link} from '@inertiajs/vue3';
import {useAuthStore} from '../../store/userStore';

const auth = useAuthStore();
defineProps({
    user: Object,
});

</script>
<template>
    <header class="text-center bg-white/10 mx-4 rounded-xl xl:p-2 mb-4 mt-2 h-auto">
        <nav class="flex items-center flex-wrap xl:flex-row flex-col xl:gap-0">
            <div
                class="text-2xl xl:border-r-2 border-white/15 pr-2 hover:bg-white/20 p-2 rounded transition-colors duration-300 font-bold">
                <Link href="/" method="get"><i class="fa fa-home"></i> Home Page</Link>
            </div>
            <div class="xl:mb-0 space-x-4 font-semibold  xl:ml-4">
                <Link href="/bookmarks" method="get"
                      class="xl:border border-transparent xl:hover:border-purple-300 transition-colors duration-300 p-2 rounded-xl sm:border-none md:border-none md:hover:bg-transparent sm:hover:bg-transparent xl:hover:bg-purple-400">
                    Edit Bookmarks
                </Link>
                <Link href="/catalogues" method="get"
                      class="xl:border border-transparent xl:hover:border-purple-300 transition-colors duration-300 p-2 rounded-xl sm:border-none md:border-none md:hover:bg-transparent sm:hover:bg-transparent xl:hover:bg-purple-400">
                    Your catalogues
                </Link>

                <Link href="/catalogues/add" method="get"
                      class="xl:border border-transparent xl:hover:border-purple-300 transition-colors duration-300 p-2 rounded-xl sm:border-none md:border-none md:hover:bg-transparent sm:hover:bg-transparent xl:hover:bg-purple-400">
                    Create a catalogue
                </Link>
            </div>
            <div
                class="xl:ml-auto xl:mt-0 mt-3 flex md:flex-row flex-col gap-4 items-center bg-white/20 xl:px-4 py-2 rounded-xl">
                <div v-if="user" class="xl:flex xl:flex-row flex-col items-center xl:gap-2 justify-center mx-2 p-1 ">
                    <div><img :src="user.avatar" alt="User Image"
                              class="rounded border-2 border-white/50 h-[50px] mx-auto"/></div>

                    <p class="font-sm">{{ user.name }}</p>
                    <Link href="/user" method="get" as="button" type="button"
                          class="border-2 py-1 px-2 rounded-xl border-purple-400 xl:mx-2 mx-2 my-1 hover:bg-white/15 transition-colors duration-300 bg-white/5">
                        User Profile
                    </Link>
                    <Link @click="auth.clearUser()" href="/logout" method="delete" as="button" type="button"
                          class="border-2 py-1 px-2 rounded-xl border-purple-600 xl:mx-2 mx-2 my-1 hover:bg-white/15 transition-colors duration-300 bg-white/5">
                        Logout
                    </Link>
                </div>
                <div v-else>
                    <Link href="/login" method="get" as="button" type="button"
                          class="border-2 py-1 px-2 rounded-xl border-purple-400 xl:mx-2 mx-2 my-1 hover:bg-white/15 transition-colors duration-300 bg-white/5">
                        Login
                    </Link>
                    <Link href="/register" method="get" as="button" type="button"
                          class="border-2 py-1 px-2 rounded-xl border-purple-600 xl:mx-2 mx-2 my-1 hover:bg-white/15 transition-colors duration-300">
                        Register
                    </Link>
                </div>

            </div>
        </nav>

    </header>
</template>
