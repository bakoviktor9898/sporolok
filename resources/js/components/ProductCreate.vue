<template>
    <div v-if="! shops.selected" class="w-full h-full flex flex-col">
        <div class="mb-2">
            <h1
            class=" text-indigo-700 text-xl mb-3 text-center font-bold">
            Kezdje el begepélni a keresett bolt nevét
            </h1>
            <multiselect
                v-model="shops.shop"
                :options="shops.options"
                :loading="shops.loading.fetch"
                placeholder="Válasszon ki egy boltot"
                track-by="id"
                label="label"
                @input="setPin"
                @search-change="fetchShops">
            </multiselect>
        </div>
        <div class="flex-grow">
            <here-map
                :lat="lat"
                :lng="lng"
                :shop="pin"
                :api-key="apiKey">
            </here-map>
        </div>
        <div>
            <button @click.prevent="shopSelected" class=" flex flex-row space-x-2 justify-center w-full py-2 mt-2 mb-4 bg-indigo-700 text-white rounded-sm text-center">
                <span>Bolt kiválasztása</span>
                <spinner v-if="shops.loading.select" variant="white"></spinner>
            </button>
        </div>
    </div>

    <div v-else class="flex flex-col flex-grow h-full">
        <div
            class="flex-grow  bg-white rounded-sm shadow-sm p-4 mb-6 flex flex-col space-y-8 items-center">
            <h1 class="text-gray-700 text-xl">Termék adatainak megadása</h1>
            <div class="flex flex-row w-full mt-6 items-center">
                <label for="category" class="text-indigo-800 font-semibold w-1/2">
                    Termék kategória
                </label>
                <multiselect
                    v-model="categories.selected"
                    :options="categories.options"
                    :loading="categories.loading"
                    track-by="id"
                    label="name">
                </multiselect>
            </div>
            <div class="flex flex-row w-full mt-6 items-center">
                <label for="manufacturer" class="text-indigo-800 font-semibold w-1/2">
                    Gyártó
                </label>
                <multiselect
                    v-model="manufacturer.selected"
                    :options="manufacturer.options"
                    :loading="manufacturer.loading"
                    track-by="id"
                    label="name">
                </multiselect>
            </div>
            <div class="flex flex-row w-full mt-6 items-center">
                <label for="manufacturer" class="text-indigo-800 font-semibold w-1/2">
                    Termék neve
                </label>
                <input
                    type="text"
                    class="w-full border-none border border-gray-100 rounded-md ml-1"
                    v-model="product.product_name">
            </div>
            <div class="flex flex-row w-full mt-6 items-center">
                <label for="manufacturer" class="text-indigo-800 font-semibold w-1/2">
                    Mennyiség
                </label>
                <div class="flex flex-row w-full">
                    <input
                        type="number"
                        class="w-full border-none border border-gray-100 rounded-md rounded-r-none"
                        v-model="product.quantity">
                </div>
            </div>
            <div class="flex flex-row w-full mt-6 items-center">
                <label for="manufacturer" class="text-indigo-800 font-semibold w-1/2">
                    Mértékegység
                </label>
                <input
                    type="text"
                    class="w-full border-none border border-gray-100 rounded-md rounded-r-none"
                    v-model="product.per">
            </div>
            <div class="flex flex-row w-full mt-6 items-center">
                <label for="manufacturer" class="text-indigo-800 font-semibold w-1/2">
                    Termék ára
                </label>
                <div class="flex flex-row w-full">
                    <input
                        type="number"
                        class="w-full border-none border border-gray-100 rounded-md rounded-r-none"
                        v-model="product.price">
                    <input type="text" value="Ft" class="w-2/6 md:w-2/12 rounded-r-md text border-none border border-gray-100 bg-gray-200"
                        disabled v-model="product.currency_name">
                </div>
            </div>
        </div>
    
        <button @click="createProduct" class="bg-indigo-700 text-white w-full py-2 text-center mt-2 mb-4 rounded-sm">
            Akciós termék rögzitése
        </button>
    </div>
</template>

<script>
import HereMap from './here/HereMap';
import Multiselect from 'vue-multiselect';
import Spinner from './animation/Spinner';

import { shopMixins } from '../mixins/shopMixins';
import { manufacturerMixins } from '../mixins/manufacturerMixins';
import { categoryMixins } from '../mixins/categoryMixins';

export default {
    components: {
        HereMap,
        Multiselect,
        Spinner,
    },

    mixins: [
        shopMixins,
        manufacturerMixins,
        categoryMixins,
    ],

    props: ['lat', 'lng', 'apiKey'],

    data() {
        return {
            pin: {
                lat: '',
                lng: '',
            },

            product: {
                shop_id: this.shopId,
                category_name: null,
                manufacturer_name: null,
                product_name: null,
                per: null,
                quantity: null,
                currency_name: "Ft",
                price: null,
            }
        }
    },

    computed: {
        shopSelect() {
            return this.shops.selected;
        }
    },

    watch: {
        async shopSelect($value) {
            if (! $value) return;
            await this.fetchManufacturers();
            await this.fetchCategories();
        }
    },

    methods: {

        setPin() {
            var pin = {
                lat: this.shops.shop.position.lat,
                lng: this.shops.shop.position.lng
            };

            this.pin = pin;
        },

        async createProduct() {
            if (!this.manufacturer.selected || !this.shops.selected || !this.categories.selected)
                return;

            this.product.manufacturer_name = this.manufacturer.selected.name;
            this.product.category_name = this.categories.selected.name;
            this.product.shop_id = this.shops.selected.id;

            console.log(this.shops.selected)
            
            try {
                const response = await axios.post('/product', this.product);
                window.location.href = '/home';
            } catch (error) {
                console.log(error);
            }
        }
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>