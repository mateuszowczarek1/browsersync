<script setup>
import Layout from './Layout.vue';
import Panel from './components/Panel.vue';
import {Link} from '@inertiajs/vue3';
defineProps({
    user: Object,
    bookmarks: Object
})
</script>

<template>
    <Layout :user="user">
        <Panel v-if="bookmarks.data.length" title="Bookmarks">
            <ul>
                <li v-for="bookmark in bookmarks.data" :key="bookmark.id">
                    <a :href="bookmark.url" target="_blank">{{ bookmark.name }}</a>
                    <p class="text-xs">
                        <span class="font-bold text-purple-300">URL as plain text:</span> {{ bookmark.url }}
                    </p>
                </li>
            </ul>

           <!-- Paginator -->
           <div class="mt-6 flex gap-4 border-t py-2 justify-center">
                <template v-for="link in bookmarks.links">
                    <Link :class="['hover:text-purple-500 transition-colors duration-300', link.active ? 'text-purple-400' : '']" v-if="link.url" :href="link.url" :key="link.url" v-html="link.label"></Link>
                    <span class="text-slate-50/25" v-else :key="link.label" v-html="link.label"></span>
                </template>
            </div>
        </Panel>
    </Layout>
</template>
