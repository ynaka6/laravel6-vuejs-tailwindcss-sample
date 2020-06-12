<template>
    <div
        class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center"
    >
        <div
            class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"
            @click.prevent="close"
        />
        <div
            class="bg-white w-full mx-auto rounded shadow-lg z-50"
            :class="[modalSize]"
        >
            <div
                class="min-h-screen lg:min-h-0 max-h-screen flex flex-col py-4 text-left px-6"
            >
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">{{ title }}</p>
                    <div
                        class="modal-close cursor-pointer z-50"
                        @click.prevent="close"
                    >
                        <font-awesome-icon :icon="['fas', 'times']" />
                    </div>
                </div>

                <div class="flex flex-grow overflow-y-auto">
                    <div class="w-full">
                        <slot />
                    </div>
                </div>

                <div class="flex justify-end pt-2">
                    <t-button
                        v-if="actionText"
                        variant="primary"
                        class="mr-2"
                        @click="action"
                    >
                        {{ actionText }}
                    </t-button>
                    <button
                        class="modal-close px-4 bg-gray-500 py-2 rounded text-white text-xs hover:bg-gray-400"
                        @click.prevent="close"
                    >
                        Close
                    </button>
                </div>
            </div>
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
        size: {
            type: String,
            require: false,
            default: "md"
        },
        actionText: {
            type: String,
            require: true,
            default: null
        }
    },
    mounted() {
        document.body.classList.add("overflow-hidden");
    },
    computed: {
        modalSize() {
            return this.size === "md" ? "lg:max-w-md" : "lg:max-w-3xl";
        }
    },
    methods: {
        action() {
            this.$emit("on-click-action");
        },
        close() {
            this.$router.go(-1);
            document.body.classList.remove("overflow-hidden");
        }
    }
};
</script>
