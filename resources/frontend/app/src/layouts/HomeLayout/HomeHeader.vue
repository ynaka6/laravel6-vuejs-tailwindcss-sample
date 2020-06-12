<template>
    <header>
        <div class="w-full bg-white border-b-4 border-purple-600">
            <div class="container mx-auto">
                <nav
                    class="flex items-center justify-between px-2 lg:px-6 py-3"
                >
                    <div class="flex items-center flex-shrink-0">
                        <router-link
                            to="/"
                            class="text-base xl:text-xl font-bold"
                        >
                            <img
                                src="@/assets/logo.png"
                                alt="Laravel6 & Vue.js Demo"
                                class="w-24"
                            />
                        </router-link>
                    </div>
                    <div class="w-full lg:w-auto mx-0">
                        <div v-if="user" class="flex items-center justify-end">
                            <div class="p-2">
                                <a href="#" @click.prevent="onClickLogout">
                                    <font-awesome-icon
                                        :icon="['fas', 'sign-out-alt']"
                                        class="ml-2"
                                    />
                                    Logout
                                </a>
                            </div>
                        </div>
                        <div v-else class="flex items-center justify-end">
                            <router-link
                                to="/login"
                                class="hidden lg:inline-block bg-purple-500 text-white text-sm text-center rounded-full px-6 py-1 shadow-lg hover:opacity-50 mr-2"
                            >
                                Login
                            </router-link>
                            <router-link
                                to="/register"
                                class="inline-block bg-orange-400 text-white text-sm text-center rounded-full px-6 py-1 shadow-lg hover:opacity-50"
                            >
                                Register
                            </router-link>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="w-full bg-purple-100 shadow">
            <div class="container mx-auto">
                <div class="flex flex-wrap font-bold text-sm">
                    <router-link
                        to="/"
                        class="w-1/2 lg:flex-1 text-center p-2 border-b border-r border-l lg:border-b-0 hover:bg-purple-500 hover:text-white"
                    >
                        Home
                    </router-link>
                    <router-link
                        to="/"
                        class="w-1/2 lg:flex-1 text-center p-2 border-b border-r border-l lg:border-b-0 hover:bg-purple-500 hover:text-white"
                    >
                        Search Posts
                    </router-link>
                    <router-link
                        to="/mypage/"
                        class="w-1/2 lg:block lg:flex-1 text-center p-2 border-r border-l hover:bg-purple-500 hover:text-white"
                    >
                        MyPage
                    </router-link>
                    <router-link
                        to="/"
                        class="w-1/2 lg:block lg:flex-1 text-center p-2 border-r border-l hover:bg-purple-500 hover:text-white"
                    >
                        Help
                    </router-link>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    computed: {
        ...mapGetters({
            user: "auth/user"
        })
    },
    methods: {
        onClickLogout() {
            this.logout().then(() => {
                this.$router.push("/login");
                this.currentUser();
            });
        },
        ...mapActions({
            logout: "auth/logout",
            currentUser: "auth/currentUser"
        })
    }
};
</script>
