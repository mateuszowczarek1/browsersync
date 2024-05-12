<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';
import FormSection from '../components/FormSection.vue';
import FormLabel from '../components/FormLabel.vue';
import FormErrorMessage from '../components/FormErrorMessage.vue';
import SubmitButton from '../components/SubmitButton.vue';
import FormInput from '../components/FormInput.vue';

const form = useForm({
    email: null,
    password: null,
});

function submit() {
    form.post('/login');
}
</script>
<template>
    <Layout>
        <Panel title="Log in" class="col-span-2">
            <form @submit.prevent="submit" class="mx-2 my-2 text-purple-950">

                <FormSection>
                    <FormLabel label-for="email">Email:</FormLabel>
                    <FormInput type="email" id="email" name="email" placeholder="Email address" @updateForm="(value) => form.email = value" required min="5" max="254" />
                    <FormErrorMessage v-if="form.errors.email">{{ form.errors.email }}</FormErrorMessage>
                </FormSection>
                <FormSection>
                    <FormLabel label-for="password">Password:</FormLabel>
                    <FormInput type="password" id="password" name="password" @updateForm="(value) => form.password = value" required min="5" max="100" />
                    <FormErrorMessage v-if="form.errors.password">{{ form.errors.password }}</FormErrorMessage>
                </FormSection>
                <FormSection>
                    <SubmitButton>Log in</SubmitButton>
                </FormSection>
            </form>
        </Panel>
    </Layout>
</template>
