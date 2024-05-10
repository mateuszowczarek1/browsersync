<script setup>
import { useForm } from '@inertiajs/vue3';
defineProps({
    userId: Number,
    bookmarks: Object
});

const form = useForm({
    url: null,
    name: null,
    userId: __props.userId,
    mainCategory: 'uncategorized',
    newCategories: '',
});

function submit() {
    if (form.newCategories.trim() !== '') {
        form.newCategories = form.newCategories.split(',').map(cat => cat.trim());
    }
    form.post('/bookmarks/add');
    form.reset();
}

function checkMainCategory()
{
    if(form.mainCategory === 'uncategorized')
    {
        form.mainCategory = '';
        return;
    }
}
</script>

<template>
    <form @submit.prevent="submit" class="mx-auto my-2 text-purple-950">
        <div>
            <label for="url" class="block text-sm font-medium leading-6 text-purple-200 my-2">Bookmark Url:</label>
            <input v-model="form.url" type="url" id="url" name="url" placeholder="https://example.com"
                class="my-2 bg-purple-400 p-2 rounded-xl placeholder-purple-600" required min="10" max="500" />
            <p v-if="form.errors.url" class="text-xs text-purple-300 px-2 py-2 border-red-600">{{ form.errors.url }}</p>
        </div>
        <div>
            <label for="name" class="block text-sm font-medium leading-6 text-purple-200 my-2">Bookmark name:</label>
            <input v-model="form.name" type="text" id="name" name="name"
                class="my-2 bg-purple-400 p-2 rounded-xl placeholder-purple-600" placeholder="the best website" required
                min="5" max="100" />
            <p v-if="form.errors.name" class="text-xs text-purple-300 px-2 py-2 border-red-600">{{ form.errors.name }}
            </p>
        </div>
        <div>
            <label for="mainCategory" class="block text-sm font-medium leading-6 text-purple-200 my-2">Bookmark categories:</label>
            <select v-model="form.mainCategory" id="mainCategory" name="mainCategory" class="my-2 bg-purple-400 p-2 rounded-xl">
                <option value="uncategorized" selected>Uncategorized</option>
                <option v-for="bookmark in bookmarks.data" :key="bookmark.id" :value="bookmark.name">{{ bookmark.name }}</option>
            </select>
        </div>
        <div>
            <label for="newCategories" class="block text-sm font-medium leading-6 text-purple-200 my-2">You can also add new categories. Separate them with a comma</label>
            <input v-model="form.newCategories" type="text" id="newCategories" name="newCategories" placeholder="Add new categories separated by commas"
                class="my-2 bg-purple-400 p-2 rounded-xl placeholder-purple-600" @input="checkMainCategory" />
        </div>
        <div>
            <button type="submit"
                class="bg-purple-900 text-white p-2 rounded-xl my-4 border-2 border-transparent hover:border-purple-100 transition-colors duration-300">Add
                a bookmark</button>
        </div>
        <input type="hidden" id="userId" name="userId" :value="userId" />
    </form>
</template>
