<template>
    <div class="p-6 bg-gray-200 min-h-screen flex justify-center items-center">
        <div class="w-full max-w-sm">
            <form
                class="mt-8 bg-white rounded-lg shadow-lg overflow-hidden"
                @submit.prevent="onSubmit"
            >
                <div class="px-10 py-12">
                    <h1 class="text-center font-bold text-3xl uppercase">
                        Login
                    </h1>
                    <div class="mx-auto mt-6 mb-6 w-24 border-b-2" />
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
                        <t-input
                            type="password"
                            v-model="form.password"
                            label="Password"
                        />
                    </t-input-group>
                </div>
                <div
                    class="px-10 py-4 bg-grey-lightest border-t border-grey-lighter flex justify-between items-center"
                >
                    <t-button
                        type="submit"
                        variant="primary"
                        size="lg"
                        class="w-full"
                    >
                        Login
                    </t-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";

export default {
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
                    this.$router.push("/");
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
