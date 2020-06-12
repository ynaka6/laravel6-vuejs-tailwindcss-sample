<template>
    <div class="breadcrumb-nav">
        <nav class="container">
            <ol class="breadcrumb">
                <li v-for="breadcrumb in breadcrumbs" :key="breadcrumb.name">
                    <router-link v-if="breadcrumb.to" :to="breadcrumb.to">
                        {{ breadcrumb.name }}
                    </router-link>
                    <span v-else>
                        {{ breadcrumb.name }}
                    </span>
                </li>
            </ol>
        </nav>
    </div>
</template>

<script>
export default {
    props: {
        breadcrumbs: {
            type: Array,
            require: true,
            default: null
        }
    }
};
</script>

<style scoped>
.breadcrumb-nav {
    @apply w-full;
}
.container {
    @apply mx-auto h-full;
}
.breadcrumb {
    @apply flex text-gray-600 px-4 py-4;
}
.breadcrumb::-webkit-scrollbar {
    @apply hidden;
}
.breadcrumb > li {
    @apply flex items-center;
}
.breadcrumb > li + li:before {
    content: "\0227B";
    @apply mx-2;
}
.breadcrumb > li a {
    @apply font-bold no-underline;
}
.breadcrumb > li span {
    @apply text-black;
}
</style>
