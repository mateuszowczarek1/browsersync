<script setup>
import {Link} from '@inertiajs/vue3';
import NavbarMenuLinks from "./NavbarMenuLinks.vue";

defineProps({
    user: Object
})
</script>

<template>
    <div>
        <Link href="/" method="get" as="button"><img src="/images/logo.svg" alt="Bookmarkr Logo"
            class="inline-block w-[30vh]" /></Link>
    </div>
    <div class="xl:mb-0 space-x-4 font-semibold text-xl xl:ml-4" v-if="user">
        <NavbarMenuLinks href="/bookmarks" method="get" as="button">Edit Bookmarks</NavbarMenuLinks>
        <NavbarMenuLinks href="/catalogues" method="get" as="button">Your catalogues</NavbarMenuLinks>
        <NavbarMenuLinks href="/catalogues/add" method="get" as="button">Create a catalogue</NavbarMenuLinks>
    </div>
</template>
