<script setup>
import {Link} from "@inertiajs/vue3";
import Panel from '../components/Panel.vue';
import Layout from '../Layout.vue';
defineProps({
    user: Object
})
</script>
<template>
    <Layout>
  <Panel title="Your bookmark catalogues" class="col-span-2">
<div v-if="user.catalogues.length">
<div class="flex font-semibold cursor-pointer flex-col text-center">
    <span v-for="catalogue in user.catalogues" class="inline-block p-2 border-2 border-green rounded-xl my-4 mx-2 hover:bg-white/15">
        <Link :href="`/catalogues/${catalogue.id}`" as="button">{{ catalogue.name}}</Link>
    </span>
 <div class="border-green border-t">
     <Link href="/catalogues/add" method="GET" as="button" class="rounded-xl cursor-pointer font-semibold inline-block p-2 my-4 mx-2 hover:bg-white/15 border-2 bg-green">Create a new catalogue</Link>
 </div>
</div>
</div>
<div v-else class="font-semibold text-xl mb-5 space-y-3">
    <p class="text-4xl">You don't own any catalogues yet.</p>
    <Link href="/catalogues/add" method="GET" as="button" class="inline-block bg-white/10 border rounded-xl p-2 hover:bg-green transition-colors duration-300">Create <strong>here</strong></Link>
</div>
  </Panel>
</Layout>
</template>
