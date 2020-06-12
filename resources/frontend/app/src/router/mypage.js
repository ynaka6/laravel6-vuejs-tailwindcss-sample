const mypageRoutes = [
    {
        path: "/mypage/register",
        name: "mypage-register",
        component: () =>
            import(
                /* webpackChunkName: "mypage-register" */ "../views/Mypage/Register.vue"
            ),
        meta: { layout: "home", requiresAuth: true }
    },
    {
        path: "/mypage",
        name: "mypage",
        component: () =>
            import(
                /* webpackChunkName: "mypage" */ "../views/Mypage/Overview.vue"
            ),
        meta: { layout: "home", requiresMypage: true }
    },
    {
        path: "/mypage/profile",
        name: "mypage-profile",
        components: {
            default: () =>
                import(
                    /* webpackChunkName: "mypage" */ "../views/Mypage/Overview.vue"
                ),
            modal: () =>
                import(
                    /* webpackChunkName: "mypage-profile" */ "../views/Mypage/Profile.vue"
                )
        },
        meta: { layout: "home", requiresMypage: true }
    },
    {
        path: "/mypage/change-mail",
        name: "mypage-change-mail",
        components: {
            default: () =>
                import(
                    /* webpackChunkName: "mypage" */ "../views/Mypage/Overview.vue"
                ),
            modal: () =>
                import(
                    /* webpackChunkName: "mypage-change-mail" */ "../views/Mypage/ChangeMail.vue"
                )
        },
        meta: { layout: "home", requiresMypage: true }
    },
    {
        path: "/mypage/change-password",
        name: "mypage-change-password",
        components: {
            default: () =>
                import(
                    /* webpackChunkName: "mypage" */ "../views/Mypage/Overview.vue"
                ),
            modal: () =>
                import(
                    /* webpackChunkName: "mypage-change-mail" */ "../views/Mypage/ChangePassword.vue"
                )
        },
        meta: { layout: "home", requiresMypage: true }
    },
    {
        path: "/mypage/activities",
        name: "mypage-activity",
        component: () =>
            import(
                /* webpackChunkName: "mypage-activity" */ "../views/Mypage/Activity.vue"
            ),
        meta: { layout: "home", requiresMypage: true }
    },
    {
        path: "/mypage/leave",
        name: "mypage-leave",
        components: {
            default: () =>
                import(
                    /* webpackChunkName: "mypage" */ "../views/Mypage/Overview.vue"
                ),
            modal: () =>
                import(
                    /* webpackChunkName: "mypage-profile" */ "../views/Mypage/Leave.vue"
                )
        },
        meta: { layout: "home", requiresMypage: true }
    }
];
export default mypageRoutes;
