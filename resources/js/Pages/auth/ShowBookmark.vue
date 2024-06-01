<script setup>
import { useForm, Link} from '@inertiajs/vue3';
import {computed} from 'vue';
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';
import FormSection from '../components/FormSection.vue';
import FormLabel from '../components/FormLabel.vue';
import FormInput from '../components/FormInput.vue';
import SubmitButton from '../components/SubmitButton.vue';
import FormErrorMessage from '../components/FormErrorMessage.vue'

defineProps({
    bookmark: Object
});

const categories = computed(() => {
    return __props.bookmark.categories.map(el => el.name).join(',');
})

const form = useForm({
    name: __props.bookmark.name,
    url: __props.bookmark.url,
    categories: categories.value,
});

function submit(){
    form.categories = form.categories.split(',').map(el => el.trim());
    form.patch('/bookmarks/' + __props.bookmark.id.toString())
}
</script>

<template>
    <Layout>
        <Panel title="Edit Bookmark" class="col-span-2">
            <form @submit.prevent="submit" class="mx-2 my-2">

                <FormSection>
                    <FormLabel label-for="name">Name:</FormLabel>
                    <FormInput type="string" id="name" name="name" :value="form.name"
                        @updateForm="(value) => form.name = value" required min="8" max="100" />
                    <FormErrorMessage v-if="form.errors.name">{{ form.errors.name }}</FormErrorMessage>
                </FormSection>
                <FormSection>
                    <FormLabel label-for="url">Url:</FormLabel>
                    <FormInput type="url" id="url" name="url" @updateForm="(value) => form.url = value" required min="5"
                        max="100" :value="form.url" />
                    <FormErrorMessage v-if="form.errors.url">{{ form.errors.url }}</FormErrorMessage>
                </FormSection>
                <FormSection>
                    <FormLabel label-for="categories">Categories:</FormLabel>
                    <FormInput type="string" id="categories" name="categories" :value="form.categories"
                        @updateForm="(value) => form.categories = value" required  />
                    <FormErrorMessage v-if="form.errors.categories">{{ form.errors.categories }}</FormErrorMessage>
                </FormSection>
                <FormSection>
                    <SubmitButton>Edit Bookmark</SubmitButton>
                </FormSection>
            </form>
            <Link :href="`/bookmarks/${bookmark.id}`" as="button" method="delete" class="inline-block p-2 border-2 border-dotted border-red-500 rounded-xl hover:bg-red-600/10 my-4">🗑️ Delete this bookmark</Link>
        </Panel>
    </Layout>
</template>
