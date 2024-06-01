<script setup>
import { useForm } from '@inertiajs/vue3';

import Panel from '../components/Panel.vue';
import Layout from '../Layout.vue';
import FormSection from '../components/FormSection.vue';
import FormLabel from '../components/FormLabel.vue';
import FormInput from '../components/FormInput.vue';
import FormErrorMessage from '../components/FormErrorMessage.vue';
import SubmitButton from '../components/SubmitButton.vue';


defineProps({
    user: Object,
})

const form = useForm({
    name: null,
    isPublished: false,
});

function submit() {
    form.isPublished = form.isPublished && true;
    form.post('/catalogues/add');
}

</script>
<template>
    <Layout>
        <Panel title="Create your bookmark catalogue" class="col-span-2">
            <form @submit.prevent="submit" class="mx-2 my-2 ">
                <FormSection>
                    <FormLabel label-for="email">Catalogue Name:</FormLabel>
                    <FormInput type="string" id="name" name="name" placeholder="Catalogue name"
                        @updateForm="(value) => form.name = value" required min="5" max="150" />
                    <FormErrorMessage v-if="form.errors.name">{{ form.errors.name }}</FormErrorMessage>
                </FormSection>
                <FormSection>
                    <FormLabel label-for="is-published">Should your catalogue be visible already?</FormLabel>
                    <FormInput type="checkbox" class="w-8 h-8 focus:ring-2 ring-green" id="is-published" name="is-published"
                        @updateForm="(value) => form.isPublished = value" />
                    </FormSection>
                    <FormSection>
                    <SubmitButton>Create catalogue</SubmitButton>
                </FormSection>
            </form>
        </Panel>
    </Layout>
</template>
