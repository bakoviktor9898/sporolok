require('./bootstrap');
window.Vue = require('vue').default;

import UserLocation from './components/UserLocation'
import ProductSearch from './components/ProductSearch'
import LatestDeals from './components/LatestDeals';
import NearestShops from './components/NearestShops';
import ProductCreate from './components/ProductCreate.vue';

const app = new Vue({
    el: '#app',
    components: {
        UserLocation,
        ProductSearch,
        LatestDeals,
        NearestShops,
        ProductCreate,
    }
})
