<template>
    <h3 class="bg-gray-100 p-2 font-bold text-gray-800 shadow-xl rounded mb-2">
        <font-awesome-icon :icon="['fas', icon]" class="text-purple-800 mr-1" />
        {{ title }}
    </h3>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            require: true,
            default: null
        },
        icon: {
            type: String,
            require: false,
            default: "stream"
        }
    }
};
</script>
