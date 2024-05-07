<script setup>
defineProps({
    buttonName: String
})
</script>
<template>
     <button class="rounded-sm p-1 m-1">{{ buttonName }}</button>
</template>
