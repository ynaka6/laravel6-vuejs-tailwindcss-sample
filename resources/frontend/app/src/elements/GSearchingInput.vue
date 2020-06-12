<template>
    <div class="relative">
        <t-input
            type="text"
            :label="label"
            class="pr-10"
            :status="status"
            :disabled="disabled"
            @input="updateInput"
        />
        <span v-if="loading" class="absolute top-0 right-0 mt-6 mr-5">
            <g-spinner />
        </span>
    </div>
</template>

<script>
import GSpinner from "./GSpinner";
export default {
    components: {
        GSpinner
    },
    props: {
        label: {
            type: String,
            require: false,
            default: null
        },
        loading: {
            type: Boolean,
            require: true,
            default: false
        },
        status: {
            type: String,
            require: false,
            default: null
        },
        disabled: {
            type: Boolean,
            require: false,
            default: false
        }
    },
    methods: {
        updateInput(event) {
            this.$emit("input", event);
        }
    }
};
</script>
