import axios from "axios";

export const shopMixins = {
    data() {
        return {
            shops: {
                shop: null,
                selected: false,
                options: [],
                loading: {
                    fetch: false,
                    create: false,
                    select: false,
                },
                error: null,
            },
        }
    },

    methods: {

        async fetchShops(query) {
            if (query.length <= 3) return;
            this.shops.loading.fetch = true;
            this.shops.error = false;
            try {
                const response = await axios.get('/maps/discover', {
                    params: {
                        q: query
                    }
                });
                this.shops.options = response.data;
            } catch (error) {
                this.shops.error = error;
            } finally {
                this.shops.loading.fetch = false;
            }
        },

        async fetchByHereMapsId(hereId) {
            this.shops.loading.fetch = true;
            this.shops.error = null;
            try {
                const response = await axios.get('/shop', {
                    params: {
                        hereMapId: hereId
                    }
                });
                return response.data;
            } catch (error) {
                this.shops.error = error;
            } finally {
                this.shops.loading.fetch = false;
            }
        },
        
        async createShop() {
            this.shops.loading.create = true;
            const data = {
                name: this.shops.shop.title,
                here_map_id: this.shops.shop.id,
                country_code: this.shops.shop.address.countryCode,
                country_name: this.shops.shop.address.countryName,
                state_name: this.shops.shop.address.state,
                county_name: this.shops.shop.address.county,
                city_name: this.shops.shop.address.city,
                street: this.shops.shop.address.street,
                postal_code: this.shops.shop.address.postalCode,
                house: this.shops.shop.address.houseNumber,
                lat: this.shops.shop.position.lat,
                lng: this.shops.shop.position.lng
            }
            this.shops.error = null;
            try {
                const response = await axios.post('/shop', data);
                return response.data;
            } catch (error) {
                this.shops.error = error;
            } finally {
                this.shops.loading.create = false;
            }
        },

        async shopSelected() {
            if (! this.shops.shop) return;
            this.shops.loading.select = true;
            var createdShop = null;

            const results = await this.fetchByHereMapsId(this.shops.shop.id);
            if (results.length != 0) {
                this.shops.selected = results[0];
                console.log(this.shops.selected);
                return;
            }

            createdShop = await this.createShop();
            this.shops.selected = createdShop;
        }
    }
}