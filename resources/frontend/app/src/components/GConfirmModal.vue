<template>
    <t-modal
        ref="modal"
        wrapper-class="bg-orange-100 border-orange-400 text-orange-700 rounded shadow-xl flex flex-col"
        overlay-class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-orange-200 opacity-75"
        body-class="text-xl flex flex-col items-center justify-center p-6 flex-grow"
        footerClass="bg-orange-400 p-3 flex justify-between"
        show
    >
        <h1 class="text-xl font-bold mb-2">
            {{ title }}
        </h1>
        <p>
            {{ message }}
        </p>
        <template v-slot:footer>
            <t-button
                variant="tertiary"
                tertiary-class="border block text-white border-transparent hover:text-gray-300"
                @click="onClickCancel"
            >
                {{ cancelText }}
            </t-button>
            <t-button @click="onClickOk" variant="warning">
                {{ okText }}
            </t-button>
        </template>
    </t-modal>
</template>

<script>
// FIXME: 汎用化を検討
// - success, info, default, warning, dangerでデザインを変更するなど
export default {
    props: {
        title: {
            type: String,
            require: true,
            default: null
        },
        message: {
            type: String,
            require: false,
            default: null
        },
        okText: {
            type: String,
            require: false,
            default: "OK"
        },
        cancelText: {
            type: String,
            require: false,
            default: "Cancel"
        },
        okFunction: {
            type: Function,
            require: false,
            default: function() {}
        },
        cancelFunction: {
            type: Function,
            require: false,
            default: function() {}
        }
    },
    methods: {
        show() {
            this.$refs.modal.show();
        },
        onClickOk() {
            this.$refs.modal.hide();
            this.okFunction();
        },
        onClickCancel() {
            this.$refs.modal.hide();
            this.cancelFunction();
        }
    }
};
</script>
