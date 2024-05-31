    <script setup>
    import { useForm } from '@inertiajs/vue3';
    import axios from 'axios';
    import { computed, ref, watch } from 'vue';
    import { useAuthStore } from '../store/userStore';
    import BookmarkLink from "./BookmarkLink.vue";
    import BookmarkPlaintext from "./BookmarkPlaintext.vue";
    import Layout from './Layout.vue';
    import AddBookmarkForm from './components/AddBookmarkForm.vue';
    import BookmarkCategory from "./components/BookmarkCategory.vue";
    import FormSection from "./components/FormSection.vue";
    import Panel from './components/Panel.vue';
    import SubmitButton from "./components/SubmitButton.vue";

    defineProps({
        user: Object,
        bookmarks: Object
    });

    const bookmarks = ref(__props.bookmarks);
    const foundBookmarks = ref(null);


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

    const filteredBookmarks = computed(() => {
        let filtered = bookmarks.value;
        if (filterByCategory.value) {
            filtered = filtered.filter(bookmark =>
                bookmark.categories.some(cat => cat.name === filterByCategory.value)
            );
        }
        return filtered;
    });

    watch(() => __props.bookmarks, (newBookmarks) => {
        bookmarks.value = newBookmarks;

    }, { deep: true });

    watch(() => foundBookmarks.value, (newFoundBookmarks) => {
    if (newFoundBookmarks.value !== null && newFoundBookmarks.length > 0) {
        bookmarks.value = newFoundBookmarks;
    } else {
        bookmarks.value = __props.bookmarks;
    }
}, {deep: true});
    const form = useForm({
        query: null,
    });

    function submit() {
        filterByCategory.value = '';
        axios.get('/search?q=' + form.query.toString()).then(response => foundBookmarks.value = response.data.bookmarks).catch(error => { console.error(error); foundBookmarks.value = [] });
        form.reset();
    }

    function resetSearches()
    {
        filterByCategory.value = '';
        bookmarks.value = __props.bookmarks;
        }

    </script>

    <template>
        <Layout>
            <Panel v-if="bookmarks.length" title="Bookmarks">

                <form @submit.prevent="submit">
                    <FormSection>
                        <input class="my-2 bg-purple-400 p-2 rounded-xl placeholder-purple-600" v-model="form.query" />
                    </FormSection>
                    <FormSection />
                    <SubmitButton>Search</SubmitButton>
                    <FormSection />
                </form>
                <p v-if="foundBookmarks && foundBookmarks.length === 0"><strong>Could not found the bookmark you were looking for.</strong></p>
                <p v-if="filterByCategory" class="my-2 text-lg">Chosen filter: <strong class="font-semibold overline text-xl text-purple-300">{{ filterByCategory }}</strong></p>
                <span @click="resetSearches"
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
