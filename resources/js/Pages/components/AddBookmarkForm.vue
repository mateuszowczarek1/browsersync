<script setup>
import { useForm } from '@inertiajs/vue3';
defineProps({
    userId: Number
});

const form = useForm({
    url: null,
    name: null,
    userId: __props.userId,
});

function submit() {
    form.post('/bookmarks/add');
    form.reset();
}
</script>

<template>
    <form @submit.prevent="submit" class="mx-auto my-2 text-purple-950">
        <div>
            <label for="url" class="block text-sm font-medium leading-6 text-purple-200 my-2">Bookmark Url:</label>
            <input v-model="form.url" type="url" id="url" name="url" placeholder="https://example.com" class="my-2 bg-purple-400 p-2 rounded-xl placeholder-purple-600" required min="10" max="500"/>
            <p v-if="form.errors.url" class="text-xs text-purple-300 px-2 py-2 border-red-600">{{ form.errors.url }}</p>
        </div>
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-purple-200 my-2">Bookmark name:</label>
            <input v-model="form.name" type="text" id="name" name="name" class="my-2 bg-purple-400 p-2 rounded-xl placeholder-purple-600" placeholder="the best website" required  min="5" max="100"/>
            <p v-if="form.errors.name" class="text-xs text-purple-300 px-2 py-2 border-red-600">{{ form.errors.name }}</p>
        </div>
        <div>
            <button type="submit" class="bg-purple-900 text-white p-2 rounded-xl my-4 border-2 border-transparent hover:border-purple-100 transition-colors duration-300">Add a bookmark</button>
        </div>
        <input type="hidden" id="userId" name="userId" :value="userId" />
    </form>
</template>
