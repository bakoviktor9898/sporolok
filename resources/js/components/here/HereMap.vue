<template>
    <div class="w-full h-full box-border flex-grow">
        <div
            id="hereMapContainer"
            class="w-full h-full rounded-sm"
            ref="hereMapContainer">
        </div>
    </div>
</template>

<script>
export default {
    props: ['lat', 'lng', 'apiKey', 'shop'],

    data() {
        return {
            center: null,
            platform: null,
            map: null,
            pin: null,
        }
    },

    computed: {
        shopLng() {
            return this.shop.lng;
        },

        shopLat() {
            return this.shop.lat;
        }
    },

    watch: {
        shopLng(value) {
            this.center.lng = value;
            this.addPinToMap(this.map, this.center);
        },

        shopLat(value) {
            this.center.lat = value;
            this.addPinToMap(this.map, this.center);
        }
    },

    methods: {
        addPinToMap(map, position) {
            if (this.map && this.pin) this.map.removeObject(this.pin);
            const marker = new window.H.map.Marker(position);
            this.pin = marker;
            map.addObject(marker);
            map.setCenter(position);
        },

        initializeHereMap(center) {
            const mapContainer = this.$refs.hereMapContainer;
            const H = window.H;

            var mapTypes = this.platform.createDefaultLayers();

            var map = new H.Map(mapContainer, mapTypes.vector.normal.map,
                {
                    zoom: 14,
                    center: center
                }
            );

            this.map = map;

            addEventListener("resize", () => map.getViewPort().resize());
            new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
            H.ui.UI.createDefault(map, mapTypes);

            this.addPinToMap(this.map, center);
        },

        setShopPin() {

        }
    },

    mounted() {
        const platform = new window.H.service.Platform({
            'apiKey': this.apiKey
        });
        this.platform = platform;
        var center = {
            lat: this.lat,
            lng: this.lng,
        };
        this.center = center;

        this.initializeHereMap(center);
    }
}
</script>