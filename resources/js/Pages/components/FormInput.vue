<script setup>
defineEmits(['updateForm']);

</script>

<template>
    <input class="my-2 bg-green/15 p-2 rounded-xl placeholder-white/30" @input="$emit('updateForm', $event.target.value)"  />
</template>
