<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue';

const form = useForm({
    email: null,
    password:null,
});

function submit() {
    form.post('/login');
}
</script>
<template>
    <Layout>
        <Panel title="Log in">
            <form @submit.prevent="submit" class="mx-2 my-2 text-purple-950">

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-purple-200 my-2">
                    Email:
                </label>
                <input type="email" id="email" name="email" placeholder="Email address" v-model="form.email" class="my-2 bg-purple-400 p-2 rounded-xl placeholder-purple-600" required min="5" max="254"/>
                <p v-if="form.errors.email"class="text-xs text-purple-300 px-2 py-2 border-red-600">{{ form.errors.email }}</p>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-purple-200 my-2">
                    Password:
                </label>
                <input type="password" id="password" name="password" v-model="form.password" class="my-2 bg-purple-400 p-2 rounded-xl" required  min="5" max="100"/>
                <p v-if="form.errors.password"class="text-xs text-purple-300 px-2 py-2 border-red-600">{{ form.errors.password }}</p>
                </div>
                <div>
                    <button type="submit" class="bg-purple-900 text-white p-2 rounded-xl my-4 border-2 border-transparent hover:border-purple-100 transition-colors duration-300">Log in</button>
                </div>
            </form>
        </Panel>
    </Layout>
</template>
