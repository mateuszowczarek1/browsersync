<script setup>
import { onMounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';
import BookmarkCategory from "../components/BookmarkCategory.vue";
import axios from 'axios';

defineProps({
    user: Object,
    bookmarks: Array
});

const categories = ref([]);
onMounted(async () => {
    try {
        const response = await axios.get('/categories/refresh');
        categories.value = response.data.categories;
    } catch (error) {
        console.error('Error fetching categories:', error);
        categories.value = [];
    }
});
</script>

<template>
    <Layout>
        <Panel title="Edit Your Bookmarks">
            <div class="flex gap-4 justify-center font-semibold text-xl flex-col text-center">
                <span v-for="bookmark in bookmarks"
                    class="border-b-2 my-2 break-words hover:bg-green p-2 transition-colors duration-300"
                    :key="bookmark.id">
                    <Link :href="`/bookmarks/${bookmark.id}`" as="button">{{ bookmark.name }}</Link>
                </span>
            </div>
        </Panel>
        <Panel title="Currently used categories">
            <div class="flex gap-2 flex-wrap">
                <BookmarkCategory v-for="category in categories" :id="category.id">{{ category.name }}</BookmarkCategory>
            </div>
        </Panel>
    </Layout>
</template>
