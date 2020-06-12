const userRoutes = [
    {
        path: "/user/preview",
        name: "user-preview",
        component: () =>
            import(
                /* webpackChunkName: "user-preview" */ "../views/User/Preview.vue"
            ),
        meta: { layout: "home", requiresAuth: true }
    },
    {
        path: "/user/:id",
        name: "user-detail",
        component: () =>
            import(
                /* webpackChunkName: "user-detail" */ "../views/User/Detail.vue"
            ),
        meta: { layout: "home" }
    }
];
export default userRoutes;
