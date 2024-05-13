<script setup>
import {computed} from 'vue';
import {Link, useForm} from '@inertiajs/vue3';
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';
import BookmarkCategory from "../components/BookmarkCategory.vue";
import FormErrorMessage from "../components/FormErrorMessage.vue";
import FormInput from "../components/FormInput.vue";
import FormSection from "../components/FormSection.vue";
import FormLabel from "../components/FormLabel.vue";
import SubmitButton from "../components/SubmitButton.vue";

defineProps({
    catalogue: Object,
    bookmarks: Object
});

const form = useForm({
    name: __props.catalogue.name,
    is_published: __props.catalogue.is_published,
    bookmarks: [... __props.catalogue.bookmarks.map(el => el.id)],
});

function submit(){
    form.put('/catalogues/edit/' + __props.catalogue.id.toString());
}
</script>

<template>
    <Layout>
        <Panel title="Edit Your Catalogue">
            <div class="flex gap-4 font-semibold flex-wrap">
                <form @submit.prevent="submit" class="mx-2 my-2 text-purple-950">
                    <FormSection>
                        <FormLabel label-for="name">Catalogue name:</FormLabel>
                        <FormInput type="string" id="name" name="name" :value="form.name"
                                   @updateForm="(value) => form.name = value" required min="8" max="100" />
                        <FormErrorMessage v-if="form.errors.name">{{ form.errors.name }}</FormErrorMessage>
                    </FormSection>
                    <FormSection>
                        <FormLabel label-for="is_published">Should your catalogue be public?</FormLabel>
                        <fieldset id="is_published" name="is_published" class="flex items-center bg-white/20 text-purple-200 gap-2 p-4 rounded-xl">
                            <label for="yes">Make public</label>
                            <input type="radio" id="yes" name="yes" value="1" v-model="form.is_published" />
                            <label for="no">Make private</label>
                            <input type="radio" id="no" name="no" value="0" v-model="form.is_published" />
                        </fieldset>
                        <FormErrorMessage v-if="form.errors.is_published">{{ form.errors.is_published }}</FormErrorMessage>
                    </FormSection>
                    <FormSection>
                        <FormLabel label-for="bookmarks">Select bookmarks to add for this catalogue</FormLabel>
                        <div class="flex gap-2 flex-wrap items-center bg-white/20 p-4 rounded-xl text-purple-200">
                            <div v-for="bookmark in bookmarks" :key="bookmark.id" class="space-x-4">
                                <input type="checkbox" :id="`bookmark_${bookmark.id}`" :value="bookmark.id" v-model="form.bookmarks" :checked="form.bookmarks.includes(bookmark.id)" />
                                <label :for="`bookmark_${bookmark.id}`">{{ bookmark.name }}</label>
                            </div>
                        </div>
                    </FormSection>
                    <FormSection>
                        <SubmitButton>Edit Catalogue</SubmitButton>
                    </FormSection>
                </form>
            </div>
        </Panel>
        <Panel title="Your bookmark database">
            <div>
               <ul class="flex gap-5 flex-wrap">
                   <li v-for="bookmark in bookmarks" class="block border border-purple-600 p-2 mt-2 mb-7 rounded-xl">
                       {{bookmark.name}}
                   </li>
               </ul>
            </div>
        </Panel>
    </Layout>
</template>
