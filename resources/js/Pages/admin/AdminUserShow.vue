<script setup>
import { useForm, Link } from '@inertiajs/vue3';
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

const { user } = __props;

const form = useForm({
    name: user.name,
    email: user.email,
    avatar: user.avatar,
    id: user.id
});

function submit() {
    form.put('/admin/user/edit');
}

</script>
<template>
    <Layout>
        <Panel title="Admin dashboard users" class="col-span-2">
            <section>
                <form @submit.prevent="submit" class="mx-2 my-2">

                    <FormSection>
                        <FormLabel label-for="name">Name:</FormLabel>
                        <FormInput type="string" id="name" name="name" :value="user.name"
                            @updateForm="(value) => form.name = value" required min="8" max="100" />
                        <FormErrorMessage v-if="form.errors.name">{{ form.errors.name }}</FormErrorMessage>
                    </FormSection>
                    <FormSection>
                        <FormLabel label-for="email">Email:</FormLabel>
                        <FormInput type="email" id="email" name="email" :value="user.email"
                            @updateForm="(value) => form.email = value" required min="5" max="254" />
                        <FormErrorMessage v-if="form.errors.email">{{ form.errors.email }}</FormErrorMessage>
                    </FormSection>
                    <FormSection>
                        <FormLabel label-for="avatar">Avatar:</FormLabel>
                        <FormInput type="url" id="avatar" name="avatar" :value="user.avatar"
                            @updateForm="(value) => form.avatar = value" required min="5" max="100" />
                        <FormErrorMessage v-if="form.errors.avatar">{{ form.errors.avatar }}</FormErrorMessage>
                    </FormSection>
                    <FormSection>
                        <SubmitButton>Edit User</SubmitButton>
                    </FormSection>
                </form>
            </section>
            <section>
                <Link :href="`/admin/users`" as="button" method="get"
                    class="inline-block p-2 border-2 border-dotted my-4">Go Back
                </Link>
            </section>
        </Panel>
    </Layout>
</template>
