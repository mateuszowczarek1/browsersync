<script setup>
defineProps({
    bookmark: Object,
});
</script>

<template>
        <a href="bookmark.url" target="_blank"
           class="font-semibold text-lg hover:text-purple-400 transition-colors duration-300">{{
                bookmark.name
            }}</a>
</template>

