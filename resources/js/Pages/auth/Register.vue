<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';
import FormSection from '../components/FormSection.vue';
import FormLabel from '../components/FormLabel.vue';
import FormErrorMessage from '../components/FormErrorMessage.vue';
import SubmitButton from '../components/SubmitButton.vue';
import FormInput from '../components/FormInput.vue'

const form = useForm({
    name: null,
    email: null,
    avatar: "https://picsum.photos/50/50",
    password: null,
});

function submit() {
    form.post('/register');
}


</script>
<template>
    <Layout>
        <Panel title="Create a new user" class="col-span-2">
            <form @submit.prevent="submit" class="mx-2 my-2">
                <FormSection>
                    <FormLabel label-for="name">Username:</FormLabel>
                    <FormInput type="text" id="name" name="name" placeholder="Your Name"
                        @updateForm="(value) => form.name = value" required min="8" max="100" />
                    <FormErrorMessage v-if="form.errors.name">{{ form.errors.name }}</FormErrorMessage>
                </FormSection>

                <FormSection>
                    <FormLabel label-for="email">Email:</FormLabel>
                    <FormInput type="email" id="email" name="email" placeholder="Email address" @updateForm="(value) => form.email = value"
                        required min="5" max="254" />
                    <FormErrorMessage v-if="form.errors.email">{{ form.errors.email }}</FormErrorMessage>
                </FormSection>

                <FormSection>
                    <FormLabel label-for="avatar">Avatar Url:
                        <p class="xl:max-w-[15%] md:max-w-[20%] text-justify text-xs">You don't need to change it, it is
                            not required. You can keep the placeholder as your avatar.</p>
                    </FormLabel>
                    <FormInput type="url" id="avatar" name="avatar" @updateForm="(value) => form.avatar = value" :value="form.avatar" min="20"
                        max="200" required />
                    <FormErrorMessage v-if="form.errors.avatar">{{ form.errors.avatar }}</FormErrorMessage>
                </FormSection>

                <FormSection>
                    <FormLabel label-for="password">Password:</FormLabel>
                    <FormInput type="password" id="password" name="password" @updateForm="(value) => form.password = value" required min="5"
                        max="100" />
                    <FormErrorMessage v-if="form.errors.password">{{ form.errors.password }}</FormErrorMessage>
                </FormSection>

                <FormSection>
                    <SubmitButton>Register</SubmitButton>
                </FormSection>
            </form>
        </Panel>
    </Layout>
</template>
