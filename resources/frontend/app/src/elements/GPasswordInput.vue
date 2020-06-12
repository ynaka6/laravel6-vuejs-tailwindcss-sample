<template>
    <div>
        <t-input
            :type="inputType"
            :label="label"
            class="pr-10"
            @input="updateInput"
        />
        <button
            v-if="icon"
            type="button"
            style="margin-top: -2.2rem;"
            class="float-right mr-2"
            @click="toggleType"
        >
            <font-awesome-icon
                :icon="['fas', icon]"
                class="text-purple-500 ml-2"
                size="lg"
            />
        </button>
    </div>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            require: true,
            default: null
        },
        label: {
            type: String,
            require: false,
            default: null
        },
        icon: {
            type: String,
            require: false,
            default: null
        }
    },
    data() {
        const password = "password";
        const text = "text";
        return {
            inputType: "password",
            password,
            text
        };
    },
    methods: {
        toggleType() {
            if (this.inputType === this.password) {
                this.inputType = this.text;
            } else {
                this.inputType = this.password;
            }
        },
        updateInput(event) {
            this.$emit("input", event);
        }
    }
};
</script>
