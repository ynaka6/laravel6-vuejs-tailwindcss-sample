<template>
    <div>
        <div
            class="flex items-center justify-between bg-gray-200 px-4 py-3 border-t cursor-pointer"
            @click.prevent="accordion = !accordion"
        >
            <span class="text-xs font-semibold ">
                Menu
            </span>
            <font-awesome-icon :icon="['fas', `angle-${arrow}`]" />
        </div>
        <div v-show="accordion" class="bg-white shadow-md border">
            <slot />
        </div>
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
        open: {
            type: Boolean,
            require: false,
            default: false
        }
    },
    data() {
        return {
            accordion: open
        };
    },
    computed: {
        arrow() {
            return this.accordion ? "up" : "down";
        }
    }
};
</script>
