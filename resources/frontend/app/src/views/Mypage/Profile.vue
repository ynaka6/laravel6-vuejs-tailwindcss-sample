<template>
    <g-modal-page
        title="Edit Profile"
        size="lg"
        action-text="Save"
        @on-click-action="onSubmit"
    >
        <div class="flex flex-wrap">
            <t-input-group
                label="Name"
                class="w-full required lg:w-1/2 lg:pr-1"
                :status="formState('profile.name').status"
                :feedback="formState('profile.name').message"
            >
                <t-input type="text" v-model="user.profile.name" label="Name" />
            </t-input-group>
            <t-input-group
                label="Name（Kana）"
                class="w-full lg:w-1/2 lg:pl-1"
                :status="formState('profile.nameKana').status"
                :feedback="formState('profile.nameKana').message"
            >
                <t-input
                    type="text"
                    v-model="user.profile.nameKana"
                    label="Name（Kana）"
                />
            </t-input-group>
            <t-input-group label="Company name" class="w-full lg:w-1/2 lg:pr-1">
                <t-input
                    type="text"
                    :value="user.mainEmployee.company.name"
                    label="Company name"
                    disabled
                />
            </t-input-group>
            <t-input-group
                label="Tel"
                class="w-full lg:w-1/2 lg:pl-1"
                :status="formState('mainEmployee.tel').status"
                :feedback="formState('mainEmployee.tel').message"
            >
                <t-input
                    type="text"
                    v-model="user.mainEmployee.tel"
                    label="Tel"
                />
            </t-input-group>
            <t-input-group
                label="Department"
                class="w-full lg:w-1/2 lg:pr-1"
                :status="formState('mainEmployee.department').status"
                :feedback="formState('mainEmployee.department').message"
            >
                <t-input
                    type="text"
                    v-model="user.mainEmployee.department"
                    label="Department"
                />
            </t-input-group>
            <t-input-group
                label="Position"
                class="w-full lg:w-1/2 lg:pl-1"
                :status="formState('mainEmployee.position').status"
                :feedback="formState('mainEmployee.position').message"
            >
                <t-input
                    type="text"
                    v-model="user.mainEmployee.position"
                    label="Position"
                />
            </t-input-group>
            <t-input-group
                v-for="providor in userProfileSiteProvidors"
                :key="providor.key"
                :label="providor.description"
                class="w-full lg:w-1/2 lg:pr-1"
                :status="formState(`profile.${providor.value}.url`).status"
                :feedback="formState(`profile.${providor.value}.url`).message"
            >
                <t-input
                    type="text"
                    v-model="user.profile.sites[providor.value].url"
                    :label="providor.description"
                />
            </t-input-group>
            <t-input-group
                label="Birthday"
                class="w-full lg:w-1/2 lg:pl-1"
                :status="formState('profile.birthday').status"
                :feedback="formState('profile.birthday').message"
            >
            </t-input-group>
            <t-input-group
                label="Sex"
                class="w-full required lg:w-1/2 lg:pr-1"
                :status="formState('profile.gender').status"
                :feedback="formState('profile.gender').message"
            >
                <t-select
                    v-model="user.profile.gender"
                    :options="userProfileGenderOption"
                />
            </t-input-group>
            <t-input-group
                label="Status"
                class="w-full required lg:w-1/2 lg:pl-1"
                :status="formState('profile.status').status"
                :feedback="formState('profile.status').message"
            >
                <t-select
                    v-model="user.profile.status"
                    :options="userProfileStatusOption"
                />
            </t-input-group>
            <t-input-group
                label="BIO"
                class="w-full"
                :status="formState('profile.detail').status"
                :feedback="formState('profile.detail').message"
            >
                <t-textarea v-model="user.profile.detail" />
            </t-input-group>
        </div>
    </g-modal-page>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import GModalPage from "@/components/GModalPage.vue";
export default {
    components: {
        GModalPage
    },
    data() {
        return {
            errors: {}
        };
    },
    computed: {
        ...mapGetters({
            user: "auth/user",
            userProfileGenderOption: "config/userProfileGenderOption",
            userProfileStatusOption: "config/userProfileStatusOption",
            userProfileSiteProvidors: "config/userProfileSiteProvidors"
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
        onSubmit() {
            const { profile, mainEmployee } = this.user;
            this.updateProfile({ profile, mainEmployee })
                .then(() => {
                    this.$toasted.show("Completed to update profile", {
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
            updateProfile: "auth/updateProfile"
        })
    }
};
</script>
