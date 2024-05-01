<script setup>
defineProps({
    buttonName: String
})
</script>
<template>
     <button class="rounded-sm p-1 m-1 bg-btnprimary hover:bg-btnsecondary hover:outline-bgsecondary hover:outline outline-1 text-darktext">{{ buttonName }}</button>
</template>
