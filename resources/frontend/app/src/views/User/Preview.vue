<template>
    <div class="max-w-5xl mx-auto">
        <g-breadcrumb
            :breadcrumbs="[
                { to: '/', name: 'Home' },
                { to: '/', name: user.mainEmployee.company.name },
                { to: null, name: user.profile.name }
            ]"
        />
        <g-page-title title="User Preview" icon="user" class="w-full mb-4" />
        <div class="lg:flex">
            <div class="w-full mb-4 lg:w-3/5 lg:mr-2">
                <g-profile-card :user="user" component="UserDetail">
                    <template v-slot:footer>
                        <div class="flex justify-end pb-4 px-4">
                            <g-follow-button
                                :active="followed"
                                @on-click="followed = !followed"
                            />
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
            followed: false,
            newsMock
        };
    },
    computed: {
        ...mapGetters({
            user: "auth/user"
        })
    }
};
</script>
