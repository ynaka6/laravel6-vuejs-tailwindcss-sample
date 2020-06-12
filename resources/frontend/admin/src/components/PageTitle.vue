<template>
    <div class="w-full bg-white shadow rounded p-4 border-b-4 border-teal-500">
        <h1 class="font-bold text-lg">
            <font-awesome-icon
                v-if="icon"
                :icon="['fas', icon]"
                class="text-teal-500 mr-2"
                size="lg"
            />
            {{ title }}
        </h1>
    </div>
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
            default: null
        }
    }
};
</script>
