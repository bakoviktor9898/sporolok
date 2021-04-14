<template>
    <div
        @focusin="showList = true"
        ref="searchContainer"
        class="w-full bg-white mt-6 rounded-sm shadow-sm text-gray-900 font-medium relative lg:max-w-2xl lg:mx-auto outline-none border-none"
        :class="{'rounded-b-none': showList}">
        <div class="flex flex-row relative"
            @blur="showList = false">
            <input
                @keyup.enter="discover"
                :value="inputValue"
                class="py-4 pl-4 flex-grow focus:outline-none border-none focus:border-none focus:ring-0"
                type="text"
                placeholder="Először is szükségünk lenne a lokációdra">
            <span
                @click="getUserLocation"
                class="flex items-center hover:bg-gray-100 locate-span">
                <spinner v-if="loading"></spinner>
                <marker-icon v-else></marker-icon>
            </span>
        </div>
        <div
            v-if="showList"
            class="search-list rounded-b-sm text-gray-900 font-medium shadow-sm">
            <div
                v-if="noOptions"
                class="py-4 px-4">
                A keresett cimet nem talaltuk, probald meg szukiteni a keresest!
            </div>
            <div
                v-else
                v-for="item in options"
                :key="item.id"
                class="hover:bg-indigo-100 py-4 px-4 cursor-pointer"
                @click="selectItem(item)">
                {{ item.address.label }}
            </div>
        </div>
    </div>
</template>

<script>
import MarkerIcon from './icons/MarkerIcon'
import Spinner from './animation/Spinner'

export default {
    name: 'UserLocation',

    components: {
        MarkerIcon,
        Spinner
    },

    computed: {
        inputValue() {
            return this.selectedItem ? this.selectedItem.address.label : ""
        }
    },

    data() {
        return {
            showList: false,
            selectedItem: null,
            options: [],
            searchInput: "",
            noOptions: false,
            loading: false,
            position: null,
        }
    },

    methods: {
        async discover(event) {
            if (event.target.value.length <= 3) return;
            try {
                this.loading = true;
                this.noOptions = false;
                const response = await axios.get("/maps/discover", {
                    params: {
                        q: event.target.value
                    }
                });
                this.noOptions = response.data.length == 0;
                this.options = response.data;
            } catch (error) {
                console.log(error);
            } finally {
                this.loading = false;
            }
        },

        async geolocate() {
            return new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(resolve, reject);
            });
        },

        async getUserLocation() {
            try {
                this.loading = true;
                const location = await this.geolocate();
                const position = {
                    lat: location.coords.latitude,
                    lng: location.coords.longitude
                }
                this.storePosition(position);
            } catch (error) {
                console.log(error);
            } finally {
                this.loading = false;
            }
        },

        selectItem(item) {
            this.showList = false;
            this.selectedItem = item;
            const position = {
                lat: item.position.lat,
                lng: item.position.lng
            };
            this.storePosition(position);
        },

        async storePosition(position) {
            try {
                const response = await axios.post('/position', position);
                window.location.href = "/home";
            } catch (error) {
                console.log(error);
            }
        },
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
    max-height: 200px;
    overflow-y: auto;
    background: #ffffff;
}
</style>
