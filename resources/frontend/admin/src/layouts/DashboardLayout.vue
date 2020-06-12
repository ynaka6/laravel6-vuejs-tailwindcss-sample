<template>
    <div>
        <div class="flex flex-col">
            <div class="min-h-screen flex flex-col bg-gray-200">
                <dashboard-header />
                <div class="flex flex-grow mt-16">
                    <div
                        class="min-h-full fixed w-300px bg-white shadow lg:block px-4"
                        :class="{ block: drawer, hidden: !drawer }"
                        style="z-index: 20;"
                    >
                        <p class="my-2 text-teal-500 font-bold mt-5">MENU</p>
                        <div class="my-1">
                            <router-link
                                to="/"
                                class="flex justify-between items-center px-4 py-2 font-bold text-gray-800 text-sm rounded-lg hover:bg-teal-100"
                            >
                                <span>
                                    <font-awesome-icon
                                        :icon="['fas', 'tachometer-alt']"
                                        class="mr-2"
                                        size="lg"
                                    />
                                    ダッシュボード
                                </span>
                            </router-link>
                        </div>
                        <div class="my-1">
                            <span
                                class="flex justify-between items-center px-4 py-2 font-bold text-gray-800 text-sm rounded-lg hover:bg-teal-100"
                            >
                                <span>
                                    <font-awesome-icon
                                        :icon="['fas', 'tags']"
                                        class="mr-2"
                                        size="lg"
                                    />
                                    タグ管理
                                </span>
                                <font-awesome-icon
                                    :icon="['fas', 'angle-down']"
                                />
                            </span>
                            <div class="border-l-4 border-teal-400 ml-6 pl-4">
                                <router-link
                                    to="/tags"
                                    class="flex justify-between items-center px-4 py-2 font-bold text-gray-800 text-sm rounded-lg hover:bg-teal-100"
                                >
                                    <span>
                                        会社タグ一覧
                                    </span>
                                </router-link>
                                <router-link
                                    to="/tags"
                                    class="flex justify-between items-center px-4 py-2 font-bold text-gray-800 text-sm rounded-lg hover:bg-teal-100"
                                >
                                    <span>
                                        投稿タグ一覧
                                    </span>
                                </router-link>
                            </div>
                        </div>
                        <div class="my-1">
                            <span
                                class="flex justify-between items-center px-4 py-2 font-bold text-gray-800 text-sm rounded-lg hover:bg-teal-100"
                            >
                                <span>
                                    <font-awesome-icon
                                        :icon="['fas', 'building']"
                                        class="mr-2"
                                        size="lg"
                                    />
                                    会社管理
                                </span>
                                <font-awesome-icon
                                    :icon="['fas', 'angle-down']"
                                />
                            </span>
                            <div class="border-l-4 border-teal-400 ml-6 pl-4">
                                <router-link
                                    to="/tags"
                                    class="flex justify-between items-center px-4 py-2 font-bold text-gray-800 text-sm rounded-lg hover:bg-teal-100"
                                >
                                    <span>
                                        会社一覧
                                    </span>
                                </router-link>
                                <router-link
                                    to="/tags"
                                    class="flex justify-between items-center px-4 py-2 font-bold text-gray-800 text-sm rounded-lg hover:bg-teal-100"
                                >
                                    <span>
                                        アカウント一覧
                                    </span>
                                </router-link>
                            </div>
                        </div>
                        <div class="my-1">
                            <router-link
                                to="/tags"
                                class="flex justify-between items-center px-4 py-2 font-bold text-gray-800 text-sm rounded-lg hover:bg-teal-100"
                            >
                                <span>
                                    <font-awesome-icon
                                        :icon="['fas', 'chalkboard']"
                                        class="mr-2"
                                        size="lg"
                                    />
                                    カテゴリー管理
                                </span>
                            </router-link>
                        </div>

                        <p class="my-2 text-teal-500 font-bold mt-5">管理</p>
                        <div class="my-1">
                            <router-link
                                to="/staffs"
                                class="flex justify-between items-center px-4 py-2 font-bold text-gray-800 text-sm rounded-lg hover:bg-teal-100"
                            >
                                <span>
                                    <font-awesome-icon
                                        :icon="['fas', 'users']"
                                        class="mr-2"
                                        size="lg"
                                    />
                                    管理ユーザー
                                </span>
                            </router-link>
                        </div>
                    </div>
                    <div
                        class="w-full overflow-hidden px-2 py-4 lg:ml-300px lg:px-12 lg:py-8"
                    >
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="fixed bottom-0 right-0 mr-2 mb-5 lg:hidden"
            style="z-index: 60;"
        >
            <t-button
                variant="primary"
                class="rounded-full h-16 w-16 flex items-center justify-center"
                @click.prevent="onClickMenu"
            >
                <font-awesome-icon
                    v-if="drawer"
                    :icon="['fas', 'times']"
                    size="lg"
                />
                <font-awesome-icon v-else :icon="['fas', 'bars']" size="lg" />
            </t-button>
        </div>
        <overlay-loading v-if="overlayLoading" />
    </div>
</template>

<script>
import { mapGetters } from "vuex";

import DashboardHeader from "./DashboardLayout/DashboardHeader.vue";
import OverlayLoading from "@/components/OverlayLoading.vue";
export default {
    components: {
        DashboardHeader,
        OverlayLoading
    },
    data() {
        return {
            drawer: false
        };
    },
    computed: {
        ...mapGetters({
            overlayLoading: "overlayLoading"
        })
    },
    methods: {
        onClickMenu() {
            this.drawer = !this.drawer;
        }
    }
};
</script>
