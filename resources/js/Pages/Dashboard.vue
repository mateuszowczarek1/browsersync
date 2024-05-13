<script setup>
import {useAuthStore} from '../store/userStore';
import {computed, ref, watch} from 'vue';
import Layout from './Layout.vue';
import Panel from './components/Panel.vue';
import BookmarkPaginator from './components/BookmarkPaginator.vue';
import AddBookmarkForm from './components/AddBookmarkForm.vue';
import BookmarkLink from "./BookmarkLink.vue";
import BookmarkPlaintext from "./BookmarkPlaintext.vue";
import BookmarkCategory from "./components/BookmarkCategory.vue";

defineProps({
    user: Object,
    bookmarks: Object
});

const {user} = __props;
const auth = useAuthStore();
if (user) {
    auth.setUser(user);
    localStorage.setItem("user", JSON.stringify(user));
}

const filterByCategory = ref('');

const filteredBookmarks = computed(() => {
    if (!filterByCategory.value) {
        return __props.bookmarks.data;
    } else {
        return __props.bookmarks.data.filter(bookmark =>
            bookmark.categories.some(cat => cat.name === filterByCategory.value)
        );
    }
});

watch(() => __props.bookmarks, (newBookmarks) => {
    if (!filterByCategory.value) {
        filteredBookmarks.value = newBookmarks.data;
    }
}, {deep: true});


</script>

<template>
    <Layout>
        <Panel v-if="bookmarks.data.length" title="Bookmarks">
            <span @click="filterByCategory = ''"
                  class="inline-block p-2 my-4 text-purple-300 bg-purple-300/10 rounded-xl px-2 hover:bg-purple-300/25 transition-colors duration-300 cursor-pointer font-semibold text-xl">Show
                all bookmarks</span>
            <ul class=" break-words">
                <li v-for="bookmark in filteredBookmarks" :key="bookmark.id" class="mt-2">
                    <BookmarkLink :bookmark="bookmark"/>
                    <BookmarkPlaintext :bookmark="bookmark"/>
                    <div class="flex gap-2">
                        <BookmarkCategory v-for="category in bookmark.categories"
                                          @click="filterByCategory = category.name"
                                          :key="category.id"  :category="category">{{ category.name }}
                        </BookmarkCategory>
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
            <AddBookmarkForm :user-id="auth.user.id" :bookmarks="bookmarks"/>
        </Panel>

    </Layout>
</template>
