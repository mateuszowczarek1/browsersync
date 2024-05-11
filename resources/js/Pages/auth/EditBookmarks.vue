<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';
defineProps({
    user: Object,
    bookmarks: Array
});


const categories = computed(() => {
    const categorySet = new Set();

    __props.bookmarks.forEach(bookmark => {
        bookmark.categories.forEach(category => {
            if (Array.isArray(category)) {
                category.forEach(subCategory => {
                    categorySet.add(subCategory.name);
                });
            } else {
                categorySet.add(category.name);
            }
        });
    });

    return Array.from(categorySet);
});

</script>

<template>
    <Layout>
        <Panel title="Edit Your Bookmarks">
            <ul>
                <li v-for="bookmark in bookmarks" class="border-b-2 border-purple-500/30 my-2 break-words" :key="bookmark.id">
                    <Link :href="`/bookmarks/${bookmark.id}`">{{ bookmark.name }}</Link>
                </li>
            </ul>
        </Panel>
        <Panel title="Currently used categories">
            <ul>
                <li v-for="category in categories" :key="category">
                    {{ category }}
                </li>
            </ul>
        </Panel>
    </Layout>
</template>
