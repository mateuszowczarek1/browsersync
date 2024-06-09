<script setup>
import { Link } from '@inertiajs/vue3';
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';


</script>
<template>
    <Layout>
        <Panel title="Admin dashboard" class="col-span-2">
            <section class="flex flex-col space-y-2 mx-4 my-4">
                <div>
                    <Link
                    :href="`/admin/users`"
                    as="button"
                    method="get"
                    class="inline-block p-2 border-2 border-dotted my-4"
                    >Users
                </Link>
                </div>
                 <Link
                :href="`/dashboard`"
                as="button"
                method="get"
                class="inline-block p-2 border-2 border-dotted my-4"
                >Go Back
            </Link>
            </section>
        </Panel>
    </Layout>
</template>
