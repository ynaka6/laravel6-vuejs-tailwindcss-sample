<template>
    <header style="z-index: 30;">
        <div class="fixed w-full">
            <nav
                class="h-16 flex items-center justify-between flex-wrap px-6 p-3 bg-white shadow"
            >
                <div class="flex items-center flex-shrink-0 mr-6">
                    <router-link to="/" class="text-base xl:text-xl font-bold">
                        <span>Admin</span>
                    </router-link>
                </div>
                <div class="flex items-center">
                    <a href="#" @click.prevent="onClickLogout">
                        <span v-if="user">{{ user.name }}</span>
                        <font-awesome-icon
                            :icon="['fas', 'sign-out-alt']"
                            class="ml-2"
                        />
                    </a>
                </div>
            </nav>
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
            });
        },
        ...mapActions({
            logout: "auth/logout"
        })
    }
};
</script>
