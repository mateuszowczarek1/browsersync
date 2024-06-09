<script setup>
import { Link } from '@inertiajs/vue3';
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';

defineProps({
    users: Object
})

</script>
<template>
    <Layout>
        <Panel title="Admin dashboard users" class="col-span-2">
            <section class="flex flex-col space-y-2">
                <div v-if="users">
                    <ol class="p-6 list-decimal">
                        <li v-for="user in users">
                            <Link :href="`/admin/users/${user.id}`" method="get">{{ user.name }}
                            </Link>
                        </li>
                    </ol>
                </div>
                <Link :href="`/dashboard`" as="button" method="get"
                    class="inline-block p-2 border-2 border-dotted my-4">Go Back
                </Link>
            </section>
        </Panel>
    </Layout>
</template>
