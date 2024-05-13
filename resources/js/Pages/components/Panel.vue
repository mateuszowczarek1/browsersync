<script setup>
defineProps({
    title: String,
})
</script>
<template>
       <section class="py-2 px-4 text-justify  border border-white/15 rounded-xl bg-white/10 group hover:border-purple-500 transition-colors duration-300">
            <h2 class="text-3xl group-hover:text-purple-500 transition-colors duration-300 text-center border-b-2 border-purple-600 mb-8 p-2 bg-purple-200/5 rounded-xl">{{title}}</h2>
            <slot>
            </slot>
        </section>
</template>
