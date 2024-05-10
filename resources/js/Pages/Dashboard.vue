<script setup>
import { useAuthStore } from '../store/userStore';
import { computed, ref } from 'vue';
import Layout from './Layout.vue';
import Panel from './components/Panel.vue';
import BookmarkPaginator from './components/BookmarkPaginator.vue'
import AddBookmarkForm from './components/AddBookmarkForm.vue';
defineProps({
    user: Object,
    bookmarks: Object
})
const {user} = __props;
const auth = useAuthStore();
if (user) {
    auth.setUser(user);
}

const {bookmarks} = __props;
const filterByCategory = ref('');

const filteredBookmarks = computed(() => {
    if (!filterByCategory.value) {
        return bookmarks.data;
    } else {
        return bookmarks.data.filter(bookmark =>
            bookmark.categories.some(cat => cat.name === filterByCategory.value)
        );
    }
});

</script>

<template>
    <Layout>
        <Panel v-if="bookmarks.data.length" title="Bookmarks">
            <span @click="filterByCategory = ''" class="inline-block p-2 my-4 text-purple-300 bg-purple-300/10 rounded-xl px-2 hover:bg-purple-300/25 transition-colors duration-300 cursor-pointer font-semibold text-xl">Show all bookmarks</span>
            <ul>
                <li v-for="bookmark in filteredBookmarks" :key="bookmark.id" class="mt-2">
                    <a :href="bookmark.url" target="_blank" class="font-semibold text-lg hover:text-purple-400 transition-colors duration-300">{{ bookmark.name }}</a>
                    <p class="text-xs">
                        <span class="font-bold text-purple-300">URL as plain text:</span> {{ bookmark.url }}
                    </p>
                    <div class="flex gap-2">
                        <span v-for="category in bookmark.categories" @click="filterByCategory = category.name" class="my-1 text-purple-500 bg-purple-300/10 rounded-xl px-2 hover:bg-purple-300/15 transition-colors duration-300 cursor-pointer" :key="category.id">{{ category.name }}</span>
                    </div>

                </li>
            </ul>

           <!-- Paginator -->
           <BookmarkPaginator :bookmarks="bookmarks"/>

        </Panel>
        <Panel v-else title="You don't have any bookmarks yet 🤭️">
            <p><strong>Add them any time you want to!</strong></p>
        </Panel>
        <Panel title="Add a bookmark">
            <AddBookmarkForm :user-id="auth.user.id" :bookmarks="bookmarks" />
        </Panel>
    </Layout>
</template>
