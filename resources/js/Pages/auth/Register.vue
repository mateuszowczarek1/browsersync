<script setup>
import {reactive} from 'vue';
import { router } from '@inertiajs/vue3'
import Layout from '../Layout.vue';
import Panel from '../components/Panel.vue'

defineProps({
    errors: Object
})

const form = reactive({
    name: null,
    email: null,
    avatar: "https://picsum.photos/50/50",
    password:null,
});

function submit() {
    router.post('/register', form);
}
</script>
<template>
    <Layout>
        <Panel title="Create a new user">
            <form @submit.prevent="submit" class="mx-2 my-2 text-purple-950">
                <div>
                    <label for="name" class="block text-sm font-medium leading-6 text-purple-200 my-2">
                    Username:
                </label>
                <input type="text" id="name" name="name" placeholder="Your Name" v-model="form.name" class="my-2 bg-purple-400 p-2 rounded-xl placeholder-purple-600" required min="8" max="100"/>
                <p v-if="errors.name"class="text-xs text-purple-300 px-2 py-2 border-red-600">{{ errors.name }}</p>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-purple-200 my-2">
                    Email:
                </label>
                <input type="email" id="email" name="email" placeholder="Email address" v-model="form.email" class="my-2 bg-purple-400 p-2 rounded-xl placeholder-purple-600" required min="5" max="254"/>
                <p v-if="errors.email"class="text-xs text-purple-300 px-2 py-2 border-red-600">{{ errors.email }}</p>
                </div>

                <div>
                    <label for="avatar" class="block text-sm font-medium leading-6 text-purple-200 my-2">
                    Avatar Url:
                    <p class="max-w-[15%] text-justify text-xs">You don't need to change it, it is not required. You can keep the placeholder as your avatar.</p>
                </label>
                <input type="url" id="avatar" name="avatar" v-model="form.avatar" class="my-2 bg-purple-400 p-2 rounded-xl placeholder-purple-600" min="20" max="500" required />
                <p v-if="errors.avatar"class="text-xs text-purple-300 px-2 py-2 border-red-600">{{ errors.avatar }}</p>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-purple-200 my-2">
                    Password:
                </label>
                <input type="password" id="password" name="password" v-model="form.password" class="my-2 bg-purple-400 p-2 rounded-xl" required  min="5" max="100"/>
                <p v-if="errors.password"class="text-xs text-purple-300 px-2 py-2 border-red-600">{{ errors.password }}</p>
                </div>
                <div>
                    <button type="submit" class="bg-purple-900 text-white p-2 rounded-xl my-4 border-2 border-transparent hover:border-purple-100 transition-colors duration-300">Register</button>
                </div>
            </form>
        </Panel>
    </Layout>
</template>
