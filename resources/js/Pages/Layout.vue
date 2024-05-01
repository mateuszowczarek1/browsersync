<script setup>
import TheBar from './components/TheBar.vue';
</script>
<template>

    <header class="text-darktext font-semibold">
        <nav class="xl:bg-bgsecondary xl:mb-4 flex xl:space-between items-center xl:h-15 flex-wrap xl:flex-row flex-col gap-2 xl:gap-0">
            <div class="text-3xl xl:border-r-4 pr-2 xl:border-btnprimary bg-bgmain text-btnprimary">
                🛖️ Home Page
            </div>
            <div class="h-full mt-8 mb-8 xl:mb-0 xl:mt-0">
                <a href="" class="p-2 bg-btnsecondary hover:bg-btnprimary">Home</a>
                <a href="" class="p-2 bg-btnsecondary hover:bg-btnprimary">About</a>
                <a href="" class="p-2 bg-btnsecondary hover:bg-btnprimary">Contact</a>
            </div>
        </nav>
    </header>
    <section class="text-default flex justify-center">
    <TheBar />
    </section>
    <main class="text-default flex items-start gap-4 lg:flex-row flex-col">
        <slot></slot>
    </main>
    <footer class="bg-bgsecondary mt-8 text-darktext">
        <div>
            <h2 class="font-semibold text-2xl">This is a footer</h2>
        </div>
        <div class="p-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea sequi incidunt dolorum atque hic, magnam dolorem possimus cumque numquam neque libero voluptatem debitis nostrum? Repudiandae praesentium eos assumenda aliquam consequuntur.</div>
    </footer>
</template>

