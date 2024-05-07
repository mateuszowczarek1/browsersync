<script setup>
defineProps({ user: Object })
import Layout from './Layout.vue';
import Panel from './components/Panel.vue';
</script>

<template>
    <Layout>
     <Panel />
     <Panel />
     <Panel />
    </Layout>
</template>
