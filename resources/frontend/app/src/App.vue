<template>
    <div id="app">
        <component v-bind:is="layout" />
        <g-overlay-loading v-if="overlayLoading" />
    </div>
</template>

<script>
import { mapGetters } from "vuex";
import GOverlayLoading from "@/components/GOverlayLoading.vue";
export default {
    components: {
        GOverlayLoading
    },
    metaInfo: {
        titleTemplate: "Laravel6 & Vue.js Demo | %s",
        htmlAttrs: {
            lang: "ja"
        }
    },
    computed: {
        layout: {
            cache: false,
            get: function() {
                return `${this.$route.meta.layout || "default"}-layout`;
            }
        },
        ...mapGetters({
            overlayLoading: "overlayLoading"
        })
    }
};
</script>
