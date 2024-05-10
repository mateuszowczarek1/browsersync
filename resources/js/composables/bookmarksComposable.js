import { ref } from 'vue';

export default function useUniqueCategories() {
    const uniqueCategories = ref([]);

    function updateUniqueCategories(bookmarks) {
        const categorySet = new Set();

        bookmarks.forEach(bookmark => {
            bookmark.categories.forEach(category => {
                if (Array.isArray(category)) {
                    category.forEach(subCategory => {
                        categorySet.add(subCategory.name);
                    });
                } else {
                    categorySet.add(category.name);
                }
            });
        });

        uniqueCategories.value = Array.from(categorySet).map((el, i) => ({ id: i, name: el }));
    }

    return { uniqueCategories, updateUniqueCategories };
}
