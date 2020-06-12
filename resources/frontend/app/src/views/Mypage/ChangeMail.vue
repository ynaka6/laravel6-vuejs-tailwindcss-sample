<template>
    <g-modal-page
        title="Edit E-Mail"
        action-text="Save"
        @on-click-action="onSubmit"
    >
        <t-input-group
            label="Current E-Mail"
            :status="formState('currentEmail').status"
            :feedback="formState('currentEmail').message"
        >
            <t-input
                type="currentEmail"
                v-model="form.currentEmail"
                label="Current E-Mail"
                autofocus
                autocapitalize="off"
            />
        </t-input-group>
        <t-input-group
            label="E-Mail"
            :status="formState('email').status"
            :feedback="formState('email').message"
        >
            <t-input type="email" v-model="form.email" label="E-Mail" />
        </t-input-group>
    </g-modal-page>
</template>

<script>
import { mapActions } from "vuex";

import GModalPage from "@/components/GModalPage.vue";
export default {
    components: {
        GModalPage
    },
    inject: ["formValidator"],
    data() {
        return {
            form: {
                email: null,
                currentEmail: null
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
            this.resetEmail(this.form)
                .then(() => {
                    this.$toasted.show(
                        "We have sent an email to your new email address. You can change your email address by accessing the site through the approval button in the email.",
                        {
                            type: "success"
                        }
                    );
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
            resetEmail: "auth/resetEmail"
        })
    }
};
</script>
