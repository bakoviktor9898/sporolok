import axios from "axios"

export const manufacturerMixins = {
    data() {
        return {
            manufacturer: {
                options: [],
                selected: null,
                loading: false,
                error: null,
            }
        }
    },

    methods: {
        async fetchManufacturers() {
            this.manufacturer.loading = true;
            this.manufacturer.error = null;
            try {
                const response = await axios.get('/product/manufacturer');
                this.manufacturer.options = response.data;
            } catch (error) {
                this.manufacturer.error = error;
            } finally {
                this.manufacturer.loading = false;
            }
        }
    }
}