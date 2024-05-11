<script setup>
defineProps({
    labelFor: String,
})
</script>

<template>
    <label :for="labelFor" class="block text-sm font-medium leading-6 text-purple-200 my-2">
        <slot></slot>
    </label>
</template>
