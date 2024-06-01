    <script setup>
    import { useForm } from '@inertiajs/vue3';
    import axios from 'axios';
    import { computed, onMounted, ref, watch } from 'vue';
    import { useAuthStore } from '../store/userStore';
    import BookmarkLink from "./BookmarkLink.vue";
    import BookmarkPlaintext from "./BookmarkPlaintext.vue";
    import Layout from './Layout.vue';
    import AddBookmarkForm from './components/AddBookmarkForm.vue';
    import BookmarkCategory from "./components/BookmarkCategory.vue";
    import FormSection from "./components/FormSection.vue";
    import Panel from './components/Panel.vue';
    import SubmitButton from "./components/SubmitButton.vue";
    import BookmarkPaginator from "./components/BookmarkPaginator.vue"

    defineProps({
        user: Object,
        bookmarks: Object
    });

    const bookmarksFromProps = ref(__props.bookmarks.data);
    const foundBookmarks = ref(null);
    const chosenFilter = ref(null);


    const { user } = __props;
    const auth = useAuthStore();

    if (user) {
        auth.setUser(user);
        localStorage.setItem("user", JSON.stringify(user));
    } else {
        auth.clearUser();
        localStorage.removeItem("user");
    }

    watch(() => __props.bookmarks.data, (newBookmarks) => {
        bookmarksFromProps.value = newBookmarks;

    }, { deep: true });

    watch(() => foundBookmarks.value, (newFoundBookmarks) => {
        if (newFoundBookmarks.value !== null && newFoundBookmarks.length > 0) {
            bookmarksFromProps.value = newFoundBookmarks;
        } else {
            bookmarksFromProps.value = __props.bookmarks.data;
        }
    }, { deep: true });


    const form = useForm({
        query: null,
    });

    function submit() {
        resetSearches();
        axios.get('/search?q=' + form.query.toString()).then(response => foundBookmarks.value = response.data.bookmarks).catch(error => { console.error(error); foundBookmarks.value = [] });
        form.reset();
    }

    function resetSearches() {
        chosenFilter.value = null;
        bookmarksFromProps.value = __props.bookmarks.data;
    }

    function filterByTag(tag) {
        resetSearches();
        chosenFilter.value = tag;
        axios.get('/bookmarks/filter?category=' + tag.toString()).then(response => foundBookmarks.value = response.data.bookmarks).catch(error => {
            console.error(error); foundBookmarks.value = []; bookmarksFromProps.value = __props.bookmarks.data;
        })
    }

</script>

    <template>
        <Layout>
            <Panel v-if="bookmarksFromProps.length" title="Bookmarks">
                <p class="text-sm px-1">Look for a specific bookmark here:</p>
                <hr class="mx-1 w-10">
                    <form @submit.prevent="submit" class="flex flex-wrap items-center gap-1">
                        <FormSection>
                            <input class="my-2 bg-green/15 py-3 px-4 rounded-xl placeholder-white/30 inline" v-model="form.query" />
                        </FormSection>
                        <FormSection />
                        <SubmitButton class="mt-0 mb-1">Search</SubmitButton>
                        <FormSection />
                    </form>
                <p v-if="foundBookmarks && foundBookmarks.length === 0"><strong>Could not found the bookmark you were
                        looking for.</strong></p>
                <p v-if="chosenFilter" class="my-8 bg-green/30 py-4 rounded-xl px-4 text-lg">Chosen filter: <strong
                        class="font-semibold overline text-2xl">{{ chosenFilter }}</strong></p>
                <span @click="resetSearches"
                    class="inline-block p-2 my-4 text-navy/80 bg-green/80 rounded-xl px-2 hover:bg-green transition-colors duration-300 cursor-pointer font-semibold text-xl">Show
                    all bookmarks</span>
                <ol class=" break-words list-decimal px-4 mx-2">
                    <li v-for="bookmark in bookmarksFromProps" :key="bookmark.id" class="mt-2 text-left border-b border-green hover:bg-white/10 px-2 py-2 transition-colors duration-500 rounded-xl">
                        <BookmarkLink :bookmark="bookmark" />
                        <BookmarkPlaintext :bookmark="bookmark" />
                        <div class="flex gap-2 flex-wrap my-4">
                            <BookmarkCategory v-for="category in bookmark.categories"
                                @click="filterByTag(category.name)" :key="category.id" :category="category">{{
                                    category.name }}
                            </BookmarkCategory>
                        </div>
                    </li>
                </ol>
                 <!-- Paginator -->
            <BookmarkPaginator :bookmarks="bookmarks" />
            </Panel>
            <Panel v-else title="You don't have any bookmarks yet 🤭️">
                <p><strong>Add them any time you want to!</strong></p>
            </Panel>
            <Panel title="Add a bookmark">
                <AddBookmarkForm :bookmarks="bookmarks" />
            </Panel>
        </Layout>
    </template>
