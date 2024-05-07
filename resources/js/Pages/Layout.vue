<script setup>
import TheHeader from './components/TheHeader.vue';
import TheFooter from './components/TheFooter.vue';
</script>
<template>

<TheHeader />

    <main class="text-default flex items-start gap-4 lg:flex-row flex-col mx-4">
        <slot></slot>
    </main>

<TheFooter />

</template>

