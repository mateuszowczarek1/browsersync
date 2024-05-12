<script setup>
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
{{ user.catalogues }}
</div>
<div v-else>
    You dont have any. Create them HERE
</div>
  </Panel>
</Layout>
</template>
