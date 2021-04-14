import axios from "axios";

export const categoryMixins = {
    data() {
        return {
            categories: {
                selected: null,
                options: [],
                loading: false,
                error: null,
            }
        }
    },

    methods: {
        async fetchCategories() {
            this.categories.error = null;
            this.categories.loading = true;
            try {
                const response = await axios.get('/product/category');
                this.categories.options = response.data;
            } catch (error) {
                this.categories.error = error;
            } finally {
                this.categories.loading = false;
            }
        }
    }
}