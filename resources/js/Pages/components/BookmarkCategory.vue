<script setup>
defineProps({
    category:  Object,
})
</script>

<template>
<span
    class="my-1 text-purple-500 bg-purple-300/10 rounded-xl px-2 hover:bg-purple-300/15 transition-colors duration-300 cursor-pointer"
><slot></slot></span>
</template>

