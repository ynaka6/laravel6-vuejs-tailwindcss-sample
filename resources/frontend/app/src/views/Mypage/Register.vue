<template>
    <div class="container">
        <g-breadcrumb
            :breadcrumbs="[
                { to: '/', name: 'Home' },
                { to: null, name: 'Registration' }
            ]"
        />
        <g-page-title
            title="Registration"
            icon="sign-in-alt"
            class="w-full mb-4"
        />
        <div class="flex justify-center items-center lg:p-6">
            <div class="w-full max-w-2xl">
                <div class="my-8">
                    <form @submit.prevent="onSubmit">
                        <t-input-group
                            label="Company name"
                            :status="
                                companyNameWarning ||
                                    formState('company.name').status
                            "
                            :feedback="
                                companyNameWarningMessage ||
                                    formState('company.name').message
                            "
                        >
                            <g-input-help-text
                                text="Please enter the full name of your company."
                            />
                            <g-searching-input
                                v-model="form.company.name"
                                label="Company name"
                                :loading="companyLoading"
                                :status="
                                    companyNameWarning ||
                                        formState('company.name').status
                                "
                            />
                        </t-input-group>
                        <t-input-group
                            label="type of business"
                            :status="
                                formState('company.businessCategoryIds').status
                            "
                            :feedback="
                                formState('company.businessCategoryIds').message
                            "
                        >
                            <t-checkbox-group
                                v-model="form.company.businessCategoryIds"
                                name="checkbox-group"
                                :options="businessCategoryOption"
                                :status="
                                    formState('company.businessCategoryIds')
                                        .status
                                "
                                :disabled="existsCompany"
                            />
                        </t-input-group>
                        <div class="lg:flex">
                            <div class="w-full lg:w-1/2">
                                <t-input-group
                                    label="Postal code"
                                    :status="
                                        formState('company.postalCode').status
                                    "
                                    :feedback="
                                        formState('company.postalCode').message
                                    "
                                >
                                    <g-input-help-text
                                        text="If you have an address outside of Japan, please provide only your address in the blank field."
                                    />
                                    <g-searching-input
                                        v-model="form.company.postalCode"
                                        label="Postal code"
                                        :loading="addressLoading"
                                        :status="
                                            formState('company.postalCode')
                                                .status
                                        "
                                        :disabled="existsCompany"
                                    />
                                </t-input-group>
                            </div>
                        </div>
                        <t-input-group
                            label="Address"
                            :status="formState('company.address').status"
                            :feedback="formState('company.address').message"
                        >
                            <t-input
                                type="text"
                                v-model="form.company.address"
                                label="Address"
                                :disabled="existsCompany"
                            />
                        </t-input-group>
                        <div class="my-4 border-b border-gray-500" />
                        <t-input-group
                            label="Person in charge"
                            :status="formState('profile.name').status"
                            :feedback="formState('profile.name').message"
                        >
                            <div class="lg:flex">
                                <t-input
                                    type="text"
                                    v-model="form.profile.lastName"
                                    label="Family name"
                                    class="mb-2 lg:mb-0 lg:mr-2"
                                    placeholder="Yamada"
                                    :status="formState('profile.name').status"
                                />
                                <t-input
                                    type="text"
                                    v-model="form.profile.firstName"
                                    label="Given name"
                                    placeholder="Taro"
                                    :status="formState('profile.name').status"
                                />
                            </div>
                        </t-input-group>
                        <t-input-group
                            label="Department"
                            :status="formState('employee.department').status"
                            :feedback="formState('employee.department').message"
                        >
                            <t-input
                                type="text"
                                v-model="form.employee.department"
                                label="Department"
                                :status="
                                    formState('employee.department').status
                                "
                            />
                        </t-input-group>
                        <t-button
                            type="submit"
                            variant="primary"
                            size="lg"
                            class="mt-10 w-full"
                        >
                            {{ existsCompany ? "Apply to join" : "Submit" }}
                        </t-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

import http from "@/http";
import GInputHelpText from "@/elements/GInputHelpText";
import GSearchingInput from "@/elements/GSearchingInput";
import GPageTitle from "@/components/GPageTitle";
import GBreadcrumb from "@/components/GBreadcrumb";

export default {
    components: {
        GInputHelpText,
        GSearchingInput,
        GPageTitle,
        GBreadcrumb
    },
    data() {
        return {
            form: {
                company: {
                    name: null,
                    postalCode: null,
                    address: null,
                    businessCategoryIds: []
                },
                profile: {
                    firstName: null,
                    lastName: null
                },
                employee: {
                    department: null
                }
            },
            companyLoading: false,
            addressLoading: false,
            existsCompany: false,
            errors: {},
            fetchCompanyByNameCancel: null,
            fetchAdderssByCodeCancel: null
        };
    },
    computed: {
        fullName() {
            if (this.form.profile.firstName && this.form.profile.lastName) {
                return this.form.profile.lastName + this.form.profile.firstName;
            }
            return null;
        },
        companyNameWarning() {
            return this.existsCompany ? "warning" : null;
        },
        companyNameWarningMessage() {
            return this.existsCompany ? "既に登録されている企業です。" : null;
        },
        ...mapGetters({
            businessCategoryOption: "config/businessCategoryOption"
        })
    },
    methods: {
        formState(name) {
            return this.errors &&
                this.errors[name] &&
                0 < this.errors[name].length
                ? { status: "error", message: this.errors[name][0] }
                : { status: null, message: null };
        },
        fetchCompanyByName(name) {
            if (!name) {
                this.errors["company.name"] = ["企業名を入力してください。"];
                this.companyLoading = false;
                return;
            }
            if (this.fetchCompanyByNameCancel) {
                this.fetchCompanyByNameCancel();
            }

            const CancelToken = http.CancelToken;
            this.companyLoading = true;
            let cancel;
            http.get("/api/companies", {
                params: { name },
                cancelToken: new CancelToken(function executor(c) {
                    cancel = c;
                })
            })
                .then(response => {
                    this.companyLoading = false;
                    const companyData = response.data.data || null;
                    this.existsCompany =
                        !!companyData && companyData.find(c => c.name === name);
                    this.errors["company.name"] = null;
                })
                .catch(error => {
                    if (!http.isCancel(error)) {
                        this.companyLoading = false;
                        this.errors["company.name"] = [
                            error.response.data.message
                        ];
                    }
                });
            this.fetchCompanyByNameCancel = cancel;
        },
        fetchAdderssByCode(code) {
            if (this.fetchAdderssByCodeCancel || !code) {
                this.fetchAdderssByCodeCancel();
            }

            const CancelToken = http.CancelToken;
            this.addressLoading = true;
            let cancel;
            http.get("/api/address/search", {
                params: { code },
                cancelToken: new CancelToken(function executor(c) {
                    cancel = c;
                })
            })
                .then(response => {
                    this.addressLoading = false;
                    const addressData = response.data.data[0] || null;
                    if (addressData) {
                        this.form.company.address = `${addressData.address1}${addressData.address2}${addressData.address3}`;
                        this.errors["company.postalCode"] = null;
                    }
                })
                .catch(error => {
                    if (!http.isCancel(error)) {
                        this.addressLoading = false;
                        this.errors["company.postalCode"] = [
                            error.response.data.message
                        ];
                    }
                });
            this.fetchAdderssByCodeCancel = cancel;
        },
        onSubmit() {
            const { company, employee } = this.form;
            this.initileze({
                company,
                employee,
                profile: { name: this.fullName }
            })
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
            initileze: "auth/initileze"
        })
    },
    watch: {
        "form.company.name": function(newValue, oldValue) {
            if (newValue !== oldValue) {
                this.fetchCompanyByName(newValue);
            }
        },
        "form.company.postalCode": function(newValue, oldValue) {
            if (newValue !== oldValue) {
                this.fetchAdderssByCode(newValue);
            }
        }
    }
};
</script>
