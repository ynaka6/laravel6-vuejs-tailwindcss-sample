import Vue from "vue";
import VueRouter from "vue-router";
import Overview from "../views/Dashboard/Overview.vue";
import Login from "../views/Login.vue";
import store from "../store";

Vue.use(VueRouter);

const routes = [
    {
        path: "/login",
        name: "login",
        component: Login,
        meta: { requiresGuest: true }
    },
    {
        path: "/",
        name: "overview",
        component: Overview,
        meta: { layout: "dashboard", requiresAuth: true }
    },
    {
        path: "/staffs",
        name: "staffs",
        component: () =>
            import(
                /* webpackChunkName: "staffs" */ "../views/Dashboard/Staff/Index.vue"
            ),
        meta: { layout: "dashboard", requiresAuth: true }
    },
    {
        path: "/staff/create",
        name: "staff-create",
        component: () =>
            import(
                /* webpackChunkName: "staff-create" */ "../views/Dashboard/Staff/Create.vue"
            ),
        meta: { layout: "dashboard", requiresAuth: true }
    },
    {
        path: "/staff/:id/edit",
        name: "staff-edit",
        component: () =>
            import(
                /* webpackChunkName: "staff-edit" */ "../views/Dashboard/Staff/Edit.vue"
            ),
        meta: { layout: "dashboard", requiresAuth: true }
    }
];

const router = new VueRouter({
    mode: "history",
    base: "/admin",
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 };
        }
    }
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters["auth/loggedIn"]) {
            next({ path: "/login" });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.requiresGuest)) {
        if (store.getters["auth/loggedIn"]) {
            next({ path: "/" });
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router;
