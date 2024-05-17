<script setup>
import Layout from './Layout.vue';
import Panel from './components/Panel.vue';
import BookmarkLink from "./BookmarkLink.vue";
import BookmarkPlaintext from "./BookmarkPlaintext.vue";
import BookmarkCategory from "./components/BookmarkCategory.vue";

defineProps({
    user: Object,
    bookmarks: Object
});
</script>

<template>
    <Layout>
        <Panel v-if="bookmarks.length" title="Search bookmarks" class="col-span-2">

            <span @click="$inertia.visit('/')"
                  class="inline-block p-2 my-4 text-purple-300 bg-purple-300/10 rounded-xl px-2 hover:bg-purple-300/25 transition-colors duration-300 cursor-pointer font-semibold text-xl">Show
                all bookmarks</span>
            <ul class=" break-words">
                <li v-for="bookmark in bookmarks" :key="bookmark.id" class="mt-2">
                    <BookmarkLink :bookmark="bookmark"/>
                    <BookmarkPlaintext :bookmark="bookmark"/>
                    <div class="flex gap-2 flex-wrap mt-2 border-b border-purple-600">
                        <BookmarkCategory v-for="category in bookmark.categories"
                                          :key="category.id" :category="category">{{ category.name }}
                        </BookmarkCategory>
                    </div>

                </li>
            </ul>

        </Panel>
        <Panel v-else title="No bookmarks were found 🤭️" class="col-span-2">
              <span @click="$inertia.visit('/')"
                    class="inline-block p-2 my-4 text-purple-300 bg-purple-300/10 rounded-xl px-2 hover:bg-purple-300/25 transition-colors duration-300 cursor-pointer font-semibold text-xl">Show
                all bookmarks</span>
            <p><strong>Go back and try again :)</strong></p>
        </Panel>

    </Layout>
</template>
