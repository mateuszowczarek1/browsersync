<script setup>
defineProps({
    category:  Object,
})
</script>

<template>
<span
    class="my-2 text-green bg-purple-300/10 rounded-xl px-2 py-1 hover:bg-green/15 transition-colors duration-300 cursor-pointer"
><slot></slot></span>
</template>

