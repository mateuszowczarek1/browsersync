<script setup>
import { useAuthStore } from '../store/userStore';
import { computed, ref, watch } from 'vue';
import Layout from './Layout.vue';
import Panel from './components/Panel.vue';
import AddBookmarkForm from './components/AddBookmarkForm.vue';
import BookmarkLink from "./BookmarkLink.vue";
import BookmarkPlaintext from "./BookmarkPlaintext.vue";
import BookmarkCategory from "./components/BookmarkCategory.vue";
import SubmitButton from "./components/SubmitButton.vue";
import FormInput from "./components/FormInput.vue";
import FormSection from "./components/FormSection.vue";

defineProps({
    user: Object,
    bookmarks: Object
});

const { user } = __props;
const auth = useAuthStore();

if (user) {
    auth.setUser(user);
    localStorage.setItem("user", JSON.stringify(user));
} else {
    auth.clearUser();
    localStorage.removeItem("user");
}

const filterByCategory = ref('');
const tempQuery = ref('');
const query = ref('');

const filteredBookmarks = computed(() => {
    let filtered = __props.bookmarks;
    if (filterByCategory.value) {
        filtered = filtered.filter(bookmark =>
            bookmark.categories.some(cat => cat.name === filterByCategory.value)
        );
    }
    if (query.value) {
        const regex = new RegExp(query.value, 'i');
        filtered = filtered.filter(bookmark => regex.test(bookmark.name));
    }
    return filtered;
});

watch(() => __props.bookmarks, (newBookmarks) => {
    if (!filterByCategory.value) {
        filteredBookmarks.value = newBookmarks.data;
    }
}, { deep: true });

function searchByName() {
filterByCategory.value = '';
query.value = tempQuery.value;
}

function clearSearches() {
filterByCategory.value = '';
query.value = '';
tempQuery.value = '';
}


</script>

<template>
    <Layout>
        <Panel v-if="bookmarks.length" title="Bookmarks">

            <form @submit.prevent="searchByName">
                <FormSection>
                    <FormInput type="text" name="q" id="q" @updateForm="(value) => tempQuery = value"  />
                </FormSection>
                <FormSection />
                <SubmitButton>Search</SubmitButton>
                <FormSection />
            </form>
            <span @click="clearSearches"
                class="inline-block p-2 my-4 text-purple-300 bg-purple-300/10 rounded-xl px-2 hover:bg-purple-300/25 transition-colors duration-300 cursor-pointer font-semibold text-xl">Show
                all bookmarks</span>
            <ul class=" break-words">
                <li v-for="bookmark in filteredBookmarks" :key="bookmark.id" class="mt-2 text-left">
                    <BookmarkLink :bookmark="bookmark" />
                    <BookmarkPlaintext :bookmark="bookmark" />
                    <div class="flex gap-2 flex-wrap mt-2 border-b border-purple-600">
                        <BookmarkCategory v-for="category in bookmark.categories"
                            @click="filterByCategory = category.name" :key="category.id" :category="category">{{
                            category.name }}
                        </BookmarkCategory>
                    </div>
                </li>
            </ul>
        </Panel>
        <Panel v-else title="You don't have any bookmarks yet 🤭️">
            <p><strong>Add them any time you want to!</strong></p>
        </Panel>
        <Panel title="Add a bookmark">
            <AddBookmarkForm :bookmarks="bookmarks" />
        </Panel>
    </Layout>
</template>
