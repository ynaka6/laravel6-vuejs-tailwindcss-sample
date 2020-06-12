<template>
    <div v-if="user" class="max-w-5xl mx-auto">
        <g-breadcrumb
            :breadcrumbs="[
                { to: '/', name: 'Home' },
                { to: '/', name: user.mainEmployee.company.name },
                { to: null, name: user.profile.name }
            ]"
        />
        <g-page-title title="User Detail" icon="user" class="w-full mb-4" />
        <div class="lg:flex">
            <div class="w-full mb-4 lg:w-3/5 lg:mr-2">
                <g-profile-card :user="user" component="UserDetail">
                    <template v-slot:footer>
                        <div class="flex justify-end pb-4 px-4">
                            <div class="flex">
                                <t-button
                                    type="button"
                                    to="/mypage/profile"
                                    variant="primary"
                                    class="rounded-full mr-2"
                                    size="sm"
                                >
                                    <font-awesome-icon
                                        :icon="['fas', 'user-edit']"
                                        size="sm"
                                        class="mr-1"
                                    />
                                    Edit
                                </t-button>
                                <g-follow-button
                                    :active="followed"
                                    :disabled="user.isMe"
                                    @on-click="toggleFollow"
                                />
                            </div>
                        </div>
                    </template>
                </g-profile-card>
            </div>
            <div class="w-full lg:w-2/5">
                <g-page-item-title title="News" />
                <g-news-card
                    v-for="(news, index) in newsMock"
                    :key="index"
                    :news="news"
                    class="bg-gray-300 mb-1"
                >
                </g-news-card>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

import GFollowButton from "@/elements/GFollowButton";
import GPageTitle from "@/components/GPageTitle";
import GBreadcrumb from "@/components/GBreadcrumb";
import GPageItemTitle from "@/components/GPageItemTitle";
import GProfileCard from "@/components/GProfileCard";
import GNewsCard from "@/components/GNewsCard";
import { fetchUser, followUser, unfollowUser } from "@/core/api/userApi.js";

// FIXME: 仮のデータなので、ニュース実装後に修正
const newsMock = [
    {
        message:
            "News Mock Data News Mock Data　News Mock Data　News Mock Data",
        created_at: "2020-02-10 00:00"
    }
];

export default {
    components: {
        GFollowButton,
        GPageTitle,
        GBreadcrumb,
        GPageItemTitle,
        GProfileCard,
        GNewsCard
    },
    data() {
        return {
            user: null,
            followed: false,
            newsMock
        };
    },
    beforeRouteEnter: (to, from, next) => {
        fetchUser(to.params.id)
            .then(response => {
                next(vm => {
                    vm.user = response.data.data;
                    vm.followed = vm.user.followed;
                });
            })
            .catch(error => {
                const response = error.response;
                to.matched[0].meta.layout = "error";
                to.matched[0].meta.error = response.status;
                next();
            });
    },
    computed: {
        ...mapGetters({
            loggedIn: "auth/loggedIn",
            initialized: "auth/initialized",
            authUser: "auth/user"
        })
    },
    methods: {
        toggleFollow() {
            if (!this.loggedIn) {
                this.$toasted.show("Please follow us again after logging in.", {
                    type: "warning"
                });
                this.$router.push("/login");
            } else if (!this.initialized) {
                this.$toasted.show(
                    "Once the user's initial setup is complete, you can follow him/her",
                    {
                        type: "warning"
                    }
                );
                this.$router.push("/mypage");
            } else if (this.authUser.id === this.user.id) {
                this.$toasted.show("You can't follow yourself", {
                    type: "danger"
                });
            } else if (this.followed) {
                this.unfollowUser(this.user.id).then(response => {
                    this.followed = !this.followed;
                    console.log(response);
                });
            } else {
                this.followUser(this.user.id).then(response => {
                    this.followed = !this.followed;
                    console.log(response);
                });
            }
        },
        followUser,
        unfollowUser
    }
};
</script>
