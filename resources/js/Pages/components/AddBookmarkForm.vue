<script setup>
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { onMounted, ref, watch } from 'vue';

defineProps({
    bookmarks: Object
});

onMounted(async () => await updateUniqueCategories());

watch(() => __props.bookmarks, async () => {
    await updateUniqueCategories();
});

const form = useForm({
    url: null,
    name: null,
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

function checkMainCategory() {
    if (form.mainCategory === 'uncategorized') {
        form.mainCategory = '';
        return;
    }
}
const uniqueCategories = ref([]);

async function updateUniqueCategories() {
    try {
        const response = await axios.get('/categories/refresh');
        uniqueCategories.value = response.data;
    } catch (error) {
        console.error('Error fetching categories:', error);
        uniqueCategories.value = [];
    }
}


</script>

<template>
    <form @submit.prevent="submit" class="mx-auto my-2 ">
        <div>
            <label for="url" class="block text-sm font-medium leading-6 my-2">Bookmark Url:</label>
            <input v-model="form.url" type="url" id="url" name="url" placeholder="https://example.com"
                class="my-2 bg-green/15 p-2 rounded-xl placeholder-white/30" required min="10" max="500" />
            <p v-if="form.errors.url" class="text-xs text-red-400 px-2 py-2 border-red-500">{{ form.errors.url }}</p>
        </div>
        <div>
            <label for="name" class="block text-sm font-medium leading-6 my-2">Bookmark name:</label>
            <input v-model="form.name" type="text" id="name" name="name"
                class="my-2 bg-green/15 p-2 rounded-xl placeholder-white/30" placeholder="the best website" required
                min="5" max="100" />
            <p v-if="form.errors.name" class="text-xs text-red-400 px-2 py-2 border-red-500">{{ form.errors.name }}
            </p>
        </div>
        <div>
            <label for="mainCategory" class="block text-sm font-medium leading-6 my-2">Bookmark
                categories:
                <p class="text-[0.7rem]">List of previously added categories.</p>
            </label>
            <select v-model="form.mainCategory" id="mainCategory" name="mainCategory"
                class="my-2 bg-green/15 p-2 rounded-xl px-4">
                <option value="uncategorized"selected class="bg-navy">Uncategorized</option>
                <option v-for="category in uniqueCategories.categories" class="bg-navy" :key="category.id" :value="category.name">{{ category.name
                    }}</option>
            </select>
        </div>
        <div>
            <label for="newCategories" class="block text-sm font-medium leading-6 my-2">You can also add
                new categories. Separate them with a comma</label>
            <input v-model="form.newCategories" type="text" id="newCategories" name="newCategories"
                placeholder="shopping, groceries"
                class="my-2 bg-green/15 p-2 rounded-xl placeholder-white/30 px-4" @input="checkMainCategory" />
        </div>
        <div>
            <button type="submit"
                class="bg-green text-white p-2 rounded-xl my-4 border-2 border-transparent hover:border-white transition-colors duration-300">
                Add
                a bookmark
            </button>
        </div>
    </form>
</template>
