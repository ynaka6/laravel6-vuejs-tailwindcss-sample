<template>
    <div class="container">
        <g-breadcrumb
            :breadcrumbs="[
                { to: '/', name: 'トップ' },
                { to: null, name: 'パスワード再設定' }
            ]"
        />
        <g-page-title
            title="パスワード再設定"
            icon="sign-in-alt"
            class="w-full mb-4"
        />
        <div class="flex justify-center items-center lg:p-6">
            <div class="w-full max-w-2xl">
                <form class="my-8" @submit.prevent="onSubmit">
                    <t-input-group
                        label="メールアドレス"
                        :status="formState('email').status"
                        :feedback="formState('email').message"
                    >
                        <t-input
                            type="email"
                            v-model="form.email"
                            label="メールアドレス"
                            autofocus
                            autocapitalize="off"
                        />
                    </t-input-group>
                    <t-input-group
                        label="パスワード"
                        class="mt-6"
                        :status="formState('password').status"
                        :feedback="formState('password').message"
                    >
                        <g-password-input
                            v-model="form.password"
                            label="パスワード"
                            icon="eye"
                        />
                    </t-input-group>
                    <t-input-group
                        label="パスワード確認"
                        class="mt-6"
                        :status="formState('password_confirmation').status"
                        :feedback="formState('password_confirmation').message"
                    >
                        <g-password-input
                            v-model="form.password_confirmation"
                            label="パスワード確認"
                            icon="eye"
                        />
                    </t-input-group>
                    <t-button
                        type="submit"
                        variant="primary"
                        size="lg"
                        class="mt-10 w-full"
                    >
                        パスワードを変更する
                    </t-button>
                </form>
                <div class="flex flex-col items-center">
                    <div class="w-1/3 border-b-4 mb-4" />
                    <router-link
                        to="/login"
                        class="text-blue-600 hover:underline"
                    >
                        <font-awesome-icon
                            :icon="['fas', 'caret-square-right']"
                            class="text-green-800"
                        />
                        ログイン画面に戻る
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import GPasswordInput from "@/elements/GPasswordInput";
import GPageTitle from "@/components/GPageTitle";
import GBreadcrumb from "@/components/GBreadcrumb";

export default {
    components: {
        GPasswordInput,
        GPageTitle,
        GBreadcrumb
    },
    data() {
        return {
            form: {
                email: this.$route.query.email,
                password: null,
                password_confirmation: null,
                token: this.$route.query.token
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
            this.resetPassword(this.form)
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
            resetPassword: "auth/resetPassword"
        })
    }
};
</script>
