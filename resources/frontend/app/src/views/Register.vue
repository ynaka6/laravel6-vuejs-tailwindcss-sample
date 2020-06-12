<template>
    <div class="container">
        <g-breadcrumb
            :breadcrumbs="[
                { to: '/', name: 'Home' },
                { to: null, name: 'Register' }
            ]"
        />
        <g-page-title title="Register" icon="sign-in-alt" class="w-full mb-4" />
        <div class="flex justify-center items-center lg:p-6">
            <div class="w-full max-w-2xl">
                <div v-if="completed" class="my-8">
                    <t-card
                        base-class="bg-white rounded-lg shadow-lg z-10 lg:p-6"
                    >
                        <h2
                            class="font-semibold text-center text-2xl mb-10 lg:text-3xl"
                        >
                            Thank you for register
                        </h2>
                        <p>
                            Please check your E-mail. Please complete this
                            registration from the URL in the email sent to you.
                        </p>
                        <t-button
                            type="button"
                            to="/"
                            variant="primary"
                            size="lg"
                            class="mt-10 w-full"
                        >
                            Go Home
                        </t-button>
                    </t-card>
                </div>
                <div v-else class="my-8">
                    <form @submit.prevent="onSubmit">
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
                        <t-input-group
                            label="Password"
                            class="mt-6"
                            :status="formState('password').status"
                            :feedback="formState('password').message"
                        >
                            <g-password-input
                                v-model="form.password"
                                label="Password"
                                icon="eye"
                            />
                        </t-input-group>
                        <t-input-group
                            label="Password Confirmation"
                            class="mt-6"
                            :status="formState('password_confirmation').status"
                            :feedback="
                                formState('password_confirmation').message
                            "
                        >
                            <g-password-input
                                v-model="form.password_confirmation"
                                label="Password Confirmation"
                                icon="eye"
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
import GPasswordInput from "@/elements/GPasswordInput";

export default {
    components: {
        GPageTitle,
        GBreadcrumb,
        GPasswordInput
    },
    data() {
        return {
            form: {
                email: null,
                password: null,
                password_confirmation: null
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
            this.register(this.form)
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
            register: "auth/register"
        })
    }
};
</script>
