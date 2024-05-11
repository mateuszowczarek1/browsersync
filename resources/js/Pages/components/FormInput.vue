<script setup>
defineEmits(['updateForm']);

</script>

<template>
    <input class="my-2 bg-purple-400 p-2 rounded-xl placeholder-purple-600" @input="$emit('updateForm', $event.target.value)"  />
</template>
