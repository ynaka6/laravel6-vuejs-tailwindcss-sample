<template>
    <div id="app">
        <component v-bind:is="layout" />
    </div>
</template>

<script>
export default {
    metaInfo: {
        titleTemplate: "%s - Genryoubank Admin",
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
        }
    }
};
</script>
