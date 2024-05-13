<script setup>
import {computed} from 'vue';
import {Link} from '@inertiajs/vue3';
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';
import BookmarkCategory from "../components/BookmarkCategory.vue";

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
            <div class="flex gap-4 justify-center font-semibold text-xl flex-wrap text-center">
                <span v-for="bookmark in bookmarks" class="border-b-2 border-purple-500/30 my-2 break-words hover:bg-purple-400 p-2 rounded-xl"
                    :key="bookmark.id">
                    <Link :href="`/bookmarks/${bookmark.id}`">{{ bookmark.name }}</Link>
                </span>
            </div>
        </Panel>
        <Panel title="Currently used categories">
            <div class="flex gap-2">
                <BookmarkCategory v-for="category in categories" :category="category">{{category}}</BookmarkCategory>
            </div>
        </Panel>
    </Layout>
</template>
