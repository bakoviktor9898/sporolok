<template>
    <li class="w-80 bg-white rounded-sm ring-1 shadow-sm ring-gray-100 p-4 relative flex-shrink-0 flex-grow-0">
        <svg
            @click="addToShoppingList"
            class="absolute top-6 right-6 w-6 h-6 text-indigo-800 cursor-pointer"
            xmlns="http://www.w3.org/2000/svg"
            :fill="fill"
            viewBox="0 0 24 24"
            stroke="currentColor">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
        <a :href="'/product/' + productId">
            <figure>
                <figcaption
                    class="flex flex-col">
                    <span
                        class="flex flex-row mb-1">
                        <span
                            class="w-full font-semibold flex-grow overflow-ellipsis whitespace-nowrap overflow-hidden text-indigo-900">
                            <slot
                                name="name">
                            </slot>
                        </span>
                    </span>
                    <span
                        class="w-full flex-grow flex flex-row overflow-ellipsis whitespace-nowrap overflow-hidden text-gray-700">
                        <span class="flex-grow">
                            <slot
                                name="manufacturer">
                            </slot>
                        </span>
                        <span
                            class="w-2/6 text-right">
                            <slot
                                name="quantity">
                            </slot>
                        </span>
                    </span>
                    <span
                        class="mt-3 font-semibold text-gray-600">
                        <slot
                            name="shop">
                        </slot>
                    </span>
                    <span
                        class="text-sm mt-3 flex flex-row justify-between">
                        <span
                            class="font-bold text-indigo-900">
                            <slot
                                name="price">
                            </slot>
                        </span>
                        <span>
                            <slot
                                name="dealDate">
                            </slot>
                        </span>
                    </span>
                </figcaption>
            </figure>
        </a>
    </li>
</template>

<script>
export default {
    props: {
        productId: null,
        shoppingList: {
            type: Array,
            default: []
        }
    },

    methods: {
        async isAuthenticated() {
            try {
                const auth = await axios.get('/me')
                if (auth.data.status == 'unauthorized')
                    return false;
                return true;
            } finally {
                return false;
            }
        },

        async addToShoppingList() {
            if (! this.isAuthenticated())
                window.location.href = '/login';
    
            try {
                await axios.put(`/shoppingList/${this.productId}`, {});
            } catch (error) {
                console.log(error);
            }

            this.$emit('update');
        }
    },

    computed: {
        fill() {
            if (this.shoppingList && this.shoppingList.includes(this.productId))
                return "#3730a3";

            return "none";
        }
    }
}
</script>