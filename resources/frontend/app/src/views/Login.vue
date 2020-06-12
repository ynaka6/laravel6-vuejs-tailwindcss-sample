<template>
    <div class="container">
        <g-breadcrumb
            :breadcrumbs="[
                { to: '/', name: 'Home' },
                { to: null, name: 'Login' }
            ]"
        />
        <g-page-title title="Login" icon="sign-in-alt" class="w-full mb-4" />
        <div class="flex justify-center items-center lg:p-6">
            <div class="w-full max-w-2xl">
                <div class="mt-4">
                    <router-link to="/register" class="hover:underline">
                        Create new Account
                    </router-link>
                </div>

                <form class="my-8" @submit.prevent="onSubmit">
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
                    <div class="flex flex-col items-center mt-5">
                        <label for="remenber" class="flex py-1 items-center">
                            <t-checkbox
                                v-model="form.remenber"
                                value="on"
                                unchecked-value="off"
                                id="remenber"
                                name="remenber"
                            />
                            <span class="ml-3">Remember me</span>
                        </label>
                    </div>
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
                    <router-link to="/forgot" class="hover:underline">
                        Forgot password?
                    </router-link>
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
                password: null
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
            this.login(this.form)
                .then(() => {
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
            login: "auth/login"
        })
    }
};
</script>
