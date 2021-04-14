<template>
    <div
        @focusin="showList = true"
        ref="searchContainer"
        class="w-full bg-white rounded-sm shadow-sm text-gray-900 font-medium relative lg:max-w-2xl lg:mx-auto outline-none border-none"
        :class="{'rounded-b-none': showList}">
        <div class="flex flex-row relative">
            <input
                v-model="search"
                @keyup.enter="searchShop"
                @blur="showList = false;"
                class="py-4 pl-4 flex-grow focus:outline-none border-none focus:border-none focus:ring-0"
                type="text"
                placeholder="Keress boltra, vagy termékre">
            <span
                @click="showFilterList = !showFilterList"
                @blur="showFilterList = false"
                class="flex items-center hover:bg-gray-100 locate-span">
                <spinner v-if="loading"></spinner>
                <adjustment-icon v-else></adjustment-icon>
            </span>
        </div>
        <div
            v-if="showList"
            class="search-list max-h-52 rounded-b-sm text-gray-900 font-medium shadow-sm z-10 border-t border-gray-100">
            <div
                v-if="noOptions"
                class="py-4 px-4">
                A keresés nem járt sikerrel!
            </div>
        </div>
        <div
            v-if="showFilterList"
            class="search-list rounded-b-sm text-gray-900 font-medium shadow-sm z-10 border-t border-gray-100 pt-4 pb-2">
            <div>
                <div class="mx-4 py-2">
                    <div class="flex flex-col">
                        <span class="text-gray-700 font-semibold">Gyártó</span>
                        <select
                            class="w-full rounded-sm border border-indigo-600 outline-none"
                            name="manufacturer"
                            id="manufacturer"
                            v-model="filter.manufacturer"
                            required>
                            <option
                                value=""
                                disabled
                                selected
                                hidden>
                                Válassza ki a termék gyátróját
                            </option>
                            <option
                                v-for="item in manufacturers"
                                :key="item.id"
                                :value="item.id">
                                    {{ item.name }}
                                </option>
                        </select>
                    </div>
                </div>
                <div class="py-2 mx-4">
                    <div class="">
                        <span class="text-gray-700 font-semibold">Termék kategória</span>
                        <select
                            class="w-full rounded-sm border border-indigo-600"
                            name="manufacturer"
                            id="manufacturer"
                            v-model="filter.category"
                            required>
                            <option
                                value=""
                                disabled
                                selected
                                hidden>
                                Válassza ki a termék kategóriáját
                            </option>
                            <option
                                v-for="item in categories"
                                :key="item.id"
                                :value="item.id">
                                    {{ item.name }}
                                </option>
                        </select>
                    </div>
                </div>
                <div class="py-2 mx-4">
                    <div class="flex flex-col w-full">
                        <span class="text-gray-700 font-semibold">Termék ára</span>
                        <div class="flex flex-row space-x-2">
                            <input type="number"
                                class="w-1/2 py-2 px-2 rounded-sm border-none border border-gray-100"
                                name="price_min"
                                v-model="filter.price.min">
                            <input type="number"
                                class="w-1/2 py-2 px-2 rounded-sm border-none border border-gray-100"
                                name="price_max"
                                v-model="filter.price.max">
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-2 pb-4 md:pb-0 pt-2 mx-4 my-2">
                <div class="flex flex-row md:justify-end md:flex-row">
                    <button
                        @click="productFilter" 
                        class="bg-indigo-700 text-white rounded-sm text-center w-full md:w-32 py-2">Szűrés</button>
                </div>
                <div class="flex flex-row md:justify-end md:flex-grow">
                    <button
                        @click="clearFilters" 
                        class="bg-red-500 text-white rounded-sm text-center w-full md:w-32 py-2">Szűrők törlése</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import AdjustmentIcon from './icons/AdjustmentIcon'
import Spinner from './animation/Spinner'

export default {
    name: 'UserLocation',

    components: {
        AdjustmentIcon,
        Spinner
    },

    props: ['searchText', 'manufacturers', 'categories'],

    data() {
        return {
            search: this.searchText,
            showList: false,
            showFilterList: false,
            noOptions: false,
            loading: false,

            filter: {
                manufacturer: null,
                category: null,
                price: {
                    min: null,
                    max: null
                }
            }
        }
    },

    copmuted: {
        selectedManufacturer() {
            const queryString = new URLSearchParams(window.location.search);
            console.log(queryString.get('manufacturer'));
            return queryString.get('manufacturer');
        }
    },

    methods: {
        async searchShop(event) {
            this.$emit('loading', true);
            try {
                this.loading = true;
                this.noOptions = false;
                const response = await axios.get("/product", {
                    params: {
                        q: event.target.value
                    }
                });
                this.noOptions = response.data.length == 0;
                if (! this.noOptions)
                    window.location.href = `/product?q=${event.target.value}`;
            } catch (error) {
                console.log(error);
            } finally {
                this.loading = false;
            }
        },

        closeLists() {
            this.showList = false;
            this.showFilterList = false;
        },

        productFilter() {
            let oldParams = new URLSearchParams(window.location.search);
            let params = new URLSearchParams();
            
            if (oldParams.get('q'))
                params.append('q', oldParams.get('q'));

            if (this.filter.manufacturer)
                params.append('manufacturer', this.filter.manufacturer);

            if (this.filter.category)
                params.append('category', this.filter.category);

            if (this.filter.price.min)
                params.append('priceFrom', this.filter.price.min);

            if (this.filter.price.max)
                params.append('priceTo', this.filter.price.max);

            window.location.href = `/product?${params}`;
        },

        setOldParams() {
            const params = new URLSearchParams(window.location.search);

            if (params.get('manufacturer'))
                this.filter.manufacturer = params.get('manufacturer');

            if (params.get('category'))
                this.filter.category = params.get('category');

            if (params.get('priceFrom'))
                this.filter.price.min = params.get('priceFrom');

            if (params.get('priceTo'))
                this.filter.price.max = params.get('priceTo');
        },

        clearFilters() {
            const currentParams = new URLSearchParams(window.location.search);
            const newParams = new URLSearchParams();

            if (currentParams.get('q'))
                newParams.append('q', currentParams.get('q'));

            window.location.href = `/product?${newParams}`;
        }
    },

    mounted() {
        const element = this.$refs.searchContainer;

        var closeHandler = (event) => {
            if (!(element == event.target || element.contains(event.target)) || (event.which == 27)) {
                this.showList = false;
                this.showFilterList = false;
            }
        };

        document.addEventListener('click', closeHandler);
        document.addEventListener('keyup', closeHandler);

        this.setOldParams();
    }
}
</script>

<style scoped>
.locate-span:hover {
    cursor: pointer;
}

.search-list {
    position: absolute;
    width: 100%;
    overflow-y: auto;
    background: #ffffff;
}
</style>
