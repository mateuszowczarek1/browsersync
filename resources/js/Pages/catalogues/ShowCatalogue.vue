<script setup>
import { Link } from "@inertiajs/vue3";
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';
import { ref } from "vue";
import moment from "moment";
import BookmarkLink from "../BookmarkLink.vue";
import copy from "copy-to-clipboard";
import { useAuthStore } from "../../store/userStore.js";

defineProps({
    catalogue: Object,

});
const parsedDate = __props.catalogue && ref(moment(__props.catalogue.created_at).locale('us').format('DD/MM/YYYY h:MM'));
const auth = useAuthStore();
</script>

<template>
    <Layout>
        <Panel :title="`Catalogue: ${catalogue.is_published ? catalogue.name : 'cannot be shown'}`" class="col-span-2">
            <div v-if="catalogue.is_published" class="space-y-2 text-left">
                <div class="bg-green/5 p-4 rounded">
                    <p class="text-3xl">Author: {{ catalogue.user.name }}</p>
                    <p class="text-2xl font-light" v-if="catalogue.original_author && catalogue.original_author !== catalogue.user.name">This catalogue was cloned from: <strong>{{ catalogue.original_author }}</strong></p>
                    <p class="font-thin">Created at: {{ parsedDate }}</p>
                    <p class="text-xl">Is published: <strong>{{ catalogue.is_published ? 'Made public' : 'Private' }}</strong>
                    </p>
                </div>
                <div class="py-2 text-left">
                    <ul v-for="bookmark in catalogue.bookmarks" class="my-5 break-words">
                        <li class="rounded-xl bg-navy/45 p-4 transition-colors duration-1000 hover:bg-green/35">
                            Link:
                            <BookmarkLink :bookmark="bookmark" key="bookmark.id" />
                            <p class="mt-2 cursor-copy border-navy border-t hover:text-navy"
                                @click="copy(bookmark.url)"><strong>URL Plaintext:</strong> {{ bookmark.url }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div v-else class="text-2xl font-semibold text-center border p-4 rounded-xl">
                This catalogue does not exist or has not yet been made public by the author.
            </div>

            <div class="py-4"
                v-if="catalogue.is_published == true && auth.getUser() !== null && catalogue.user_id !== auth.getUser().id">
                <Link :href="`/catalogues/clone/${catalogue.id}`" as="button" method="post"
                    class="py-2 px-4 rounded-xl bg-green/45 inline-block cursor-pointer hover:bg-green transition-colors duration-400 mb-5">
                Add this catalogue to your own collection</Link>
            </div>
            <div class="py-4" v-else-if="!auth.getUser()">
                <Link href="/login" as="button" method="get"
                    class="py-2 px-4 rounded-xl bg-green-700 inline-block cursor-pointer hover:bg-green-600 transition-colors duration-400 mx-4 mb-5">
                Log in to manage or clone this catalogue</Link>
            </div>
            <div v-if="auth.getUser() && auth.getUser().id === catalogue.user_id" class="bg-white/10 rounded-xl my-5">
                <div class="font-semibold py-2 px-4 text-xl mb-4">
                    You own this catalogue.
                </div>
                <div class="flex flex-wrap gap-4">
                    <Link :href="`/catalogues/edit/${catalogue.id}`" as="button" method="get"
                        class="py-2 px-4 rounded-xl bg-green/45 inline-block cursor-pointer hover:bg-green transition-colors duration-300 mx-4 mb-5">
                    Edit it here</Link>
                    <Link :href="`/catalogues/edit/${catalogue.id}`" as="button" method="delete"
                        class="py-2 px-4 rounded-xl bg-green/25 inline-block cursor-pointer hover:bg-green transition-colors duration-300 mx-4 mb-5">
                    Or delete it here</Link>
                </div>



            </div>
        </Panel>
    </Layout>
</template>
