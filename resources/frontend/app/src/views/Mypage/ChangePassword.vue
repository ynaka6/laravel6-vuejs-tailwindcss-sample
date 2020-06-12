<template>
    <g-modal-page
        title="Edit Password"
        action-text="Save"
        @on-click-action="onSubmit"
    >
        <t-input-group
            label="Passowrd"
            class="mt-6"
            :status="formState('password').status"
            :feedback="formState('password').message"
        >
            <g-password-input
                v-model="form.password"
                label="Passowrd"
                icon="eye"
            />
        </t-input-group>
        <t-input-group
            label="Passowrd Confirmation"
            class="mt-6"
            :status="formState('password_confirmation').status"
            :feedback="formState('password_confirmation').message"
        >
            <g-password-input
                v-model="form.password_confirmation"
                label="Passowrd Confirmation"
                icon="eye"
            />
        </t-input-group>
    </g-modal-page>
</template>

<script>
import { mapActions } from "vuex";

import GModalPage from "@/components/GModalPage.vue";
import GPasswordInput from "@/elements/GPasswordInput";
export default {
    components: {
        GModalPage,
        GPasswordInput
    },
    data() {
        return {
            form: {
                password: null,
                password_confirmation: null
            },
            errors: null
        };
    },
    methods: {
        formState(name) {
            return this.errors &&
                this.errors[name] &&
                0 < this.errors[name].length
                ? { status: "error", message: this.errors[name][0] }
                : { status: null, message: null };
        },
        onSubmit() {
            this.changePassword(this.form)
                .then(() => {
                    this.$toasted.show("Your password has been updated.", {
                        type: "success"
                    });
                    this.$router.push("/mypage");
                })
                .catch(err => {
                    const response = err.response;
                    const errors = response.data.errors;
                    if (errors) {
                        this.errors = errors;
                    }
                });
        },
        ...mapActions({
            changePassword: "auth/changePassword"
        })
    }
};
</script>
