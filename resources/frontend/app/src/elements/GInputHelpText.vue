<template>
    <p class="my-1 text-gray-600 text-xs">{{ text }}</p>
</template>

<script>
export default {
    props: {
        text: {
            type: String,
            require: true,
            default: null
        }
    }
};
</script>
