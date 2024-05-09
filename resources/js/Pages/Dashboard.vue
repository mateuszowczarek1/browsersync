<script setup>
import { useAuthStore } from '../store/userStore';

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
</script>

<template>
    <Layout>
        <Panel v-if="bookmarks.data.length" title="Bookmarks">
            <ul>
                <li v-for="bookmark in bookmarks.data" :key="bookmark.id">
                    <a :href="bookmark.url" target="_blank">{{ bookmark.name }}</a>
                    <p class="text-xs">
                        <span class="font-bold text-purple-300">URL as plain text:</span> {{ bookmark.url }}
                    </p>
                    <span v-for="category in bookmark.categories" :key="category.id">{{ category.name }}</span>
                </li>
            </ul>

           <!-- Paginator -->
           <BookmarkPaginator :bookmarks="bookmarks"/>

        </Panel>
        <Panel v-else title="You don't have any bookmarks yet 🤭️">
            <p><strong>Add them any time you want to!</strong></p>
        </Panel>
        <Panel title="Add a bookmark">
            <AddBookmarkForm :user-id="auth.user.id" />
        </Panel>
    </Layout>
</template>
