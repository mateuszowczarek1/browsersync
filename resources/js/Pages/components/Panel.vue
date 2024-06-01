<script setup>
defineProps({
    title: String,
})
</script>
<template>
       <section class="py-8 px-4 text-justify text-white rounded-tl-lg bg-white/5 group">
            <h2 class="text-4xl group-hover:text-green transition-colors duration-300 text-center border-green mb-8 p-2  rounded-xl">{{title}}</h2>
            <slot>
            </slot>
        </section>
</template>
