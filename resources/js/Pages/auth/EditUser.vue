<script setup>
import { useForm } from '@inertiajs/vue3';

import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';
import FormSection from '../components/FormSection.vue';
import FormLabel from '../components/FormLabel.vue';
import FormErrorMessage from '../components/FormErrorMessage.vue';
import SubmitButton from '../components/SubmitButton.vue';
import FormInput from '../components/FormInput.vue';



defineProps({
    user: Object
})

const {user} = __props;

const form = useForm({
    name: user.name,
    password: null,
    avatar: user.avatar,
});

function submit() {
    form.put('/user');
}
</script>
<template>
    <Layout>
        <Panel title="Edit user Info">
            <form @submit.prevent="submit" class="mx-2 my-2 text-purple-950">

                <FormSection>
                    <FormLabel label-for="name">Name:</FormLabel>
                    <FormInput type="string" id="name" name="name" :value="form.name" @updateForm="(value) => form.name = value" required min="8" max="100" />
                    <FormErrorMessage v-if="form.errors.name">{{ form.errors.name }}</FormErrorMessage>
                </FormSection>
                <FormSection>
                    <FormLabel label-for="password">Password:</FormLabel>
                    <FormInput type="password" id="password" name="password" @updateForm="(value) => form.password = value" required min="5" max="100" />
                    <FormErrorMessage v-if="form.errors.password">{{ form.errors.password }}</FormErrorMessage>
                </FormSection>
                <FormSection>
                    <FormLabel label-for="avatar">Avatar:</FormLabel>
                    <FormInput type="url" id="avatar" name="avatar" :value="form.avatar" @updateForm="(value) => form.avatar = value" required min="5" max="100" />
                    <FormErrorMessage v-if="form.errors.avatar">{{ form.errors.avatar }}</FormErrorMessage>
                </FormSection>
                <FormSection>
                    <SubmitButton>Edit User</SubmitButton>
                </FormSection>
            </form>
        </Panel>
        <Panel title="How to do it...">
            <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore ullam, quaerat voluptates doloremque quo quos quasi explicabo distinctio, quis in eligendi beatae dolor animi, quas officia porro blanditiis maiores impedit.</div>
        </Panel>
    </Layout>
</template>
