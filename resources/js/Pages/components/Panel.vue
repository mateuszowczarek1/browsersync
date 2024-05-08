<script setup>
defineProps({
    title: String,
})
</script>
<template>
       <section class="py-2 px-4 text-justify sm:w-[100%] border border-white/15 rounded-xl bg-white/10 group hover:border-purple-500">
            <h2 class="text-3xl group-hover:text-purple-500">{{title}}</h2>
          <div>
            <slot>
            </slot>
          </div>
        </section>
</template>
