<template>
    <lane>
        <template #title>
            Közeledben lévő akciók
        </template>
        <template #items>
            <div v-if="fetching"
                class="flex flex-row justify-center w-full my-12">
                <spinner></spinner>
            </div>
            <lane-item v-else
                @update="fetchShoppingList"
                v-for="item in options"
                :key="item.id"
                :product-id="item.id"
                :shopping-list="shoppingList">
                <template #name>
                    <a :href="'/product/'+item.id">
                        {{ item.product.name }}
                    </a>
                </template>
                <template #manufacturer>
                    {{ item.product.manufacturer.name }}
                </template>
                <template #quantity>
                    {{ item.quantity }} {{ item.per }}
                </template>
                <template #shop>
                    {{ item.shop.name.name }},
                    {{ item.shop.address.postal_code.city.name }}
                    {{ item.shop.address.street }}
                    {{ item.shop.address.house }}
                </template>
                <template #price>
                    {{ item.price }} {{ item.currency.name }}
                </template>
                <template #dealDate>
                    {{ new Date(item.added_at).toDateString() }}
                </template>
            </lane-item>
        </template>
    </lane>
</template>

<script>
import Lane from './lane/Lane'
import LaneItem from './lane/LaneItem'
import Spinner from './animation/Spinner'

export default {
    components: {
        Lane,
        LaneItem,
        Spinner
    },

    computed: {
        fetching() {
            return this.options.length == 0 && this.loading;
        }
    },

    data() {
        return {
            options: [],
            loading: true,
            shoppingList: [],
        }
    },

    methods: {
        async featchData() {
            this.loading = true;
            this.options = [];
            try {
                const response = await axios.get('/product', {
                    params: {
                        nearest: 20
                    }
                });
                this.options = response.data;
            } catch (error) {
                console.log(error);
                this.options = [];
            } finally {
                this.loading = false;
            }
        },

        async fetchShoppingList() {
            try {
                const authUser = await axios.get('/me');
                if (authUser.data.status == 'unauthorized') {
                    this.shoppingList = [];
                    return;
                }

                const response = await axios.get('/shoppingList');
                this.shoppingList = response.data;
            } catch (error) {
                console.log(error);
            }
        }
    },

    async mounted() {
        this.fetchShoppingList();
        this.featchData();
    }
}
</script>
