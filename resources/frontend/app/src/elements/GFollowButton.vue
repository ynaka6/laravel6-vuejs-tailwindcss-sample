<template>
    <t-button
        type="button"
        variant="secondary"
        class="rounded-full"
        :class="{ active: active && !disabled, disabled }"
        @click.prevent="$emit('on-click', active)"
    >
        <font-awesome-icon :icon="[iconType, 'handshake']" class="mr-2" />
        Follow
    </t-button>
</template>

<script>
export default {
    props: {
        active: {
            type: Boolean,
            require: true,
            default: false
        },
        disabled: {
            type: Boolean,
            require: true,
            default: false
        }
    },
    computed: {
        iconType() {
            return this.active ? "fas" : "far";
        }
    }
};
</script>

<style lang="postcss" scoped>
.active {
    @apply bg-blue-500 opacity-75 border-blue-600 text-white;
}

.disabled {
    @apply bg-gray-300 text-gray-800 opacity-75 text-gray-900  border-0 cursor-not-allowed;
}
</style>
