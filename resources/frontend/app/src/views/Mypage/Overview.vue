<template>
    <div class="container">
        <g-breadcrumb
            :breadcrumbs="[
                { to: '/', name: 'Homee' },
                { to: null, name: 'MyPage' }
            ]"
        />
        <g-page-title title="MyPage" icon="user" class="w-full mb-4" />
        <div class="lg:flex">
            <div class="w-full mb-4 lg:w-3/5 lg:mr-2">
                <g-page-item-title title="Profile" />
                <g-profile-card :user="user">
                    <template v-slot:footer>
                        <g-accordion title="Menu">
                            <router-link
                                v-for="(menu, index) in userMenu"
                                :key="index"
                                :to="menu.to"
                                class="flex items-center justify-between bg-white px-4 py-3 border-t"
                            >
                                <span class="text-xs">
                                    <font-awesome-icon
                                        :icon="['fas', menu.icon]"
                                        size="sm"
                                        class="mr-1"
                                    />
                                    {{ menu.name }}
                                </span>
                                <font-awesome-icon
                                    :icon="['fas', 'angle-right']"
                                />
                            </router-link>
                        </g-accordion>
                    </template>
                </g-profile-card>
                <g-page-item-title title="担当企業" class="mt-10" />
                <g-company-card
                    v-for="(employee, index) in user.employees"
                    :key="index"
                    :company="employee.company"
                />
            </div>
            <div class="w-full lg:w-2/5">
                <g-page-item-title title="News" />
                <g-news-card
                    v-for="(news, index) in newsMock"
                    :key="index"
                    :news="news"
                    class="bg-gray-300 mb-1"
                >
                    <template v-slot:footer>
                        <div class="flex justify-end p-2">
                            <t-button
                                type="button"
                                to="/mypage"
                                variant="primary"
                                class="rounded-full text-xs"
                                size="sm"
                            >
                                <font-awesome-icon
                                    :icon="['fas', 'edit']"
                                    size="xs"
                                    class="mr-1"
                                />
                                Edit
                            </t-button>
                        </div>
                    </template>
                </g-news-card>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from "vuex";

import GAccordion from "@/components/GAccordion";
import GPageTitle from "@/components/GPageTitle";
import GBreadcrumb from "@/components/GBreadcrumb";
import GPageItemTitle from "@/components/GPageItemTitle";
import GProfileCard from "@/components/GProfileCard";
import GCompanyCard from "@/components/GCompanyCard";
import GNewsCard from "@/components/GNewsCard";

const userMenu = [
    { name: "Edit Profile", to: "/mypage/profile", icon: "user-edit" },
    { name: "Edit E-Mail", to: "/mypage/change-mail", icon: "envelope" },
    { name: "Edit Password", to: "/mypage/change-password", icon: "key" },
    { name: "Activity", to: "/mypage/activities", icon: "database" },
    { name: "Leave", to: "/mypage/leave", icon: "door-open" }
];

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
        GAccordion,
        GPageTitle,
        GBreadcrumb,
        GPageItemTitle,
        GProfileCard,
        GCompanyCard,
        GNewsCard
    },
    data() {
        return {
            userMenu,
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
