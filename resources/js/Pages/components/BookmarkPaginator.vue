<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    bookmarks: Object
})
</script>
<template>
    <div class="mt-6 flex gap-4 border-t py-2 justify-center text-xl">
        <template v-for="link in bookmarks.links">
            <Link
                :class="['hover:text-green transition-colors duration-300', link.active ? 'text-green/20' : '']"
                v-if="link.url" :href="link.url" :key="link.url" v-html="link.label">
            </Link>
            <span class="text-slate-50/25" v-else :key="link.label" v-html="link.label"></span>
        </template>
    </div>
</template>
