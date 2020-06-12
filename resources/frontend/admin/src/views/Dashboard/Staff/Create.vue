<template>
    <div>
        <div class="flex flex-wrap">
            <breadcrumb
                :breadcrumbs="[
                    { to: '/', name: 'ダッシュボード' },
                    { to: '/staffs', name: '管理ユーザー一覧' },
                    { to: null, name: '追加' }
                ]"
            />
            <div class="w-full relative">
                <page-title
                    title="管理ユーザー追加"
                    icon="users"
                    class="w-full mb-4"
                />
            </div>
            <form @submit.prevent="onSubmit" class="w-full">
                <t-card class="w-full">
                    <staff-form v-bind.sync="form" :errors="errors" />
                    <template v-slot:footer>
                        <div class="flex justify-between">
                            <t-button to="/staffs" size="sm" variant="tertiary">
                                戻る
                            </t-button>
                            <t-button
                                type="submit"
                                size="sm"
                                variant="primary"
                                :class="{ disabled: sending }"
                            >
                                送信する
                            </t-button>
                        </div>
                    </template>
                </t-card>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import http from "@/http";
import PageTitle from "@/components/PageTitle";
import Breadcrumb from "@/components/Breadcrumb";
import StaffForm from "./StaffForm.vue";

export default {
    components: {
        PageTitle,
        Breadcrumb,
        StaffForm
    },
    data() {
        return {
            form: {
                name: null,
                email: null,
                password: null,
                role: 1
            },
            errors: null,
            sending: false
        };
    },
    methods: {
        onSubmit() {
            if (this.sending) {
                return;
            }
            this.sending = true;
            this.showOverlayLoading();
            http.post("/api/staff", this.form)
                .then(() => {
                    this.$router.push("/staffs");
                })
                .catch(err => {
                    const response = err.response;
                    const errors = response.data.errors;
                    if (errors) {
                        this.errors = errors;
                    }
                })
                .finally(() => {
                    this.sending = false;
                    this.hideOverlayLoading();
                });
        },
        ...mapActions({
            showOverlayLoading: "showOverlayLoading",
            hideOverlayLoading: "hideOverlayLoading"
        })
    }
};
</script>
