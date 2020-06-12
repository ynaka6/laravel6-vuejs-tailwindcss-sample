<template>
    <div class="container">
        <g-breadcrumb
            :breadcrumbs="[
                { to: '/', name: 'Home' },
                { to: null, name: 'Forgot password?' }
            ]"
        />
        <g-page-title
            title="Forgot password?"
            icon="sign-in-alt"
            class="w-full mb-4"
        />
        <div class="flex justify-center items-center lg:p-6">
            <div class="w-full max-w-2xl">
                <div v-if="completed" class="my-8">
                    <t-card
                        base-class="bg-gray-100 rounded-lg border shadow-md p-6 z-10"
                    >
                        <h2
                            class="font-semibold text-center text-2xl mb-10 lg:text-3xl"
                        >
                            We sent you an email.
                        </h2>
                        <p>
                            Please click on the link in the email to reset your
                            password.
                        </p>
                        <t-button
                            type="button"
                            to="/"
                            variant="primary"
                            size="lg"
                            class="mt-10 w-full"
                        >
                            Go to Home
                        </t-button>
                    </t-card>
                </div>
                <div v-else>
                    <form class="my-8" @submit.prevent="onSubmit">
                        <p class="text-center mb-10">
                            <font-awesome-icon
                                :icon="['fas', 'exclamation-triangle']"
                                class="text-yellow-600 mr-2"
                                size="lg"
                            />
                            If you've forgotten your password, please enter your
                            registered email address.
                        </p>
                        <t-input-group
                            label="E-Mail"
                            :status="formState('email').status"
                            :feedback="formState('email').message"
                        >
                            <t-input
                                type="email"
                                v-model="form.email"
                                label="E-Mail"
                                autofocus
                                autocapitalize="off"
                            />
                        </t-input-group>
                        <t-button
                            type="submit"
                            variant="primary"
                            size="lg"
                            class="mt-10 w-full hover:shadow-2xl"
                        >
                            Submit
                        </t-button>
                    </form>
                    <div class="flex flex-col items-center">
                        <div class="w-1/3 border-b-4 mb-4" />
                        <router-link to="/login" class="hover:underline">
                            Go to login
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import GPageTitle from "@/components/GPageTitle";
import GBreadcrumb from "@/components/GBreadcrumb";

export default {
    components: {
        GPageTitle,
        GBreadcrumb
    },
    data() {
        return {
            form: {
                email: null
            },
            errors: null,
            completed: false
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
            this.sendResetLinkEmail(this.form)
                .then(() => {
                    this.completed = true;
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
            sendResetLinkEmail: "auth/sendResetLinkEmail"
        })
    }
};
</script>
