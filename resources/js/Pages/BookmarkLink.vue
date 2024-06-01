<script setup>
defineProps({
    bookmark: Object,
});
</script>

<template>
        <a :href="bookmark.url" target="_blank"
           class="font-semibold text-xl hover:text-green transition-colors duration-300">{{
                bookmark.name
            }}</a>
</template>

